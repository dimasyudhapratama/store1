<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCityTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'city_id' => [
				'type' => 'INT',
				'constraint' => 2,
			],
			'province_id' => [
				'type' => 'INT',
				'constraint' => 2,
			],
			'city_name' => [
				'type' => 'VARCHAR',
				'constraint' => 20,
			],
		]);

		$this->forge->addKey('city_id', TRUE);
		$this->forge->createTable('city');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('city');
	}
}
