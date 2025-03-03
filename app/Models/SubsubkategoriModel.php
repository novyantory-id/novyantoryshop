<?php

namespace App\Models;

use CodeIgniter\Model;

class SubsubkategoriModel extends Model
{
    protected $table            = 'subsubkategori';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'subsubkategori',
        'slug_subsubkategori',
        'subkategori_id'
    ];

    public function getSubSubKategori()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('subsubkategori');
        $builder->select('subsubkategori.*,subkategori.subkategori,kategori.kategori');
        $builder->join('subkategori', 'subsubkategori.subkategori_id = subkategori.id');
        $builder->join('kategori', 'subkategori.kategori_id = kategori.id');
        return $builder->get()->getResultArray();
    }

    public function getSubSubKategoriById($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('subsubkategori');
        $builder->select('subsubkategori.*,subkategori.subkategori,subkategori.kategori_id,kategori.kategori');
        $builder->join('subkategori', 'subsubkategori.subkategori_id = subkategori.id');
        $builder->join('kategori', 'subkategori.kategori_id = kategori.id');
        $builder->where('subsubkategori.id', $id);
        return $builder->get()->getRowArray();
    }
}
