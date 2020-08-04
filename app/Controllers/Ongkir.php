<?php namespace App\Controllers;

use CodeIgniter\Controller;

Class Ongkir extends Controller{    
    protected $request;

    //Construct
    public function __construct(){
        $this->product_categories_model = new \App\Models\MProductCategories();
        $this->products_model = new \App\Models\MProducts();
        $this->request = \Config\Services::request();
    }

    public function province(){
        $province = new \App\Models\MProvince();
        echo json_encode($province->findAll(),true);
    }

    public function city($province_id){
        $city = new \App\Models\MCity();
        echo json_encode($city->where('province_id',$province_id)->findAll(),true);
    }
}