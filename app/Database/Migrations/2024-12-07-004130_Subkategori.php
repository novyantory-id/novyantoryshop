<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Subkategori extends Migration
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
            'subkategori' => [
                'type'          => 'VARCHAR',
                'constraint'    => '30',
            ],
            'slug_subkategori' => [
                'type'          => 'VARCHAR',
                'constraint'    => '30',
            ],
            'kategori_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'       => true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kategori_id', 'kategori', 'id');
        $this->forge->createTable('subkategori');
    }

    public function down()
    {
        $this->forge->dropTable('subkategori');
    }
}
