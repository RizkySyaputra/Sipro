<?php

namespace App\Controllers;

use App\Models\Rpiw\ProgramRpiwModel;
use App\Models\Rpiw\KawasanRpiwModel;
use App\Models\Rakorbangwil\ProgTahunanModel;
use App\Models\Rakorbangwil\KebutuhanKLModel;
use App\Models\Rakorbangwil\ReportProgTahunanPerProvinsiModel;
use App\Models\Rakorbangwil\ReportProgTahunanPerProvinsiPerPNModel;
use App\Models\Rakorbangwil\ReportProgTahunanPerProvinsiPerUnorModel;
use App\Models\Master\ProvinsiModel;
use App\Models\Master\UnorModel;
use App\Models\Master\PendanaanModel;
use App\Models\Master\SatuanModel;
use App\Models\Master\MpModel;
use App\Models\Master\StackholderModel;
use App\Models\Master\KabkotModel;
use App\Models\Master\KabkotMemoModel;
use App\Models\Master\KawasanMemoModel;
use App\Models\Master\KawasanProgTahunanModel;
use App\Models\Master\KabkotProgTahunanModel;
use App\Models\Master\KawasanModel;
use App\Models\Master\ProgramModel;
use App\Models\Master\KegiatanModel;
use App\Models\Master\KroModel;
use App\Models\Master\RoModel;
use App\Models\Master\PnModel;
use App\Models\Master\PraRakorModel;
use App\Models\Master\KesepakatanModel;
use App\Models\Master\ProPraRakorModel;
use App\Models\Master\RekapKawasanModel;
use App\Models\Master\RekapProgramPraRakModel;
use App\Models\Rakorbangwil\DaftarProgTahunanModel;
use App\Models\Rpiw\DaftarRenaksiModel;
use App\Models\Rpiw\RenaksiModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use function PHPUnit\Framework\returnCallback;

class Rakorbangwil extends BaseController
{
    protected $programRpiwModel;
    protected $kebutuhan_kl_Model;
    protected $kawasanRpiwModel;
    protected $provinsiModel;
    protected $unorModel;
    protected $pendanaanModel;
    protected $kabkotModel;
    protected $pnModel;
    protected $praRakorModel;
    protected $proPraRakorModel;
    protected $kawasanModel;
    protected $kabkotMemoModel;
    protected $kawasanMemoModel;
    protected $rekapKawasanModel;
    protected $kabkotProgramTahunanModel;
    protected $kawasanProgramTahunanModel;
    protected $rekapProgram;
    protected $kesepakatanModel;
    protected $programModel;
    protected $kegiatanModel;
    protected $kroModel;
    protected $roModel;
    protected $daftarProgTahunanModel;
    protected $progTahunanModel;
    protected $reportProgTahunanPerProvinsiModel;
    protected $reportProgTahunanPerProvinsiPerPNModel;
    protected $reportProgTahunanPerProvinsiPerUnorModel;
    protected $satuanModel;
    protected $mpModel;
    protected $daftarRenaksiModel;
    protected $renaksiModel;
    protected $stakholderModel;
    protected $rekapProgRakorbangwilModel;
    public function __construct()

    {

        $this->kebutuhan_kl_Model = new KebutuhanKLModel();
        $this->programModel = new ProgramModel();
        $this->kegiatanModel = new KegiatanModel();
        $this->kroModel = new KroModel();
        $this->roModel = new RoModel();
        $this->daftarProgTahunanModel = new DaftarProgTahunanModel();
        $this->progTahunanModel = new ProgTahunanModel();
        $this->reportProgTahunanPerProvinsiModel = new ReportProgTahunanPerProvinsiModel();
        $this->reportProgTahunanPerProvinsiPerPNModel = new ReportProgTahunanPerProvinsiPerPNModel();
        $this->reportProgTahunanPerProvinsiPerUnorModel = new ReportProgTahunanPerProvinsiPerUnorModel();
        $this->programRpiwModel = new ProgramRpiwModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->unorModel = new UnorModel();
        $this->rekapKawasanModel = new RekapKawasanModel();
        $this->rekapProgRakorbangwilModel = new RekapProgramPraRakModel();
        $this->pnModel = new PnModel();
        $this->pendanaanModel = new PendanaanModel();
        $this->kawasanRpiwModel = new KawasanRpiwModel();
        $this->satuanModel = new SatuanModel();
        $this->mpModel = new MpModel();
        $this->daftarRenaksiModel = new daftarRenaksiModel();
        $this->renaksiModel = new renaksiModel();
        $this->stakholderModel = new StackholderModel();
        $this->kabkotModel = new KabkotModel();
        $this->kabkotMemoModel = new KabkotMemoModel();
        $this->kabkotProgramTahunanModel = new KabkotProgTahunanModel();
        $this->kawasanModel = new KawasanModel();
        $this->kawasanMemoModel = new KawasanMemoModel();
        $this->kawasanProgramTahunanModel = new KawasanProgTahunanModel();
        $this->praRakorModel = new PraRakorModel();
        $this->proPraRakorModel = new ProPraRakorModel();
        $this->kesepakatanModel = new KesepakatanModel();


        helper('permission');
    }

