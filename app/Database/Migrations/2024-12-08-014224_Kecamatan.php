<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kecamatan extends Migration
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
            'kecamatan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '35',
            ],
            'kabupaten_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'       => true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kabupaten_id', 'kabupaten', 'id');
        $this->forge->createTable('kecamatan');
    }

    public function down()
    {
        $this->forge->dropTable('kecamatan');
    }
}
