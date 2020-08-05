<?php namespace App\Controllers;

use CodeIgniter\Controller;

Class Shoppingcart extends Controller{
    //Initialization
    private $product_categories_model;
    private $products_model;
    protected $request;

    //Construct
    function __construct(){
        $this->product_categories_model = new \App\Models\MProductCategories();
        $this->products_model = new \App\Models\MProducts();
        $this->request = \Config\Services::request();
    }

    //Index
    public function index(){
        //Data For Navbar
        $data['product_categories'] = $this->product_categories_model->findAll();

        //Data For this Page
        $data['items'] = json_decode($this->cart(),true);
        $data['total_items'] = json_decode($this->getTotalItem());
        echo view('v_frontend/modules/cart/v_index',$data);
    } 

    //Data Cart
    public function cart(){
        $items = session()->has('cart') ? array_values(session('cart')) : array();
        return json_encode($items);
    }

    //Buy
    public function buy(){
        $id = $this->request->getPost('id');
        $quantity = $this->request->getPost('quantity');
        $increment = $this->request->getPost('increment');

        $product = $this->products_model->find($id);
        $weight = $product['weight'];
        $item = array(
            'id' => $product['id'],
            'product_name' => $product['product_name'],
            'unit_weight' => $weight,
            // 'weight' => $weight * $quantity,
            'price' => $product['price'],
            'quantity' => $quantity,
            
        );

        $session = session();
        if(session()->has('cart')){
            $index = $this->exist($id);
            $cart = array_values(session('cart'));
            if($index == -1){
                array_push($cart, $item);                
            }else{
                // $increment == true ?   : $cart[$index]['quantity'] += $quantity;
                if($increment == "true"){
                    // $cart[$index]['weight'] += $weight * $quantity;
                    $cart[$index]['quantity'] += $quantity ;
                }else if($increment == "false"){
                    // $cart[$index]['weight'] = $weight * $quantity;
                    $cart[$index]['quantity'] = $quantity;
                }
                
            }
            session()->set('cart',$cart);
        }else{            
            $cart = array($item);      
            session()->set('cart',$cart);      
        }

        // session()->set('cart',$cart);

        
    }

    function exist($id){
        $items = array_values(session('cart'));

        for($i = 0;$i < count($items); $i++){
            if($items[$i]['id'] == $id){
                return $i;
            }
        }
        return -1;

    }

    function getTotalItem(){
        $total = session()->has('cart') ? count(array_values(session('cart'))) : 0;
        
        return json_encode($total);
    }

    function getWeightTotal(){
        $weight_total = 0;
        $items = session()->has('cart') ? array_values(session('cart')) : array();
        foreach($items as $item){
            $weight_total += $item['unit_weight'] * $item['quantity'];
        }

        return "".$weight_total;

    }
    function getGrandTotal(){
        $grand_total = 0;
        $items = session()->has('cart') ? array_values(session('cart')) : array();
        foreach($items as $item){
            $grand_total += $item['price'] * $item['quantity'];
        }

        // return "Rp. ".number_format($grand_total,0,',','.');
        return "".$grand_total;

    }

    function remove($id){
        $index = $this->exist($id);
        if($index > -1){
            $items = array_values(session('cart'));
            unset($items[$index]);
            session()->set('cart',$items);
        }
    }
}

