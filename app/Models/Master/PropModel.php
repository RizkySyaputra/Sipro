<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class PropModel extends Model
{
    protected $table = 'k_pro_p';
    protected $useTimestamps = true;

    public function getAll()
    {
        return $this->findAll();
    }

    public function getbyKP($id_kp)
    {
        $builder = $this->db->table('k_pro_p ');
        $builder->select('id_prop, nama_prop, id_kp ');
        $builder->distinct();
        $builder->where('id_kp', $id_kp);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getProgram($id_prop)
    {
        $builder = $this->db->table('k_pro_p as prp');
        $builder->select('prp.kd_prog, m_program.id_unor, m_unor.unor');
        $builder->join('m_program', 'prp.kd_prog = m_program.kdprogram', 'left');
        $builder->join('m_unor', 'm_program.id_unor = m_unor.id', 'left');
        $builder->distinct();
        $builder->where('prp.id_prop', $id_prop);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getKegiatan($id_prop)
    {
        $builder = $this->db->table('k_pro_p as prp');
        $builder->select('prp.kd_kgiat, m_kegiatan.kdgiat, m_kegiatan.nmgiat');
        $builder->join('m_kegiatan', 'prp.kd_kgiat = m_kegiatan.kdgiat', 'left');
        $builder->distinct();
        $builder->where('prp.id_prop', $id_prop);
        $query = $builder->get();
        return $query->getResult();
    }
    // public function getKegsiatan($id_prop)
    // {
    //     $builder = $this->db->table('k_pro_p ');
    //     $builder->select('id_prop, nama_prop, id_prop ');
    //     $builder->distinct();
    //     $builder->where('id_prop', $id_prop);
    //     $query = $builder->get();
    //     return $query->getResult();
    // }
    public function getKro($id_prop)
    {
        //new
        $builder = $this->db->table('k_pro_p as prp');
        $builder->select('prp.kd_kro, m_kro.kdkro, m_kro.nmkro');
        $builder->join('m_kro', 'prp.kd_kro = m_kro.kdkro', 'left');
        $builder->distinct();
        $builder->where('prp.id_prop', $id_prop);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getRo($kd_kro, $id_prop)
    {
        $builder = $this->db->table('k_pro_p as prp');
        $builder->select('prp.kd_ro, m_ro.kdro, m_ro.nmro');
        $builder->join('m_ro', 'prp.kd_ro = m_ro.kdro', 'left');
        $builder->distinct();
        $builder->where('prp.kd_kro', $kd_kro);
        $builder->where('prp.id_prop', $id_prop);
        $query = $builder->get();
        return $query->getResult();
    }
}
