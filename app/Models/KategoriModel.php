<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'kategori';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'kategori',
        'slug_kategori'
    ];

    public function getAllKategori()
    {
        return $this->findAll();
    }

    // untuk frontend market (kategori)
    public function getJumlahProdukByKategori()
    {
        $builder = $this->db->table('kategori')
            ->select('kategori.id, kategori.kategori, kategori.slug_kategori, COUNT(produk.id) as total_produk')
            ->join('subkategori', 'subkategori.kategori_id = kategori.id', 'left')
            ->join('subsubkategori', 'subsubkategori.subkategori_id = subkategori.id', 'left')
            ->join('produk', 'produk.subsubkategori_id = subsubkategori.id', 'left')
            ->groupBy('kategori.id');

        return $builder->get()->getResultArray();
    }

    public function getKategoriBySlug($slug_kategori)
    {
        return $this->where('slug_kategori', $slug_kategori)->first();
    }

    public function isKategoriExists($slug_kategori)
    {
        return $this->where('slug_kategori', $slug_kategori)->countAllResults() > 0;
    }
}
