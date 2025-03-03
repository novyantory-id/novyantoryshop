<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusActiveProduct extends Migration
{
    public function up()
    {
        $fields = [
            'status_active_produk' => [
                'type' => 'ENUM',
                'constraint'    => ['aktif', 'tidak aktif'],
                'default' => 'aktif',
                'null' => false
            ],
        ];

        $this->forge->addColumn('produk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('produk', 'status_active_produk');
    }
}
