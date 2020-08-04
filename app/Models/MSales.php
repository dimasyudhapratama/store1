<?php namespace App\Models;

use CodeIgniter\Model;

class MSales extends Model
{
    protected $table      = 'sales';
    protected $primaryKey = 'id';    
    
    
    protected $allowedFields = ['id','transaction_time','price_total','courier','shipping_price','unique_code','grand_total','city_code','full_address','transaction_status'];
}

