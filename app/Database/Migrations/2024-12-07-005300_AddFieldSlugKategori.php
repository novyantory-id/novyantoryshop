<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldSlugKategori extends Migration
{
    public function up()
    {
        $fields = [
            'slug_kategori' => [
                'type' => 'VARCHAR',
                'constraint'    => '30',
            ],
        ];

        $this->forge->addColumn('kategori', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('kategori', 'slug_kategori');
    }
}
