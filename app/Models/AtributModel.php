<?php

namespace App\Models;

use CodeIgniter\Model;

class AtributModel extends Model
{
    protected $table            = 'atribut';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nama_atribut',
        'nilai_atribut'
    ];
}
