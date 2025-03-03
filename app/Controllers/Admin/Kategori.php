<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\SubkategoriModel;
use App\Models\SubsubkategoriModel;
use CodeIgniter\HTTP\ResponseInterface;

class Kategori extends BaseController
{
    private $kategoriModel;
    private $subkategoriModel;
    private $subsubkategoriModel;

    function __construct()
    {
        helper(['url', 'form']);
        $this->kategoriModel = new KategoriModel();
        $this->subkategoriModel = new SubkategoriModel();
        $this->subsubkategoriModel = new SubsubkategoriModel();
    }

    public function kategori()
    {
        $data = [
            'title_tab' => 'Kategori List - Novyantoryshop',
            'title' => 'Kategori',
            'title_detail' => 'Kategori List',
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategoriModel->findAll()
        ];

        return view('admin/kategori/kategori', $data);
    }

    public function subkategori()
    {
        $data = [
            'title_tab' => 'Sub Kategori List - Novyantoryshop',
            'title' => 'Sub Kategori',
            'title_detail' => 'Sub Kategori List',
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategoriModel->findAll(),
            'subkategori' => $this->subkategoriModel->getSubKategori(),
        ];

        return view('admin/kategori/subkategori', $data);
    }

    public function subsubkategori()
    {
        $data = [
            'title_tab' => 'Sub-sub Kategori List - Novyantoryshop',
            'title' => 'Sub-sub Kategori',
            'title_detail' => 'Sub-sub Kategori List',
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategoriModel->findAll(),
            'subkategori' => $this->subkategoriModel->getSubKategori(),
            'subsubkategori' => $this->subsubkategoriModel->getSubSubKategori(),
        ];

        return view('admin/kategori/subsubkategori', $data);
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

    public function storekategori()
    {
        $rules = [
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kategori tidak boleh kosong'
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Add Kategori - Novyantoryshop',
                'title' => 'Kategori',
                'title_detail' => 'Add Kategori',
                'validation' => \Config\Services::validation(),
            ];
            return view('admin/kategori', $data);
        } else {

            $this->kategoriModel->insert([
                'kategori' => $this->request->getPost('kategori'),
                'slug_kategori' => $this->request->getPost('slug_kategori'),
            ]);

            session()->setFlashdata('success', 'Data kategori berhasil disimpan');
            return redirect()->to(base_url('admin/kategori'));
        }
    }

