<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSlugProdukk extends Migration
{
    public function up()
    {
        $fields = [
            'slug_produk' => [
                'type' => 'VARCHAR',
                'constraint'    => '128',
            ],
        ];

        $this->forge->addColumn('produk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('produk', 'slug_produk');
    }
}
