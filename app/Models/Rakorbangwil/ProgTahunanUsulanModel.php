<?php

namespace App\Models\Rakorbangwil;

use CodeIgniter\Model;

class ProgTahunanUsulanModel extends Model
{
    protected $table            = 'prog_tahunan_usulan';
    protected $primaryKey       = 'id_prog_tahunan';   // asumsi primary key ini
    protected $useAutoIncrement = false;

    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;


    protected $useTimestamps = true;
    protected $createdField  = 'created_at';  // pastikan ada di tabel
    protected $updatedField  = 'updated_at';  // pastikan ada di tabel

}
