<?php namespace App\Models;

use CodeIgniter\Model;

class MProductCategories extends Model
{
    protected $table      = 'product_categories';
    protected $primaryKey = 'id';

    protected $allowedFields = ['category_name'];
}