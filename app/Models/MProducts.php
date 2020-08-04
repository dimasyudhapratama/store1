<?php namespace App\Models;

use CodeIgniter\Model;

class MProducts extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'id';

    protected $allowedFields = ['product_categories_id','product_name','stock','price','description','viewed_total','sold_total','images'];
}