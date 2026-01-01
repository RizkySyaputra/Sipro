<?php

namespace App\Models\Rakorbangwil;

use CodeIgniter\Model;

class BakUnorPejabatModel extends Model
{
    protected $table            = 'm_ttd_ba_unor_pejabat';
    protected $useAutoIncrement = true;
    protected $primaryKey       = 'id';

    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'id',
        'thn_pelaksanaan',
        'kegiatan',
        'id_kl',
        'id_pejabat',
        'prioritas'
    ];


    protected $useTimestamps = true;
    protected $createdField  = 'created_at';  // pastikan ada di tabel
    protected $updatedField  = 'updated_at';  // pastikan ada di tabel

    public function getKl()
    {
        $builder = $this->db->table('m_ttd_ba_unor_kl as a');
        $builder->select('a.id_kl,  b.nama_kl');
        $builder->join('m_kl b', 'a.id_kl = b.id_kl', 'left');
        $builder->orderBy('a.prioritas');
        $query = $builder->get();
        return $query->getResult();
    }
}
