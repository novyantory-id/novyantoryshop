<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'order';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'user_id',
        'nomor_pesanan',
        'total_harga_keseluruhan',
        'status_order',
        'created_order_at',
        'payment_method',
        'payment_detail',
        'nama_penerima',
        'nohp_penerima',
        'alamat_penerima',
        'subtotalproduk',
        'subtotalcost',
        'totalbayar',
        'courier',
        'no_resi',
        'service',
        'cost_etd'
    ];

    public function createOrder($data)
    {
        $data['nomor_pesanan'] = $this->generateUniqueOrderNumber();

        return $this->insert($data);
    }

    public function generateUniqueOrderNumber()
    {
        do {
            $randomNumber = 'ORD-' . strtoupper(bin2hex(random_bytes(4)));
        } while ($this->where('nomor_pesanan', $randomNumber)->first());

        return $randomNumber;
    }

    public function detailOrderById()
    {
        // $user_id = session()->get('user_id');
        return $this->select('order.*, users.nama_user, users.email_user, users.nohp_user')
            ->join('users', 'order.user_id = users.id');
    }

    public function purchaseByUser()
    {
        // $user_id = session()->get('user_id');
        return $this->select('order.*,
        orderdetails.variasi, orderdetails.harga_varian
        users.nama_user, users.email_user, users.nohp_user')
            ->join('users', 'order.user_id = users.id')
            ->join('produk', 'orderdetails.produk_id = produk.id')
            ->join('order', 'orderdetails.order_id = order.id', 'left');
    }
}
