<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class Register extends BaseController
{
    private $usersModel;
    function __construct()
    {
        helper(['url', 'form']);
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation(),
        ];

        return view('register', $data);
    }

    public function store()
    {
        $rules = [
            'nama_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap tidak boleh kosong'
                ],
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username tidak boleh kosong'
                ],
            ],
            'nohp_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No telepon tidak boleh kosong'
                ],
            ],
            'email_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email tidak boleh kosong'
                ],
            ],
            'tgl_lahir_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal lahir tidak boleh kosong'
                ],
            ],
            'password_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong'
                ],
            ],
            'konfirmasi_password' => [
                'rules' => 'required|matches[password_user]',
                'errors' => [
                    'required' => 'Konfirmasi password tidak boleh kosong',
                    'matches' => 'Konfirmasi password tidak cocok'
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            $data = [
                'validation' => \Config\Services::validation(),
            ];

            echo view('register', $data);
        } else {
            $kodeVerifikasi = random_int(100000, 999999);
            $urlVerifikasi = bin2hex(random_bytes(20));
            $link = base_url('akun/verifikasi?user=' . $kodeVerifikasi . '&verify=' . $urlVerifikasi);
            // dd($link);
            $nama_user = htmlspecialchars($this->request->getPost('nama_user'));
            $username = htmlspecialchars($this->request->getPost('username'));
            $email_user = htmlspecialchars($this->request->getPost('email_user'));

            $this->usersModel->insert([
                'nama_user' => $nama_user,
                'username' => $username,
                'email_user' => $email_user,
                'tgl_lahir_user' => $this->request->getPost('tgl_lahir_user'),
                'nohp_user' => htmlspecialchars($this->request->getPost('nohp_user')),
                'password_user' => password_hash($this->request->getPost('password_user'), PASSWORD_DEFAULT),
                'images_user' => 'avatar.jpg',
                'kode_verifikasi_user' => $kodeVerifikasi,
                'url_verifikasi_user' => $urlVerifikasi,
                'status_aktif_user' => 'Nonaktif',
                'tgl_daftar_user' => date('Y-m-d'),
                'role_id' => 'User',

            ]);

            $messageUp = <<<EOD

<html>
<head>
	<style>
		body{font-family: Arial, sans-serif; color: #333;}

		.begin h2{
text-align: center;
.begin a {
	background-color: #9f0692;
}
		}
	</style>
</head>
<body>
<div class="begin">
	<h2>Selamat datang di NovyantoryShop!</h2>

	<p>Terima kasih telah bergabung dengan NovyantoryShop. Berikut adalah detail akun Anda. Pastikan Anda menyimpannya dengan aman.</p>

	<p>Username: 
EOD;
            $messageUp2 = <<<EOD
<br>
		Alamat email: 
EOD;
            $messageMid = <<<EOD
            </p>

	<p>Namun, sebelum Anda menggunakan akun tersebut, harap lakukan aktivasi dengan mengklik tombol di bawah ini</p>

	<a href="
EOD;
            $messageMid2 = <<<EOD
           " style="background-color: #9f0692; padding: 15px; color: #fff; text-decoration: none;">Aktivasi akun</a>
	<br>
	<br>

	<p>Jika tombol di atas tidak berfungsi, salin tautan berikut dan masukkan ke peramban web Anda:</p>

</div>

<div class="mid-class">
	<p style="background-color: gray; padding: 15px; text-decoration: none; border-radius: 5px; color: blue;"> 
EOD;
            $messageDown = <<<EOD
           </p>

	<p>Catatan: Jika email ini masuk di folder Spam, harap tandai sebagai bukan Spam dan tambahkan alamat email ini ke kontak Anda.</p>
</div>

<p>Salam sukses,
<br>
Tim NovyantoryShop</p>
<p style="text-align: center;">NovyantoryShop.com, All right reserved.</p>

</body>
</html> 
EOD;

            $emailService = \Config\Services::email();
            $emailService->setTo($email_user);
            $emailService->setFrom('yourgmail@gmail.com', 'Tim Admin NovyantoryShop');
            $emailService->setSubject('Verifikasi Akun Baru');
            $emailService->setMessage($messageUp . $username . $messageUp2 . $email_user . $messageMid . $link . $messageMid2 . $link . $messageDown);
            $emailService->setMailType('html');

            if ($emailService->send()) {
                session()->setFlashdata('berhasil', 'Kode verifikasi telah dikirim ke email Anda.');
                session()->setFlashdata('verifikasi', 'Tautan verifikasi akun telah dikirim ke email Anda.');
                return redirect()->to(base_url('signin'));
            } else {
                return redirect()->to(base_url('register'));
            }
            // session()->setFlashdata('berhasil', 'Tautan verifikasi telah dikirim ke email Anda.');
            // return redirect()->to(base_url('login'));
        }
    }

    public function verifikasi()
    {
        $kodeVerifikasi = $this->request->getGet('user');
        $urlVerifikasi = $this->request->getGet('verify');

        $user = $this->usersModel->getVerify($kodeVerifikasi, $urlVerifikasi);

        if ($user->status_aktif_user === 'Aktif') {
            return redirect()->to(base_url('signin'));
        }

        $user_id = $user->id;
        // Update order
        $this->usersModel->update($user_id, [
            'status_aktif_user' => 'Aktif'
        ]);



        $data = [
            'title' => 'Verifikasi Akun - NovyantoryShop',
            'user' => $user,
        ];

        return view('verifikasi', $data);
    }
}
