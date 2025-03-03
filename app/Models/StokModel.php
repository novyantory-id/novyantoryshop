<?php

namespace App\Models;

use CodeIgniter\Model;

class StokModel extends Model
{
    protected $table            = 'stokproduk';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'produk_id',
        'warna',
        'ukuran',
        'stok',
        'harga_varian',
        'created_stok_at',
        'variasi',
        'kombinasi_atribut',
        'bobot'
    ];

    public function getStokProduk()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('stokproduk');
        $builder->select('stokproduk.*,
        produk.kode_produk, produk.nama_produk, produk.images_produk_thumbnail');
        $builder->join('produk', 'stokproduk.produk_id = produk.id', 'left');
        $builder->orderBy('produk.nama_produk', 'ASC');
        return $builder->get()->getResultArray();
    }

    public function getStokProdukById($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('stokproduk');
        $builder->select('stokproduk.*,
        produk.kode_produk, produk.nama_produk, produk.images_produk_thumbnail, brand.nama_brand');
        $builder->join('produk', 'stokproduk.produk_id = produk.id', 'left');
        $builder->join('brand', 'produk.brand_id = brand.id');
        $builder->orderBy('produk.nama_produk', 'ASC');
        $builder->where('stokproduk.id', $id);
        return $builder->get()->getRowArray();
    }
}
