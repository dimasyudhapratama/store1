<?php namespace App\Controllers\Backend;

use CodeIgniter\Controller;

Class ProductCategories extends Controller{
    private $product_categories_model;
    protected $request;

    //Construct
    function __construct(){
        //Check Login
        if(isset(session()->login_) != 1){
            header("Location: ".base_url().'/login');
            exit();
        }

        $this->product_categories_model = new \App\Models\MProductCategories();
        $this->request = \Config\Services::request();
    }

    //Index
    public function index(){
        $data = [
            'product_categories' => $this->product_categories_model->findAll()
        ];
        echo view('backend/modules/product_categories/v_index',$data);
    } 

    //Add Products
    public function add(){
        helper('form');
        echo view('backend/modules/product_categories/v_add');
    }

    //Save Action
    public function save(){
        $data = [
            'category_name' => $this->request->getPost('category_name')
        ];
        
        if($this->product_categories_model->insert($data)){
            $save_success = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-check'></i> Data Kategori Produk Berhasil Diinput</h6>                
            </div>";

            session()->setFlashData('info',$save_success);
        }else{
            $save_error = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-ban'></i> Data Kategori Produk Gagal Diinput</h6>                
            </div>";

            session()->setFlashData('info',$save_error);
        }

        return redirect()->to(base_url('Backend/ProductCategories'));
    }

    //Edit Products
    public function edit($id = null){
        if($id == null){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }else{
            //Search Data On Database
            $product_categories = $this->product_categories_model->find($id);
            //Check Data Must Found on Database
            if(is_array($product_categories)){
                //Load Helper
                helper('form');

                //Passing Data to View
                $data = [
                    'record' => $product_categories
                ];
                echo view('backend/modules/product_categories/v_edit',$data);
            }else{
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    function update(){
        $id = $this->request->getPost('id');
        $data = ['category_name' => $this->request->getPost('category_name')];
        
        if($this->product_categories_model->update($id,$data)){
            $save_success = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-check'></i> Data Kategori Produk Berhasil Diubah</h6>                
            </div>";

            session()->setFlashData('info',$save_success);
        }else{
            $save_error = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-ban'></i> Data Kategori Produk Gagal Diubah</h6>                
            </div>";

            session()->setFlashData('info',$save_error);
        }

        return redirect()->to(base_url('Backend/ProductCategories'));
    }

    public function delete($id = null){
        
        if($this->product_categories_model->delete($id)){
            $save_success = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-check'></i> Data Kategori Produk Berhasil Dihapus</h6>                
            </div>";

            session()->setFlashData('info',$save_success);
        }else{
            $save_error = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-ban'></i> Data Kategori Produk Gagal Dihapus</h6>                
            </div>";

            session()->setFlashData('info',$save_error);
        }

        return redirect()->to(base_url('Backend/ProductCategories'));
    }
}

