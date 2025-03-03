<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SlidesModel;
use CodeIgniter\HTTP\ResponseInterface;

class Slides extends BaseController
{
    private $slidesModel;

    function __construct()
    {
        helper(['url', 'form']);
        $this->slidesModel = new SlidesModel();
    }

    public function index()
    {
        $data = [
            'title_tab' => 'Slides List - Novyantoryshop',
            'title' => 'Slides',
            'title_detail' => 'Slides List',
            'slides' => $this->slidesModel->findAll()
        ];

        return view('admin/slides/index', $data);
    }

    public function create()
    {
        $data = [
            'title_tab' => 'Add Slides - Novyantoryshop',
            'title' => 'Slides',
            'title_detail' => 'Add Slides',
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/slides/create', $data);
    }

    public function store()
    {
        $rules = [
            'judul_slides' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul tidak boleh kosong'
                ],
            ],
            'deskripsi_slides' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi tidak boleh kosong'
                ],
            ],
            'images_slides' => [
                'rules' => 'uploaded[images_slides]|max_size[images_slides,1024]|mime_in[images_slides,image/png,image/jpeg]',
                'errors' => [
                    'uploaded' => "File gambar wajib diupload",
                    'max_size' => "Ukuran gambar melebihi 1MB",
                    'mime_in' => "jenis file yang diizinkan hanya PNG atau JPEG"

                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Add Slides - Novyantoryshop',
                'title' => 'Slides',
                'title_detail' => 'Add Slides',
                'validation' => \Config\Services::validation(),
            ];
            return view('admin/slides/create', $data);
        } else {
            $images_slides = $this->request->getFile('images_slides');

            if ($images_slides->getError() == 4) {
                $nama_images = 'default.png';
            } else {
                $nama_images = $images_slides->getRandomName();
                $images_slides->move('assets/img/slides', $nama_images);
            }

            $this->slidesModel->insert([
                'judul_slides' => $this->request->getPost('judul_slides'),
                'deskripsi_slides' => $this->request->getPost('deskripsi_slides'),
                'images_slides' => $nama_images,
            ]);

            session()->setFlashdata('success', 'Data Slides berhasil disimpan');
            return redirect()->to(base_url('admin/slides'));
        }
    }

    public function edit($id)
    {
        $data = [
            'title_tab' => 'Edit Slides - Novyantoryshop',
            'title' => 'Slides',
            'title_detail' => 'Edit Slides',
            'validation' => \Config\Services::validation(),
            'slides' => $this->slidesModel->find($id),
        ];

        return view('admin/slides/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'judul_slides' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul tidak boleh kosong'
                ],
            ],
            'deskripsi_slides' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi tidak boleh kosong'
                ],
            ],
            'images_slides' => [
                'rules' => 'max_size[images_slides,1024]|mime_in[images_slides,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => "Ukuran gambar melebihi 1MB",
                    'mime_in' => "jenis file yang diizinkan hanya PNG atau JPEG"

                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Edit Slides - Novyantoryshop',
                'title' => 'Slides',
                'title_detail' => 'Edit Slides',
                'validation' => \Config\Services::validation(),
                'slides' => $this->slidesModel->find($id),
            ];
            return view('admin/slides/edit', $data);
        } else {
            $slidesModel = $this->slidesModel->where('id', $id)->first();
            $lokasiFile = FCPATH . 'assets/img/slides/';
            $fileLama = $lokasiFile . $slidesModel['images_slides'];

            $images_slides = $this->request->getFile('images_slides');

            if ($images_slides->getError() == 4) {
                $nama_images = $this->request->getPost('images_lama');
            } else {
                $nama_images = $images_slides->getRandomName();
                $images_slides->move('assets/img/slides', $nama_images);

                if (is_file($fileLama)) {
                    unlink($fileLama);
                }
            }

            $this->slidesModel->where('id', $id)
                ->set([
                    'judul_slides' => $this->request->getPost('judul_slides'),
                    'deskripsi_slides' => $this->request->getPost('deskripsi_slides'),
                    'images_slides' => $nama_images,
                ])
                ->update();

            session()->setFlashdata('success', 'Data Slides berhasil disimpan');
            return redirect()->to(base_url('admin/slides'));
        }
    }

    public function delete($id)
    {
        $slides = $this->slidesModel->find($id);

        $slidesModel = $this->slidesModel->where('id', $id)->first();
        $lokasiFile = FCPATH . 'assets/img/slides/';
        $fileLama = $lokasiFile . $slidesModel['images_slides'];

        if ($slides) {
            $this->slidesModel->where('id', $id)->delete();
            if (is_file($fileLama)) {
                unlink($fileLama);
            }
        }

        session()->setFlashdata('success', 'Data Slides berhasil dihapus');
        return redirect()->to(base_url('admin/slides'));
    }
}
