<?php

namespace App\Models\Desk;

use CodeIgniter\Model;

class BaModel extends Model
{
    protected $table = 'tr_ttd_ba';
    protected $allowedFields = ['id', 'id_provinsi', 'id_pejabat'];
    protected $useTimestamps  = 'true';


    public function getPejabat()
    {
        $builder = $this->db->table('tr_ttd_ba as tr');
        $builder->select('tr.*, pj.*');
        $builder->join('m_pejabat as pj', 'pj.id_pejabat = tr.id_pejabat', 'left');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getPejabatById($id_provinsi = null)
    {
        $builder = $this->db->table('tr_ttd_ba as tr');
        $builder->select('tr.*, pj.*, mp.provinsi');
        $builder->join('m_provinsi as mp', 'mp.id = tr.id_provinsi');
        $builder->join('m_pejabat as pj', 'pj.id_pejabat = tr.id_pejabat', 'left');
        if ($id_provinsi) {
            $builder->where('tr.id_provinsi', $id_provinsi);
        }
        $query = $builder->get();

        return $query->getResult();
    }
    public function delete_pejabat($id)
    {
        $this->delete($id);
    }

    public function addBa() {}
}
