<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderdetailsModel extends Model
{
    protected $table            = 'orderdetails';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'order_id',
        'produk_id',
        'variasi',
        'harga_varian_order',
        'kuantitas',
        'subtotal',
        'totalbobot'
    ];

    public function detailProdukOrderByUser()
    {
        return $this->select('orderdetails.*,
        produk.nama_produk, produk.images_produk_thumbnail, order.nomor_pesanan, order.total_harga_keseluruhan')
            ->join('produk', 'orderdetails.produk_id = produk.id')
            ->join('order', 'orderdetails.order_id = order.id');
    }

    public function detailPurchaseByUser()
    {
        return $this->select('orderdetails.*,
        produk.nama_produk, produk.images_produk_thumbnail, order.nomor_pesanan, order.total_harga_keseluruhan')
            ->join('produk', 'orderdetails.produk_id = produk.id')
            ->join('order', 'orderdetails.order_id = order.id');
    }
}
