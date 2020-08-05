<?php namespace App\Controllers\Backend;

use CodeIgniter\Controller;

Class Dashboard extends Controller{

    function __construct(){
        //Check Login
        if(isset(session()->login_) != 1){
            header("Location: ".base_url().'/login');
            exit();
        }
    }

    //Index
    public function index(){
        echo view('backend/modules/dashboard/v_dashboard');
    } 

    public function dailyChart(){
        //Load Database
        $db = \Config\Database::connect();

        $all_data = [];
        $pendapatan_penjualan = [];
        $pendapatan_kode_unik = [];

        //Mencari Data Bulan Sekarang
        $last_date_in_month = date('t');

        //Looping
        for($date_increment=1;$date_increment<=$last_date_in_month;$date_increment++){
            //Tanggal
            $date = date('Y-m-').$date_increment;;

            $daily_sales = $db->query("SELECT COALESCE(SUM(price_total),0) AS daily_price_total, COALESCE(SUM(unique_code),0) AS daily_unique_code FROM sales WHERE DATE(transaction_time)='$date'")->getRowArray();

            $all_data[] = $daily_sales;
    
        }

        //Data Yang Akan Dikirim Ke Front End
        return json_encode($all_data);
    }

}

