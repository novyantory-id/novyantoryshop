<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'username' => [
                'type'          => 'CHAR',
                'constraint'    => '30',
            ],
            'nama_user' => [
                'type'          => 'VARCHAR',
                'constraint'    => '128',
            ],
            'password_user' => [
                'type'          => 'VARCHAR',
                'constraint'    => '256',
            ],
            'tgl_lahir_user' => [
                'type'          => 'DATE',
            ],
            'jk_user' => [
                'type'          => 'VARCHAR',
                'constraint'    => '25',
            ],
            'email_user' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'nohp_user' => [
                'type'          => 'VARCHAR',
                'constraint'    => '13',
            ],
            'kode_verifikasi_user' => [
                'type'          => 'INT',
                'constraint'    => 6,
            ],
            'url_verifikasi_user' => [
                'type'          => 'VARCHAR',
                'constraint'    => '20',
            ],
            'images_user' => [
                'type'          => 'VARCHAR',
                'constraint'    => '256',
            ],
            'status_aktif_user' => [
                'type'          => 'VARCHAR',
                'constraint'    => '15',
            ],
            'tgl_daftar_user' => [
                'type'          => 'DATE',
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
