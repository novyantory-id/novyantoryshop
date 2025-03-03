<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleIdUsers extends Migration
{
    public function up()
    {
        $fields = [
            'role_id' => [
                'type' => 'VARCHAR',
                'constraint'    => '5',
            ],
        ];

        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'role_id');
    }
}
