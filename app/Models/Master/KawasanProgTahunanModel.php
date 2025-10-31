<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class KawasanProgTahunanModel extends Model
{
    protected $table = 'prog_tahunan_kwsn';

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = [
        'id',
        'id_prog_tahunan',
        'id_kawasan'
    ];
}
