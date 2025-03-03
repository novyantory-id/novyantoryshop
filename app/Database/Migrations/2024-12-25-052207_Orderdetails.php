<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orderdetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'order_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'       => true,
            ],
            'produk_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'       => true,
            ],
            'variasi' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'harga_varian_order' => [
                'type'          => 'INT',
                'constraint'    => 11,
            ],
            'kuantitas' => [
                'type'          => 'INT',
                'constraint'    => 11,
            ],
            'subtotal' => [
                'type'          => 'INT',
                'constraint'    => 11,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('order_id', 'order', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('produk_id', 'produk', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('orderdetails');
    }

    public function down()
    {
        $this->forge->dropTable('orderdetails');
    }
}
