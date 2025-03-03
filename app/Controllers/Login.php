<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    private $adminModel;
    private $usersModel;

    function __construct()
    {
        helper(['url', 'form']);
        $this->adminModel = new AdminModel();
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation(),
        ];

        return view('sign-in', $data);
    }

    public function login()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            return view('sign-in', $data);
        } else {
            $username = $this->request->getVar('username');

            $admin = $this->adminModel->where('username', $username)->orWhere('email', $username)->where('role_id', 'Admin')->first();
            $user = $this->usersModel->where('username', $username)->orWhere('email_user', $username)->where('role_id', 'User')->first();

            if ($admin !== null) {
                return $this->loginAdmin($admin);
            } elseif ($user !== null) {
                return $this->loginUser($user);
            } else {
                session()->setFlashdata('pesan', 'Email atau Username tidak terdaftar, silahkan coba lagi');
                return redirect()->to(base_url('signin'));
            }
        }
    }

    private function loginAdmin()
    {
        $session = session();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $admin = $this->adminModel->where('role_id', 'Admin')->first();
        $role_id = $admin['role_id'];

        $cekusername = $this->adminModel->where('username', $username)->first();
        if ($cekusername) {
            $password_db = $cekusername['password'];
            $cek_password = password_verify($password, $password_db);
            if (!$cek_password) {
                $session->setFlashdata('pesan', 'Password salah, silahkan coba lagi');
                return redirect()->to(base_url('signin'));
            } else {
                $session_data = [
                    'admin_id' => $cekusername['id'],
                    'username' => $cekusername['username'],
                    'admin_name' => $cekusername['nama'],
                    'admin_images' => $cekusername['images'],
                    'logged_in' => TRUE,
                    'role_id' => $role_id,
                ];
                $session->set($session_data);

                return redirect()->to(base_url('admin/home'));
            }
        } else {
            $session->setFlashdata('pesan', 'Username anda salah, silahkan coba lagi');
            return redirect()->to(base_url('signin'));
        }
    }

    private function loginUser()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $users = $this->usersModel->where('role_id', 'User')->first();
        $role_id = $users['role_id'];

        $cekAll = $this->usersModel
            ->where('username', $username)
            ->orWhere('email_user', $username)
            ->first();

        if ($cekAll['status_aktif_user'] === 'Nonaktif') {
            $session->setFlashdata('pesan', 'Akun tidak aktif, silahkan periksa email dan lakukan verifikasi');
            return redirect()->to(base_url('signin'));
        } else {
            $password_db = $cekAll['password_user'];
            $cek_password = password_verify($password, $password_db);
            if (!$cek_password) {
                $session->setFlashdata('pesan', 'Password salah, silahkan coba lagi');
                return redirect()->to(base_url('signin'));
            } else {
                $session_data = [
                    'user_id' => $cekAll['id'],
                    'username' => $cekAll['username'],
                    'nama_user' => $cekAll['nama_user'],
                    'email_user' => $cekAll['email_user'],
                    'images_user' => $cekAll['images_user'],
                    'status_aktif_user' => $cekAll['status_aktif_user'],
                    'logged_in' => TRUE,
                    'role_id' => $role_id,
                ];
                $session->set($session_data);

                return redirect()->to(base_url('user/home'));
            }
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('signin'));
    }
}
