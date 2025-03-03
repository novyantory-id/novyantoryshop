<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Slides extends Migration
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
            'judul_slides' => [
                'type'          => 'VARCHAR',
                'constraint'    => '25',
            ],
            'deskripsi_slides' => [
                'type'          => 'VARCHAR',
                'constraint'    => '128',
            ],
            'images_slides' => [
                'type'          => 'VARCHAR',
                'constraint'    => '256',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('slides');
    }

    public function down()
    {
        $this->forge->dropTable('slides');
    }
}
