<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBankTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 2,
				'auto_increment' => TRUE
			],
			'bank_name' => [
				'type' => 'VARCHAR',
				'constraint' => 35,
			],
			'bank_account_name' => [
				'type' => 'VARCHAR',
				'constraint' => 35,
			],
			'bank_account_number' => [
				'type' => 'VARCHAR',
				'constraint' => 20,
			],
			
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('bank_accounts');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('bank_accounts');
	}
}
