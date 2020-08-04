<?php namespace App\Models;

use CodeIgniter\Model;

class MProofOfPayments extends Model
{
    protected $table      = 'proof_of_payments';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id','sales_date','bank_accounts_id','transfer_date','transfer_amount','proof_of_payment_image']; 
}