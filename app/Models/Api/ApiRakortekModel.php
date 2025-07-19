<?php

namespace App\Models\Api;

use CodeIgniter\Model;

class ApiRakortekModel extends Model
{
    protected $table = 'k_rakortek_api';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_usulan',
        'id_provinsi',
        'id_unor',
        'tematik',
        'id_pn',
        'id_pp',
        'id_kp',
        'id_prop',
        'kementerian',
        'source_ro_id',
        'source_ro',
        'usulan',
        'lokasi_usulan_ids',
        'lokasi_rakortek_ids',
        'volume_ro',
        'volume_usulan',
        'volume_rakortek',
        'id_satuan',
        'alokasi_usulan',
        'alokasi_rakortek',
        'criterias_usulan',
        'approval_rakortek',
        'note_rakortek',
        'kesepakatan',
        'catatan_pembahasan'
    ];

    public function getProgram($id_provinsi = null, $id_unor = null, $kesepakatan = null, $kesepakatan_desk = null)
    {
        $builder = $this->db->table('k_rakortek_api as rkt');
        $builder->select('rkt.*,k_pn.nama_pn, k_pp.nama_pp, k_kp.nama_kp,k_pro_p.nama_prop, m_provinsi.*, m_unor.unor,m_satuan.nama_satuan ');
        $builder->distinct();
        $builder->join('m_provinsi', 'rkt.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'rkt.id_unor = m_unor.id', 'left');
        $builder->join('m_satuan', 'rkt.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('k_pn', 'rkt.id_pn = k_pn.id_pn', 'left');
        $builder->join('k_pp', 'rkt.id_pp = k_pp.id_pp', 'left');
        $builder->join('k_kp', 'rkt.id_kp = k_kp.id_kp', 'left');
        $builder->join('k_pro_p', 'rkt.id_prop = k_pro_p.id_prop', 'left');
        $builder->whereIn('rkt.approval_rakortek', [3, 4]);


        // $builder->join('m_program', 'k_pro_p.kd_prog = m_program.kdprogram', 'left');
        // $builder->join('m_kegiatan', 'k_pro_p.kd_kgiat = m_kegiatan.kdgiat', 'left');
        // $builder->join('m_kro', 'k_pro_p.kd_kro = m_kro.kdkro', 'left');
        // $builder->join('m_ro', 'k_pro_p.kd_ro = m_ro.kdro', 'left');
        if ($id_provinsi) {
            $builder->where('rkt.id_provinsi', $id_provinsi);
        }
        if ($id_unor) {
            $builder->where('rkt.id_unor', $id_unor);
        }
        if ($kesepakatan) {
            $builder->where('rkt.approval_rakortek', $kesepakatan);
        }
        if ($kesepakatan_desk) {
            $builder->where('rkt.kesepakatan', $kesepakatan_desk);
        }
        $builder->orderBy('m_provinsi.id', 'ASC');
        $builder->orderBy('rkt.approval_rakortek', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getDataDetail($id_rkt)
    {
        $builder = $this->db->table('k_rakortek_api as rkt');
        $builder->select('rkt.*,k_pn.nama_pn, k_pp.nama_pp, k_kp.nama_kp,k_pro_p.nama_prop, m_provinsi.*, m_unor.unor,m_satuan.nama_satuan');
        $builder->distinct();
        $builder->join('m_provinsi', 'rkt.id_provinsi = m_provinsi.id', 'left');
        $builder->join('m_unor', 'rkt.id_unor = m_unor.id', 'left');
        $builder->join('m_satuan', 'rkt.id_satuan = m_satuan.id_satuan', 'left');
        $builder->join('k_pn', 'rkt.id_pn = k_pn.id_pn', 'left');
        $builder->join('k_pp', 'rkt.id_pp = k_pp.id_pp', 'left');
        $builder->join('k_kp', 'rkt.id_kp = k_kp.id_kp', 'left');
        $builder->join('k_pro_p', 'rkt.id_prop = k_pro_p.id_prop', 'left');
        $builder->where('rkt.id_usulan', $id_rkt);
        $query = $builder->get();
        return $query->getResult();
    }
}
