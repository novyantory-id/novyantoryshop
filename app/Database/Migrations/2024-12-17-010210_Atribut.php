<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Atribut extends Migration
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
            'nama_atribut' => [
                'type'          => 'VARCHAR',
                'constraint'    => '25',
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('atribut');
    }

    public function down()
    {
        $this->forge->dropTable('atribut');
    }
}
