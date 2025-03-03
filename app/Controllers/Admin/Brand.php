<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BrandModel;
use CodeIgniter\HTTP\ResponseInterface;

class Brand extends BaseController
{
    private $brandModel;

    function __construct()
    {
        helper(['url', 'form']);
        $this->brandModel = new BrandModel();
    }

    public function index()
    {
        $data = [
            'title_tab' => 'Brand List - Novyantoryshop',
            'title' => 'Brand',
            'title_detail' => 'Brand List',
            'brand' => $this->brandModel->findAll()
        ];

        return view('admin/brand/index', $data);
    }

    public function create()
    {
        $data = [
            'title_tab' => 'Add Brand - Novyantoryshop',
            'title' => 'Brand',
            'title_detail' => 'Add Brand',
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/brand/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama_brand' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Brand tidak boleh kosong'
                ],
            ],
            'images_brand' => [
                'rules' => 'uploaded[images_brand]|max_size[images_brand,1024]|mime_in[images_brand,image/png,image/jpeg]',
                'errors' => [
                    'uploaded' => "File gambar wajib diupload",
                    'max_size' => "Ukuran gambar melebihi 1MB",
                    'mime_in' => "jenis file yang diizinkan hanya PNG atau JPEG"

                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Add Brand - Novyantoryshop',
                'title' => 'Brand',
                'title_detail' => 'Add Brand',
                'validation' => \Config\Services::validation(),
            ];
            return view('admin/brand/create', $data);
        } else {
            $images_brand = $this->request->getFile('images_brand');

            if ($images_brand->getError() == 4) {
                $nama_images = 'default.png';
            } else {
                $nama_images = $images_brand->getRandomName();
                $images_brand->move('assets/img/brand', $nama_images);
            }

            $this->brandModel->insert([
                'nama_brand' => $this->request->getPost('nama_brand'),
                'slug_brand' => $this->request->getPost('slug_brand'),
                'images_brand' => $nama_images,
            ]);

            session()->setFlashdata('success', 'Data Brand berhasil disimpan');
            return redirect()->to(base_url('admin/brand'));
        }
    }

    public function edit($slug)
    {
        $data = [
            'title_tab' => 'Edit Brand - Novyantoryshop',
            'title' => 'Brand',
            'title_detail' => 'Edit Brand',
            'validation' => \Config\Services::validation(),
            'brand' => $this->brandModel->getBrandBySlug($slug),
        ];

        return view('admin/brand/edit', $data);
    }

    public function update($slug)
    {
        $rules = [
            'nama_brand' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Brand tidak boleh kosong'
                ],
            ],
            'images_brand' => [
                'rules' => 'max_size[images_brand,1024]|mime_in[images_brand,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => "Ukuran gambar melebihi 1MB",
                    'mime_in' => "jenis file yang diizinkan hanya PNG atau JPEG"

                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Edit Brand - Novyantoryshop',
                'title' => 'Brand',
                'title_detail' => 'Edit Brand',
                'validation' => \Config\Services::validation(),
                'brand' => $this->brandModel->getBrandBySlug($slug),
            ];

            return view('admin/brand/edit', $data);
        } else {
            $brandModel = $this->brandModel->where('slug_brand', $slug)->first();
            $lokasiFile = FCPATH . 'assets/img/brand/';
            $fileLama = $lokasiFile . $brandModel['images_brand'];

            $images_brand = $this->request->getFile('images_brand');

            if ($images_brand->getError() == 4) {
                $nama_images = $this->request->getPost('images_lama');
            } else {
                $nama_images = $images_brand->getRandomName();
                $images_brand->move('assets/img/brand', $nama_images);

                if (is_file($fileLama)) {
                    unlink($fileLama);
                }
            }

            $this->brandModel->where('slug_brand', $slug)
                ->set([
                    'nama_brand' => $this->request->getPost('nama_brand'),
                    'slug_brand' => $this->request->getPost('slug_brand'),
                    'images_brand' => $nama_images,
                ])
                ->update();

            session()->setFlashdata('success', 'Data Brand berhasil diupdate');
            return redirect()->to(base_url('admin/brand'));
        }
    }

    public function delete($slug)
    {
        $brand = $this->brandModel->getBrandBySlug($slug);

        $brandModel = $this->brandModel->where('slug_brand', $slug)->first();
        $lokasiFile = FCPATH . 'assets/img/brand/';
        $fileLama = $lokasiFile . $brandModel['images_brand'];

        if ($brand) {
            $this->brandModel->where('slug_brand', $slug)->delete();
            if (is_file($fileLama)) {
                unlink($fileLama);
            }
        }

        session()->setFlashdata('success', 'Data Brand berhasil dihapus');
        return redirect()->to(base_url('admin/brand'));
    }
}
