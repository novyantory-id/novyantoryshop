<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KabupatenModel;
use App\Models\KecamatanModel;
use App\Models\ProvinsiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Provinsi extends BaseController
{
    private $provinsiModel;
    private $kabupatenModel;
    private $kecamatanModel;

    function __construct()
    {
        helper(['url', 'form']);
        $this->provinsiModel = new ProvinsiModel();
        $this->kabupatenModel = new KabupatenModel();
        $this->kecamatanModel = new KecamatanModel();
    }

    public function provinsi()
    {
        $data = [
            'title_tab' => 'Provinsi List - Novyantoryshop',
            'title' => 'Provinsi',
            'title_detail' => 'Provinsi List',
            'validation' => \Config\Services::validation(),
            'provinsi' => $this->provinsiModel->findAll()
        ];
        return view('admin/provinsi/provinsi', $data);
    }

    public function kabupaten()
    {
        $data = [
            'title_tab' => 'Kabupaten List - Novyantoryshop',
            'title' => 'Kabupaten',
            'title_detail' => 'Kabupaten List',
            'validation' => \Config\Services::validation(),
            'provinsi' => $this->provinsiModel->findAll(),
            'kabupaten' => $this->kabupatenModel->getKabupaten()
        ];
        return view('admin/provinsi/kabupaten', $data);
    }

    public function kecamatan()
    {
        $data = [
            'title_tab' => 'Kecamatan List - Novyantoryshop',
            'title' => 'Kecamatan',
            'title_detail' => 'Kecamatan List',
            'validation' => \Config\Services::validation(),
            'provinsi' => $this->provinsiModel->findAll(),
            'kabupaten' => $this->kabupatenModel->findAll(),
            'kecamatan' => $this->kecamatanModel->getKecamatan()
        ];
        // dd($data);
        return view('admin/provinsi/kecamatan', $data);
    }

    public function getKabupaten()
    {
        if ($this->request->isAJAX()) {

            // key data AJAX diterima dari data: provinsi_id
            $provinsiId = $this->request->getVar('provinsi_id');

            if (!$provinsiId) {
                return $this->response->setJSON(['error' => 'Provinsi ID tidak ditemukan']);
            }

            // Debugging provinsi_id
            log_message('debug', 'Provinsi ID: ' . $provinsiId);

            // ambil data dari kabupaten[provinsi_id]
            $kabupatenList = $this->kabupatenModel->where('provinsi_id', $provinsiId)->findAll();

            // kembalikan data dalam bentuk JSON ke Javascript
            return $this->response->setJSON($kabupatenList); //Kirim data sebagai JSON
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException('Permintaan tidak valid.');
    }

    public function storeprovinsi()
    {
        $rules = [
            'provinsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Provinsi tidak boleh kosong'
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Provinsi List - Novyantoryshop',
                'title' => 'Provinsi',
                'title_detail' => 'Provinsi List',
                'validation' => \Config\Services::validation(),
                'provinsi' => $this->provinsiModel->findAll()
            ];
            return view('admin/provinsi/provinsi', $data);
        } else {

            $this->provinsiModel->insert([
                'provinsi' => $this->request->getPost('provinsi'),
            ]);

            session()->setFlashdata('berhasil', 'Data Provinsi berhasil disimpan');
            return redirect()->to(base_url('admin/provinsi'));
        }
    }

    public function storekabupaten()
    {
        $rules = [
            'provinsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama provinsi tidak boleh kosong'
                ],
            ],
            'kabupaten' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kabupaten tidak boleh kosong'
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Kabupaten List - Novyantoryshop',
                'title' => 'Kabupaten',
                'title_detail' => 'Kabupaten List',
                'validation' => \Config\Services::validation(),
                'provinsi' => $this->provinsiModel->findAll(),
                'kabupaten' => $this->kabupatenModel->getKabupaten()
            ];
            return view('admin/provinsi/kabupaten', $data);
        } else {

            $this->kabupatenModel->insert([
                'kabupaten' => $this->request->getPost('kabupaten'),
                'provinsi_id' => $this->request->getPost('provinsi'),
            ]);

            session()->setFlashdata('berhasil', 'Data Provinsi berhasil disimpan');
            return redirect()->to(base_url('admin/kabupaten'));
        }
    }

    public function storekecamatan()
    {
        $rules = [
            'provinsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama provinsi tidak boleh kosong'
                ],
            ],
            'kabupaten' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kabupaten tidak boleh kosong'
                ],
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kecamatan tidak boleh kosong'
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Kecamatan List - Novyantoryshop',
                'title' => 'Kecamatan',
                'title_detail' => 'Kecamatan List',
                'validation' => \Config\Services::validation(),
                'provinsi' => $this->provinsiModel->findAll(),
                'kabupaten' => $this->kabupatenModel->findAll(),
                'kecamatan' => $this->kecamatanModel->getKecamatan()
            ];
            return view('admin/provinsi/kecamatan', $data);
        } else {

            $this->kecamatanModel->insert([
                'kecamatan' => $this->request->getPost('kecamatan'),
                'kabupaten_id' => $this->request->getPost('kabupaten'),
            ]);

            session()->setFlashdata('berhasil', 'Data Kecamatan berhasil disimpan');
            return redirect()->to(base_url('admin/kecamatan'));
        }
    }

    public function editprovinsi($id)
    {
        $data = [
            'title_tab' => 'Edit Provinsi - Novyantoryshop',
            'title' => 'Provinsi',
            'title_detail' => 'Edit Provinsi',
            'validation' => \Config\Services::validation(),
            'provinsi' => $this->provinsiModel->find($id),
        ];

        return view('admin/provinsi/edit-provinsi', $data);
    }

    public function editkabupaten($id)
    {
        $data = [
            'title_tab' => 'Edit Kabupaten - Novyantoryshop',
            'title' => 'Kabupaten',
            'title_detail' => 'Edit Kabupaten',
            'validation' => \Config\Services::validation(),
            'provinsi' => $this->provinsiModel->findAll(),
            'kabupaten' => $this->kabupatenModel->getKabupatenById($id)
        ];

        return view('admin/provinsi/edit-kabupaten', $data);
    }

    public function editkecamatan($id)
    {
        $data = [
            'title_tab' => 'Edit Kecamatan - Novyantoryshop',
            'title' => 'Kecamatan',
            'title_detail' => 'Edit Kecamatan',
            'validation' => \Config\Services::validation(),
            'provinsi' => $this->provinsiModel->findAll(),
            // 'kabupaten' => $this->kabupatenModel->getKabupatenById($id),
            'kecamatan' => $this->kecamatanModel->getKecamatanById($id)
        ];
        // dd($data);
        return view('admin/provinsi/edit-kecamatan', $data);
    }

    public function updateprovinsi($id)
    {
        $rules = [
            'provinsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama provinsi tidak boleh kosong'
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Edit Provinsi - Novyantoryshop',
                'title' => 'Provinsi',
                'title_detail' => 'Edit Provinsi',
                'validation' => \Config\Services::validation(),
                'provinsi' => $this->provinsiModel->find($id),
            ];

            return view('admin/provinsi/edit-provinsi', $data);
        } else {
            $this->provinsiModel->where('id', $id)
                ->set([
                    'provinsi' => $this->request->getPost('provinsi'),
                ])
                ->update();

            session()->setFlashdata('berhasil', 'Data provinsi berhasil diupdate');
            return redirect()->to(base_url('admin/provinsi'));
        }
    }

    public function updatekabupaten($id)
    {
        $rules = [
            'provinsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama provinsi tidak boleh kosong'
                ],
            ],
            'kabupaten' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kabupaten tidak boleh kosong'
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Edit Kabupaten - Novyantoryshop',
                'title' => 'Kabupaten',
                'title_detail' => 'Edit Kabupaten',
                'validation' => \Config\Services::validation(),
                'provinsi' => $this->provinsiModel->findAll(),
                'kabupaten' => $this->kabupatenModel->getKabupatenById($id)
            ];

            return view('admin/provinsi/edit-kabupaten', $data);
        } else {
            $this->kabupatenModel->where('id', $id)
                ->set([
                    'kabupaten' => $this->request->getPost('kabupaten'),
                    'provinsi_id' => $this->request->getPost('provinsi'),
                ])
                ->update();

            session()->setFlashdata('berhasil', 'Data kabupaten berhasil diupdate');
            return redirect()->to(base_url('admin/kabupaten'));
        }
    }

    public function updatekecamatan($id)
    {
        $rules = [
            'provinsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama provinsi tidak boleh kosong'
                ],
            ],
            'kabupaten' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kabupaten tidak boleh kosong'
                ],
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kecamatan tidak boleh kosong'
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Edit Kecamatan - Novyantoryshop',
                'title' => 'Kecamatan',
                'title_detail' => 'Edit Kecamatan',
                'validation' => \Config\Services::validation(),
                'provinsi' => $this->provinsiModel->findAll(),
                // 'kabupaten' => $this->kabupatenModel->getKabupatenById($id),
                'kecamatan' => $this->kecamatanModel->getKecamatanById($id)
            ];
            // dd($data);
            return view('admin/provinsi/edit-kecamatan', $data);
        } else {
            $this->kecamatanModel->where('id', $id)
                ->set([
                    'kecamatan' => $this->request->getPost('kecamatan'),
                    'kabupaten_id' => $this->request->getPost('kabupaten'),
                ])
                ->update();

            session()->setFlashdata('berhasil', 'Data kecamatan berhasil diupdate');
            return redirect()->to(base_url('admin/kecamatan'));
        }
    }

    public function deletekecamatan($id)
    {
        $kecamatan = $this->kecamatanModel->where('id', $id)->first();

        if ($kecamatan) {
            $this->kecamatanModel->where('id', $id)->delete();
        }

        session()->setFlashdata('berhasil', 'Data kecamatan berhasil dihapus');
        return redirect()->to(base_url('admin/kecamatan'));
    }
}
