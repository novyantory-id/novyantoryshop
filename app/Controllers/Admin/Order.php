<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderdetailsModel;
use App\Models\OrderModel;
use CodeIgniter\HTTP\ResponseInterface;

class Order extends BaseController
{
    private $orderModel;
    private $orderdetailsModel;

    function __construct()
    {
        helper(['url', 'form']);
        $this->orderModel = new OrderModel();
        $this->orderdetailsModel = new OrderdetailsModel();
    }

    // Entry
    public function entry()
    {
        $orders = $this->orderModel
            ->where('order.status_order', 'pending')
            ->findAll();
        $data = [
            'title_tab' => 'Customers Order - Novyantoryshop',
            'title' => 'Entry Orders',
            'title_detail' => 'All Entry',
            'orders' => $orders
        ];

        return view('admin/order/entry/index', $data);
    }

    public function entryDetail($nomorPesanan)
    {
        // For Pending

        $orders = $this->orderModel->detailOrderById()
            ->where('order.status_order', 'pending')
            ->where('order.nomor_pesanan', $nomorPesanan)
            ->first();

        // dd($orders);

        $orderDetails = $this->orderdetailsModel
            ->detailProdukOrderByUser()
            ->where('orderdetails.order_id', $orders['id'])
            ->findAll();

        $data = [
            'title_tab' => 'Customers Order - Novyantoryshop',
            'title' => 'Detail Order',
            'title_detail' => 'Detail',
            'orders' => $orders,
            'orderdetails' => $orderDetails
        ];

        return view('admin/order/entry/detail', $data);
    }

    public function statusEntry($nomorPesanan)
    {

        $orderId = $this->request->getPost('order_id');
        // Update order
        $this->orderModel->update($orderId, [
            'status_order' => 'confirmed'
        ]);

        session()->setFlashdata('success', 'Pesanan berhasil dikonfirmasi');
        return redirect()->to(base_url("admin/order/entry"));
    }
    // Entry End

    // Confirm
    public function confirm()
    {
        $orders = $this->orderModel
            ->where('order.status_order', 'confirmed')
            ->findAll();
        $data = [
            'title_tab' => 'Customers Order - Novyantoryshop',
            'title' => 'Confirmed Orders',
            'title_detail' => 'All Confirmed',
            'orders' => $orders
        ];

        return view('admin/order/confirm/index', $data);
    }

    public function confirmDetail($nomorPesanan)
    {
        // For Pending

        $orders = $this->orderModel->detailOrderById()
            ->where('order.status_order', 'confirmed')
            ->where('order.nomor_pesanan', $nomorPesanan)
            ->first();

        // dd($orders);

        $orderDetails = $this->orderdetailsModel
            ->detailProdukOrderByUser()
            ->where('orderdetails.order_id', $orders['id'])
            ->findAll();

        $data = [
            'title_tab' => 'Customers Order - Novyantoryshop',
            'title' => 'Detail Order',
            'title_detail' => 'Detail',
            'orders' => $orders,
            'orderdetails' => $orderDetails
        ];

        return view('admin/order/confirm/detail', $data);
    }

    public function statusConfirm($nomorPesanan)
    {

        $orderId = $this->request->getPost('order_id');
        // Update order
        $this->orderModel->update($orderId, [
            'status_order' => 'packing'
        ]);

        session()->setFlashdata('success', 'Pesanan berhasil dikemas');
        return redirect()->to(base_url("admin/order/confirm"));
    }
    // Confirm End

    // Packing
    public function packing()
    {
        $orders = $this->orderModel
            ->where('order.status_order', 'packing')
            ->findAll();
        $data = [
            'title_tab' => 'Customers Order - Novyantoryshop',
            'title' => 'Packing Orders',
            'title_detail' => 'All Packing',
            'orders' => $orders
        ];

        return view('admin/order/packing/index', $data);
    }

    public function packingDetail($nomorPesanan)
    {
        // For Pending

        $orders = $this->orderModel->detailOrderById()
            ->where('order.status_order', 'packing')
            ->where('order.nomor_pesanan', $nomorPesanan)
            ->first();

        // dd($orders);

        $orderDetails = $this->orderdetailsModel
            ->detailProdukOrderByUser()
            ->where('orderdetails.order_id', $orders['id'])
            ->findAll();

        $data = [
            'title_tab' => 'Customers Order - Novyantoryshop',
            'title' => 'Detail Order',
            'title_detail' => 'Detail',
            'orders' => $orders,
            'orderdetails' => $orderDetails
        ];

        return view('admin/order/packing/detail', $data);
    }

