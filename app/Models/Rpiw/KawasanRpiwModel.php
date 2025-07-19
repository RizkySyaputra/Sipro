<?php

namespace App\Models\Rpiw;

use CodeIgniter\Model;

class KawasanRpiwModel extends Model
{
    protected $table = 'm_kawasan';
    protected $allowedFields = ['kode_kawasan', 'id_provinsi', 'nama_kawasan', 'mapservice_kawasan'];
    protected $useTimestamps  = 'true';

    public function getKawasanRpiw()
    {
        $builder = $this->db->table('m_kawasan');
        $builder->select('m_kawasan.*, m_provinsi.*');
        $builder->join('m_provinsi', 'm_provinsi.id = m_kawasan.id_provinsi', 'left');
        $builder->where('m_kawasan.kode_kawasan !=', '0');
        $query = $builder->get();
        return $query->getResult();
    }
    public function getKawasanAll()
    {
        $builder = $this->db->table('m_kawasan');
        $builder->select('m_kawasan.nama_kawasan, r_program_kawasan.kode_program');
        $builder->join('r_program_kawasan', 'r_program_kawasan.kode_kawasan = m_kawasan.kode_kawasan', 'left');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getKawasan()
    {
        $builder = $this->db->table('m_kawasan');
        $builder->select('m_kawasan.*');
        $builder->orderBy('kode_kawasan', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }
    public function getKawasanByProvinsi($id_provinsi)
    {
        $builder = $this->db->table('m_kawasan');
        $builder->select('m_kawasan.*');
        $builder->orderBy('nama_kawasan', 'ASC');
        if ($id_provinsi != "") {
            $builder->where('id_provinsi', $id_provinsi);
        }
        $query = $builder->get();
        return $query->getResult();
    }
    public function getKawasanById($idProgram)
    {
        // return $this->join('r_program_kawasan', 'r_program_kawasan.kode_kawasan = m_kawasan.kode_kawasan', 'left')
        // ->where('m_kawasan.kode_kawasan', $kodeKawasan)
        // ->findAll();
        $builder = $this->db->table('m_kawasan');
        $builder->select('m_kawasan.*,  m_provinsi.*, r_program_kawasan.kode_kawasan');
        $builder->join('m_provinsi', 'm_kawasan.id_provinsi = m_provinsi.id', 'left');
        $builder->join('r_program_kawasan', 'r_program_kawasan.kode_kawasan = m_kawasan.kode_kawasan', 'left');
        $builder->where('r_program_kawasan.kode_program', $idProgram);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getKawasanRpiwDetail($id)
    {
        $builder = $this->db->table('m_kawasan');
        $builder->select('m_kawasan.*,  m_provinsi.*');
        $builder->join('m_provinsi', 'm_kawasan.id_provinsi = m_provinsi.id', 'left');
        $builder->join('r_program_kawasan', 'r_program_kawasan.kode_kawasan = m_kawasan.nama_kawasan', 'left');
        $builder->where('m_kawasan.kode_kawasan', $id);
        $query = $builder->get();
        return $query->getResult();
    }
}
