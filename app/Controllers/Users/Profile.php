<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class Profile extends BaseController
{
    private $usersModel;
    function __construct()
    {
        helper(['url', 'form']);
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $user_id = session()->get('user_id');

        $user = $this->usersModel->find($user_id);
        $data = [
            'title' => 'Profile - Novyantoryshop',
            'user' => $user,
        ];

        return view('users/profile', $data);
    }

    public function edit()
    {
        $user_id = session()->get('user_id');
        $user = $this->usersModel->find($user_id);

        $data = [
            'title' => 'Edit Profile - Novyantoryshop',
            'user' => $user,
        ];

        return view('users/editprofile', $data);
    }

    public function update()
    {
        $rules = [
            // 'images_dosen' => [
            //     'rules' => 'max_size[images_dosen,1024]|mime_in[images_dosen,image/png,image/jpeg]',
            //     'errors' => [
            //         'max_size' => 'Ukuran foto melebihi 1MB',
            //         'mime_in' => 'Jenis file yang diizinkan hanya PNG atau JPG'
            //     ],
            // ],
            'nama_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap pengguna tidak boleh kosong'
                ],
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username tidak boleh kosong'
                ],
            ],
            'jk_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Gender harus dipilih'
                ],
            ],
            'tgl_lahir_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal lahir tidak boleh kosong'
                ],
            ],
            'email_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email pengguna tidak boleh kosong'
                ],
            ],
            'nohp_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor handphone user tidak boleh kosong'
                ],
            ],
        ];
        if (!$this->validate($rules)) {
            $user_id = session()->get('user_id');
            $user = $this->usersModel->find($user_id);

            $data = [
                'title' => 'Edit Profile - Novyantoryshop',
                'user' => $user,
            ];

            echo view('users/editprofile', $data);
        }
        $user_id = session()->get('user_id');
        $this->usersModel->where('id', $user_id)->set([
            'nama_user' => htmlspecialchars($this->request->getPost('nama_user')),
            'jk_user' => htmlspecialchars($this->request->getPost('jk_user')),
            'tgl_lahir_user' => htmlspecialchars($this->request->getPost('tgl_lahir_user')),
            'email_user' => $this->request->getPost('email_user'),
            'nohp_user' => htmlspecialchars($this->request->getPost('nohp_user')),
        ])
            ->update();

        session()->setFlashdata('berhasil', 'Profile berhasil diupdate');
        return redirect()->to(base_url('user/profile'));
    }
}
