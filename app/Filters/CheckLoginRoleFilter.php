<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponsableInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CheckLoginRoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->has('logged_in')) {

            $role = session()->get('role_id');

            if ($role == 'Admin') {
                return redirect()->to(base_url('/admin/home'));
            } elseif ($role == 'User') {
                return redirect()->to(base_url('/user/home'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
