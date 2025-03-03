<?php

namespace App\Models;

use CodeIgniter\Model;

class SubkategoriModel extends Model
{
    protected $table            = 'subkategori';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'subkategori',
        'slug_subkategori',
        'kategori_id'
    ];

    public function getSubKategori()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('subkategori');
        $builder->select('subkategori.*,kategori.kategori');
        $builder->join('kategori', 'subkategori.kategori_id = kategori.id');
        return $builder->get()->getResultArray();
    }

    public function getSubKategoriById($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('subkategori');
        $builder->select('subkategori.*,kategori.kategori');
        $builder->join('kategori', 'subkategori.kategori_id = kategori.id');
        $builder->where('subkategori.id', $id);
        return $builder->get()->getRowArray();
    }
}
