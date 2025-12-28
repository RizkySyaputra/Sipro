<?php

namespace Myth\Auth\Models;

use CodeIgniter\Model;

class UserProvinsiModel extends Model
{
    protected $table            = 'm_user_provinsi';
    protected $primaryKey       = 'id_trx';
    protected $allowedFields    = [
        'id_user',
        'id_provinsi',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
}
