<?php

namespace App\Controllers;

use App\Models\Rpiw\ProgramRpiwModel;
use App\Models\Rpiw\KawasanRpiwModel;
use App\Models\Master\PejabatModel;
use App\Models\Rakorbangwil\PejabatBakModel;
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
use App\Models\Rakorbangwil\PejabatBakModel as RakorbangwilPejabatBakModel;
use App\Models\Rakorbangwil\ProgTahunanUsulanModel;
use App\Models\Rpiw\DaftarRenaksiModel;
use App\Models\Rpiw\RenaksiModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use function PHPUnit\Framework\returnCallback;

class Rakorbangwil extends BaseController
{

    protected $pejabatModel;
    protected $pejabatBakModel;
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
    protected $programTahunanUsulanModel;
    protected $renaksiModel;
    protected $stakholderModel;
    protected $rekapProgRakorbangwilModel;

    public function __construct()

    {

        $this->pejabatModel = new PejabatModel();
        $this->pejabatBakModel = new PejabatBakModel();
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
        $this->programTahunanUsulanModel = new ProgTahunanUsulanModel();


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
        // Ambil provinsi
        if (user()->id_provinsi) {
            $provinsi_id = user()->id_provinsi;
        } else {
            $provinsi_id = $this->request->getPost('provinsi');
        }

        $id_role = user()->id_role;
        $unor_id = $this->request->getPost('unor');
        $sumber = $this->request->getPost('sumber');
        $catatan_pra_rakorbangwil = $this->request->getPost('catatan_rakorbangwil');
        $konfirmasi_pemda = $this->request->getPost('konfirmasi_pemda');
        if ($this->request->getPost('pn')) {
            $pn = $this->request->getPost('pn');
        } else {
            $pn = "ALLPN";
        }
        // Ambil data utama
        $daftar_program_tahunan = $this->daftarProgTahunanModel->getDaftarProgramTahunan(
            $provinsi_id,
            $unor_id,
            $sumber,
            $pn,
            null,
            null,
            null,
            $catatan_pra_rakorbangwil,
            null,
            $konfirmasi_pemda
        );

        // ===========================
        //   HITUNG SUMMARY SECTION  
        // ===========================

        $jumlah_total = count($daftar_program_tahunan);

        $memerlukan_catatan = 0;   // null atau '-'
        $jumlah_ada = 0;           // catatan terisi

        $kawasan_list = [];        // untuk hitung distinct kawasan

        foreach ($daftar_program_tahunan as $row) {

            // hitung kawasan unik
            if (!empty($row->kawasan)) {
                $kawasan_list[] = $row->kawasan;
            }

            // status catatan pemda
            if ($row->catatan_pemda === null || $row->catatan_pemda == '-') {
                $memerlukan_catatan++;
            } else {
                $jumlah_ada++;
            }
        }

        $jumlah_kawasan = count(array_unique($kawasan_list));

        // ===========================
        //  END SUMMARY SECTION
        // ===========================

        // hak akses
        $data = [
            'daftar_program_tahunan' => $daftar_program_tahunan,
            'can_view' => has_permission_menu($id_role, '/rakorbangwil/program_tahunan', 'can_view'),
            'can_edit' => has_permission_menu($id_role, '/rakorbangwil/program_tahunan', 'can_edit'),
            'can_delete' => has_permission_menu($id_role, '/rakorbangwil/program_tahunan', 'can_delete')
        ];

        // kembalikan JSON untuk ajax

        return $this->response->setJSON([
            'table' => view('pages/rakorbangwil/tabel/tabel_daftar_program_tahunan_pemda', $data),
            'summary' => [
                'memerlukan_catatan' => $memerlukan_catatan,
                'jumlah_kawasan' => $jumlah_kawasan,
                'jumlah_ada_catatan' => $jumlah_ada,
                'jumlah_total' => $jumlah_total
            ]
        ]);
    }

