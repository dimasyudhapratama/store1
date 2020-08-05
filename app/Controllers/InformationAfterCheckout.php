<?php namespace App\Controllers;

use CodeIgniter\Controller;

Class Informationaftercheckout extends Controller{
    //Index
    public function index($id){
        //Data For Navbar
        $product_categories_model = new \App\Models\MProductCategories();
        $data['product_categories'] = $product_categories_model->findAll();

        //Data For this Page
        $sales = new \App\Models\MSales();
        $bank_accounts = new \App\Models\MBankAccounts();
        $data['sales_data'] =  $sales->select('id,transaction_time,price_total,shipping_price,unique_code,grand_total,full_address,courier,transaction_status')->find($id);
        $data['bank_accounts'] = $bank_accounts->findAll();
        echo view('v_frontend/modules/information_after_checkout/v_index',$data);
    } 
}

