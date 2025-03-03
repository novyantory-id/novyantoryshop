<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\StokModel;
use CodeIgniter\HTTP\ResponseInterface;

class Produk extends BaseController
{
    public function index($slug_produk)
    {
        $produkModel = new ProdukModel();
        $stokModel = new StokModel();

        $produk = $produkModel->where('slug_produk', $slug_produk)->first();

        $stokProduk = $stokModel->where('produk_id', $produk['id'])->findAll();

        // $atributGrouped = [];
        // foreach ($stokProduk as $stok) {
        //     $kombinasi = json_decode($stok['kombinasi_atribut'], true);
        //     foreach ($kombinasi as $nama_atribut => $nilai_atribut) {
        //         foreach ($nilai_atribut as $nilai) {
        //             $atributGrouped[$nama_atribut][$nilai] = true;
        //         }
        //     }
        // }

        // menentukan harga terendah dan tertinggi
        $harga_varian = array_column($stokProduk, 'harga_varian');
        $harga_terendah = min($harga_varian);
        $harga_tertinggi = max($harga_varian);

        if ($harga_terendah == $harga_tertinggi) {
            $harga_output = number_format($produk['harga_produk'], 0, ',', ',');
        } else {
            $harga_output = number_format($harga_terendah, 0, ',', ',') . " - " . number_format($harga_tertinggi, 0, ',', ',');
        }

        $totalStok = array_sum(array_column($stokProduk, 'stok'));
        $hargaDasar = $produk['harga_produk'];

        // Decode kombinasi atribut dari setiap stok
        foreach ($stokProduk as &$stok) {
            $stok['kombinasi_atribut'] = json_decode($stok['kombinasi_atribut'], true);
        }

        $data = [
            'title' => 'Novyantoryshop - Product Detail',
            'produk' => $produk,
            'stokproduk' => $stokProduk,
            // 'atributGrouped' => $atributGrouped,
            'hargaDasar' => $hargaDasar,
            'totalStok' => $totalStok,
            'harga_output' => $harga_output,
            'newproduk' => $produkModel->getAllNewProduk(10),
        ];



        return view('users/produk', $data);
    }
}
