<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldForOrders2 extends Migration
{
    public function up()
    {
        $fields = [
            'service' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
            ],
            'cost_etd' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
        ];

        $this->forge->addColumn('order', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('order', 'service');
        $this->forge->dropColumn('order', 'cost_etd');
    }
}
