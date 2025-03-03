<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Subsubkategori extends Migration
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
            'subsubkategori' => [
                'type'          => 'VARCHAR',
                'constraint'    => '30',
            ],
            'slug_subsubkategori' => [
                'type'          => 'VARCHAR',
                'constraint'    => '30',
            ],
            'subkategori_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'       => true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('subkategori_id', 'subkategori', 'id');
        $this->forge->createTable('subsubkategori');
    }

    public function down()
    {
        $this->forge->dropTable('subsubkategori');
    }
}
