<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSalesDetailTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 10,
				'auto_increment' => TRUE
			],
			'sales_id' => [
				'type' => 'INT',
				'constraint' => 10
			],
			'products_id' => [
				'type' => 'INT',
				'constraint' => 10
			],
			'unit_weight' => [
				'type' => 'INT',
				'constraint' => 10
			],
			'unit_price' => [
				'type' => 'INT',
				'constraint' => 10
			],
			'quantity' => [
				'type' => 'INT',
				'constraint' => 15
			],
			'weight_subtotal' => [
				'type' => 'INT',
				'constraint' => 8,
			],
			'price_subtotal' => [
				'type' => 'INT',
				'constraint' => 8,
			]
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('sales_id','sales','id','RESTRICT','CASCADE');
		$this->forge->addForeignKey('products_id','products','id','RESTRICT','CASCADE');
		$this->forge->createTable('sales_details');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sales_details');
	}
}
