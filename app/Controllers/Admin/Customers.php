<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class Customers extends BaseController
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
            'title_tab' => 'Customers List - Novyantoryshop',
            'title' => 'Customers',
            'title_detail' => 'Customers List',
            'validation' => \Config\Services::validation(),
            'customers' => $this->usersModel->findAll()
        ];
        return view('admin/customers/index', $data);
    }
}
