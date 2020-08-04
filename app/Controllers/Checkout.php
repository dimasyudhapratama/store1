<?php namespace App\Controllers;

use CodeIgniter\Controller;

Class Checkout extends Controller{
    //Initialization
    protected $request;

    //Construct
    function __construct(){
        $this->request = \Config\Services::request();
    }

    //Index
    public function index(){
        //Data For Navbar
        $product_categories_model = new \App\Models\MProductCategories();
        $data['product_categories'] = $product_categories_model->findAll();

        //Data For this Page
        $data['cart'] = json_decode($this->cart(),true);
        echo view('v_frontend/modules/checkout_page/v_index',$data);
    } 

    //Data Cart
    public function cart(){
        $items = session()->has('cart') ? array_values(session('cart')) : array();
        return json_encode($items);
    }

    //Order
    public function order(){
        //Cek, Untuk Order, harus ada produk yang dibeli
        if(session()->has('cart')){
            //Iniisialisasi Model
            $sales = new \App\Models\MSales();
            $sales_detail = new \App\Models\MSalesDetail();

            //Data to be inserted to table 'Sales'
            $price_total = $this->request->getPost('price_total');
            $courier = $this->request->getPost('courier');
            $shipping_price = $this->request->getPost('shipping_price');
            $unique_code = random_int(1,300);
            $grand_total = $price_total + $shipping_price + $unique_code;
            $city_code = $this->request->getPost('city_code');
            $full_address = $this->request->getPost('full_address');

            $sales_id = $this->autoCodePrimaryKey();
            $data = [
                'id' => $sales_id,
                'transaction_time' => date('Y-m-d H:i:s'),
                'price_total' => $price_total,
                'courier' => $courier,
                'shipping_price' => $shipping_price,
                'unique_code' => $unique_code,
                'grand_total' => $grand_total,
                'city_code' => $city_code,
                'full_address' => $full_address,
                'transaction_status' => 1
            ];
            //Insert to Sales Table
            $sales->insert($data);
            $items = array_values(session('cart'));
            foreach($items as $item){
                $data_detail = [
                    'sales_id' => $sales_id,
                    'products_id' => $item['id'],
                    'unit_weight' => $item['unit_weight'],
                    'unit_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'weight_subtotal' => $item['quantity'] * $item['unit_weight'],
                    'price_subtotal' => $item['quantity'] * $item['price'],
                ];

                $sales_detail->insert($data_detail);
            }
            
            session()->remove('cart');

            $json_for_return = [
                'messages' => '1',
                'sales_id' => $sales_id
            ];
        }else{
            $json_for_return = [
                'messages' => '0'
            ];
        }
        
        $json_for_return = [
            'messages' => '1',
            'sales_id' => $sales_id
        ];
        return json_encode($json_for_return);
        
        // return redirect()->to(base_url('checkoutinformation/'.$sales_id));
    }

    //Auto Code
    public function autoCodePrimaryKey(){
        //Initalize Variable
        $sales = new \App\Models\MSales();

        //Count Transaction This Day
        $sales_on_this_day = $sales->where('DATE(transaction_time)',date('Y-m-d'))->countAll();
        $new_number = $sales_on_this_day+1;
        $new_code = date('ymd').$new_number;
        return $new_code;
    }
}