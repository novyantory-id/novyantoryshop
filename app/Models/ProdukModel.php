<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'kode_produk',
        'nama_produk',
        'berat_produk',
        'harga_produk',
        'deskripsi_produk',
        'deskripsi_panjang_produk',
        'images_produk_galeri',
        'images_produk_thumbnail',
        'is_promo',
        'is_baru',
        'is_bestseller',
        'brand_id',
        'subsubkategori_id',
        'created_produk_at',
        'status_active_produk',
        'slug_produk',
    ];

    public function getStokByProduk($produk_id)
    {
        return $this->where('produk_id', $produk_id)->findAll();
    }

    public function getProduk()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('produk');
        $builder->select('produk.*,
        brand.nama_brand,
        subsubkategori.subsubkategori,subkategori.subkategori,kategori.kategori');
        $builder->join('brand', 'produk.brand_id = brand.id');
        $builder->join('subsubkategori', 'produk.subsubkategori_id = subsubkategori.id');
        $builder->join('subkategori', 'subsubkategori.subkategori_id = subkategori.id');
        $builder->join('kategori', 'subkategori.kategori_id = kategori.id');
        $builder->orderBy('produk.id', 'ASC');
        return $builder->get()->getResultArray();
    }

    public function getProdukById($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('produk');
        $builder->select('produk.*,
        brand.nama_brand,
        subsubkategori.subsubkategori,subsubkategori.subkategori_id,subkategori.subkategori,subkategori.kategori_id,kategori.kategori');
        $builder->join('brand', 'produk.brand_id = brand.id');
        $builder->join('subsubkategori', 'produk.subsubkategori_id = subsubkategori.id');
        $builder->join('subkategori', 'subsubkategori.subkategori_id = subkategori.id');
        $builder->join('kategori', 'subkategori.kategori_id = kategori.id');
        $builder->orderBy('produk.id', 'ASC');
        $builder->where('produk.id', $id);
        return $builder->get()->getRowArray();
    }

    // for frontend
    public function getProdukBySlugKategori($slug_kategori = null, $minPrice = 0, $maxPrice = 100000000)
    {
        $builder = $this->db->table('produk')
            ->select('produk.*,
        subsubkategori.subsubkategori,subsubkategori.subkategori_id,subkategori.subkategori,subkategori.kategori_id,kategori.kategori')
            ->join('subsubkategori', 'produk.subsubkategori_id = subsubkategori.id')
            ->join('subkategori', 'subsubkategori.subkategori_id = subkategori.id')
            ->join('kategori', 'subkategori.kategori_id = kategori.id');

        if ($slug_kategori) {
            $builder->where('kategori.slug_kategori', $slug_kategori);
        }

        return $builder->get()->getResultArray();
    }

    // for frontend
    public function getProdukBySlugKategoriAndPrice($slug_kategori = null, $hargaMaksimal = null)
    {
        $builder = $this->db->table('produk')
            ->select('produk.*,
        subsubkategori.subsubkategori,subsubkategori.subkategori_id,subkategori.subkategori,subkategori.kategori_id,kategori.kategori')
            ->join('subsubkategori', 'produk.subsubkategori_id = subsubkategori.id')
            ->join('subkategori', 'subsubkategori.subkategori_id = subkategori.id')
            ->join('kategori', 'subkategori.kategori_id = kategori.id');

        if ($slug_kategori) {
            $builder->where('kategori.slug_kategori', $slug_kategori);
        }

        if ($hargaMaksimal) {
            $builder->where('produk.harga_produk <=', $hargaMaksimal);
        }

        return $builder->get()->getResultArray();
    }

    public function getAllProduk()
    {

        return $this->select('produk.*,
        subsubkategori.subsubkategori,subsubkategori.subkategori_id,subkategori.subkategori,subkategori.kategori_id,kategori.kategori')
            ->join('subsubkategori', 'produk.subsubkategori_id = subsubkategori.id')
            ->join('subkategori', 'subsubkategori.subkategori_id = subkategori.id')
            ->join('kategori', 'subkategori.kategori_id = kategori.id')
            ->findAll();
    }

    public function getAllNewProduk($limit = 10)
    {
        return $this->select('produk.*,
        subsubkategori.subsubkategori,subsubkategori.subkategori_id,subkategori.subkategori,subkategori.kategori_id,kategori.kategori')
            ->join('subsubkategori', 'produk.subsubkategori_id = subsubkategori.id')
            ->join('subkategori', 'subsubkategori.subkategori_id = subkategori.id')
            ->join('kategori', 'subkategori.kategori_id = kategori.id')
            ->orderBy('created_produk_at', 'DESC')
            ->findAll($limit);
    }

    public function getProdukByBestSeller($limit = 10)
    {
        return $this->select('produk.*,
        subsubkategori.subsubkategori,subsubkategori.subkategori_id,subkategori.subkategori,subkategori.kategori_id,kategori.kategori')
            ->join('subsubkategori', 'produk.subsubkategori_id = subsubkategori.id')
            ->join('subkategori', 'subsubkategori.subkategori_id = subkategori.id')
            ->join('kategori', 'subkategori.kategori_id = kategori.id')
            ->where('is_bestseller', 1)
            ->orderBy('RAND()')
            ->findAll($limit);
    }

    public function getJumlahProduk($status_active_produk)
    {
        return $this->where('status_active_produk', $status_active_produk)->countAllResults();
    }
}
