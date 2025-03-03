<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\OrderdetailsModel;
use App\Models\OrderModel;
use CodeIgniter\HTTP\ResponseInterface;

class Purchase extends BaseController
{
    private $orderModel;
    private $orderdetailsModel;

    function __construct()
    {
        helper(['url', 'form']);
        $this->orderModel = new OrderModel();
        $this->orderdetailsModel = new OrderdetailsModel();
    }

    public function index()
    {
        $user_id = session()->get('user_id');

        // For Pending
        $orders = $this->orderModel
            ->where('order.status_order', 'pending')
            ->where('order.user_id', $user_id)
            ->findAll();

        // dd($orders);

        foreach ($orders as &$order) {
            $order['details'] = $this->orderdetailsModel
                ->detailProdukOrderByUser()
                ->where('order_id', $order['id'])
                ->findAll();
        }

        // For Pending End

        // For Dikemas
        $orders2 = $this->orderModel
            ->whereIn('order.status_order', ['confirmed', 'packing'])
            ->where('order.user_id', $user_id)
            ->findAll();

        foreach ($orders2 as &$order) {
            $order['details'] = $this->orderdetailsModel
                ->detailProdukOrderByUser()
                ->where('order_id', $order['id'])
                ->findAll();
        }
        // For Dikemas End

        // For Dikemas
        $orders3 = $this->orderModel
            ->whereIn('order.status_order', ['sending', 'shipping'])
            ->where('order.user_id', $user_id)
            ->findAll();

        foreach ($orders3 as &$order) {
            $order['details'] = $this->orderdetailsModel
                ->detailProdukOrderByUser()
                ->where('order_id', $order['id'])
                ->findAll();
        }
        // For Dikemas End

        // For Dikemas
        $orders4 = $this->orderModel
            ->where('order.status_order', 'finished')
            ->where('order.user_id', $user_id)
            ->findAll();

        foreach ($orders4 as &$order) {
            $order['details'] = $this->orderdetailsModel
                ->detailProdukOrderByUser()
                ->where('order_id', $order['id'])
                ->findAll();
        }
        // For Dikemas End

        $data = [
            'title' => 'My Purchase - Novyantoryshop',
            'orders' => $orders,
            'orders2' => $orders2,
            'orders3' => $orders3,
            'orders4' => $orders4
        ];

        return view('users/purchase', $data);
    }

    public function bayar($nomorPesanan)
    {
        $user_id = session()->get('user_id');

        // For Pending
        $orders = $this->orderModel
            ->where('order.status_order', 'pending')
            ->where('order.nomor_pesanan', $nomorPesanan)
            ->where('order.user_id', $user_id)
            ->first();

        if (!$orders) {
            session()->setFlashdata('failed', 'Tidak ada order ' . $nomorPesanan . ' dengan status Belum bayar');
            return redirect()->to(base_url('user/purchase'));
        }

        $data = [
            'title' => 'Info Pembayaran - Novyantoryshop',
            'orders' => $orders,
        ];

        return view('users/bayar', $data);
    }

    public function dikonfirmasi($nomorPesanan)
    {
        $user_id = session()->get('user_id');

        // For Pending

        $orders = $this->orderModel
            ->where('order.status_order', 'confirmed')
            ->where('order.nomor_pesanan', $nomorPesanan)
            ->where('order.user_id', $user_id)
            ->first();

        if (!$orders) {
            session()->setFlashdata('failed', 'Tidak ada order ' . $nomorPesanan . ' dengan status Dikonfirmasi');
            return redirect()->to(base_url('user/purchase'));
        }

        $orderDetails = $this->orderdetailsModel
            ->detailPurchaseByUser()
            ->where('orderdetails.order_id', $orders['id'])
            ->findAll();



        $data = [
            'title' => 'Rincian Pesanan - Novyantoryshop',
            'orders' => $orders,
            'orderdetails' => $orderDetails
        ];
        // dd($data);

        return view('users/dikonfirmasi', $data);
    }

