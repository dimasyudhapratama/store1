<?php namespace App\Models;

use CodeIgniter\Model;

class MBankAccounts extends Model
{
    protected $table      = 'bank_accounts';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id','bank_name','bank_account_name','bank_account_number']; 
}