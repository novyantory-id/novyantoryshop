<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukatributModel extends Model
{
    protected $table            = 'produkatribut';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'produk_id',
        'atribut_id',
        'nilai_atribut'
    ];

    public function getProdukAtribut($produk_id)
    {
        return $this->where('produk_id', $produk_id)
            ->join('atribut', 'produkatribut.atribut_id = atribut.id')
            ->select('produkatribut.*,atribut.nama_atribut')
            ->findAll();
    }
}
