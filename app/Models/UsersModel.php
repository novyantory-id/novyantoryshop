<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'username',
        'nama_user',
        'password_user',
        'tgl_lahir_user',
        'jk_user',
        'email_user',
        'nohp_user',
        'kode_verifikasi_user',
        'url_verifikasi_user',
        'images_user',
        'status_aktif_user',
        'tgl_daftar_user',
        'role_id'
    ];

    public function getVerify($kodeVerifikasi = null, $urlVerifikasi = null)
    {
        $builder = $this->db->table('users')
            ->select('users.*');

        if ($kodeVerifikasi) {
            $builder->where('users.kode_verifikasi_user', $kodeVerifikasi);
        }

        if ($urlVerifikasi) {
            $builder->where('users.url_verifikasi_user', $urlVerifikasi);
        }

        return $builder->get()->getRow();
    }

    public function getJumlahUser()
    {
        return $this->countAllResults();
    }
}
