<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'auto_increment' => TRUE
			],
			'nickname' => [
				'type' => 'VARCHAR',
				'constraint' => 40,
			],
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => 30,
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => 60,
			],
			'level' => [
				'type' => 'ENUM',
				'constraint' => ['Admin']
			],
			
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
