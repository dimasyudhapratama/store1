<?php namespace App\Controllers;

use CodeIgniter\Controller;

Class ProductByCategory extends Controller{    
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
    public function index($id){
        //Data Passed to View
        $data = [
            //Data for Navbar
            'product_categories' => $this->product_categories_model->findAll(), //Kategori Produk

            //Only data for 1 page
            'product_category_name' => $this->product_categories_model->find($id)['category_name'],
            'product_total' => $this->products_model->where('product_categories_id',$id)->countAllResults()
        ];
        echo view('v_frontend/modules/product_by_category/v_product_by_category',$data);
    } 

    //Load Products
    public function loadProducts(){
        //Get Data from POST AJAX
        $url_data = $this->request->getPost('url_data');
        $offset = $this->request->getPost('offset');

        //Offset Digunakan untuk memandai record akan ditampilkan mulai index nomer berapa
        //Limit Digunakan Untuk Membatasi Jumlah Produk Yang Ditampilkan
        $limit = 8;

        //Mengambil Data Category ID dari URL
        $data_url_array = explode('/',$url_data);
        $category_id = intval(end($data_url_array));

        //Data Passed To View
        $products = $this->products_model->where('product_categories_id',$category_id)->findAll($limit,$offset);

        //Return Data to Ajax as JSON Data
        return json_encode($products);
    }
}

