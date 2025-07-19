<?php

namespace App\Models\Rpiw;

use CodeIgniter\Model;
use CodeIgniter\Cache\CacheInterface;

class RekapProgramModel extends Model
{
    protected $table = 'r_rekap_program';
    protected $allowedFields = ['id_provinsi', 'id_unor', 'id_pendanaan', 'kode_kawasan', 'tagging_mp', 'jumlah_program', 'anggaran', 'updated_at'];
    protected $useTimestamps  = 'true';
    protected $cache;
    public function getRekapProgram($id_provinsi = null, $id_unor = null, $id_kawasan = null, $pendanaan = null)
    {
        $this->cache = \Config\Services::cache();
        $cacheKey = 'rekap_program_data'; // Kunci cache
        $cacheTime = 3600; // Waktu cache dalam detik (1 jam)

        // Cek apakah data ada di cache
        if ($this->cache->get($cacheKey)) {
            return $this->cache->get($cacheKey); // Mengembalikan data dari cache
        }
        // Jika tidak ada di cache, ambil dari database
        $builder = $this->db->table('r_rekap_program');
        $builder->select('r_rekap_program.*, m_provinsi.provinsi, m_unor.unor, m_pendanaan.sumber_pendanaan, m_kawasan.nama_kawasan');
        $builder->join('m_provinsi', 'r_rekap_program.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'r_rekap_program.id_unor = m_unor.id', 'left');
        $builder->join('m_pendanaan', 'r_rekap_program.id_pendanaan = m_pendanaan.id_pendanaan', 'left');
        $builder->join('m_kawasan', 'r_rekap_program.kode_kawasan = m_kawasan.kode_kawasan', 'left');
        $builder->orderBy('jumlah_program , updated_at', 'DESC');
        // Tambahkan kondisi untuk filter jika parameter tidak null
        if ($id_provinsi) {
            $builder->where('r_rekap_program.id_provinsi', $id_provinsi);
        }
        if ($id_unor) {
            $builder->where('r_rekap_program.id_unor', $id_unor);
        }
        if ($id_kawasan) {
            $builder->where('r_program_kawasan.kode_kawasan', $id_kawasan);
        }
        if ($pendanaan) {
            $builder->where('mpe.id_pendanaan', $pendanaan);
        }
        $query = $builder->get();

        // Simpan hasil query ke cache
        $this->cache->save($cacheKey, $query->getResult(), $cacheTime);
        return $query->getResult();
    }

    public function getLastUpdate()
    {
        $builder = $this->db->table('r_rekap_program');
        $builder->select('updated_at');
        $builder->orderBy('updated_at', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        return $query->getResult();
    }
    public function getLastUpdateList()
    {
        $builder = $this->db->table('r_rekap_program');
        $builder->select('DISTINCT(updated_at)');
        $query = $builder->get();
        return $query->getResult();
    }
    public function insertRekapProgram()
    {
        $this->cache = \Config\Services::cache();
        $sql = "
            INSERT INTO r_rekap_program (id_provinsi, id_unor, id_pendanaan, kode_kawasan, tagging_mp, jumlah_program, anggaran, updated_at)
            SELECT 
                a.id_provinsi,
                a.id_unor,
                a.id_pendanaan,
                b.kode_kawasan,
                a.tagging_mp,
                COUNT(a.id_program) AS Total_Program,
                SUM(a.biaya) AS Jumlah_Anggaran,
                CURRENT_TIME() AS updated_at 
            FROM 
                program_rpiw a 
            JOIN 
                r_program_kawasan b ON a.id_program = b.kode_program
            GROUP BY 
                a.id_provinsi, a.id_unor, a.id_pendanaan, a.tagging_mp, b.kode_kawasan 
            ORDER BY 
                Total_Program DESC;
        ";
        $this->cache->delete('rekap_program_data');
        return $this->db->query($sql);
    }
}
