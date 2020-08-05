<?php namespace App\Controllers\Backend;

use CodeIgniter\Controller;

Class Users extends Controller{
    private $users_model;
    protected $request;

    //Construct
    function __construct(){
        //Check Login
        if(isset(session()->login_) != 1){
            header("Location: ".base_url().'/login');
            exit();
        }

        $this->users_model = new \App\Models\MUsers();
        $this->request = \Config\Services::request();
    }

    //Index
    public function index(){
        $data = [
            'users' => $this->users_model->findAll()
        ];
        echo view('backend/modules/users/v_index',$data);
    } 

    //Add Users
    public function add(){
        helper('form');
        echo view('backend/modules/users/v_add');
    }

    //Save Action
    public function save(){
        $data = [
            'nickname' => $this->request->getPost('nickname'),
            'username' => $this->request->getPost('username'),
            'level' => $this->request->getPost('level'),
            'password' => password_hash($this->request->getPost('password_'),PASSWORD_DEFAULT),
        ];
        
        if($this->users_model->insert($data)){
            $save_success = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-check'></i> Data Pengguna Berhasil Diinput</h6>                
            </div>";

            session()->setFlashData('info',$save_success);
        }else{
            $save_error = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-ban'></i> Data Pengguna Gagal Diinput</h6>                
            </div>";

            session()->setFlashData('info',$save_error);
        }

        return redirect()->to(base_url('backend/users'));
    }

    //Edit Users
    public function edit($id = null){
        if($id == null){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }else{
            //Search Data On Database
            $users = $this->users_model->find($id);
            //Check Data Must Found on Database
            if(is_array($users)){
                //Load Helper
                helper('form');

                //Passing Data to View
                $data = [
                    'record' => $users
                ];
                echo view('backend/modules/users/v_edit',$data);
            }else{
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    function update(){
        $id = $this->request->getPost('id');
        $data = [
            'nickname' => $this->request->getPost('nickname'),
            'username' => $this->request->getPost('username'),
            'level' => $this->request->getPost('level'),
        ];
        
        if($this->users_model->update($id,$data)){
            $save_success = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-check'></i> Data Pengguna Berhasil Diubah</h6>                
            </div>";

            session()->setFlashData('info',$save_success);
        }else{
            $save_error = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-ban'></i> Data Pengguna Gagal Diubah</h6>                
            </div>";

            session()->setFlashData('info',$save_error);
        }

        return redirect()->to(base_url('backend/users'));
    }

    //Edit User Password
    public function editPassword($id = null){
        if($id == null){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }else{
            //Search Data On Database
            $users = $this->users_model->find($id);
            //Check Data Must Found on Database
            if(is_array($users)){
                //Load Helper
                helper('form');

                //Passing Data to View
                $data = [
                    'record' => $users
                ];
                echo view('backend/modules/users/v_edit_password',$data);
            }else{
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }

    function updatePassword(){
        $id = $this->request->getPost('id');
        
        //Check Password and Confirmation Password Must Same
        if($this->request->getPost('password_') == $this->request->getPost('repassword_')){
            $data = [
                'password' => password_hash($this->request->getPost('password_'),PASSWORD_DEFAULT),
            ];

            if($this->users_model->update($id,$data)){
                $save_success = "<div class='alert alert-success alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h6><i class='icon fas fa-check'></i> Data Pengguna Berhasil Diubah</h6>                
                </div>";
    
                session()->setFlashData('info',$save_success);
            }else{
                $save_error = "<div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h6><i class='icon fas fa-ban'></i> Data Pengguna Gagal Diubah</h6>                
                </div>";
    
                session()->setFlashData('info',$save_error);
            }
        }else{
            $save_warning = "<div class='alert alert-warning alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h6><i class='icon fas fa-exclamation-triangle'></i> Password Tidak Sama, Silahkan Ulangi</h6>                
                </div>";
            session()->setFlashData('info',$save_warning);
        }             

        return redirect()->to(base_url('backend/users'));
    }

    public function delete($id = null){
        
        if($this->users_model->delete($id)){
            $save_success = "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-check'></i> Data Pengguna Berhasil Dihapus</h6>                
            </div>";

            session()->setFlashData('info',$save_success);
        }else{
            $save_error = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-ban'></i> Data Pengguna Gagal Dihapus</h6>                
            </div>";

            session()->setFlashData('info',$save_error);
        }

        return redirect()->to(base_url('backend/users'));
    }
}

