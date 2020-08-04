<?php namespace App\Models;

use CodeIgniter\Model;

class MSalesDetail extends Model
{
    protected $table      = 'sales_details';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id','sales_id','products_id','unit_weight','unit_price','quantity','weight_subtotal','price_subtotal']; 
}