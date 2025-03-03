<?php

namespace App\Models;

use CodeIgniter\Model;

class KuponModel extends Model
{
    protected $table            = 'kupon';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nama_kupon',
        'diskon_kupon',
        'validasi',
        'status_kupon'
    ];
}
