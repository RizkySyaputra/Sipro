<?php

namespace App\Models\Rakorbangwil;

use CodeIgniter\Model;

class BakUnorModel extends Model
{
    protected $table            = 'm_ttd_ba_unor_kl';
    protected $useAutoIncrement = true;
    protected $primaryKey       = 'id';

    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'id',
        'thn_pelaksanaan',
        'kegiatan',
        'id_kl',
        'prioritas'
    ];


    protected $useTimestamps = true;
    protected $createdField  = 'created_at';  // pastikan ada di tabel
    protected $updatedField  = 'updated_at';  // pastikan ada di tabel
    public function getPejabatKl()
    {
        $db = \Config\Database::connect();

        $sql = "
        SELECT
    kl.nama_kl,
    pj.nama_pejabat,
    pj.jabatan,
    pj.tanda_tangan,
    uk.prioritas AS urutan_kl,
    up.prioritas AS urutan_pejabat
FROM m_ttd_ba_unor_kl uk
JOIN m_kl kl 
    ON kl.id_kl = uk.id_kl
JOIN m_ttd_ba_unor_pejabat up 
    ON up.id_kl = uk.id_kl
   AND up.thn_pelaksanaan = uk.thn_pelaksanaan
   AND up.kegiatan = uk.kegiatan
JOIN m_pejabat pj 
    ON pj.id_pejabat = up.id_pejabat
WHERE uk.thn_pelaksanaan = '2027'
  AND uk.kegiatan = 'Rakorbangwil'
ORDER BY
    uk.prioritas ASC,
    up.prioritas ASC;
";
        return $db->query($sql)->getResult();
    }


    public function getKl()
    {
        $builder = $this->db->table('m_ttd_ba_unor_kl as a');
        $builder->select('a.id_kl,a.id,  b.nama_kl');
        $builder->join('m_kl b', 'a.id_kl = b.id_kl', 'left');
        $builder->orderBy('a.prioritas', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }
}
