<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Stokproduk extends Migration
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
            'produk_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'       => true,
            ],
            'warna' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'ukuran' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'stok' => [
                'type'          => 'INT',
                'default'    => 0,
            ],
            'harga_varian' => [
                'type'          => 'INT',
                'constraint'    => 11,
            ],
            'created_stok_at' => [
                'type'          => 'DATETIME',
                'null'       => true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('produk_id', 'produk', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('stokproduk');
    }

    public function down()
    {
        $this->forge->dropTable('stokproduk');
    }
}