    public function dikemas($nomorPesanan)
    {
        $user_id = session()->get('user_id');

        // For Pending

        $orders = $this->orderModel
            ->where('order.status_order', 'packing')
            ->where('order.nomor_pesanan', $nomorPesanan)
            ->where('order.user_id', $user_id)
            ->first();

        if (!$orders) {
            session()->setFlashdata('failed', 'Tidak ada order ' . $nomorPesanan . ' dengan status Dikemas');
            return redirect()->to(base_url('user/purchase'));
        }

        $orderDetails = $this->orderdetailsModel
            ->detailPurchaseByUser()
            ->where('orderdetails.order_id', $orders['id'])
            ->findAll();

        $data = [
            'title' => 'Rincian Pesanan - Novyantoryshop',
            'orders' => $orders,
            'orderdetails' => $orderDetails
        ];
        // dd($data);

        return view('users/dikemas', $data);
    }

    public function dikirim($nomorPesanan)
    {
        $user_id = session()->get('user_id');

        // For Pending

        $orders = $this->orderModel
            ->where('order.status_order', 'sending')
            ->where('order.nomor_pesanan', $nomorPesanan)
            ->where('order.user_id', $user_id)
            ->first();

        if (!$orders) {
            session()->setFlashdata('failed', 'Tidak ada order ' . $nomorPesanan . ' dengan status Dikirim');
            return redirect()->to(base_url('user/purchase'));
        }

        $orderDetails = $this->orderdetailsModel
            ->detailPurchaseByUser()
            ->where('orderdetails.order_id', $orders['id'])
            ->findAll();

        $data = [
            'title' => 'Rincian Pesanan - Novyantoryshop',
            'orders' => $orders,
            'orderdetails' => $orderDetails
        ];
        // dd($data);

        return view('users/dikirim', $data);
    }

    public function dalamperjalanan($nomorPesanan)
    {
        $user_id = session()->get('user_id');

        // For Pending

        $orders = $this->orderModel
            ->where('order.status_order', 'shipping')
            ->where('order.nomor_pesanan', $nomorPesanan)
            ->where('order.user_id', $user_id)
            ->first();

        if (!$orders) {
            session()->setFlashdata('failed', 'Tidak ada order ' . $nomorPesanan . ' dengan status Dalam Perjalanan');
            return redirect()->to(base_url('user/purchase'));
        }

        $orderDetails = $this->orderdetailsModel
            ->detailPurchaseByUser()
            ->where('orderdetails.order_id', $orders['id'])
            ->findAll();

        $data = [
            'title' => 'Rincian Pesanan - Novyantoryshop',
            'orders' => $orders,
            'orderdetails' => $orderDetails
        ];
        // dd($data);

        return view('users/dalamperjalanan', $data);
    }

    public function selesai($nomorPesanan)
    {
        $user_id = session()->get('user_id');

        // For Pending

        $orders = $this->orderModel
            ->where('order.status_order', 'finished')
            ->where('order.nomor_pesanan', $nomorPesanan)
            ->where('order.user_id', $user_id)
            ->first();

        if (!$orders) {
            session()->setFlashdata('failed', 'Tidak ada order ' . $nomorPesanan . ' dengan status Dalam Perjalanan');
            return redirect()->to(base_url('user/purchase'));
        }

        $orderDetails = $this->orderdetailsModel
            ->detailPurchaseByUser()
            ->where('orderdetails.order_id', $orders['id'])
            ->findAll();

        $data = [
            'title' => 'Rincian Pesanan - Novyantoryshop',
            'orders' => $orders,
            'orderdetails' => $orderDetails
        ];
        // dd($data);

        return view('users/selesai', $data);
    }

    public function acceptOrder($nomorPesanan)
    {

        $nomorPesanan = $this->request->getPost('nomor_pesanan');
        // Update order
        $this->orderModel->where('nomor_pesanan', $nomorPesanan)
            ->set([
                'status_order' => 'finished'
            ])
            ->update();

        session()->setFlashdata('success', 'Pesanan berhasil diterima');
        return redirect()->to(base_url("user/purchase"));
    }
}
