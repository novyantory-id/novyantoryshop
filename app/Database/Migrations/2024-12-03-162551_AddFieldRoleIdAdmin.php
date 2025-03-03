<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldRoleIdAdmin extends Migration
{
    public function up()
    {
        $fields = [
            'role_id' => [
                'type' => 'VARCHAR',
                'constraint'    => '5',
            ],
        ];

        $this->forge->addColumn('admin', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('admin', 'role_id');
    }
}
