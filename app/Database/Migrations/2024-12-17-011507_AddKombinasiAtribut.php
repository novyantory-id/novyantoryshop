<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKombinasiAtribut extends Migration
{
    public function up()
    {
        $fields = [
            'kombinasi_atribut' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ];

        $this->forge->addColumn('produk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('produk', 'kombinasi_atribut');
    }
}
