<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponsableInterface;
use CodeIgniter\HTTP\ResponseInterface;

class UsersFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            session()->setFlashdata('pesan', 'Anda belum login');
            return redirect()->to(base_url('signin'));
        }

        //jika role id bukan admin
        if (session()->get('role_id') != 'User') {
            session()->setFlashdata('pesan', 'Anda belum login');
            return redirect()->to(base_url('signin'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
