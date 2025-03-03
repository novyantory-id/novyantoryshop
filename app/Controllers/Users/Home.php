<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\ProdukModel;
use App\Models\SlidesModel;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class Home extends BaseController
{

    public function index($slug_kategori = null)
    {
        $slidesModel = new SlidesModel();
        $kategoriModel = new KategoriModel();
        $produkModel = new ProdukModel();
        $userModel = new UsersModel();

        $hour = date('G'); //format 0-23
        $hourText = $this->namaJam($hour);
        $periode = $this->getPeriode($hour);

        $message = "Wah, sudah pukul $hourText $periode!";

        $produkData = $produkModel->getJumlahProduk('aktif');
        $userData = $userModel->getJumlahUser();


        if ($slug_kategori) {
            // ambil produk berdasarkan kategori
            $data = [
                'title' => 'Novyantoryshop - Buying Your Fashion',
                'carousel_slides' => $slidesModel->findAll(),
                'produk' => $produkModel->getProdukBySlugKategori($slug_kategori),
                'selected_category' => $slug_kategori,
                'kategori' => $kategoriModel->getAllKategori(),
                'newproduk' => $produkModel->getAllNewProduk(10),
                'bestseller' => $produkModel->getProdukByBestSeller(10),
                'patrickMessage' => $message,
                'produkdata' => $produkData,
                'userdata' => $userData
            ];
        } else {
            // tampilkan semua produk jika kategori tidak dipilih
            $data = [
                'title' => 'Novyantoryshop - Buying Your Fashion',
                'carousel_slides' => $slidesModel->findAll(),
                'produk' => $produkModel->getAllProduk(),
                'selected_category' => null,
                'kategori' => $kategoriModel->getAllKategori(),
                'newproduk' => $produkModel->getAllNewProduk(10),
                'bestseller' => $produkModel->getProdukByBestSeller(10),
                'patrickMessage' => $message,
                'produkdata' => $produkData,
                'userdata' => $userData
            ];
        }


        return view('users/index', $data);
    }

    private function namaJam($hour)
    {
        $numbers = [
            0 => 'nol',
            1 => 'satu',
            2 => 'dua',
            3 => 'tiga',
            4 => 'empat',
            5 => 'lima',
            6 => 'enam',
            7 => 'tujuh',
            8 => 'delapan',
            9 => 'sembilan',
            10 => 'sepuluh',
            11 => 'sebelas',
            12 => 'dua belas'
        ];
        if ($hour > 12) {
            return $numbers[$hour - 12];
        }

        return $numbers[$hour];
    }

    private function getPeriode($hour)
    {
        if ($hour >= 1 && $hour <= 11) {
            return 'pagi';
        } elseif ($hour >= 12 && $hour <= 15) {
            return 'siang';
        } elseif ($hour >= 16 && $hour <= 18) {
            return 'sore';
        } else {
            return 'malam';
        }
    }
}
