<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AtributModel;
use App\Models\ProdukModel;
use App\Models\StokModel;
use CodeIgniter\HTTP\ResponseInterface;

class Stok extends BaseController
{
    private $stokModel;
    private $produkModel;
    private $atributModel;

    function __construct()
    {
        helper(['url', 'form']);
        $this->produkModel = new ProdukModel();
        $this->stokModel = new StokModel();
        $this->atributModel = new AtributModel();
    }

    public function index()
    {
        $data = [
            'title_tab' => 'Stock Product List - Novyantoryshop',
            'title' => 'Product',
            'title_detail' => 'Stock Product List',
            'validation' => \Config\Services::validation(),
            'stok' => $this->stokModel->getStokProduk()
        ];

        return view('admin/stok/index', $data);
    }

    public function getProdukData($id)
    {
        $produk = $this->produkModel->getProdukById($id);

        if ($produk) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $produk,
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ]);
        }
    }

    public function getAtribut($produk_id) {}

    public function create()
    {
        $atribut = $this->atributModel->findAll();

        $kelombokAtribut = [];
        foreach ($atribut as $item) {
            $kelombokAtribut[$item['nama_atribut']][$item['id']] = $item['nilai_atribut'];
        }
        $data = [
            'title_tab' => 'Add Stock Product - Novyantoryshop',
            'title' => 'Product',
            'title_detail' => 'Add Stock Product List',
            'validation' => \Config\Services::validation(),
            'produk' => $this->produkModel->findAll(),
            'stok' => $this->stokModel->getStokProduk(),
            'atribut' => $kelombokAtribut,
        ];

        return view('admin/stok/create', $data);
    }

    public function store()
    {
        $rules = [
            'produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Produk tidak boleh kosong'
                ],
            ],
            'harga_varian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga varian tidak boleh kosong'
                ],
            ],
            'bobot' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bobot produk tidak boleh kosong'
                ],
            ],
            'stok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stok produk tidak boleh kosong'
                ],
            ],
        ];
        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Add Stock Product - Novyantoryshop',
                'title' => 'Product',
                'title_detail' => 'Add Stock Product List',
                'validation' => \Config\Services::validation(),
                'produk' => $this->produkModel->findAll(),
                'stok' => $this->stokModel->getStokProduk()
            ];

            return view('admin/stok/create', $data);
        } else {
            $produk_id = $this->request->getPost('produk');
            $stok = $this->request->getPost('stok');
            $kombinasi_atribut = $this->request->getPost('kombinasi_atribut');

            if (!$kombinasi_atribut || !is_array($kombinasi_atribut)) {
                return redirect()->to(base_url('admin/stock/create'));
            }

            $kombinasi_atribut_json = json_encode($kombinasi_atribut);

            $this->stokModel->insert([
                'produk_id' => $produk_id,
                'kombinasi_atribut' => $kombinasi_atribut_json,
                'bobot' => $this->request->getPost('bobot'),
                'stok' => $stok,
                'harga_varian' => $this->request->getPost('harga_varian'),
                'created_stok_at' => date('Y-m-d H:i:s'),
            ]);

            session()->setFlashdata('success', 'Data stok berhasil disimpan');
            return redirect()->to(base_url('admin/stock'));
        }
    }

    public function edit($id)
    {
        $data = [
            'title_tab' => 'Edit Stock Product - Novyantoryshop',
            'title' => 'Product',
            'title_detail' => 'Edit Stock Product List',
            'validation' => \Config\Services::validation(),
            'produk' => $this->produkModel->findAll(),
            'stok' => $this->stokModel->getStokProdukById($id)
        ];

        return view('admin/stok/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'harga_varian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga varian tidak boleh kosong'
                ],
            ],
        ];
        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Edit Stock Product - Novyantoryshop',
                'title' => 'Product',
                'title_detail' => 'Edit Stock Product List',
                'validation' => \Config\Services::validation(),
                'produk' => $this->produkModel->findAll(),
                'stok' => $this->stokModel->getStokProdukById($id)
            ];
            return view('admin/stok/edit', $data);
        } else {
            $this->stokModel->where('id', $id)
                ->set([
                    'harga_varian' => $this->request->getPost('harga_varian')
                ])
                ->update();

            session()->setFlashdata('success', 'Data Stok berhasil diupdate');
            return redirect()->to(base_url('admin/stock'));
        }
    }
}