    public function storesubkategori()
    {
        $rules = [
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
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Add Sub Kategori - Novyantoryshop',
                'title' => 'Sub Kategori',
                'title_detail' => 'Add Sub Kategori',
                'validation' => \Config\Services::validation(),
                'kategori' => $this->kategoriModel->findAll(),
                'subkategori' => $this->subkategoriModel->getSubKategori(),
            ];
            return view('admin/kategori/subkategori', $data);
        } else {

            $this->subkategoriModel->insert([
                'subkategori' => $this->request->getPost('subkategori'),
                'slug_subkategori' => $this->request->getPost('slug_subkategori'),
                'kategori_id' => $this->request->getPost('kategori'),
            ]);

            session()->setFlashdata('success', 'Data Sub Kategori berhasil disimpan');
            return redirect()->to(base_url('admin/subkategori'));
        }
    }

    public function storesubsubkategori()
    {
        $rules = [
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
                'title_tab' => 'Sub-sub Kategori List - Novyantoryshop',
                'title' => 'Sub-sub Kategori',
                'title_detail' => 'Sub-sub Kategori List',
                'validation' => \Config\Services::validation(),
                'kategori' => $this->kategoriModel->findAll(),
                'subkategori' => $this->subkategoriModel->getSubKategori(),
                'subsubkategori' => $this->subsubkategoriModel->getSubSubKategori(),
            ];
            return view('admin/kategori/subsubkategori', $data);
        } else {

            $this->subsubkategoriModel->insert([
                'subsubkategori' => $this->request->getPost('subsubkategori'),
                'slug_subsubkategori' => $this->request->getPost('slug_subsubkategori'),
                'subkategori_id' => $this->request->getPost('subkategori'),
            ]);

            session()->setFlashdata('success', 'Data Sub-sub Kategori berhasil disimpan');
            return redirect()->to(base_url('admin/subsubkategori'));
        }
    }

    public function editkategori($id)
    {
        $data = [
            'title_tab' => 'Edit Kategori - Novyantoryshop',
            'title' => 'Kategori',
            'title_detail' => 'Edit Kategori',
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategoriModel->find($id),
        ];

        return view('admin/kategori/edit-kategori', $data);
    }

    public function editsubkategori($id)
    {
        $data = [
            'title_tab' => 'Edit Sub Kategori - Novyantoryshop',
            'title' => 'Sub Kategori',
            'title_detail' => 'Edit Sub Kategori',
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategoriModel->findAll(),
            'subkategori' => $this->subkategoriModel->getSubKategoriById($id)
        ];

        return view('admin/kategori/edit-subkategori', $data);
    }

    public function editsubsubkategori($id)
    {
        $data = [
            'title_tab' => 'Edit Sub-sub Kategori - Novyantoryshop',
            'title' => 'Sub-sub Kategori',
            'title_detail' => 'Edit Sub-sub Kategori',
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategoriModel->findAll(),
            'subsubkategori' => $this->subsubkategoriModel->getSubSubKategoriById($id)
        ];

        // dd($data);
        return view('admin/kategori/edit-subsubkategori', $data);
    }

    public function updatekategori($id)
    {
        $rules = [
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kategori tidak boleh kosong'
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Edit Kategori - Novyantoryshop',
                'title' => 'Kategori',
                'title_detail' => 'Edit Kategori',
                'validation' => \Config\Services::validation(),
                'kategori' => $this->kategoriModel->find($id),
            ];

            return view('admin/kategori/edit-kategori', $data);
        } else {
            $this->kategoriModel->where('id', $id)
                ->set([
                    'kategori' => $this->request->getPost('kategori'),
                    'slug_kategori' => $this->request->getPost('slug_kategori'),
                ])
                ->update();

            session()->setFlashdata('success', 'Data kategori berhasil diupdate');
            return redirect()->to(base_url('admin/kategori'));
        }
    }

    public function updatesubkategori($id)
    {
        $rules = [
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kategori tidak boleh kosong'
                ],
            ],
            'subkategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kategori tidak boleh kosong'
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Edit Sub Kategori - Novyantoryshop',
                'title' => 'Sub Kategori',
                'title_detail' => 'Edit Sub Kategori',
                'validation' => \Config\Services::validation(),
                'kategori' => $this->kategoriModel->findAll(),
                'subkategori' => $this->subkategoriModel->getSubKategoriById($id)
            ];
            return view('admin/kategori/edit-subkategori', $data);
        } else {
            $this->subkategoriModel->where('id', $id)
                ->set([
                    'subkategori' => $this->request->getPost('subkategori'),
                    'slug_subkategori' => $this->request->getPost('slug_subkategori'),
                    'kategori_id' => $this->request->getPost('kategori'),
                ])
                ->update();

            session()->setFlashdata('success', 'Data sub kategori berhasil diupdate');
            return redirect()->to(base_url('admin/subkategori'));
        }
    }

    public function updatesubsubkategori($id)
    {
        $rules = [
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
                'title_tab' => 'Edit Sub-sub Kategori - Novyantoryshop',
                'title' => 'Sub-sub Kategori',
                'title_detail' => 'Edit Sub-sub Kategori',
                'validation' => \Config\Services::validation(),
                'kategori' => $this->kategoriModel->findAll(),
                'subkategori' => $this->subkategoriModel->getSubKategoriById($id),
                'subsubkategori' => $this->subsubkategoriModel->getSubSubKategoriById($id)
            ];
            return view('admin/kategori/edit-subsubkategori', $data);
        } else {
            $this->subsubkategoriModel->where('id', $id)
                ->set([
                    'subsubkategori' => $this->request->getPost('subsubkategori'),
                    'slug_subsubkategori' => $this->request->getPost('slug_subsubkategori'),
                    'subkategori_id' => $this->request->getPost('subkategori'),
                ])
                ->update();

            session()->setFlashdata('success', 'Data sub-sub kategori berhasil diupdate');
            return redirect()->to(base_url('admin/subsubkategori'));
        }
    }

    public function deletesubsubkategori($id)
    {
        $subsubkategori = $this->subsubkategoriModel->where('id', $id)->first();

        if ($subsubkategori) {
            $this->subsubkategoriModel->where('id', $id)->delete();
        }

        session()->setFlashdata('success', 'Data Sub-sub kategori berhasil dihapus');
        return redirect()->to(base_url('admin/subsubkategori'));
    }
}
