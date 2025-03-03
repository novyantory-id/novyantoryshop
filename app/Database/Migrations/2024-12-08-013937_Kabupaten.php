<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kabupaten extends Migration
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
            'kabupaten' => [
                'type'          => 'VARCHAR',
                'constraint'    => '35',
            ],
            'provinsi_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'       => true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('provinsi_id', 'provinsi', 'id');
        $this->forge->createTable('kabupaten');
    }

    public function down()
    {
        $this->forge->dropTable('kabupaten');
    }
}
