<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProdukAtribut extends Migration
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
            'atribut_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'       => true,
            ],
            'nilai_atribut' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('produk_id', 'produk', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('atribut_id', 'atribut', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('produkatribut');
    }

    public function down()
    {
        $this->forge->dropTable('produkatribut');
    }
}
