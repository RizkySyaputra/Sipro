<?php

namespace App\Models\Memorandum;

use CodeIgniter\Model;

class MemoModel extends Model
{
    protected $table            = 'prog_memorandum';
    protected $primaryKey       = 'id_memorandum';   // asumsi primary key ini
    protected $useAutoIncrement = false;

    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'id_renaksi',
        'id_memorandum',
        'id_program',
        'id_kegiatan',
        'id_kro',
        'id_ro',
        'id_provinsi',
        'id_unor',
        'pekerjaan',
        'lokasi',
        'justifikasi',
        'tahun_mulai',
        'tahun_selesai',
        'id_satuan',
        'volume_1',
        'volume_2',
        'volume_3',
        'volume_4',
        'volume_5',
        'id_pendanaan_1',
        'anggaran_1',
        'id_pendanaan_2',
        'anggaran_2',
        'id_pendanaan_3',
        'anggaran_3',
        'id_pendanaan_4',
        'anggaran_4',
        'id_pendanaan_5',
        'anggaran_5',
        'geotag',
        'geotag_uraian',
        'catatan_memorandum',
        'sumber',
        'periode',
        'id_kabkot'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';  // pastikan ada di tabel
    protected $updatedField  = 'updated_at';  // pastikan ada di tabel

}
