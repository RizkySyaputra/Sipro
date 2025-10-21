<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class KawasanMemoModel extends Model
{
    protected $table = 'prog_memorandum_kwsn';

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = [
        'id',
        'id_memorandum',
        'id_kawasan'
    ];
}
