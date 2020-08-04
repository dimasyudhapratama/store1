<?php namespace App\Models;

use CodeIgniter\Model;

class MProvince extends Model
{
    protected $table      = 'province';
    // protected $primaryKey = 'province_id';

    protected $allowedFields = ['province_id','province'];
}