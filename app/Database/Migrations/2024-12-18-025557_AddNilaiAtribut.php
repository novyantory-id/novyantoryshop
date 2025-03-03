<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNilaiAtribut extends Migration
{
    public function up()
    {
        $fields = [
            'nilai_atribut' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ];

        $this->forge->addColumn('atribut', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('atribut', 'nilai_atribut');
    }
}
