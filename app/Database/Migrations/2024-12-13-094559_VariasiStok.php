<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VariasiStok extends Migration
{
    public function up()
    {
        $fields = [
            'variasi' => [
                'type' => 'VARCHAR',
                'constraint'    => '50',
            ],
        ];

        $this->forge->addColumn('stokproduk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('stokproduk', 'variasi');
    }
}
