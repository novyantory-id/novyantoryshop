<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
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
            'username' => [
                'type'          => 'VARCHAR',
                'constraint'    => '25',
            ],
            'nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => '128',
            ],
            'email' => [
                'type'          => 'VARCHAR',
                'constraint'    => '128',
            ],
            'password' => [
                'type'          => 'VARCHAR',
                'constraint'    => '256',
            ],
            'images' => [
                'type'          => 'VARCHAR',
                'constraint'    => '256',
            ],
            'created_at' => [
                'type'          => 'DATETIME'
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('admin');
    }

    public function down()
    {
        $this->forge->dropTable('admin');
    }
}
