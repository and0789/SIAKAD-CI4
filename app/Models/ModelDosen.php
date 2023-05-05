<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDosen extends Model
{

    protected $table            = 'dosen';
    protected $primaryKey       = 'kode_dosen';
    protected $allowedFields    = [
        'id_dosen',
        'kode_dosen',
        'nama_dosen',
        'alamat_dosen',
        'jk_dosen',
        'telp_dosen'
    ];


}
