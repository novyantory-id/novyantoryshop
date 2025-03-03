<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Brand extends Migration
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
            'nama_brand' => [
                'type'          => 'VARCHAR',
                'constraint'    => '25',
            ],
            'slug_brand' => [
                'type'          => 'VARCHAR',
                'constraint'    => '25',
            ],
            'images_brand' => [
                'type'          => 'VARCHAR',
                'constraint'    => '256',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('brand');
    }

    public function down()
    {
        $this->forge->dropTable('brand');
    }
}
