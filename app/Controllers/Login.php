<?php namespace App\Controllers;

use CodeIgniter\Controller;

Class Login extends Controller{   
    protected $request;

    //Construct
    public function __construct(){
        $this->request = \Config\Services::request();
    }

    //Index
    public function index(){
        helper('form');
        echo view('login/v_login');
    }

    public function signIn(){        
        //Call User Models
        $user = new \App\Models\MUsers();

        //Get Post Request Data From View
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password_');

        // print_r($user->where('username',$username)->countAllResults());
        // return;
        //Check User if Exist
        if($user->where('username',$username)->countAllResults() == 1){
            //If Exist, Get Password Hashed. and verify that with input from form
            $user_data = $user->select('password')->where('username',$username)->first();            
            
            //Verify Password
            if(password_verify($password, $user_data['password'])){
                //If Password Match, Get User Data,Save Login Session & Redirect to Admin Dashboard
                $user_data = $user->select('nickname, username')->where('username',$username)->first();

                $data_login = [
                    'nickname' => $user_data['nickname'],
                    'username' => $user_data['username'],
                    'login_' => 1
                ];
                session()->set($data_login);

                return redirect()->to(base_url('backend/dashboard'));   

            }else{
                //if password not match, redirect to Login with flash messages info
                $info = "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h6><i class='icon fas fa-ban'></i> Username / Password Salah</h6>                
                </div>";
                session()->setFlashData('info',$info);                

                return redirect()->to(base_url('login'));   
            }

        }else{
            //If Not Exist, redirect to Login with flash message info
            $info = "<div class='alert alert-danger alert-dismissible'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h6><i class='icon fas fa-ban'></i> Username / Password Salah</h6>                
            </div>";
            session()->setFlashData('info',$info);                
            
            return redirect()->to(base_url('login'));    
        }
    }

    public function signOut(){
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

}