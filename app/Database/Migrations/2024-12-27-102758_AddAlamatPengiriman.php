<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAlamatPengiriman extends Migration
{
    public function up()
    {
        $fields = [
            'nama_penerima' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'nohp_penerima' => [
                'type' => 'VARCHAR',
                'constraint' => 13,
            ],
            'alamat_penerima' => [
                'type' => 'TEXT',
            ],
        ];

        $this->forge->addColumn('order', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('order', 'nama_penerima');
        $this->forge->dropColumn('order', 'nohp_penerima');
        $this->forge->dropColumn('order', 'alamat_penerima');
    }
}
