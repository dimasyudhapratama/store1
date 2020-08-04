<?php namespace App\Controllers;

use CodeIgniter\Controller;

Class PaymentConfirmation extends Controller{
    //Index
    public function index(){
        //Data For Navbar
        $product_categories_model = new \App\Models\MProductCategories();
        $data['product_categories'] = $product_categories_model->findAll();

        //Data For This Page
        $bank_accounts = new \App\Models\MBankAccounts();
        $data['bank_accounts'] = $bank_accounts->findAll();
        
        helper('form');
        echo view('v_frontend/modules/payment_confirmation/v_index',$data);
    }

    //Save Payment Confirmation
    public function save(){
        $sales = new \App\Models\MSales();
        $proof_of_payments = new \App\Models\MProofOfPayments();

        //Initialize Variable
        $sales_date = $this->request->getPost('tanggal_pemesanan');
        $bank_accounts_id = $this->request->getPost('bank');
        $transfer_date = $this->request->getPost('tanggal_transfer');
        $transfer_amount = $this->request->getPost('jumlah_transfer');
        $images_name = "";
        $messages = [];
        
        //Check Data is Available in DB
        $check_sales_data = $sales->where('date(transaction_time)',$sales_date)->where('grand_total',$transfer_amount)->countAll();
        if($check_sales_data != 1){
            $messages = [
                'status' => '0',
                'messages' => 'Data Pemesanan Tidak Ditemukan',
            ];
            return json_encode($messages,true);
        }

        //Check User Upload Images?
        if($images = $this->request->getFile('bukti_transfer')){
            if ($images->isValid() && ! $images->hasMoved()){
                //Rename Images File
                $images_name = $images->getRandomName();

                //Uploading Proccess
                $images->move(ROOTPATH.'uploaded_images/bukti_transfer',$images_name);
            }            
        }else{
            $images_name = "";
        }

        $data = [
            'sales_date' => $sales_date,
            'bank_accounts_id' => $bank_accounts_id,
            'transfer_date' => $transfer_date,
            'transfer_amount' => $transfer_amount,
            'proof_of_payment_image' => $images_name
        ];

        if($proof_of_payments->insert($data)){
            $messages = [
                'status' => '1',
                'messages' => 'Konfirmasi Pembayaran Berhasil, Tunggu Beberapa Saat. Admin Akan Melakukan Pengecekan',
            ];
        }else{
            $messages = [
                'status' => '0',
                'messages' => 'Gagal',
            ];
        }

        return json_encode($messages);
    }
}