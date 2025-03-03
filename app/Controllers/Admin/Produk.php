<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AtributModel;
use App\Models\BrandModel;
use App\Models\KategoriModel;
use App\Models\ProdukModel;
use App\Models\StokModel;
use App\Models\SubkategoriModel;
use App\Models\SubsubkategoriModel;
use CodeIgniter\HTTP\ResponseInterface;

class Produk extends BaseController
{
    private $produkModel;
    private $brandModel;
    private $subsubkategoriModel;
    private $subkategoriModel;
    private $kategoriModel;
    private $atributModel;
    private $stokModel;

    function __construct()
    {
        helper(['url', 'form']);
        $this->produkModel = new ProdukModel();
        $this->brandModel = new BrandModel();
        $this->subsubkategoriModel = new SubsubkategoriModel();
        $this->kategoriModel = new KategoriModel();
        $this->subkategoriModel = new SubkategoriModel();
        $this->atributModel = new AtributModel();
        $this->stokModel = new StokModel();
    }

    public function index()
    {
        $data = [
            'title_tab' => 'Product List - Novyantoryshop',
            'title' => 'Product',
            'title_detail' => 'Product List',
            'validation' => \Config\Services::validation(),
            'produk' => $this->produkModel->getProduk()
        ];

        return view('admin/produk/index', $data);
    }

    public function create()
    {
        $atribut = $this->atributModel->findAll();

        $kelombokAtribut = [];
        foreach ($atribut as $item) {
            $kelombokAtribut[$item['nama_atribut']][$item['id']] = $item['nilai_atribut'];
        }
        $data = [
            'title_tab' => 'Add Product- Novyantoryshop',
            'title' => 'Product',
            'title_detail' => 'Add Product',
            'validation' => \Config\Services::validation(),
            'brand' => $this->brandModel->findAll(),
            'kategori' => $this->kategoriModel->findAll(),
            'atribut' => $kelombokAtribut,
        ];
        return view('admin/produk/create', $data);
    }

