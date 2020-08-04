<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSalesTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 10
			],
			'transaction_time' => [
				'type' => 'DATETIME'
			],
			'price_total' => [
				'type' => 'INT',
				'constraint' => 7,
			],
			'courier' => [
				'type' => 'VARCHAR',
				'constraint' => 18
			],
			'shipping_price' => [
				'type' => 'INT',
				'constraint' => 7,
			],
			'unique_code' => [
				'type' => 'INT',
				'constraint' => 7,
			],
			'grand_total' => [
				'type' => 'INT',
				'constraint' => 7,
			],
			'city_code' => [
				'type' => 'INT',
				'constraint' => 4,
			],
			'full_address' => [
				'type' => 'TEXT'
			],
			'transaction_status' => [
				'type' => 'ENUM',
				'constraint' => ['1','2','3']
				//Code : Deskripsi
				// 1 : Menunggu Pembayaran
				// 2 : Pesanan Diproses
				// 3 : Barang Dikirim
			]
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('sales');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('sales');
	}
}
