<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table            = 'brand';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nama_brand',
        'slug_brand',
        'images_brand'
    ];

    public function getBrandBySlug($slug)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('brand');
        $builder->select('brand.*');
        $builder->where('brand.slug_brand', $slug);
        // return $builder->get()->getResultArray(); untuk banyak data
        return $builder->get()->getRowArray(); //untuk satu data
    }
}
