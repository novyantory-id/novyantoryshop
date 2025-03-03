<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KuponModel;
use CodeIgniter\HTTP\ResponseInterface;

class Kupon extends BaseController
{
    private $kuponModel;

    function __construct()
    {
        helper(['url', 'form']);
        $this->kuponModel = new KuponModel();
    }

    public function index()
    {
        $data = [
            'title_tab' => 'Kupon List - Novyantoryshop',
            'title' => 'Kupon',
            'title_detail' => 'Kupon List',
            'kupon' => $this->kuponModel->findAll()
        ];

        return view('admin/kupon/index', $data);
    }

    public function create()
    {
        $data = [
            'title_tab' => 'Add Coupon - Novyantoryshop',
            'title' => 'Coupon',
            'title_detail' => 'Add Coupon',
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/kupon/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama_kupon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode kupon tidak boleh kosong'
                ],
            ],
            'diskon_kupon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Diskon kupon tidak boleh boleh kosong'
                ],
            ],
            'validasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Validasi date harus diatur'
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Add Coupon - Novyantoryshop',
                'title' => 'Coupon',
                'title_detail' => 'Add Coupon',
                'validation' => \Config\Services::validation(),
            ];
            return view('admin/kupon/create', $data);
        } else {

            $this->kuponModel->insert([
                'nama_kupon' => $this->request->getPost('nama_kupon'),
                'diskon_kupon' => $this->request->getPost('diskon_kupon'),
                'validasi' => $this->request->getPost('validasi'),
            ]);

            session()->setFlashdata('berhasil', 'Data Kupon berhasil disimpan');
            return redirect()->to(base_url('admin/kupon'));
        }
    }

    public function edit($id)
    {
        $data = [
            'title_tab' => 'Edit Coupon - Novyantoryshop',
            'title' => 'Coupon',
            'title_detail' => 'Edit Coupon',
            'validation' => \Config\Services::validation(),
            'kupon' => $this->kuponModel->find($id),
        ];

        return view('admin/kupon/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama_kupon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode kupon tidak boleh kosong'
                ],
            ],
            'diskon_kupon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Diskon kupon tidak boleh boleh kosong'
                ],
            ],
            'validasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Validasi date harus diatur'
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'title_tab' => 'Edit Coupon - Novyantoryshop',
                'title' => 'Coupon',
                'title_detail' => 'Edit Coupon',
                'validation' => \Config\Services::validation(),
                'kupon' => $this->kuponModel->find($id),
            ];
            return view('admin/kupon/edit', $data);
        } else {
            $kuponModel = $this->kuponModel->where('id', $id)->first();

            $this->kuponModel->where('id', $id)
                ->set([
                    'nama_kupon' => $this->request->getPost('nama_kupon'),
                    'diskon_kupon' => $this->request->getPost('diskon_kupon'),
                    'validasi' => $this->request->getPost('validasi'),
                    'status_kupon' => $this->request->getPost('status_kupon'),
                ])
                ->update();

            session()->setFlashdata('berhasil', 'Data kupon berhasil diupdate');
            return redirect()->to(base_url('admin/kupon'));
        }
    }

    public function delete($id)
    {
        $kupon = $this->kuponModel->find($id);

        if ($kupon) {
            $this->kuponModel->where('id', $id)->delete();
        }

        session()->setFlashdata('berhasil', 'Data kupon berhasil dihapus');
        return redirect()->to(base_url('admin/kupon'));
    }
}
