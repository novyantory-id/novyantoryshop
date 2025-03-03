<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
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
            'kode_produk' => [
                'type'          => 'VARCHAR',
                'constraint'    => '30',
            ],
            'nama_produk' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'berat_produk' => [
                'type'          => 'INT',
                'constraint'    => 5,
            ],
            'harga_produk' => [
                'type'          => 'INT',
                'constraint'    => 11,
            ],
            'deskripsi_produk' => [
                'type'          => 'TEXT',
            ],
            'deskripsi_panjang_produk' => [
                'type'          => 'TEXT',
            ],
            'images_produk_galeri' => [
                'type'          => 'VARCHAR',
                'constraint'    => '256',
            ],
            'images_produk_thumbnail' => [
                'type'          => 'VARCHAR',
                'constraint'    => '256',
            ],
            'is_promo' => [
                'type'          => 'BOOLEAN',
                'default'    => false,
            ],
            'is_baru' => [
                'type'          => 'BOOLEAN',
                'default'    => false,
            ],
            'is_bestseller' => [
                'type'          => 'BOOLEAN',
                'default'    => false,
            ],
            'brand_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'       => true,
            ],
            'subsubkategori_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'       => true,
            ],
            'created_produk_at' => [
                'type'          => 'DATETIME',
                'null'       => true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('brand_id', 'brand', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('subsubkategori_id', 'subsubkategori', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('produk');
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
