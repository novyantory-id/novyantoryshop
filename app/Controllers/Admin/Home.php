<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title_tab' => 'Dashboard - Novyantoryshop',
            'title' => 'Dashboard',
            'title_detail' => 'Main Menu',
        ];

        return view('admin/index', $data);
    }
}
