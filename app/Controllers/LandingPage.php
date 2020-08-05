<?php namespace App\Controllers;

use CodeIgniter\Controller;

Class Landingpage extends Controller{    
    private $product_categories_model;
    private $products_model;    
    protected $request;

    //Construct
    public function __construct(){
        $this->product_categories_model = new \App\Models\MProductCategories();
        $this->products_model = new \App\Models\MProducts();
        $this->request = \Config\Services::request();
    }

    //Index
    public function index(){
        //Data Passed to View
        $data = [
            'product_categories' => $this->product_categories_model->findAll(), //Kategori Produk
            'latest_products' =>  $this->products_model->orderBy('id','desc')->findAll(6)
        ];
        echo view('v_frontend/modules/landing_page/v_landing_page',$data);
    } 

    //Load Products
    public function loadProducts($offset=0){
        //Offset Digunakan untuk memandai record akan ditampilkan mulai index nomer berapa
        //Limit Digunakan Untuk Membatasi Jumlah Produk Yang Ditampilkan
        $limit = 8;

        //Data Passed To View
        $products = $this->products_model->findAll($limit,$offset);

        //Return Data to Ajax as JSON Data
        return json_encode($products);
    }
}