    // // --- VIEW DETAIL ---
    public function view($id)
    {
        $prog_tahunan = $this->daftarProgTahunanModel->find($id);
        $kabkot = $this->kabkotMemoModel->getKabkotMemo($id);

        if (!$prog_tahunan) {
            return $this->response->setStatusCode(404)->setBody('Data tidak ditemukan');
        }

        // --- Ambil peta kawasan berdasarkan nama kawasan di view_prog_tahunan ---
        $selectedKawasan = [];
        if (!empty($prog_tahunan->kawasan)) {
            // diasumsikan disimpan: "Kawasan A, Kawasan B"
            $selectedKawasan = array_map('trim', explode(',', $prog_tahunan->kawasan));
        }

        $petaKawasan = [];
        foreach ($selectedKawasan as $nama) {
            $row = $this->kawasanModel
                ->where('nama_kawasan', $nama)
                ->first();

            if ($row && !empty($row['peta_kawasan'])) {
                $petaKawasan[] = $row['peta_kawasan'];   // nama file geojson-nya
            }
        }

        return view('/pages/rakorbangwil/ModalView', [
            'prog_tahunan' => $prog_tahunan,
            'kabkot'       => $kabkot,
            'petaKawasan'  => $petaKawasan,
        ]);
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
        // --- Ambil file geojson kawasan berdasarkan nama kawasan yg dipilih ---

        if (!empty($progTahunan->kawasan)) {
            $selectedKawasan = array_map('trim', explode(',', $progTahunan->kawasan));
        }
        $petaKawasan = [];
        foreach ($selectedKawasan as $nama) {
            $row = $this->kawasanModel
                ->where('nama_kawasan', $nama)
                ->first();

            if ($row && !empty($row['peta_kawasan'])) {
                $petaKawasan[] = $row['peta_kawasan'];
            }
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
        return view('/pages/rakorbangwil/ModalEditPemda', [
            'selectedKabkot' => $selectedKabkot,
            'selectedKawasan' => $selectedKawasan,
            'kawasan' => $kawasan,
            'progTahunan' => $progTahunan,
            't_prog' => $t_prog,
            'namaList' => $namaList,
            'kabkot' => $kabkot,
            'pendanaan' => $pendanaan,
            'program' => $program,
            'kegiatan' => $kegiatan,
            'kro' => $kro,
            'ro' => $ro,
            'kabkotProgTahunan' => $kabkotProgTahunan,
            'petaKawasan' => $petaKawasan  // ← TAMBAHKAN INI
        ]);
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
        $pendanaan = $this->pendanaanModel->findAll();
        $rekap_kawasan = $this->rekapKawasanModel->where('id_pn', $id)->findAll();
        $rekap_program = $this->rekapProgRakorbangwilModel->where('id_pn', $id)->findAll();
        $kebutuhan_dukungan_kl = $this->kebutuhan_kl_Model->getKebutuhanKl($id);
        $catatan_pn = $this->praRakorModel->getCatatan($id);
        $this->template->write('title', 'Detail Prioritas Nasional');
        $this->template->load('/templates/main', '/pages/rakorbangwil/view_pn', [
            'kawasanData' => $rekap_kawasan,
            'programData' => $rekap_program,
            'pn' => $pn,
            'pendanaan' => $pendanaan,
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
        $sheet->setCellValue('AL1', 'Kebutuhan Dukungan K/L');
        $sheet->setCellValue('AM1', 'Catatan Pra Rakorbangwil');
        $sheet->setCellValue('AN1', 'Kebutuhan Dukungan Pemda');
        $sheet->setCellValue('AO1', 'Catatan Pemda');
        $sheet->setCellValue('AP1', 'Catatan Desk Rakorbangwil');
        // $sheet->setCellValue('AM1', 'Reviu Puswil');

        // Membuat teks header menjadi bold
        $sheet->getStyle('A1:AP1')->getFont()->setBold(true);

        // Atur kolom agar auto size
        // foreach (range('A', 'AM') as $col) {
        //     $sheet->getColumnDimension($col)->setAutoSize(true);
        // }

        // Atur semua kolom agar auto size (termasuk kolom di atas 'Z')
        // foreach ($sheet->getColumnIterator() as $column) {
        //     $columnIndex = $column->getColumnIndex();
        //     $sheet->getColumnDimension($columnIndex)->setAutoSize(true);
        // }

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
            $sheet->setCellValue('AN' . $row, $dt->catatan_konfrm_pemda);
            $sheet->setCellValue('AO' . $row, $dt->catatan_pemda);
            $sheet->setCellValue('AP' . $row, $dt->catatan_desk_rakorbangwil);
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
        $pendanaan = $this->pendanaanModel->findAll();
        $pn = $this->pnModel->find($id);
        $stackholder = $this->stakholderModel->orderBy('id_kategori')->orderBy('id_stakeholder')->findAll();
        $namaList = array_column($stackholder, 'stakeholder');
        $program = $this->praRakorModel->where('id_pn', $id)->findAll();
        $kebutuhan_dukungan_kl = $this->kebutuhan_kl_Model->getKebutuhanKl($id);
        $catatan_pn = $this->praRakorModel->getCatatan($id);
        $daftar_program_tahunan_usulan = $this->programTahunanUsulanModel->where('pn', $id)->findAll();
        $this->template->write('title', 'Detail Prioritas Nasional');
        $this->template->load('/templates/main', '/pages/rakorbangwil/desk_view_pn', [
            'provinsi' => $dataProvinsi,
            'daftar_program_tahunan_usulan' => $daftar_program_tahunan_usulan,
            'kesepakatan' => $dataKesepakatan,
            'unor' => $dataUnor,
            'pendanaan' => $pendanaan,
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
        $id_pendanaan = $this->request->getPost('pendanaan');
        $unor_id = $this->request->getPost('unor');
        $tipe = $this->request->getPost('tipe');
        $catatan_pemda = $this->request->getPost('catatan_pemda');
        $catatan_rakorbangwil = $this->request->getPost('catatan_rakorbangwil');
        $konfirmasi_pemda = $this->request->getPost('konfirmasi_pemda');
        $kesepakatan = $this->request->getPost('kesepakatan');
        $sumber = $this->request->getPost('sumber');
        $daftar_program_tahunan = $this->daftarProgTahunanModel->getDaftarProgramTahunan($provinsi_id, $unor_id, $sumber, $id_pn, null, $id_pendanaan, $tipe, $catatan_rakorbangwil, $catatan_pemda, $konfirmasi_pemda, $kesepakatan);
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
        $namaList = array_column($stackholder, 'stakeholder');
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
        $id_kegiatan = $this->request->getPost('id_kegiatan');
        $id_kro = $this->request->getPost('id_kro');
        $id_ro = $this->request->getPost('id_ro');
        $kabkot = $this->request->getPost('kabkot');
        $kawasan = $this->request->getPost('kawasan');
        $pekerjaan     = $this->request->getPost('pekerjaan');
        $lokasi        = $this->request->getPost('lokasi');
        $id_pendanaan   = $this->request->getPost('id_pendanaan');
        $anggaran   = $this->request->getPost('anggaran');
        $id_satuan   = $this->request->getPost('id_satuan');
        $volume   = $this->request->getPost('volume');
        // Ambil input utama
        $tipe_pekerjaan = $this->request->getPost('tipe_pekerjaan');
        $kesepakatan    = $this->request->getPost('kesepakatan');

        // Ambil array catatan desk
        $namaArr = $this->request->getPost('desk_nama');   // ← ini BENAR
        $textArr = $this->request->getPost('desk_text');   // ← ini BENAR

        // Susun catatan desk
        $deskCatatan = [];

        if ($namaArr && $textArr) {
            foreach ($namaArr as $i => $nama) {
                if (!empty($nama) && isset($textArr[$i]) && trim($textArr[$i]) !== '') {

                    $deskCatatan[] = [
                        'nama'    => $nama,
                        'catatan' => $textArr[$i]
                    ];
                }
            }
        }

        // Data yang akan diupdate
        $dataToUpdate = [
            'catatan_desk_rakorbangwil' => json_encode($deskCatatan, JSON_UNESCAPED_UNICODE),
            'tipe_pekerjaan'            => $tipe_pekerjaan,
            'desk_rakorbangwil'         => $kesepakatan,
            'id_kegiatan'       => $id_kegiatan,
            'id_kro'            => $id_kro,
            'id_ro'             => $id_ro,
            'pekerjaan'         => $pekerjaan,
            'lokasi'            => $lokasi,
            'id_pendanaan'      => $id_pendanaan,
            'anggaran'          => $anggaran,
            'id_satuan'         => $id_satuan,
            'volume'            => $volume
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

        // Update database
        if ($progTahunanModel->update($id, $dataToUpdate)) {
            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Data berhasil disimpan.'
            ]);
        } else {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Terjadi kesalahan saat menyimpan.'
            ]);
        }
    }

    public function berita_acara()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataPn = $this->pnModel->getAll();
        $pejabat = $this->pejabatModel->findAll();
        $this->template->write('title', 'Berita Acara Kesepakatan');
        $this->template->load('/templates/main', '/pages/rakorbangwil/berita_acara', [
            'provinsi' => $dataProvinsi,
            'pn' => $dataPn,
            'pejabat' => $pejabat
        ]);
    }

    public function get_data_berita_acara()
    {
        $id_pn = $this->request->getPost('pn');
        $provinsi_id = $this->request->getPost('provinsi');

        $kawasan = $this->praRakorModel->getKawasanList($provinsi_id, null, $id_pn);
        $diakomodasi1 = $this->daftarProgTahunanModel->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 1);
        $diakomodasi2 = $this->daftarProgTahunanModel->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 2);
        $ditangguhkan3 = $this->daftarProgTahunanModel
            ->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 3);
        $ditangguhkan4 = $this->daftarProgTahunanModel
            ->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 4);
        $ditangguhkan5 = $this->daftarProgTahunanModel
            ->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 5);
        $ditangguhkan6 = $this->daftarProgTahunanModel
            ->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 6);
        $ditangguhkan = array_merge($ditangguhkan3, $ditangguhkan4, $ditangguhkan5, $ditangguhkan6);
        $diakomodasi = array_merge($diakomodasi1, $diakomodasi2);
        $tidakTerbahas = $this->daftarProgTahunanModel->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 0);
        $pejabat_bak = $this->pejabatBakModel->where('id_provinsi', $provinsi_id)->where('id_pn', $id_pn)->orderBy('prioritas', 'ASC')->findAll();
        return $this->response->setJSON([
            'kawasan'        => $kawasan,
            'diakomodasi'    => $diakomodasi,
            'ditangguhkan'   => $ditangguhkan,
            'tidakTerbahas'  => $tidakTerbahas,
            'pejabat_bak'  => $pejabat_bak,

        ]);
    }
    public function create_bak()
    {
        $id_pn = $this->request->getPost('pn_id');
        $provinsi_id = $this->request->getPost('provinsi_id');
        $tanggal = $this->request->getPost('tanggal');
        $pejabat_bak = $this->pejabatBakModel
            ->select('m_ttd_ba_rakorbangwil.*, pejabat.nama_pejabat, pejabat.jabatan, pejabat.instansi, pejabat.tanda_tangan')
            ->join('m_pejabat pejabat', 'pejabat.id_pejabat = m_ttd_ba_rakorbangwil.id_pejabat')
            ->where('m_ttd_ba_rakorbangwil.id_provinsi', $provinsi_id)
            ->where('m_ttd_ba_rakorbangwil.id_pn', $id_pn)
            ->where('m_ttd_ba_rakorbangwil.thn_pelaksanaan', session('tahun_pelaksana'))
            ->orderBy('m_ttd_ba_rakorbangwil.prioritas')
            ->findAll();

        $provinsi = $this->provinsiModel->find($provinsi_id); // Ganti dengan nama tabel Anda
        $pn = $this->pnModel->find($id_pn); // Ganti dengan nama tabel Anda
        // $kawasandesk = $this->programModel->getProgramKawasan($id_provinsi);
        // $catatan_provinsi = $this->catatanModel->getCatatanbyProvinsi($id_provinsi);
        // $pejabat = $this->baModel->getPejabatById($id_provinsi, $id_unor);
        $kawasan = $this->praRakorModel->getKawasanList($provinsi_id, null, $id_pn);
        $diakomodasi1 = $this->daftarProgTahunanModel->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 1);
        $diakomodasi2 = $this->daftarProgTahunanModel->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 2);
        $ditangguhkan3 = $this->daftarProgTahunanModel
            ->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 3);
        $ditangguhkan4 = $this->daftarProgTahunanModel
            ->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 4);
        $ditangguhkan5 = $this->daftarProgTahunanModel
            ->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 5);
        $ditangguhkan6 = $this->daftarProgTahunanModel
            ->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 6);
        $ditangguhkan = array_merge($ditangguhkan3, $ditangguhkan4, $ditangguhkan5, $ditangguhkan6);
        $diakomodasi = array_merge($diakomodasi1, $diakomodasi2);

        $tidakTerbahas = $this->daftarProgTahunanModel->getDaftarProgramTahunan($provinsi_id, null, null, $id_pn, null, null, null, null, null, null, 0);
        $html = view('/pages/rakorbangwil/berita_acara_pdf', [
            'kawasan' => $kawasan,
            'diakomodasi' => $diakomodasi,
            'ditangguhkan' => $ditangguhkan,
            'tidakTerbahas' => $tidakTerbahas,
            'provinsi' => $provinsi,
            'pn' => $pn,
            'pejabat_bak' => $pejabat_bak,
            'tanggal_bak' => $tanggal

        ]);


        // Inisialisasi mPDF
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'L',
            'margin_bottom' => 15,
        ]);

        // Load HTML ke dalam mPDF // Menentukan footer sebagai fallback
        $mpdf->SetWatermarkImage('assets/img/pu-transparan.png', 0.2);
        $mpdf->showWatermarkImage = true;

        $mpdf->SetHTMLFooter('<div style="text-align: center;">© 2025 - Berita Acara Kesepakatan Rakorbangwil Provinsi ' . ucwords($provinsi["provinsi"]) . ' | Prioritas Nasional ' .  ucwords($pn["id_pn"]) . ' | Halaman {PAGENO} dari {nbpg}</div>');
        $mpdf->WriteHTML($html);

        // Output PDF ke browser
        return $this->response->setHeader('Content-Type', 'application/pdf')
            ->setBody($mpdf->Output('BERITA ACARA RAKORBANGIWL.pdf', 'I')); // 'I' untuk menampilkan, 'D' untuk mengunduh
    }
    public function get_pejabat_bak()
    {
        $provinsi_id = $this->request->getPost('provinsi');
        $pn_id       = $this->request->getPost('pn');

        if (!$provinsi_id || !$pn_id) {
            return $this->response->setJSON([]);
        }

        // join ke master pejabat + provinsi
        $data = $this->pejabatBakModel
            ->select('m_ttd_ba_rakorbangwil.id,
                  m_pejabat.nama_pejabat,
                  m_pejabat.jabatan,
                  m_provinsi.provinsi,
                  m_ttd_ba_rakorbangwil.prioritas')
            ->join('m_pejabat', 'm_pejabat.id_pejabat = m_ttd_ba_rakorbangwil.id_pejabat')
            ->join('m_provinsi', 'm_provinsi.id = m_ttd_ba_rakorbangwil.id_provinsi')
            ->where('m_ttd_ba_rakorbangwil.id_provinsi', $provinsi_id)
            ->where('m_ttd_ba_rakorbangwil.id_pn', $pn_id)
            ->where('m_ttd_ba_rakorbangwil.thn_pelaksanaan', session('tahun_pelaksana'))
            ->orderBy('prioritas', 'ASC')
            ->findAll();

        return $this->response->setJSON($data);
    }


    public function addPejabatBAK()
    {
        $pejabat_id  = $this->request->getPost('pejabat_id');
        $provinsi_id = $this->request->getPost('provinsi_id');
        $pn_id       = $this->request->getPost('pn_id');

        if (!$pejabat_id || !$provinsi_id || !$pn_id) {
            return redirect()->back()->with('error', 'Data tidak lengkap.');
        }

        // ===========================================
        // 1. CARI PRIORITAS TERAKHIR UNTUK PROVINSI + PN
        // ===========================================
        $last = $this->pejabatBakModel
            ->where('id_provinsi', $provinsi_id)
            ->where('id_pn', $pn_id)
            ->where('thn_pelaksanaan',  session('tahun_pelaksana'))
            ->orderBy('prioritas', 'DESC')
            ->first();

        // Jika belum ada data → mulai dari prioritas 1
        $newPrioritas = $last ? $last->prioritas + 1 : 1;

        // ===========================================
        // 2. INSERT PEJABAT DENGAN PRIORITAS OTOMATIS
        // ===========================================
        $this->pejabatBakModel->insert([
            'id_pejabat'  => $pejabat_id,
            'id_provinsi' => $provinsi_id,
            'id_pn'       => $pn_id,
            'prioritas'   => $newPrioritas,
            'thn_pelaksanaan'   => session('tahun_pelaksana')
        ]);

        return redirect()->back()->with('success', 'Pejabat berhasil ditambahkan.');
    }


    public function delete_pejabat_bak()
    {
        $id = $this->request->getPost('id');
        $this->pejabatBakModel->delete($id);

        return $this->response->setJSON(['status' => true]);
    }
    public function updatePrioritasPejabat()
    {
        $orderData = $this->request->getPost('order');

        if (!$orderData) {
            return $this->response->setJSON(['status' => 'error']);
        }

        foreach ($orderData as $row) {
            $this->pejabatBakModel
                ->where('id', $row['id'])
                ->set(['prioritas' => $row['prioritas']])
                ->update();
        }

        return $this->response->setJSON(['status' => 'success']);
    }

    public function get_rekap_kawasan()
    {
        if (user()->id_provinsi) {
            $provinsi = user()->id_provinsi;
        } else {
            $provinsi = $this->request->getPost('provinsi');
        }
        $pn = $this->request->getPost('pn');
        $sumber = $this->request->getPost('sumber');
        $unor = $this->request->getPost('unor');
        $catatan_pra_rakorbangwil = $this->request->getPost('catatan_rakorbangwil');
        $konfirmasi_pemda = $this->request->getPost('konfirmasi_pemda');
        if ($this->request->getPost('pn')) {
            $pn = $this->request->getPost('pn');
        } else {
            $pn = "ALLPN";
        }
        // Data pekerjaan (SAMA dengan dashboard)
        $dataPekerjaan = $this->daftarProgTahunanModel->getDaftarProgramTahunan(
            $provinsi,
            $unor,
            $sumber,
            $pn,
            null,
            null,
            null,
            $catatan_pra_rakorbangwil,
            null,
            $konfirmasi_pemda
        );

        $rekap = [];

        foreach ($dataPekerjaan as $p) {

            if (empty($p->kawasan_panjang)) continue;

            $key = $p->kawasan_panjang;

            if (!isset($rekap[$key])) {
                $rekap[$key] = [
                    'kawasan' => $p->kawasan_panjang,
                    'tematik' => $p->tematik,
                    'jumlah'  => 0
                ];
            }

            $rekap[$key]['jumlah']++;
        }

        // TARUH NON KAWASAN DI BAWAH
        $nonKawasan = null;
        if (isset($rekap['Non Kawasan'])) {
            $nonKawasan = $rekap['Non Kawasan'];
            unset($rekap['Non Kawasan']);
        }

        // Sort A-Z
        usort($rekap, fn($a, $b) => strcmp($a['kawasan'], $b['kawasan']));

        // Append Non Kawasan terakhir
        if ($nonKawasan) {
            $rekap[] = $nonKawasan;
        }

        return $this->response->setJSON(array_values($rekap));
    }

    public function laporan5()
    {
        if (user()->id_provinsi) {
            $id_provinsi = user()->id_provinsi;
            $dataProvinsi = $this->provinsiModel->where('id', $id_provinsi)->first();
        } else {
            $dataProvinsi = $this->provinsiModel->getProvinsi();
        }
        // $dataKawasan = $this->kawasanRpiwModel->getKawasan();
        // $dataUnor = $this->unorModel->getUnor();
        $data = [
            // 'kawasan' => $dataKawasan,
            'provinsi' => $dataProvinsi,
            // 'unor' => $dataUnor
        ];
        $this->template->write('title', 'Program Tahunan');
        $this->template->load('/templates/main', '/pages/rakorbangwil/report_desk_kawasan_pekerjaan', $data);
    }

    public function filter_laporan5()
    {
        if (user()->id_provinsi) {
            $provinsi = user()->id_provinsi;
        } else {
            $provinsi = $this->request->getPost('id_provinsi');
        }
        $pn = $this->request->getPost('id_pn');
        // $sumber = $this->request->getPost('sumber');
        // $unor = $this->request->getPost('unor');
        if ($this->request->getPost('id_pn')) {
            $pn = $this->request->getPost('id_pn');
        } else {
            $pn = "ALLPN";
        }

        $dataPekerjaan = $this->reportProgTahunanPerProvinsiModel->getReportDeskRakorbangwilKawasanPekerjaan(
            $provinsi,
            $pn,
            null,
            'x'
        );

        $rekap = [];

        foreach ($dataPekerjaan as $p) {

            if (empty($p->kawasan_panjang)) continue;

            // $key = $p->kawasan_panjang;

            // key unik per provinsi dan kawasan panjang untuk mengcover value yang sama (contoh: Non Kawasan)
            $key = $p->provinsi . '|' . $p->kawasan_panjang;

            if (!isset($rekap[$key])) {
                $rekap[$key] = [
                    'provinsi' => $p->provinsi,
                    'tematik' => $p->tematik,
                    'kawasan' => $p->kawasan_panjang,
                    'pekerjaan_belum_dibahas'   => 0,
                    'pekerjaan_sudah_dibahas'   => 0,
                    'jumlah_pekerjaan'  => 0
                ];
            }

            if ($p->desk_rakorbangwil == 0) {
                $rekap[$key]['pekerjaan_belum_dibahas']++;
            } else {
                $rekap[$key]['pekerjaan_sudah_dibahas']++;
            }

            $rekap[$key]['jumlah_pekerjaan']++;
        }

        // Sort A-Z
        usort($rekap, function ($a, $b) {
            // 1. Sort berdasarkan provinsi dulu
            $cmp = strcmp($a['provinsi'], $b['provinsi']);
            if ($cmp !== 0) return $cmp;
            // 2. Jika provinsi sama, non-kawasan selalu terakhir
            $isA = ($a['kawasan'] === 'Non Kawasan');
            $isB = ($b['kawasan'] === 'Non Kawasan');

            // A muncul setelah B karena A > B
            if ($isA && !$isB) return 1;
            // A muncul sebelum B karena A < B
            if ($isB && !$isA) return -1;

            // 3. Selain itu urutkan kawasan A–Z
            return strcmp($a['kawasan'], $b['kawasan']);
        });

        $data = [
            'rekap' => $rekap
        ];

        return view('/pages/rakorbangwil/tabel/tabel_report_desk_kawasan_pekerjaan', $data);
    }
}
