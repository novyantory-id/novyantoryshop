<?php

namespace App\Models;

use CodeIgniter\Model;

class KecamatanModel extends Model
{
    protected $table            = 'kecamatan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'kecamatan',
        'kabupaten_id'
    ];

    public function getKecamatan()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kecamatan');
        $builder->select('kecamatan.*,kabupaten.kabupaten,provinsi.provinsi');
        $builder->join('kabupaten', 'kecamatan.kabupaten_id = kabupaten.id');
        $builder->join('provinsi', 'kabupaten.provinsi_id = provinsi.id');
        $builder->orderBy('provinsi');
        return $builder->get()->getResultArray();
    }

    public function getKecamatanById($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kecamatan');
        $builder->select('kecamatan.*,kabupaten.kabupaten,kabupaten.provinsi_id,provinsi.provinsi');
        $builder->join('kabupaten', 'kecamatan.kabupaten_id = kabupaten.id');
        $builder->join('provinsi', 'kabupaten.provinsi_id = provinsi.id');
        $builder->where('kecamatan.id', $id);
        return $builder->get()->getRowArray();
    }
}
