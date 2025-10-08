<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class NomenklaturModel extends Model
{
    protected $table = 'view_m_nomenklatur_pu';
    protected $allowedFields = ['nm_program', 'nm_kegiatan', 'nm_kro', 'nm_ro'];
    protected $useTimestamps  = 'true';

    public function getNomenklatur($id_program, $id_kegiatan, $id_kro, $id_ro)
    {
        $builder = $this->db->table('view_m_nomenklatur_pu as vmnpu');
        $builder->select('vmnpu.nm_program as nm_program, vmnpu.nm_kegiatan as nm_kegiatan, vmnpu.nm_kro as nm_kro, vmnpu.nm_ro as nm_ro, vmnpu.nama_satuan as nama_satuan');

        $builder->where('vmnpu.id_program', $id_program);

        if (!empty($id_kegiatan)) {
            $builder->where('vmnpu.id_kegiatan', $id_kegiatan);
        }
        if (!empty($id_kro)) {
            $builder->where('vmnpu.id_kro', $id_kro);
        }

        if (!empty($id_ro)) {
            $builder->where('vmnpu.id_ro', $id_ro);
        }
        $query = $builder->get();
        return $query->getResult();
    }
}
