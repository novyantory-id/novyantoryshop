<?php

namespace App\Models;

use CodeIgniter\Model;

class KabupatenModel extends Model
{
    protected $table            = 'kabupaten';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'kabupaten',
        'provinsi_id'
    ];

    public function getKabupaten()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kabupaten');
        $builder->select('kabupaten.*,provinsi.provinsi');
        $builder->join('provinsi', 'kabupaten.provinsi_id = provinsi.id');
        return $builder->get()->getResultArray();
    }

    public function getKabupatenById($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kabupaten');
        $builder->select('kabupaten.*,provinsi.provinsi');
        $builder->join('provinsi', 'kabupaten.provinsi_id = provinsi.id');
        $builder->where('kabupaten.id', $id);
        return $builder->get()->getRowArray();
    }
}
