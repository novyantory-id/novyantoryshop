<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBobotStokProduk extends Migration
{
    public function up()
    {
        $fields = [
            'bobot' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ];

        $this->forge->addColumn('stokproduk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('stokproduk', 'bobot');
    }
}
