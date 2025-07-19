<?php

namespace App\Models\Konreg;

use CodeIgniter\Model;

class BaModel extends Model
{
    protected $table = 'tr_ttd_ba_konreg';
    protected $allowedFields = ['id', 'id_provinsi', 'id_pejabat', 'id_unor'];
    protected $useTimestamps  = 'true';


    public function getPejabat()
    {
        $builder = $this->db->table('tr_ttd_ba_konreg as tr');
        $builder->select('tr.*, pj.*');
        $builder->join('m_pejabat as pj', 'pj.id_pejabat = tr.id_pejabat', 'left');
        $builder->orderBy('pj.id_pejabat', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getPejabatById($id_provinsi = null, $id_unor = null)
    {
        $builder = $this->db->table('tr_ttd_ba_konreg as tr');
        $builder->select('tr.*, mu.unor, pj.*, mp.provinsi');
        $builder->join('m_provinsi as mp', 'mp.id = tr.id_provinsi');
        $builder->join('m_unor as mu', 'mu.id = tr.id_unor');
        $builder->join('m_pejabat as pj', 'pj.id_pejabat = tr.id_pejabat', 'left');
        if ($id_provinsi && $id_unor) {
            $builder->where('tr.id_provinsi', $id_provinsi);
            $builder->where('tr.id_unor', $id_unor);
        }
        $builder->orderBy('tr.id', 'ASC');
        $query = $builder->get();

        return $query->getResult();
    }
    public function delete_pejabat($id)
    {
        $this->delete($id);
    }

    public function addBa() {}
}
