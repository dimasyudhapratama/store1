<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProofOfPaymentsTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE
			],
			'sales_date' => [
				'type' => 'DATE',
			],
			'bank_accounts_id' => [
				'type' => 'INT',
				'constraint' => 2,
			],
			'transfer_date' => [
				'type' => 'DATE',
			],
			'transfer_amount' => [
				'type' => 'INT',
				'constraint' => 11,
			],
			'proof_of_payment_image' => [
				'type' => 'VARCHAR',
				'constraint' => 225,
			],
			
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('bank_accounts_id','bank_accounts','id','RESTRICT','CASCADE');
		$this->forge->createTable('proof_of_payments');
		
		
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('proof_of_payments');
	}
}
