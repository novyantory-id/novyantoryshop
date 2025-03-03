<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kupon extends Migration
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
            'nama_kupon' => [
                'type'          => 'VARCHAR',
                'constraint'    => '25',
            ],
            'diskon_kupon' => [
                'type'          => 'INT',
                'constraint'    => 3,
            ],
            'validasi' => [
                'type'          => 'DATE',
            ],
            'status_kupon' => [
                'type'          => 'ENUM',
                'constraint'    => ['valid', 'invalid'],
                'default'       => 'valid',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kupon');
    }

    public function down()
    {
        $this->forge->dropTable('kupon');
    }
}
