<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductCategoriesTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'auto_increment' => TRUE
			],
			'category_name' => [
				'type' => 'VARCHAR',
				'constraint' => 40,
			],

		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('product_categories');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('product_categories');
	}
}
