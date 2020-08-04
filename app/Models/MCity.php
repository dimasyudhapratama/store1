<?php namespace App\Models;

use CodeIgniter\Model;

class MCity extends Model
{
    protected $table      = 'city';
    protected $primaryKey = 'city_id';
    protected $allowedFields = ['city_id','province_id','city_name'];
}