<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\ProdukModel;
use CodeIgniter\HTTP\ResponseInterface;

class Market extends BaseController
{
    public function index($slug_kategori = null)
    {
        $kategoriModel = new KategoriModel();
        $produkModel = new ProdukModel();

        // Ambil parameter GET untuk filter harga
        $hargaMaksimal = $this->request->getGet('harga') ?? null;

        $produk = $produkModel->getProdukBySlugKategoriAndPrice($slug_kategori, $hargaMaksimal);

        $kategoriData = $kategoriModel->getJumlahProdukByKategori();
        $produkData = $produkModel->getJumlahProduk('aktif');

        $data = [
            'title' => 'Novyantoryshop - Buying Your Fashion',
            'produk' => $produk,
            'hargaMaksimal' => $hargaMaksimal,
            'selected_category' => $slug_kategori,
            'kategori' => $kategoriModel->getAllKategori(),
            'kategoridata' => $kategoriData,
            'produkdata' => $produkData
        ];

        return view('users/market', $data);
    }
}
