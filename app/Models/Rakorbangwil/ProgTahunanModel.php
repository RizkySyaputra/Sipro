<?php

namespace App\Models\Rakorbangwil;

use CodeIgniter\Model;

class ProgTahunanModel extends Model
{
    protected $table            = 'prog_tahunan';
    protected $primaryKey       = 'id_prog_tahunan';   // asumsi primary key ini
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
        'id_satuan',
        'volume',
        'id_pendanaan',
        'anggaran',
        'geotag',
        'geotag_uraian',
        'catatan_memorandum',
        'sumber',
        'thn_pelaksanaan',
        'kebutuhan_dukungan_kl',
        'catatan_pra_rakorbangwil',
        'catatan_konfrm_pemda',
        'catatan_pemda',
        'catatan_desk_rakorbangwil',
        'desk_rakorbangwil',
        'pn_lama',
        'tipe_pekerjaan',
        'pra_konreg',
        'catatan_pra_konreg'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';  // pastikan ada di tabel
    protected $updatedField  = 'updated_at';  // pastikan ada di tabel

}