    public function statusPacking($nomorPesanan)
    {

        $orderId = $this->request->getPost('order_id');
        // Update order
        $this->orderModel->update($orderId, [
            'status_order' => 'sending'
        ]);

        session()->setFlashdata('success', 'Pesanan berhasil dikirim');
        return redirect()->to(base_url("admin/order/packing"));
    }
    // Packing End

    // Sending
    public function sending()
    {
        $orders = $this->orderModel
            ->where('order.status_order', 'sending')
            ->findAll();
        $data = [
            'title_tab' => 'Customers Order - Novyantoryshop',
            'title' => 'Sending Orders',
            'title_detail' => 'All Sending',
            'orders' => $orders
        ];

        return view('admin/order/sending/index', $data);
    }

    public function sendingDetail($nomorPesanan)
    {
        // For Pending

        $orders = $this->orderModel->detailOrderById()
            ->where('order.status_order', 'sending')
            ->where('order.nomor_pesanan', $nomorPesanan)
            ->first();

        // dd($orders);

        $orderDetails = $this->orderdetailsModel
            ->detailProdukOrderByUser()
            ->where('orderdetails.order_id', $orders['id'])
            ->findAll();

        $data = [
            'title_tab' => 'Customers Order - Novyantoryshop',
            'title' => 'Detail Order',
            'title_detail' => 'Detail',
            'orders' => $orders,
            'orderdetails' => $orderDetails
        ];

        return view('admin/order/sending/detail', $data);
    }

    public function statusSending($nomorPesanan)
    {

        $orderId = $this->request->getPost('order_id');
        // Update order
        $this->orderModel->update($orderId, [
            'no_resi' => $this->request->getPost('no_resi'),
            'status_order' => 'shipping'
        ]);

        session()->setFlashdata('success', 'Pesanan dalam perjalanan');
        return redirect()->to(base_url("admin/order/sending"));
    }
    // Sending End

    // Shipping
    public function shipping()
    {
        $orders = $this->orderModel
            ->where('order.status_order', 'shipping')
            ->findAll();
        $data = [
            'title_tab' => 'Customers Order - Novyantoryshop',
            'title' => 'Shipping Orders',
            'title_detail' => 'All Shipping',
            'orders' => $orders
        ];

        return view('admin/order/shipping/index', $data);
    }

    public function shippingDetail($nomorPesanan)
    {
        // For Pending

        $orders = $this->orderModel->detailOrderById()
            ->where('order.status_order', 'shipping')
            ->where('order.nomor_pesanan', $nomorPesanan)
            ->first();

        // dd($orders);

        $orderDetails = $this->orderdetailsModel
            ->detailProdukOrderByUser()
            ->where('orderdetails.order_id', $orders['id'])
            ->findAll();

        $data = [
            'title_tab' => 'Customers Order - Novyantoryshop',
            'title' => 'Detail Order',
            'title_detail' => 'Detail',
            'orders' => $orders,
            'orderdetails' => $orderDetails
        ];

        return view('admin/order/shipping/detail', $data);
    }

    public function statusShipping($nomorPesanan)
    {

        $orderId = $this->request->getPost('order_id');
        // Update order
        $this->orderModel->update($orderId, [
            'no_resi' => $this->request->getPost('no_resi'),
            'status_order' => 'finished'
        ]);

        session()->setFlashdata('success', 'Pesanan telah diterima');
        return redirect()->to(base_url("admin/order/shipping"));
    }
    // Shipping End

    // Finished
    public function finished()
    {
        $orders = $this->orderModel
            ->where('order.status_order', 'finished')
            ->findAll();
        $data = [
            'title_tab' => 'Customers Order - Novyantoryshop',
            'title' => 'Finished Orders',
            'title_detail' => 'All Finished',
            'orders' => $orders
        ];

        return view('admin/order/finished/index', $data);
    }

    public function finishedDetail($nomorPesanan)
    {
        // For Pending

        $orders = $this->orderModel->detailOrderById()
            ->where('order.status_order', 'finished')
            ->where('order.nomor_pesanan', $nomorPesanan)
            ->first();

        // dd($orders);

        $orderDetails = $this->orderdetailsModel
            ->detailProdukOrderByUser()
            ->where('orderdetails.order_id', $orders['id'])
            ->findAll();

        $data = [
            'title_tab' => 'Customers Order - Novyantoryshop',
            'title' => 'Detail Order',
            'title_detail' => 'Detail',
            'orders' => $orders,
            'orderdetails' => $orderDetails
        ];

        return view('admin/order/finished/detail', $data);
    }
}
