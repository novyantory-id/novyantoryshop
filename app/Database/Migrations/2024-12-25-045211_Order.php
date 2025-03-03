<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
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
            'user_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'       => true,
            ],
            'nomor_pesanan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '20',
                'unique'    => true,
            ],
            'total_harga_keseluruhan' => [
                'type'          => 'INT',
                'constraint'    => 11,
            ],
            'status_order' => [
                'type' => 'ENUM',
                'constraint'    => ['pending', 'confirmed', 'packing', 'sending', 'shipping', 'finished'],
                'default' => 'pending',
                'null' => false
            ],
            'created_order_at' => [
                'type'          => 'DATETIME',
                'null'       => true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('order');
    }

    public function down()
    {
        $this->forge->dropTable('order');
    }
}
