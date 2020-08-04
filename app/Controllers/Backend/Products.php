<?php namespace App\Controllers\Backend;

use CodeIgniter\Controller;

Class Products extends Controller{
    protected $request;

    //Construct
    public function __construct(){
        //Check Login
        if(isset(session()->login_) != 1){
            header("Location: ".base_url().'/login');
            exit();
        }

        $this->request = \Config\Services::request();
    }

    //Index
    public function index(){
        //Call Products Model
        $products_model = new \App\Models\MProducts();

        $data = [
            'products' => $products_model->findAll()
        ];
        echo view('backend/modules/products/v_index',$data);
    } 

    //Add Products
    public function add(){
        //Call Form Helper
        helper('form');

        //Call Product Categories Model
        $product_categories_model = new \App\Models\MProductCategories();

        $data = [
            'product_categories' => $product_categories_model->findAll()
        ];

        echo view('backend/modules/products/v_add',$data);
    }

    //Save Products
    public function update(){
        //Call Products Model
        $products_model = new \App\Models\MProducts();

        //Initialize Variable
        $data = [];

        //Check User Upload Images?
        if($images = $this->request->getFile('images')){
            if ($images->isValid() && ! $images->hasMoved()){
                //Rename Images File
                $images_name = $images->getRandomName();

                //Uploading Proccess
                $images->move(ROOTPATH.'uploaded_images',$images_name);

                //If User Update Image, Update in Database
                $data['images'] = $images_name;
            }            
        }

        //Setting Field to Update
        $id = $this->request->getPost('id');
        $data += [
            'product_categories_id' => $this->request->getPost('product_categories_id'),
            'product_name' => $this->request->getPost('product_name'),
            'stock' => $this->request->getPost('stock'),
            'weight' => $this->request->getPost('weight'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description'),
        ];

        if($products_model->update($id,$data)){
            $save_success = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-check'></i> Data Produk Berhasil Diubah</h6>                
            </div>";

            session()->setFlashData('info',$save_success);
        }else{
            $save_error = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-ban'></i> Data Produk Gagal Diubah</h6>                
            </div>";

            session()->setFlashData('info',$save_error);
        }
        return redirect()->to(base_url('Backend/Products'));
    }

    //Detail Products
    public function detail($id = null){
        if($id == null){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }else{
            //Call Products Model
            $products_model = new \App\Models\MProducts();

            //Search Data On Database
            $product = $products_model->find($id);
            //Check Data Must Found on Database
            if(is_array($product)){
                //Load Helper
                helper('form');

                //Passing Data to View
                $data = [
                    'record' => $product
                ];
                echo view('backend/modules/products/v_detail',$data);
            }else{
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    //Edit Products
    public function edit($id = null){
        if($id == null){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }else{
            //Call Products Model
            $products_model = new \App\Models\MProducts();
            //Call Product Categories Model
            $product_categories_model = new \App\Models\MProductCategories();

            //Search Data On Database
            $product = $products_model->find($id);
            //Check Data Must Found on Database
            if(is_array($product)){
                //Load Helper
                helper('form');

                //Passing Data to View
                $data = [
                    'record' => $product,
                    'product_categories' => $product_categories_model->findAll()
                ];
                echo view('backend/modules/products/v_edit',$data);
            }else{
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    //Update Products
    public function save(){
        //Call Products Model
        $products_model = new \App\Models\MProducts();

        //Initialize Variable
        $images_name = "";

        //Check User Upload Images?
        if($images = $this->request->getFile('images')){
            if ($images->isValid() && ! $images->hasMoved()){
                //Rename Images File
                $images_name = $images->getRandomName();

                //Uploading Proccess
                $images->move(ROOTPATH.'uploaded_images',$images_name);
            }      
        }

        $data = [
            'product_categories_id' => $this->request->getPost('product_categories_id'),
            'product_name' => $this->request->getPost('product_name'),
            'stock' => $this->request->getPost('stock'),
            'weight' => $this->request->getPost('weight'),
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description'),
            'images' => $images_name
        ];

        if($products_model->insert($data)){
            $save_success = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-check'></i> Data Produk Berhasil Diinput</h6>                
            </div>";

            session()->setFlashData('info',$save_success);
        }else{
            $save_error = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-ban'></i> Data Produk Gagal Diinput</h6>                
            </div>";

            session()->setFlashData('info',$save_error);
        }

        return redirect()->to(base_url('Backend/Products'));

    }



    //Delete Products
    public function delete($id = null){
        //Call Products Model
        $products_model = new \App\Models\MProducts();
        if($products_model->delete($id)){
            $save_success = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-check'></i> Data Produk Berhasil Dihapus</h6>                
            </div>";

            session()->setFlashData('info',$save_success);
        }else{
            $save_error = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-ban'></i> Data Produk Gagal Dihapus</h6>                
            </div>";

            session()->setFlashData('info',$save_error);
        }

        return redirect()->to(base_url('Backend/Products'));
    }

    //Seed
    public function seed(){
        //Call Products Model
        $products_model = new \App\Models\MProducts();

        for($i=0;$i<500;$i++){
            $data = [
                'product_categories_id' => 1,
                'product_name' => 'Produk'.$i,
                'stock' => $i,
                'price' => $i,
                'description' => 'Desc'.$i,
                'images' => ''
            ];

            $products_model->insert($data);
        }
    }
}

