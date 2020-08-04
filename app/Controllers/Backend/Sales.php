<?php namespace App\Controllers\Backend;

use CodeIgniter\Controller;

Class Sales extends Controller{
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
        $sales = new \App\Models\MSales();

        $data = [
            'sales' => $sales->select('id,transaction_time,grand_total,transaction_status')->findAll()
        ];

        //Load Helper
        helper('form');

        echo view('backend/modules/sales/v_index',$data);
    }

    public function detail($id = NULL){
        if($id == null){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }else{
            //Load Database
            $db      = \Config\Database::connect();

            //Load Sales Model
            $sales = new \App\Models\MSales();     
            
            //Load City Model
            $city = new \App\Models\MCity();

            //Search Data On Database
            $sales_data = $sales->find($id);
            //Check Data Must Found on Database
            if(is_array($sales_data)){

                $detail_sales_data = $db->table('sales_details')
                                        ->select('products.product_name,quantity,weight_subtotal, price_subtotal')
                                        ->join('products','sales_details.products_id = products.id')
                                        ->where('sales_details.sales_id',$id)
                                        ->get();

                //Passing Data to View
                $data = [
                    'record' => $sales_data,

                    //Data Kota Dipanggil Langsung Untuk Meminimalisir Join untuk menghindari penurunan kecepatan
                    'city' => $city->select('city_name')->find($sales_data['city_code']), 

                    'detail_sales_data' => $detail_sales_data->getResultArray()
                ];
                echo view('backend/modules/sales/v_detail',$data);
            }else{
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    function getSalesData($sales_id){
        $sales = new \App\Models\MSales();

        $sales_data = $sales->select('id,transaction_status')->find($sales_id);
        return json_encode($sales_data);
    }

    function updateStatus(){
        //Load Model
        $sales = new \App\Models\MSales();

        //Get Data From View
        $id = $this->request->getPost('id');
        $data = ['transaction_status' => $this->request->getPost('status')];
        
        if($sales->update($id,$data)){
            $save_success = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-check'></i> Data Penjualan Berhasil Diubah</h6>                
            </div>";

            session()->setFlashData('info',$save_success);
        }else{
            $save_error = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-ban'></i> Data Penjualan Gagal Diubah</h6>                
            </div>";

            session()->setFlashData('info',$save_error);
        }

        return redirect()->to(base_url('Backend/Sales'));
    }

    public function delete($id = NULL){
        $sales = new \App\Models\MSales();
        $sales_detail = new \App\Models\MSalesDetail();

        $sales_detail->where('sales_id',$id)->delete();
        
        if($sales->delete($id)){
            $save_success = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-check'></i> Data Penjualan Berhasil Dihapus</h6>                
            </div>";

            session()->setFlashData('info',$save_success);
        }else{
            $save_error = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-ban'></i> Data Penjualan Gagal Dihapus</h6>                
            </div>";

            session()->setFlashData('info',$save_error);
        }

        return redirect()->to(base_url('Backend/Sales'));
    }
}

