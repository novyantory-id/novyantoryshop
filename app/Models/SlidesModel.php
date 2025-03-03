<?php

namespace App\Models;

use CodeIgniter\Model;

class SlidesModel extends Model
{
    protected $table            = 'slides';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'judul_slides',
        'deskripsi_slides',
        'images_slides'
    ];
}
