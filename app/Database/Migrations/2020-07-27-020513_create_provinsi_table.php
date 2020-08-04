<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProvinsiTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'province_id' => [
				'type' => 'INT',
				'constraint' => 2,
			],
			'province' => [
				'type' => 'VARCHAR',
				'constraint' => 20,
			],
		]);

		$this->forge->addKey('province_id', TRUE);
		$this->forge->createTable('province');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('province');
	}
}
