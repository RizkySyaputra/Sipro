<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class KawasanModel extends Model
{
    protected $table = 'm_kawasan';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
