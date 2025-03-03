<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPaymentDetail extends Migration
{
    public function up()
    {
        $fields = [
            'payment_detail' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
        ];

        $this->forge->addColumn('order', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('order', 'payment_detail');
    }
}
