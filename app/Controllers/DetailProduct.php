<?php namespace App\Controllers;

use CodeIgniter\Controller;

Class DetailProduct extends Controller{
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
        //Data For Navbar
        $data['product_categories'] = $this->product_categories_model->findAll();

        //Proccess Data
        //Get Detail Product
        $data['product'] = $this->products_model->find($id); //Data Product

        //Get Product Category ID
        $product_categories_id = $data['product']['product_categories_id'];
        
        //Get Product Category Name of Product
        $data['product_category_name'] = $this->product_categories_model->find($product_categories_id)['category_name'];

        //Get Random Related Products
        $total_product_with_same_category = $this->products_model->where('product_categories_id',$product_categories_id)->countAllResults();
        $offset_number = $total_product_with_same_category > 6 ? mt_rand(0,$total_product_with_same_category - 6) : 0; 

        //Get Related Products
        $data['related_products'] = $this->products_model->where('product_categories_id',$product_categories_id)->findAll(6,$offset_number);//Show Related Products

        echo view('v_frontend/modules/detail_product_page/v_detail_product_page',$data);
    } 
}

