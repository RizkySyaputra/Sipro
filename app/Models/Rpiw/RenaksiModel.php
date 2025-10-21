<?php

namespace App\Models\Rpiw;

use CodeIgniter\Model;

class RenaksiModel extends Model
{
    protected $table            = 'rpiw_renaksi';
    protected $primaryKey       = 'id_renaksi';   // asumsi primary key ini
    protected $useAutoIncrement = false;

    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'id_renaksi',
        'id_provinsi',
        'id_unor',
        'pekerjaan',
        'lokasi',
        'justifikasi',
        'kesiapan_rc',
        'volume',
        'id_satuan',
        'biaya',
        'mp',
        'id_pendanaan',
        'tahun_mulai',
        'tahun_selesai',
        'periode'
    ];


    protected $useTimestamps = true;
    protected $createdField  = 'created_at';  // pastikan ada di tabel
    protected $updatedField  = 'updated_at';  // pastikan ada di tabel

}