    //program_tahunan
    public function daftar_program_tahunan()
    {
        $dataKawasan = $this->kawasanRpiwModel->getKawasan();
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        $data = [
            'kawasan' => $dataKawasan,
            'provinsi' => $dataProvinsi,
            'unor' => $dataUnor
        ];
        $this->template->write('title', 'Program Tahunan');
        $this->template->load('/templates/main', '/pages/rakorbangwil/daftar_program_tahunan', $data);
    }
    public function catatan_pemda()
    {
        if (user()->id_provinsi) {
            $id_provinsi = user()->id_provinsi;
            $dataProvinsi = $this->provinsiModel->where('id', $id_provinsi)->first();
        } else {
            $dataProvinsi = $this->provinsiModel->getProvinsi();
        }
        $dataKawasan = $this->kawasanRpiwModel->getKawasan();
        $dataUnor = $this->unorModel->getUnor();
        $data = [
            'kawasan' => $dataKawasan,
            'provinsi' => $dataProvinsi,
            'unor' => $dataUnor
        ];
        $this->template->write('title', 'Program Tahunan');
        $this->template->load('/templates/main', '/pages/rakorbangwil/catatan_pemda', $data);
    }
    public function get_daftar_program_tahunan()
    {
        $id_role = user()->id_role;
        $provinsi_id = $this->request->getPost('provinsi');
        $unor_id = $this->request->getPost('unor');
        $sumber = $this->request->getPost('sumber');
        $pn = $this->request->getPost('pn');
        $daftar_program_tahunan = $this->daftarProgTahunanModel->getDaftarProgramTahunan($provinsi_id, $unor_id, $sumber, $pn);


        $data = [
            'daftar_program_tahunan' => $daftar_program_tahunan,
            'can_view' => has_permission_menu($id_role, '/rakorbangwil/program_tahunan', 'can_view'),
            'can_edit' => has_permission_menu($id_role, '/rakorbangwil/program_tahunan', 'can_edit'),
            'can_delete' => has_permission_menu($id_role, '/rakorbangwil/program_tahunan', 'can_delete')
        ];
        return view('/pages/rakorbangwil/tabel/tabel_daftar_program_tahunan', $data);
    }
    public function get_daftar_program_tahunan_catatan_pemda()
    {
        $provinsi_id = user()->id_provinsi;
        $id_role = user()->id_role;
        $unor_id = $this->request->getPost('unor');
        $sumber = $this->request->getPost('sumber');
        $pn = $this->request->getPost('pn');
        $daftar_program_tahunan = $this->daftarProgTahunanModel->getDaftarProgramTahunan($provinsi_id, $unor_id, $sumber, $pn, 'x', 1);


        $data = [
            'daftar_program_tahunan' => $daftar_program_tahunan,
            'can_view' => has_permission_menu($id_role, '/rakorbangwil/program_tahunan', 'can_view'),
            'can_edit' => has_permission_menu($id_role, '/rakorbangwil/program_tahunan', 'can_edit'),
            'can_delete' => has_permission_menu($id_role, '/rakorbangwil/program_tahunan', 'can_delete')
        ];
        return view('/pages/rakorbangwil/tabel/tabel_daftar_program_tahunan', $data);
    }
    // // --- VIEW DETAIL ---
    public function view($id)
    {
        $prog_tahunan = $this->daftarProgTahunanModel->find($id);
        $kabkot = $this->kabkotMemoModel->getKabkotMemo($id);

        if (!$prog_tahunan) {
            return $this->response->setStatusCode(404)->setBody('Data tidak ditemukan');
        }
        return view('/pages/rakorbangwil/ModalView', ['prog_tahunan' => $prog_tahunan, 'kabkot' => $kabkot]);
    }

    public function edit($id)
    {

        $t_prog = $this->progTahunanModel->find($id);

        $progTahunan = $this->daftarProgTahunanModel->find($id);
        $selectedKawasan = [];

        if (!empty($progTahunan->kawasan)) {
            $selectedKawasan = array_map('trim', explode(',', $progTahunan->kawasan));
        }
        $selectedKabkot = [];

        if (!empty($progTahunan->kabkot)) {
            $selectedKabkot = array_map('trim', explode(',', $progTahunan->kabkot));
        }
        $stackholder = $this->stakholderModel->orderBy('id_kategori')->orderBy('id_stakeholder')->findAll();
        $namaList = array_column($stackholder, 'short_stakeholder');
        $id_prov = $t_prog->id_provinsi;
        $kabkotProgTahunan = $this->kabkotProgramTahunanModel->getKabkotProgTahunan($id);
        $kabkot = $this->kabkotModel->where('id_prov', $id_prov)->findAll();
        $program = $this->programModel->where('id_unor', $progTahunan->id_unor)->findAll();
        $kegiatan = $this->kegiatanModel->where('id_program', $progTahunan->id_program)->findAll();
        $kro = $this->kroModel->findAll();
        $ro = $this->roModel->findAll();
        $pendanaan = $this->pendanaanModel->findAll();
        $kawasan = $this->kawasanModel->where('id_provinsi', $id_prov)->findAll();

        if (!$progTahunan) {
            return $this->response->setStatusCode(404)->setBody('Data tidak ditemukan');
        }
        return view('/pages/rakorbangwil/ModalEdit', ['selectedKabkot' => $selectedKabkot, 'selectedKawasan' => $selectedKawasan, 'kawasan' => $kawasan, 'progTahunan' => $progTahunan, 't_prog' => $t_prog, 'namaList' => $namaList, 'kabkot' => $kabkot, 'pendanaan' => $pendanaan, 'program' => $program, 'kegiatan' => $kegiatan, 'kro' => $kro, 'ro' => $ro, 'kabkotProgTahunan' => $kabkotProgTahunan]);
    }


