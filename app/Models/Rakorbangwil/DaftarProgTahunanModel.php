<?php

namespace App\Models\Rakorbangwil;

use CodeIgniter\Model;

class DaftarProgTahunanModel extends Model
{
    protected $table = 'view_prog_tahunan';
    protected $primaryKey = 'id_prog_tahunan';
    protected $returnType = 'object';


    public function getDaftarProgramTahunan($id_provinsi, $id_unor, $sumber, $pn = "ALL", $catatan_kl = null, $pembiayaan = null, $tipe = null, $catatan_pra_rakorbangwil = null, $catatan_pemda = null, $konfirmasi_pemda = null, $kesepakatan = null)
    {
        $tahun_pelaksanaan = session('tahun_pelaksana');
        $builder = $this->db->table('view_prog_tahunan as a');

        // SELECT clause
        $builder->select("a.*");
        // WHERE clause
        if ($id_provinsi) {
            $builder->where('a.id_provinsi', $id_provinsi);
        }
        if ($id_unor) {
            $builder->where('a.id_unor', $id_unor);
        }
        if ($sumber) {
            $builder->where('a.sumber', $sumber);
        }

        if ($pembiayaan) {
            $builder->where('a.id_pendanaan', $pembiayaan);
        }
        if ($pn) {
            if ($pn == "ALLPN") {
                $builder->where('a.id_pn is not null', null, false);
            } else {
                $builder->where('a.id_pn', $pn);
            }
        }
        if ($tipe) {
            $builder->where('a.tipe_pekerjaan', $tipe);
        }
        if ($catatan_pra_rakorbangwil) {
            if ($catatan_pra_rakorbangwil == "ya") {
                $builder->where('a.catatan_pra_rakorbangwil IS NOT NULL', null, false)
                    ->where('a.catatan_pra_rakorbangwil !=', '-');
            } elseif ($catatan_pra_rakorbangwil == "tidak") {
                $builder->groupStart()
                    ->where('a.catatan_pra_rakorbangwil', null)
                    ->orWhere('a.catatan_pra_rakorbangwil', '-')
                    ->groupEnd();
            }
        }
        if ($catatan_pemda) {
            if ($catatan_pemda == "ya") {
                $builder->where('a.catatan_pemda IS NOT NULL', null, false)
                    ->where('a.catatan_pemda !=', '-');
            } elseif ($catatan_pemda == "tidak") {
                $builder->groupStart()
                    ->where('a.catatan_pemda', null)
                    ->orWhere('a.catatan_pemda', '-')
                    ->groupEnd();
            }
        }
        if ($konfirmasi_pemda) {
            if ($konfirmasi_pemda == "ya") {
                $builder->where('a.catatan_konfrm_pemda IS NOT NULL', null, false)
                    ->where('a.catatan_konfrm_pemda !=', '-');
            } elseif ($konfirmasi_pemda == "tidak") {
                $builder->groupStart()
                    ->where('a.catatan_konfrm_pemda', null)
                    ->orWhere('a.catatan_konfrm_pemda', '-')
                    ->groupEnd();
            }
        }
        if ($kesepakatan) {
            $builder->where('a.desk_rakorbangwil', $kesepakatan);
        }
        $builder->where('a.thn_pelaksanaan', $tahun_pelaksanaan);
        if ($catatan_kl) {
            $builder->groupStart() // buka grup OR
                ->groupStart()
                ->where('a.kebutuhan_dukungan_kl IS NOT NULL', null, false)
                ->where('a.kebutuhan_dukungan_kl !=', '-')
                ->groupEnd()
                ->orGroupStart()
                ->where('a.catatan_konfrm_pemda IS NOT NULL', null, false)
                ->where('a.catatan_konfrm_pemda !=', '-')
                ->groupEnd()
                ->groupEnd(); // tutup grup OR
            $builder->orderBy('a.catatan_pemda', 'ASC');
        }
        $builder->orderBy('a.id_prog_tahunan', 'ASC');
        // Eksekusi
        $query = $builder->get();
        return $query->getResult();
    }
}
