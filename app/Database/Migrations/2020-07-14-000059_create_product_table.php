<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'auto_increment' => TRUE
			],
			'product_categories_id' => [
				'type' => 'INT',
				'constraint' => 5,
			],
			'product_name' => [
				'type' => 'VARCHAR',
				'constraint' => 40,
			],
			'stock' => [
				'type' => 'INT',
				'constraint' => 7,
			],
			'weight' => [
				'type' => 'FLOAT',
				'constraint' => 10,
			],
			'price' => [
				'type' => 'INT',
				'constraint' => 10,
			],
			'description' => [
				'type' => 'TEXT'
			],
			'viewed_total' => [
				'type' => 'INT',
				'constraint' => 7,
			],
			'sold_total' => [
				'type' => 'INT',
				'constraint' => 7,
			],
			'images' => [
				'type' => 'VARCHAR',
				'constraint' => 225,
			],
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('product_categories_id','product_categories','id','RESTRICT','CASCADE');
		$this->forge->createTable('products');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('products');
	}
}
