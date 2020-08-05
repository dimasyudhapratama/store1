<?php namespace App\Controllers\Backend;

use CodeIgniter\Controller;

Class Proofofpayment extends Controller{
    protected $request;

    function __construct(){
        //Check Login
        if(isset(session()->login_) != 1){
            header("Location: ".base_url().'/login');
            exit();
        }

        $this->request = \Config\Services::request();
    }

    //Index
    public function index(){
        //Load Database
        $db      = \Config\Database::connect();

        $proof_of_payments = $db->table('proof_of_payments')
        ->select('proof_of_payments.id, sales_date, transfer_date, transfer_amount, bank_name, bank_account_name, bank_account_number, proof_of_payment_image')
        ->join('bank_accounts','proof_of_payments.bank_accounts_id = bank_accounts.id')
        ->get();

        $data = ['proof_of_payments' => $proof_of_payments->getResultArray()];

        //Load Helper
        helper('form');

        echo view('backend/modules/proof_of_payment/v_index',$data);
    }

    public function delete($id = NULL){
        $proof_of_payments = new \App\Models\MProofOfPayments();
        
        if($proof_of_payments->delete($id)){
            $save_success = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-check'></i> Data Bukti Pembayaran Berhasil Dihapus</h6>                
            </div>";

            session()->setFlashData('info',$save_success);
        }else{
            $save_error = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-ban'></i> Data Bukti Pembayaran Gagal Dihapus</h6>                
            </div>";

            session()->setFlashData('info',$save_error);
        }

        return redirect()->to(base_url('Backend/ProofOfPayment'));
    }
}

