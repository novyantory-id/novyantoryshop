<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldForOrders extends Migration
{
    public function up()
    {
        $fields = [
            'subtotalproduk' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'subtotalcost' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'totalbayar' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'courier' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
            ],
            'no_resi' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
            ],
        ];

        $this->forge->addColumn('order', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('order', 'subtotalproduk');
        $this->forge->dropColumn('order', 'subtotalcost');
        $this->forge->dropColumn('order', 'totalbayar');
        $this->forge->dropColumn('order', 'courier');
        $this->forge->dropColumn('order', 'no_resi');
    }
}