    public function getSubkategori()
    {
        if ($this->request->isAJAX()) {

            // key data AJAX diterima dari data: kategori_id
            $kategoriId = $this->request->getVar('kategori_id');

            if (!$kategoriId) {
                return $this->response->setJSON(['error' => 'Kategori ID tidak ditemukan']);
            }

            // Debugging kategori_id
            log_message('debug', 'Kategori ID: ' . $kategoriId);

            // ambil data dari subkategori[kategori_id]
            $subkategoriList = $this->subkategoriModel->where('kategori_id', $kategoriId)->findAll();

            // kembalikan data dalam bentuk JSON ke Javascript
            return $this->response->setJSON($subkategoriList); //Kirim data sebagai JSON
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException('Permintaan tidak valid.');
    }

    public function getSubsubkategori()
    {
        if ($this->request->isAJAX()) {

            // key data AJAX diterima dari data: kategori_id
            $subkategoriId = $this->request->getVar('subkategori_id');

            if (!$subkategoriId) {
                return $this->response->setJSON(['error' => 'Sub Kategori ID tidak ditemukan']);
            }

            // Debugging kategori_id
            log_message('debug', 'Sub Kategori ID: ' . $subkategoriId);

            // ambil data dari subkategori[kategori_id]
            $subsubkategoriList = $this->subsubkategoriModel->where('subkategori_id', $subkategoriId)->findAll();

            // kembalikan data dalam bentuk JSON ke Javascript
            return $this->response->setJSON($subsubkategoriList); //Kirim data sebagai JSON
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException('Permintaan tidak valid.');
    }

    public function getProductCode()
    {
        $produk = 'PRD';

        $nomorRandom = str_pad(random_int(0, 9999999), 7, '0', STR_PAD_LEFT);

        return $produk . '-' . $nomorRandom;
    }

    public function getUrlProduct($nama_produk)
    {
        $slug = strtolower($nama_produk);
        $slug = preg_replace('/[^a-z0-9\s]/', '', $slug);
        $slug = preg_replace('/\s+/', '-', $slug);
        $slug = trim($slug, '-');
        return $slug;
    }

    public function store()
    {
        $rules = [
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama produk tidak boleh kosong'
                ],
            ],
            // 'kode_produk' => [
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => 'Kode produk tidak boleh kosong'
            //     ],
            // ],
            'berat_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Berat produk tidak boleh kosong'
                ],
            ],
            'harga_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga produk tidak boleh kosong'
                ],
            ],
            'deskripsi_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'deskripsi produk tidak boleh kosong'
                ],
            ],
            'deskripsi_panjang_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi panjang produk tidak boleh kosong'
                ],
            ],
            'brand' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama brand tidak boleh kosong'
                ],
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kategori tidak boleh kosong'
                ],
            ],
            'subkategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama sub kategori tidak boleh kosong'
                ],
            ],
            'subsubkategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Sub-sub kategori tidak boleh kosong'
                ],
            ],
            'images_produk_thumbnail' => [
                'rules' => 'uploaded[images_produk_thumbnail]|max_size[images_produk_thumbnail,1024]|mime_in[images_produk_thumbnail,image/png,image/jpeg]',
                'errors' => [
                    'uploaded' => "File gambar wajib diupload",
                    'max_size' => "Ukuran gambar melebihi 1MB",
                    'mime_in' => "jenis file yang diizinkan hanya PNG atau JPEG"

                ],
            ],
            'images_produk_galeri' => [
                'rules' => 'uploaded[images_produk_galeri]|max_size[images_produk_galeri,1024]|mime_in[images_produk_galeri,image/png,image/jpeg]',
                'errors' => [
                    'uploaded' => "File gambar wajib diupload",
                    'max_size' => "Ukuran gambar melebihi 1MB",
                    'mime_in' => "jenis file yang diizinkan hanya PNG atau JPEG"

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
                'title_tab' => 'Add Product- Novyantoryshop',
                'title' => 'Product',
                'title_detail' => 'Add Product',
                'validation' => \Config\Services::validation(),
                'brand' => $this->brandModel->findAll(),
                'kategori' => $this->kategoriModel->findAll(),
            ];
            return view('admin/produk/create', $data);
        } else {
            $images_thumbnail = $this->request->getFile('images_produk_thumbnail');
            $images_galeri = $this->request->getFile('images_produk_galeri');

            if ($images_thumbnail->getError() == 4) {
                $nama_images = 'default.png';
            } else {
                $nama_images = $images_thumbnail->getRandomName();
                $images_thumbnail->move('assets/img/product', $nama_images);
            }

            if ($images_galeri->getError() == 4) {
                $nama_images2 = 'default.png';
            } else {
                $nama_images2 = $images_galeri->getRandomName();
                $images_galeri->move('assets/img/product', $nama_images2);
            }

            $nama_produk = $this->request->getPost('nama_produk');
            $slug = $this->getUrlProduct($nama_produk);
            $berat_produk = $this->request->getPost('berat_produk');
            $harga_produk = $this->request->getPost('harga_produk');

            $this->produkModel->insert([
                'kode_produk' => $this->getProductCode(),
                'nama_produk' => $nama_produk,
                'slug_produk' => $slug,
                'berat_produk' => $berat_produk,
                'harga_produk' => $harga_produk,
                'deskripsi_produk' => $this->request->getPost('deskripsi_produk'),
                'deskripsi_panjang_produk' => $this->request->getPost('deskripsi_panjang_produk'),
                'images_produk_galeri' => $nama_images2,
                'images_produk_thumbnail' => $nama_images,
                'is_promo' => $this->request->getPost('is_promo') ? '1' : '0',
                'is_baru' => $this->request->getPost('is_baru') ? '1' : '0',
                'is_bestseller' => $this->request->getPost('is_bestseller') ? '1' : '0',
                'brand_id' => $this->request->getPost('brand'),
                'subsubkategori_id' => $this->request->getPost('subsubkategori'),
                'created_produk_at' => date('Y-m-d H:i:s'),
                'status_active_produk' => 'aktif'
            ]);

            $produk_id = $this->produkModel->getInsertID();
            $stok = $this->request->getPost('stok');
            $kombinasi_atribut = $this->request->getPost('kombinasi_atribut');

            if (!$kombinasi_atribut || !is_array($kombinasi_atribut)) {
                return redirect()->to(base_url('admin/product/create'));
            }

            $kombinasi_atribut_json = json_encode($kombinasi_atribut);

            $this->stokModel->insert([
                'produk_id' => $produk_id,
                'kombinasi_atribut' => $kombinasi_atribut_json,
                'bobot' => $berat_produk,
                'stok' => $stok,
                'harga_varian' => $harga_produk,
                'created_stok_at' => date('Y-m-d H:i:s'),
            ]);

            session()->setFlashdata('success', 'Data Produk berhasil disimpan');
            return redirect()->to(base_url('admin/product'));
        }
    }

    public function edit($id)
    {
        $data = [
            'title_tab' => 'Edit Product- Novyantoryshop',
            'title' => 'Product',
            'title_detail' => 'Edit Product',
            'validation' => \Config\Services::validation(),
            'brand' => $this->brandModel->findAll(),
            'kategori' => $this->kategoriModel->findAll(),
            'produk' => $this->produkModel->getProdukById($id),
        ];
        return view('admin/produk/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama produk tidak boleh kosong'
                ],
            ],
            'berat_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Berat produk tidak boleh kosong'
                ],
            ],
            'harga_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga produk tidak boleh kosong'
                ],
            ],
            'deskripsi_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'deskripsi produk tidak boleh kosong'
                ],
            ],
            'deskripsi_panjang_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi panjang produk tidak boleh kosong'
                ],
            ],
            'brand' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama brand tidak boleh kosong'
                ],
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kategori tidak boleh kosong'
                ],
            ],
            'subkategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama sub kategori tidak boleh kosong'
                ],
            ],
            'subsubkategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Sub-sub kategori tidak boleh kosong'
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Edit Product- Novyantoryshop',
                'title' => 'Product',
                'title_detail' => 'Edit Product',
                'validation' => \Config\Services::validation(),
                'brand' => $this->brandModel->findAll(),
                'kategori' => $this->kategoriModel->findAll(),
                'produk' => $this->produkModel->getProdukById($id),
            ];
            return view('admin/produk/edit', $data);
        } else {
            $produkModel = $this->produkModel->where('id', $id)->first();
            $lokasiFile = FCPATH . 'assets/img/product/';

            $fileLamaThumbnail = $lokasiFile . $produkModel['images_produk_thumbnail'];

            $images_produk_thumbnail = $this->request->getFile('images_produk_thumbnail');

            if ($images_produk_thumbnail->getError() == 4) {
                $nama_images = $this->request->getPost('images_produk_thumbnail_lama');
            } else {
                $nama_images = $images_produk_thumbnail->getRandomName();
                $images_produk_thumbnail->move('assets/img/product', $nama_images);

                if (is_file($fileLamaThumbnail)) {
                    unlink($fileLamaThumbnail);
                }
            }

            // ---------------------------------

            $fileLamaGaleri = $lokasiFile . $produkModel['images_produk_galeri'];

            $images_produk_galeri = $this->request->getFile('images_produk_galeri');

            if ($images_produk_galeri->getError() == 4) {
                $nama_images2 = $this->request->getPost('images_produk_galeri_lama');
            } else {
                $nama_images2 = $images_produk_galeri->getRandomName();
                $images_produk_galeri->move('assets/img/product', $nama_images2);

                if (is_file($fileLamaGaleri)) {
                    unlink($fileLamaGaleri);
                }
            }

            $this->produkModel->where('id', $id)
                ->set([
                    'nama_produk' => $this->request->getPost('nama_produk'),
                    'berat_produk' => $this->request->getPost('berat_produk'),
                    'harga_produk' => $this->request->getPost('harga_produk'),
                    'deskripsi_produk' => $this->request->getPost('deskripsi_produk'),
                    'deskripsi_panjang_produk' => $this->request->getPost('deskripsi_panjang_produk'),
                    'images_produk_galeri' => $nama_images2,
                    'images_produk_thumbnail' => $nama_images,
                    'is_promo' => $this->request->getPost('is_promo') ? '1' : '0',
                    'is_baru' => $this->request->getPost('is_baru') ? '1' : '0',
                    'is_bestseller' => $this->request->getPost('is_bestseller') ? '1' : '0',
                    'brand_id' => $this->request->getPost('brand'),
                    'subsubkategori_id' => $this->request->getPost('subsubkategori'),
                    'status_active_produk' => $this->request->getPost('status_active_produk')
                ])
                ->update();

            session()->setFlashdata('success', 'Data Produk berhasil diupdate');
            return redirect()->to(base_url('admin/product'));
        }
    }
}
