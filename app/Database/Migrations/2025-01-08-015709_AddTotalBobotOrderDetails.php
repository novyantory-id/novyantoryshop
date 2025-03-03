<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTotalBobotOrderDetails extends Migration
{
    public function up()
    {
        $fields = [
            'totalbobot' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ];

        $this->forge->addColumn('orderdetails', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('orderdetails', 'totalbobot');
    }
}