    public function update($id)
    {

        $progTahunanModel = new progTahunanModel();

        // Ambil input lain
        $id_program = $this->request->getPost('id_program');
        $id_kegiatan = $this->request->getPost('id_kegiatan');
        $id_kro = $this->request->getPost('id_kro');
        $id_ro = $this->request->getPost('id_ro');
        $kabkot = $this->request->getPost('kabkot');
        $kawasan = $this->request->getPost('kawasan');
        $pekerjaan     = $this->request->getPost('pekerjaan');
        $lokasi        = $this->request->getPost('lokasi');
        $justifikasi   = $this->request->getPost('justifikasi');
        $id_pendanaan   = $this->request->getPost('id_pendanaan');
        $anggaran   = $this->request->getPost('anggaran');
        $id_satuan   = $this->request->getPost('id_satuan');
        $volume   = $this->request->getPost('volume');
        $thn_pelaksanaan = $this->request->getPost('thn_pelaksanaan');
        $kebutuhan_dukungan_kl = $this->request->getPost('kebutuhan_dukungan_kl');
        $geotag = $this->request->getPost('geotag');
        $reviu_puswil = $this->request->getPost('reviu_puswil');
        $catatan_pra_rakorbangwil = $this->request->getPost('catatan_pra_rakorbangwil');
        $catatan_konfrm_pemda = $this->request->getPost('catatan_konfrm_pemda');


        // Ambil catatan
        $namaArr = $this->request->getPost('catatan_nama');
        $textArr = $this->request->getPost('catatan_text');

        $catatan = [];
        if ($namaArr && $textArr) {
            foreach ($namaArr as $i => $nama) {
                // Hanya simpan jika nama & catatan tidak kosong
                if (!empty($nama) && isset($textArr[$i]) && trim($textArr[$i]) !== '') {
                    $catatan[] = [
                        'nama'    => $nama,
                        'catatan' => $textArr[$i]
                    ];
                }
            }
        }

        // Data yang akan diupdate
        $dataToUpdate = [
            'id_program'        => $id_program,
            'id_kegiatan'       => $id_kegiatan,
            'id_kro'            => $id_kro,
            'id_ro'             => $id_ro,
            'pekerjaan'         => $pekerjaan,
            'lokasi'            => $lokasi,
            'justifikasi'       => $justifikasi,
            'id_pendanaan'          => $id_pendanaan,
            'anggaran'          => $anggaran,
            'id_satuan'         => $id_satuan,
            'kebutuhan_dukungan_kl' => $kebutuhan_dukungan_kl,
            'geotag'            => $geotag,
            'volume'            => $volume,
            'thn_pelaksanaan'   => $thn_pelaksanaan,
            'catatan_pra_rakorbangwil' => $catatan_pra_rakorbangwil,
            'catatan_konfrm_pemda' => $catatan_konfrm_pemda
        ];
        // Update data
        $this->kabkotProgramTahunanModel->where('id_prog_tahunan', $id)->delete();
        $this->kawasanProgramTahunanModel->where('id_prog_tahunan', $id)->delete();
        if ($kabkot) {
            foreach ($kabkot as $data) {
                $this->kabkotProgramTahunanModel->insert(['id_prog_tahunan' => $id, 'id_kabkot' => $data]);
            }
        }
        if ($kawasan) {
            foreach ($kawasan as $data) {
                $this->kawasanProgramTahunanModel->insert(['id_prog_tahunan' => $id, 'id_kawasan' => $data]);
            }
        }

        if ($progTahunanModel->update($id, $dataToUpdate)) {
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Data berhasil disimpan.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyimpan.'
            ]);
        }
    }

    public function edit_pemda($id)
    {
        $t_prog = $this->progTahunanModel->find($id);

        $progTahunan = $this->daftarProgTahunanModel->find($id);
        $selectedKawasan = [];

        if (!empty($progTahunan->kawasan)) {
            $selectedKawasan = array_map('trim', explode(',', $progTahunan->kawasan));
        }
        $selectedKabkot = [];

        if (!empty($progTahunan->kabkot)) {
            $selectedKabkot = array_map('trim', explode(',', $progTahunan->kabkot));
        }
        $stackholder = $this->stakholderModel->orderBy('id_kategori')->orderBy('id_stakeholder')->findAll();
        $namaList = array_column($stackholder, 'short_stakeholder');
        $id_prov = $t_prog->id_provinsi;
        $kabkotProgTahunan = $this->kabkotProgramTahunanModel->getKabkotProgTahunan($id);
        $kabkot = $this->kabkotModel->where('id_prov', $id_prov)->findAll();
        $program = $this->programModel->where('id_unor', $progTahunan->id_unor)->findAll();
        $kegiatan = $this->kegiatanModel->where('id_program', $progTahunan->id_program)->findAll();
        $kro = $this->kroModel->findAll();
        $ro = $this->roModel->findAll();
        $pendanaan = $this->pendanaanModel->findAll();
        $kawasan = $this->kawasanModel->where('id_provinsi', $id_prov)->findAll();

        if (!$progTahunan) {
            return $this->response->setStatusCode(404)->setBody('Data tidak ditemukan');
        }
        return view('/pages/rakorbangwil/ModalEditPemda', ['selectedKabkot' => $selectedKabkot, 'selectedKawasan' => $selectedKawasan, 'kawasan' => $kawasan, 'progTahunan' => $progTahunan, 't_prog' => $t_prog, 'namaList' => $namaList, 'kabkot' => $kabkot, 'pendanaan' => $pendanaan, 'program' => $program, 'kegiatan' => $kegiatan, 'kro' => $kro, 'ro' => $ro, 'kabkotProgTahunan' => $kabkotProgTahunan]);
    }

    public function update_pemda($id)
    {

        $progTahunanModel = new progTahunanModel();

        // Ambil input lain
        $catatan_pemda = $this->request->getPost('catatan_pemda');

        // Data yang akan diupdate
        $dataToUpdate = [
            'catatan_pemda' => $catatan_pemda
        ];

        if ($progTahunanModel->update($id, $dataToUpdate)) {
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Catatan berhasil disimpan.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyimpan.'
            ]);
        }
    }
    // --- DELETE ---
    public function delete($id = null)
    {
        if ($this->request->getMethod(true) !== 'DELETE') {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Metode tidak valid']);
        }

        $progTahunan = $this->progTahunanModel->find($id);
        if (!$progTahunan) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
        $this->progTahunanModel->where('id_prog_tahunan', $id)->delete();

        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    }

    //pra_rakorbangwil
    public function daftar_pn()
    {
        $id_role = user()->id_role;
        $dataPn = $this->pnModel->findAll();
        $dataKl = $this->pnModel->getKl();

        $klByPn = [];
        foreach ($dataKl as $kl) {
            $klByPn[$kl->id_pn][] = $kl->nama_kl;
        }

        $data = [
            'dataPn' => $dataPn,
            'klByPn' => $klByPn,
            'can_view' => has_permission_menu($id_role, '/rakorbangwil/desk_pra_rakorbangwil', 'can_view'),
            'can_edit' => has_permission_menu($id_role, '/rakorbangwil/desk_pra_rakorbangwil', 'can_edit'),
            'can_delete' => has_permission_menu($id_role, '/rakorbangwil/desk_pra_rakorbangwil', 'can_delete')
        ];

        $this->template->write('title', 'Pra Rakorbangwil');
        $this->template->load('/templates/main', '/pages/rakorbangwil/daftar_pn', $data);
    }
    public function view_pn($id)
    {
        $id_role = user()->id_role;
        $pn = $this->pnModel->find($id);
        $stackholder = $this->stakholderModel->orderBy('id_kategori')->orderBy('id_stakeholder')->findAll();
        $namaList = array_column($stackholder, 'stakeholder');
        $program = $this->praRakorModel->where('id_pn', $id)->findAll();
        $rekap_kawasan = $this->rekapKawasanModel->where('id_pn', $id)->findAll();
        $rekap_program = $this->rekapProgRakorbangwilModel->where('id_pn', $id)->findAll();
        $kebutuhan_dukungan_kl = $this->kebutuhan_kl_Model->getKebutuhanKl($id);
        $catatan_pn = $this->praRakorModel->getCatatan($id);
        $this->template->write('title', 'Detail Prioritas Nasional');
        $this->template->load('/templates/main', '/pages/rakorbangwil/view_pn', [
            'kawasanData' => $rekap_kawasan,
            'programData' => $rekap_program,
            'pn' => $pn,
            'catatan_pn' => $catatan_pn,
            'namaList' => $namaList,
            'kebutuhan_dukungan_kl' => $kebutuhan_dukungan_kl,
            'can_view' => has_permission_menu($id_role, '/rakorbangwil/desk_pra_rakorbangwil', 'can_view'),
            'can_edit' => has_permission_menu($id_role, '/rakorbangwil/desk_pra_rakorbangwil', 'can_edit'),
            'can_delete' => has_permission_menu($id_role, '/rakorbangwil/desk_pra_rakorbangwil', 'can_delete')
        ]);
    }
    public function get_list_kawasan()
    {
        // Ambil parameter dari AJAX
        $id_pn       = $this->request->getPost('id_pn');
        $id_provinsi = $this->request->getPost('id_provinsi');
        $provinsi = $this->request->getPost('provinsi');
        $id_tematik  = $this->request->getPost('id_tematik');

        // Validasi sederhana
        if (empty($id_provinsi) || empty($id_tematik)) {
            return $this->response->setStatusCode(400)->setBody('Parameter tidak lengkap');
        }

        // Ambil data kawasan dari model
        $list_kawasan = $this->praRakorModel->getKawasanList($id_provinsi, $id_tematik, $id_pn);
        // Jika tidak ada data
        if (!$list_kawasan || count($list_kawasan) === 0) {
            return $this->response->setStatusCode(404)->setBody('Tidak ada data kawasan ditemukan');
        }

        // Return tampilan modal daftar kawasan
        return view('/pages/rakorbangwil/ModalListKawasan', [
            'list_kawasan' => $list_kawasan,
            'id_pn' => $id_pn,
            'id_tematik' => $id_tematik,
            'id_provinsi' => $id_provinsi,
            'provinsi' => $provinsi
        ]);
    }
    public function get_list_program()
    {
        // Ambil parameter dari AJAX
        $id_pn       = $this->request->getPost('id_pn');
        $id_provinsi = $this->request->getPost('id_provinsi');
        $provinsi = $this->request->getPost('provinsi');
        $id_tematik  = $this->request->getPost('id_tematik');

        // Validasi sederhana
        if (empty($id_provinsi) || empty($id_tematik)) {
            return $this->response->setStatusCode(400)->setBody('Parameter tidak lengkap');
        }

        // Ambil data program dari model
        $list_program = $this->praRakorModel->getProgramList($id_provinsi, $id_tematik, $id_pn);

        // Jika tidak ada data
        if (!$list_program || count($list_program) === 0) {
            return $this->response->setStatusCode(404)->setBody('Tidak ada data program ditemukan');
        }

        // Return tampilan modal daftar program
        return view('/pages/rakorbangwil/ModalListProgram', [
            'list_program' => $list_program,
            'id_pn' => $id_pn,
            'id_tematik' => $id_tematik,
            'id_provinsi' => $id_provinsi,
            'provinsi' => $provinsi
        ]);
    }
    public function update_usulan()
    {
        $id_pn = $this->request->getPost('id_pn');
        $usulan = $this->request->getPost('usulan_pekerjaan');

        $this->proPraRakorModel
            ->where('id_pn', $id_pn)
            ->set('usulan_pekerjaan', $usulan)
            ->update();

        return $this->response->setStatusCode(200);
    }

    public function update_catatan()
    {
        $id_pn = $this->request->getPost('id_pn');
        $catatan = $this->request->getPost('catatan');

        $this->proPraRakorModel
            ->where('id_pn', $id_pn)
            ->set('catatan_pra_rakorbangwil', $catatan)
            ->update();

        return $this->response->setStatusCode(200);
    }

    public function laporan1()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();

        $data = [
            'provinsi' => $dataProvinsi,
            'unor'     => $dataUnor

        ];

        $this->template->write('title', 'Laporan Kawasan Per Provinsi');
        $this->template->load('/templates/main', '/pages/rakorbangwil/report_kawasan_provinsi', $data);
    }

    public function filter_laporan1()
    {

        // $session = session();
        $tahun_pelaksanaan = $this->request->getPost('tahun_pelaksanaan');
        $id_provinsi = $this->request->getPost('id_provinsi');
        $id_unor = $this->request->getPost('id_unor');
        $id_pn = $this->request->getPost('id_pn');

        // print_r($id_provinsi);


        if (!empty($tahun_pelaksanaan)) {
            $kawasanPerProvinsi = $this->reportProgTahunanPerProvinsiModel->getReportKawasanPerProvinsi($tahun_pelaksanaan, $id_provinsi, $id_unor, $id_pn);

            $data = [
                'kawasan_per_provinsi' => $kawasanPerProvinsi,
            ];
        } else {
            $data = [
                'kawasan_per_provinsi' => []
            ];
        }
        // print_r($data);
        // exit;
        return view('/pages/rakorbangwil/tabel/tabel_report_kawasan_provinsi', $data);
    }

    public function laporan2()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();

        $data = [
            'provinsi'  => $dataProvinsi
        ];

        $this->template->write('title', 'Laporan Kawasan Per Provinsi Per PN');
        $this->template->load('/templates/main', '/pages/rakorbangwil/report_kawasan_provinsi_per_pn', $data);
    }

    public function filter_laporan2()
    {

        $tahun_pelaksanaan = $this->request->getPost('tahun_pelaksanaan');
        $id_provinsi = $this->request->getPost('id_provinsi');


        if (!empty($tahun_pelaksanaan)) {
            $kawasanPerProvinsiPerPN = $this->reportProgTahunanPerProvinsiPerPNModel->getReportKawasanPerProvinsiPerPN($tahun_pelaksanaan, $id_provinsi);

            $data = [
                'kawasan_per_provinsi_per_pn' => $kawasanPerProvinsiPerPN,
            ];
        } else {
            $data = [
                'kawasan_per_provinsi_per_pn' => []
            ];
        }

        return view('/pages/rakorbangwil/tabel/tabel_report_kawasan_provinsi_per_pn', $data);
    }

    public function laporan3()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();

        $data = [
            'provinsi'  => $dataProvinsi
        ];

        $this->template->write('title', 'Laporan Kawasan Per Provinsi Per Unor');
        $this->template->load('/templates/main', '/pages/rakorbangwil/report_kawasan_provinsi_per_unor', $data);
    }

    public function filter_laporan3()
    {


        $tahun_pelaksanaan = $this->request->getPost('tahun_pelaksanaan');
        $id_provinsi = $this->request->getPost('id_provinsi');


        if (!empty($tahun_pelaksanaan)) {
            $kawasanPerProvinsiPerUnor = $this->reportProgTahunanPerProvinsiPerUnorModel->getReportKawasanPerProvinsiPerUnor($tahun_pelaksanaan, $id_provinsi);

            $data = [
                'kawasan_per_provinsi_per_unor' => $kawasanPerProvinsiPerUnor,
            ];
        } else {
            $data = [
                'kawasan_per_provinsi_per_unor' => []
            ];
        }

        return view('/pages/rakorbangwil/tabel/tabel_report_kawasan_provinsi_per_unor', $data);
    }

    public function laporan4()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();

        $data = [
            'provinsi' => $dataProvinsi,
            'unor'     => $dataUnor
        ];

        $this->template->write('title', 'Laporan Anggaran Per Provinsi');
        $this->template->load('/templates/main', '/pages/rakorbangwil/report_anggaran_per_provinsi', $data);
    }

    public function filter_laporan4()
    {

        $tahun_pelaksanaan = $this->request->getPost('tahun_pelaksanaan');
        $id_provinsi = $this->request->getPost('id_provinsi');
        $id_unor = $this->request->getPost('id_unor');
        $id_pn = $this->request->getPost('id_pn');


        if (!empty($tahun_pelaksanaan)) {
            $anggaranPerProvinsi = $this->reportProgTahunanPerProvinsiModel->getReportAnggaranPerProvinsi($tahun_pelaksanaan, $id_provinsi, $id_unor, $id_pn);

            $data = [
                'anggaran_per_provinsi' => $anggaranPerProvinsi,
            ];
        } else {
            $data = [
                'anggaran_per_provinsi' => []
            ];
        }

        return view('/pages/rakorbangwil/tabel/tabel_report_anggaran_per_provinsi', $data);
    }

    public function export_to_excel()
    {
        // Ambil data filter dari request POST
        $provinsi_id = $this->request->getPost('provinsi');
        $unor_id = $this->request->getPost('unor');
        $sumber = $this->request->getPost('sumber');
        $pn = $this->request->getPost('pn');

        // Ambil data berdasarkan filter
        $daftar_program_tahunan = $this->daftarProgTahunanModel->getDaftarProgramTahunan($provinsi_id, $unor_id, $sumber, $pn);

        // Buat Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID Renaksi');
        $sheet->setCellValue('C1', 'ID Memorandum');
        $sheet->setCellValue('D1', 'ID Program Tahunan');
        $sheet->setCellValue('E1', 'ID PN');
        $sheet->setCellValue('F1', 'Nama PN');
        $sheet->setCellValue('G1', 'ID PP');
        $sheet->setCellValue('H1', 'Nama PP');
        $sheet->setCellValue('I1', 'ID KP');
        $sheet->setCellValue('J1', 'Nama KP');
        $sheet->setCellValue('K1', 'ID Prop');
        $sheet->setCellValue('L1', 'Nama Prop');
        $sheet->setCellValue('M1', 'ID Program');
        $sheet->setCellValue('N1', 'Nama Program');
        $sheet->setCellValue('O1', 'ID Kegiatan');
        $sheet->setCellValue('P1', 'Nama Kegiatan');
        $sheet->setCellValue('Q1', 'ID KRO');
        $sheet->setCellValue('R1', 'Nama KRO');
        $sheet->setCellValue('S1', 'ID RO');
        $sheet->setCellValue('T1', 'Nama RO');
        $sheet->setCellValue('U1', 'Tahun Pelaksanaan');
        $sheet->setCellValue('V1', 'ID Provinsi');
        $sheet->setCellValue('W1', 'Nama Provinsi');
        $sheet->setCellValue('X1', 'Unor');
        $sheet->setCellValue('Y1', 'Pekerjaan');
        $sheet->setCellValue('Z1', 'Kawasan');
        $sheet->setCellValue('AA1', 'Tematik');
        $sheet->setCellValue('AB1', 'Kabkot');
        $sheet->setCellValue('AC1', 'Lokasi');
        $sheet->setCellValue('AD1', 'Justifikasi');
        $sheet->setCellValue('AE1', 'Nama Satuan');
        $sheet->setCellValue('AF1', 'Volume');
        $sheet->setCellValue('AG1', 'Sumber Pendanaan');
        $sheet->setCellValue('AH1', 'Anggaran');
        $sheet->setCellValue('AI1', 'Sumber');
        $sheet->setCellValue('AJ1', 'Catatan Memorandum');
        $sheet->setCellValue('AK1', 'KL');
        $sheet->setCellValue('AL1', 'Kebutuhan Dukungan KL');
        $sheet->setCellValue('AM1', 'Catatan Pra Rakorbangwil');
        $sheet->setCellValue('AN1', 'Catatan Pemda');
        // $sheet->setCellValue('AM1', 'Reviu Puswil');

        // Membuat teks header menjadi bold
        $sheet->getStyle('A1:AN1')->getFont()->setBold(true);

        // Atur kolom agar auto size
        // foreach (range('A', 'AM') as $col) {
        //     $sheet->getColumnDimension($col)->setAutoSize(true);
        // }

        // Atur semua kolom agar auto size (termasuk kolom di atas 'Z')
        foreach ($sheet->getColumnIterator() as $column) {
            $columnIndex = $column->getColumnIndex();
            $sheet->getColumnDimension($columnIndex)->setAutoSize(true);
        }

        // Recalculate lebar kolom agar pas
        $sheet->calculateColumnWidths();

        // Isi data ke dalam sheet
        $row = 2; // Baris data dimulai dari baris ke-2
        foreach ($daftar_program_tahunan as $index => $dt) {

            //
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $dt->id_renaksi);
            $sheet->setCellValue('C' . $row, $dt->id_memorandum);
            $sheet->setCellValue('D' . $row, $dt->id_prog_tahunan);
            $sheet->setCellValue('E' . $row, $dt->id_pn);
            $sheet->setCellValue('F' . $row, $dt->nama_pn);
            $sheet->setCellValue('G' . $row, $dt->id_pp);
            $sheet->setCellValue('H' . $row, $dt->nama_pp);
            $sheet->setCellValue('I' . $row, $dt->id_kp);
            $sheet->setCellValue('J' . $row, $dt->nama_kp);
            $sheet->setCellValue('K' . $row, $dt->id_prop);
            $sheet->setCellValue('L' . $row, $dt->nama_prop);
            $sheet->setCellValue('M' . $row, $dt->id_program);
            $sheet->setCellValue('N' . $row, $dt->nm_program);
            $sheet->setCellValue('O' . $row, $dt->id_kegiatan);
            $sheet->setCellValue('P' . $row, $dt->nm_kegiatan);
            $sheet->setCellValue('Q' . $row, $dt->id_kro);
            $sheet->setCellValue('R' . $row, $dt->nm_kro);
            $sheet->setCellValue('S' . $row, $dt->id_ro);
            $sheet->setCellValue('T' . $row, $dt->nm_ro);
            $sheet->setCellValue('U' . $row, $dt->thn_pelaksanaan);
            $sheet->setCellValue('V' . $row, $dt->id_provinsi);
            $sheet->setCellValue('W' . $row, $dt->provinsi);
            $sheet->setCellValue('X' . $row, $dt->unor);
            $sheet->setCellValue('Y' . $row, $dt->pekerjaan);
            $sheet->setCellValue('Z' . $row, $dt->kawasan);
            $sheet->setCellValue('AA' . $row, $dt->tematik);
            $sheet->setCellValue('AB' . $row, $dt->kabkot);
            $sheet->setCellValue('AC' . $row, $dt->lokasi);
            $sheet->setCellValue('AD' . $row, $dt->justifikasi);
            $sheet->setCellValue('AE' . $row, $dt->nama_satuan);
            $sheet->setCellValue('AF' . $row, $dt->volume);
            $sheet->setCellValue('AG' . $row, $dt->sumber_pendanaan);
            $sheet->setCellValue('AH' . $row, $dt->anggaran);
            $sheet->setCellValue('AI' . $row, $dt->sumber);
            $sheet->setCellValue('AJ' . $row, $dt->catatan_memorandum);
            $sheet->setCellValue('AK' . $row, $dt->kl);
            $sheet->setCellValue('AL' . $row, $dt->kebutuhan_dukungan_kl);
            $sheet->setCellValue('AM' . $row, $dt->catatan_pra_rakorbangwil);
            $sheet->setCellValue('AN' . $row, $dt->catatan_pemda);
            // $sheet->setCellValue('AM' . $row, $dt->reviu_puswil);
            $row++;
        }

        // Simpan file sebagai output langsung
        $writer = new Xlsx($spreadsheet);
        $filename = 'Daftar_Program_Tahunan_' . date('Y-m-d_H-i-s') . '.xlsx';

        // Header untuk download file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // clean output buffer
        while (ob_get_level()) {
            ob_end_clean();
        }
        // Tulis file ke output
        $writer->save('php://output');
        exit;
    }

    //desk
    public function desk_daftar_pn()
    {
        $id_role = user()->id_role;
        $dataPn = $this->pnModel->findAll();
        $dataKl = $this->pnModel->getKl();

        $klByPn = [];
        foreach ($dataKl as $kl) {
            $klByPn[$kl->id_pn][] = $kl->nama_kl;
        }

        $data = [
            'dataPn' => $dataPn,
            'klByPn' => $klByPn,
            'can_view' => has_permission_menu($id_role, '/rakorbangwil/desk_rakorbangwil', 'can_view'),
            'can_edit' => has_permission_menu($id_role, '/rakorbangwil/desk_rakorbangwil', 'can_edit'),
            'can_delete' => has_permission_menu($id_role, '/rakorbangwil/desk_rakorbangwil', 'can_delete')
        ];

        $this->template->write('title', 'Desk Rakorbangwil');
        $this->template->load('/templates/main', '/pages/rakorbangwil/desk_daftar_pn', $data);
    }
    public function desk_view_pn($id)
    {
        $dataKesepakatan = $this->kesepakatanModel->where('kegiatan', 'Rakorbangwil')->findAll();
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        $id_role = user()->id_role;
        $pn = $this->pnModel->find($id);
        $stackholder = $this->stakholderModel->orderBy('id_kategori')->orderBy('id_stakeholder')->findAll();
        $namaList = array_column($stackholder, 'stakeholder');
        $program = $this->praRakorModel->where('id_pn', $id)->findAll();
        $kebutuhan_dukungan_kl = $this->kebutuhan_kl_Model->getKebutuhanKl($id);
        $catatan_pn = $this->praRakorModel->getCatatan($id);
        $this->template->write('title', 'Detail Prioritas Nasional');
        $this->template->load('/templates/main', '/pages/rakorbangwil/desk_view_pn', [
            'provinsi' => $dataProvinsi,
            'kesepakatan' => $dataKesepakatan,
            'unor' => $dataUnor,
            'program' => $program,
            'pn' => $pn,
            'catatan_pn' => $catatan_pn,
            'namaList' => $namaList,
            'kebutuhan_dukungan_kl' => $kebutuhan_dukungan_kl,
            'can_view' => has_permission_menu($id_role, '/rakorbangwil/desk_rakorbangwil', 'can_view'),
            'can_edit' => has_permission_menu($id_role, '/rakorbangwil/desk_rakorbangwil', 'can_edit'),
            'can_delete' => has_permission_menu($id_role, '/rakorbangwil/desk_rakorbangwil', 'can_delete')
        ]);
    }
    public function get_desk_daftar_program_tahunan()
    {
        $id_pn = $this->request->getPost('id_pn');
        $id_role = user()->id_role;
        $provinsi_id = $this->request->getPost('provinsi');
        $unor_id = $this->request->getPost('unor');
        $tipe = $this->request->getPost('tipe');
        $catatan_rakorbangwil = $this->request->getPost('catatan_rakorbangwil');
        $catatan_pemda = $this->request->getPost('catatan_pemda');
        $konfirmasi_pemda = $this->request->getPost('konfirmasi_pemda');
        $kesepakatan = $this->request->getPost('kesepakatan');
        $sumber = $this->request->getPost('sumber');
        $daftar_program_tahunan = $this->daftarProgTahunanModel->getDaftarProgramTahunan($provinsi_id, $unor_id, $sumber, $id_pn, null, null, $tipe, $catatan_rakorbangwil, $catatan_pemda, $konfirmasi_pemda, $kesepakatan);


        $data = [
            'daftar_program_tahunan' => $daftar_program_tahunan,
            'can_view' => has_permission_menu($id_role, '/rakorbangwil/desk_rakorbangwil', 'can_view'),
            'can_edit' => has_permission_menu($id_role, '/rakorbangwil/desk_rakorbangwil', 'can_edit'),
            'can_delete' => has_permission_menu($id_role, '/rakorbangwil/desk_rakorbangwil', 'can_delete')
        ];
        return view('/pages/rakorbangwil/tabel/tabel_desk_daftar_program_tahunan', $data);
    }
    public function edit_desk($id)
    {
        $t_prog = $this->progTahunanModel->find($id);
        $dataKesepakatan = $this->kesepakatanModel->where('kegiatan', 'Rakorbangwil')->findAll();
        $progTahunan = $this->daftarProgTahunanModel->find($id);
        $selectedKawasan = [];

        if (!empty($progTahunan->kawasan)) {
            $selectedKawasan = array_map('trim', explode(',', $progTahunan->kawasan));
        }
        $selectedKabkot = [];

        if (!empty($progTahunan->kabkot)) {
            $selectedKabkot = array_map('trim', explode(',', $progTahunan->kabkot));
        }
        $stackholder = $this->stakholderModel->orderBy('id_kategori')->orderBy('id_stakeholder')->findAll();
        $namaList = array_column($stackholder, 'short_stakeholder');
        $id_prov = $t_prog->id_provinsi;
        $kabkotProgTahunan = $this->kabkotProgramTahunanModel->getKabkotProgTahunan($id);
        $kabkot = $this->kabkotModel->where('id_prov', $id_prov)->findAll();
        $program = $this->programModel->where('id_unor', $progTahunan->id_unor)->findAll();
        $kegiatan = $this->kegiatanModel->where('id_program', $progTahunan->id_program)->findAll();
        $kro = $this->kroModel->findAll();
        $ro = $this->roModel->findAll();
        $pendanaan = $this->pendanaanModel->findAll();
        $kawasan = $this->kawasanModel->where('id_provinsi', $id_prov)->findAll();

        if (!$progTahunan) {
            return $this->response->setStatusCode(404)->setBody('Data tidak ditemukan');
        }
        return view('/pages/rakorbangwil/ModalEditRakorbangwil', ['selectedKabkot' => $selectedKabkot, 'kesepakatan' => $dataKesepakatan, 'selectedKawasan' => $selectedKawasan, 'kawasan' => $kawasan, 'progTahunan' => $progTahunan, 't_prog' => $t_prog, 'namaList' => $namaList, 'kabkot' => $kabkot, 'pendanaan' => $pendanaan, 'program' => $program, 'kegiatan' => $kegiatan, 'kro' => $kro, 'ro' => $ro, 'kabkotProgTahunan' => $kabkotProgTahunan]);
    }
    public function update_desk($id)
    {

        $progTahunanModel = new progTahunanModel();

        // Ambil input lain
        $catatan_desk_rakorbangwil = $this->request->getPost('catatan_desk_rakorbangwil');
        $tipe_pekerjaan = $this->request->getPost('tipe_pekerjaan');
        $kesepakatan = $this->request->getPost('kesepakatan');

        // Data yang akan diupdate
        $dataToUpdate = [
            'catatan_desk_rakorbangwil' => $catatan_desk_rakorbangwil,
            'tipe_pekerjaan' => $tipe_pekerjaan,
            'desk_rakorbangwil' => $kesepakatan
        ];


        if ($progTahunanModel->update($id, $dataToUpdate)) {
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Data berhasil disimpan.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyimpan.'
            ]);
        }
    }
    public function berita_acara()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataPn = $this->pnModel->getAll();
        $this->template->write('title', 'Berita Acara Kesepakatan');
        $this->template->load('/templates/main', '/pages/rakorbangwil/berita_acara', [
            'provinsi' => $dataProvinsi,
            'pn' => $dataPn
        ]);
    }
    public function get_data_berita_acara()
    {
        // $id_pn = $this->request->getPost('id_pn');
        // $provinsi_id = $this->request->getPost('provinsi');
        $id_pn = 2;
        $provinsi_id = 11;
        $kawasan = $this->praRakorModel->getKawasanList($provinsi_id, null, $id_pn);
        $diakomodasi = $this->daftarProgTahunanModel->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 1);
        $ditangguhkan2 = $this->daftarProgTahunanModel->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 2);
        $ditangguhkan3 = $this->daftarProgTahunanModel->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 3);
        $belumDibahas = $this->daftarProgTahunanModel->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 0);
        $pejabat = "";
        d($kawasan);
        d($diakomodasi);
        d($ditangguhkan2);
        d($ditangguhkan3);
        dd($belumDibahas);
    }
}
