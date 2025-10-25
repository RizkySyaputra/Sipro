<?php

namespace App\Controllers;

use App\Models\Rpiw\ProgramRpiwModel;
use App\Models\Rpiw\KawasanRpiwModel;
use App\Models\Rakorbangwil\ProgTahunanModel;
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
use App\Models\Rakorbangwil\DaftarProgTahunanModel;
use App\Models\Rpiw\DaftarRenaksiModel;
use App\Models\Rpiw\RenaksiModel;

use function PHPUnit\Framework\returnCallback;

class Rakorbangwil extends BaseController
{
    protected $programRpiwModel;
    protected $kawasanRpiwModel;
    protected $provinsiModel;
    protected $unorModel;
    protected $pendanaanModel;
    protected $kabkotModel;
    protected $kawasanModel;
    protected $kabkotMemoModel;
    protected $kawasanMemoModel;
    protected $kabkotProgramTahunanModel;
    protected $kawasanProgramTahunanModel;
    protected $rekapProgram;
    protected $programModel;
    protected $kegiatanModel;
    protected $kroModel;
    protected $roModel;
    protected $daftarProgTahunanModel;
    protected $progTahunanModel;
    protected $satuanModel;
    protected $mpModel;
    protected $daftarRenaksiModel;
    protected $renaksiModel;
    protected $stakholderModel;
    public function __construct()

    {
        $this->programModel = new ProgramModel();
        $this->kegiatanModel = new KegiatanModel();
        $this->kroModel = new KroModel();
        $this->roModel = new RoModel();
        $this->daftarProgTahunanModel = new DaftarProgTahunanModel();
        $this->progTahunanModel = new ProgTahunanModel();
        $this->programRpiwModel = new ProgramRpiwModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->unorModel = new UnorModel();
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

        helper('permission');
    }
    // public function index()
    // {
    //     $unor_id = $this->request->getPost('unor');
    //     $provinsi_id = $this->request->getPost('provinsi');
    //     $kawasan_id = $this->request->getPost('kawasan');
    //     $tahun_anggaran = $this->request->getPost('tahun_anggaran');
    //     $residu = $this->request->getPost('residu');
    //     $dataKawasan = $this->kawasanRpiwModel->getKawasan();
    //     $dataProvinsi = $this->provinsiModel->getProvinsi();
    //     $dataUnor = $this->unorModel->getUnor();
    //     if (isset($unor_id) || isset($provinsi_id) || isset($kawasan_id)) {
    //         $programs = $this->programRpiwModel->getProgramRpiw($provinsi_id, $unor_id, $kawasan_id, $tahun_anggaran, $residu);
    //         $kawasans = $this->kawasanRpiwModel->getKawasanAll();
    //         $kawasanAll = []; // $programs menjadi array object 
    //         foreach ($kawasans as $kawasan) {
    //             $kawasanAll[$kawasan->kode_program][] = $kawasan;
    //         }
    //         $data = [
    //             'p_rpiw' => $programs,
    //             'kawasans' => $kawasanAll,
    //             'kawasan' => $dataKawasan,
    //             'provinsi' => $dataProvinsi,
    //             'unor' => $dataUnor,
    //         ];
    //         $this->template->write('title', 'Memorandum Program');
    //         $this->template->load('/templates/main', '/pages/memorandum/program', $data);
    //     } else {
    //         $data = [
    //             'kawasan' => $dataKawasan,
    //             'provinsi' => $dataProvinsi,
    //             'unor' => $dataUnor,
    //             'tahun' => $tahun_anggaran
    //         ];
    //         $this->template->write('title', 'Memorandum Program');
    //         // $this->template->add_js('assets/js/memorandum/program.js');
    //         $this->template->load('/templates/main', '/pages/memorandum/program', $data);
    //     }
    // }
    // public function get_program()
    // {

    //     $unor_id = $this->request->getPost('unor');
    //     $provinsi_id = $this->request->getPost('provinsi');
    //     $kawasan_id = $this->request->getPost('kawasan');
    //     $programs = $this->programModel->getProgramMemo($provinsi_id, $unor_id, $kawasan_id);
    //     $kawasans = $this->kawasanRpiwModel->getKawasanAll();
    //     $kawasanAll = []; // $programs menjadi array object 
    //     foreach ($kawasans as $kawasan) {
    //         $kawasanAll[$kawasan->kode_program][] = $kawasan;
    //     }
    //     $data = [
    //         'p_memo' => $programs,
    //         'kawasans' => $kawasanAll,
    //     ];
    //     return view('/pages/memorandum/tabel/tabel_memorandum', $data);
    // }
    // public function filter_data()
    // {
    //     $unor_id = $this->request->getPost('unor');
    //     $provinsi_id = $this->request->getPost('provinsi');
    //     $kawasan_id = $this->request->getPost('kawasan');
    //     $residu = $this->request->getPost('residu');
    //     $tahun_anggaran = $this->request->getPost('tahun_anggaran');

    //     // Lakukan query berdasarkan filter yang diterapkan
    //     $programs = $this->programRpiwModel->getProgramRpiw($provinsi_id, $unor_id, $kawasan_id, $tahun_anggaran, $residu);
    //     $kawasans = $this->kawasanRpiwModel->getKawasanAll();
    //     $kawasanAll = []; // $programs menjadi array object 
    //     foreach ($kawasans as $kawasan) {
    //         $kawasanAll[$kawasan->kode_program][] = $kawasan;
    //     }
    //     $data = [
    //         'p_rpiw' => $programs,
    //         'kawasans' => $kawasanAll,
    //         'tahun' => $tahun_anggaran
    //     ];
    //     // Load view dan kembalikan hanya bagian tabel
    //     return view('/pages/memorandum/tabel/tabel_program', $data); // Pastikan view hanya memuat tbody
    // }

    // public function get_kawasan()
    // {
    //     $provinsi_id = $this->request->getPost('provinsi_id');
    //     $kawasan = $this->kawasanRpiwModel->getKawasanByProvinsi($provinsi_id);
    //     return $this->response->setJSON($kawasan);
    // }

    // public function detail($id)
    // {
    //     $dataProgram = $this->programRpiwModel->getProgramRpiwDetail($id);
    //     $dataKawasan = $this->kawasanRpiwModel->getKawasanById($id);
    //     $dataSatuan = $this->satuanModel->getSatuan();
    //     $dataMp = $this->mpModel->getMp();

    //     // Array untuk menampung data geojson
    //     $petaKawasan = [];
    //     $namaKawasan = [];

    //     foreach ($dataKawasan as $kawasan) {
    //         if ($kawasan->kode_kawasan != 0) {
    //             // Cek apakah peta_kawasan ada
    //             if (!empty($kawasan->peta_kawasan)) {
    //                 $filePath = FCPATH . 'geoJson/' . $kawasan->peta_kawasan;
    //                 // Cek jika file peta_kawasan ada
    //                 if (file_exists($filePath)) {
    //                     // Masukkan isi file GeoJSON ke dalam array
    //                     $petaKawasan[] = file_get_contents($filePath);
    //                     $namaKawasan[] = $kawasan->nama_kawasan;
    //                 }
    //             }
    //         } else {
    //             // Jika tidak ada kawasan, set petaKawasan ke null
    //             $petaKawasan = null;
    //             $namaKawasan = null;
    //         }
    //     }

    //     foreach ($dataProgram as $program) {
    //         if ($program->tagging_program != "") {
    //             $jsonProgram = FCPATH . 'geoJson/' . $program->geojtagging_programson;
    //             $petaProgram = file_get_contents($jsonProgram);
    //         } else {
    //             $petaProgram = "";
    //         }
    //         $lat = $program->latitude;
    //         $long = $program->longitude;
    //     }


    //     $data = [
    //         'kawasans' => $dataKawasan,
    //         'p_rpiw' => $dataProgram,
    //         'peta_kawasan' => $petaKawasan,
    //         'namaKawasan' => $namaKawasan,
    //         'peta_program' => $petaProgram,
    //         'latitude' => $lat,
    //         'longitude' => $long,
    //         'satuan' => $dataSatuan,
    //         'mp' => $dataMp

    //     ];
    //     $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
    //     $this->template->write('title', 'Detail Program RPIW');
    //     $this->template->load('/templates/main', '/pages/memorandum/detail', $data);
    // }
    // public function insert()
    // {
    //     $provinsi_id = $this->request->getPost('id_provinsi');
    //     $unor_id = $this->request->getPost('id_unor');
    //     $program_id = $this->request->getPost('id_program');
    //     $nama_program = $this->request->getPost('nama_program');
    //     $lokasi = $this->request->getPost('lokasi');
    //     $justifikasi = $this->request->getPost('justifikasi');
    //     $kesiapan_rc = $this->request->getPost('kesiapan_rc');
    //     $volume = $this->request->getPost('volume');
    //     $id_satuan = $this->request->getPost('id_satuan');
    //     $biaya = $this->request->getPost('biaya');
    //     $id_pendanaan = $this->request->getPost('id_pendanaan');
    //     $tagging_mp = $this->request->getPost('tagging_mp');
    //     $tahun_anggaran = $this->request->getPost('tahun_anggaran');
    //     $prefix_id_program =  '26' . $provinsi_id . $unor_id;
    //     //proses cek id yang sudah ada
    //     $id_mprogram_db = $this->programModel->getIdProgramMemo($prefix_id_program);
    //     $existing_ids = array_map(function ($row) use ($prefix_id_program) {
    //         return (int)substr($row->id_mprogram, strlen($prefix_id_program));
    //     }, $id_mprogram_db);
    //     // Jika ada ID yang sudah ada, cari angka berurutan berikutnya yang unik
    //     if (!empty($existing_ids)) {
    //         // Cari angka akhir terbesar dan tambahkan 1
    //         $max_sequence = max($existing_ids);
    //         $new_sequence = $max_sequence + 1;
    //     } else {
    //         // Jika belum ada ID dengan prefix_id_program ini, mulai dari 1
    //         $new_sequence = 1;
    //     }

    //     // Gabungkan menjadi ID baru
    //     $new_id_mprogram = $prefix_id_program . $new_sequence;

    //     $this->programModel->addMemorandumProgram(
    //         $new_id_mprogram,
    //         $provinsi_id,
    //         $unor_id,
    //         $program_id,
    //         $nama_program,
    //         $lokasi,
    //         $justifikasi,
    //         $kesiapan_rc,
    //         $volume,
    //         $biaya,
    //         $id_satuan,
    //         $id_pendanaan,
    //         $tagging_mp,
    //         $tahun_anggaran
    //     );
    //     return redirect()->to('/daftar_program');
    // }

    // public function addCatatan()
    // {
    //     $jenis = $this->request->getPost('jenis');
    //     $id_mprogram = $this->request->getPost('id_mprogram');
    //     $bpiw = $this->request->getPost('bpiw');
    //     $unor = $this->request->getPost('unor');
    //     $kl = $this->request->getPost('kl');
    //     $nama_program = $this->request->getPost('nama_program');
    //     $id_satuan = $this->request->getPost('id_satuan');
    //     $volume = $this->request->getPost('volume');
    //     $biaya = $this->request->getPost('biaya');
    //     $kesiapan_rc = $this->request->getPost('rc');
    //     $desk = $this->request->getPost('desk');
    //     $id_pendanaan = $this->request->getPost('id_pendanaan');
    //     $catatan_desk2 = $this->request->getPost('catatan_desk2');
    //     $desk2 = $this->request->getPost('desk2');
    //     $desk2 = ($desk2 == "x") ? null : $desk2;

    //     $this->programModel->add_catatan($id_mprogram, $bpiw, $unor, $catatan_desk2, $nama_program,  $volume, $id_satuan, $biaya, $kesiapan_rc, $desk, $id_pendanaan, $desk2);
    //     if ($jenis == "desk") {
    //         return redirect()->to(base_url('desk_program'));
    //     }
    //     return redirect()->to(base_url('daftar_program'));
    //     //return redirect()->back();
    // }
    // public function listProgram()
    // {
    //     // $unor_id = $this->request->getPost('unor');
    //     // $provinsi_id = $this->request->getPost('provinsi');
    //     // $kawasan_id = $this->request->getPost('kawasan');
    //     // $tahun_anggaran = $this->request->getPost('tahun_anggaran');
    //     // $programs = $this->programModel->getProgramMemo($provinsi_id, $unor_id, $kawasan_id, $tahun_anggaran);
    //     // $kawasans = $this->kawasanRpiwModel->getKawasanAll();
    //     $dataKawasan = $this->kawasanRpiwModel->getKawasan();
    //     $dataProvinsi = $this->provinsiModel->getProvinsi();
    //     $dataUnor = $this->unorModel->getUnor();
    //     // $kawasanAll = []; // $programs menjadi array object 
    //     // foreach ($kawasans as $kawasan) {
    //     //     $kawasanAll[$kawasan->kode_program][] = $kawasan;
    //     // }
    //     $data = [
    //         'kawasan' => $dataKawasan,
    //         'provinsi' => $dataProvinsi,
    //         'unor' => $dataUnor
    //     ];
    //     $this->template->write('title', 'List Memorandom Program');
    //     $this->template->load('/templates/main', '/pages/memorandum/listProgram', $data);
    // }

    // public function programMemorandumDetail($id_memo)
    // {
    //     $dataMemorandum = $this->programModel->getProgramMemorandumById($id_memo);
    //     $id_rpiw = $dataMemorandum[0]->id_rpiw;
    //     $dataKawasan = $this->kawasanRpiwModel->getKawasanById($id_rpiw);
    //     $dataSatuan = $this->satuanModel->getSatuan();
    //     // $dataKawasan = $this->kawasanRpiwModel->getKawasanById($id_rpiw);
    //     // Array untuk menampung data geojson
    //     $petaKawasan = [];
    //     $namaKawasan = [];

    //     foreach ($dataKawasan as $kawasan) {
    //         if ($kawasan->kode_kawasan != 0) {
    //             // Cek apakah peta_kawasan ada
    //             if (!empty($kawasan->peta_kawasan)) {
    //                 $filePath = FCPATH . 'geoJson/' . $kawasan->peta_kawasan;
    //                 // Cek jika file peta_kawasan ada
    //                 if (file_exists($filePath)) {
    //                     // Masukkan isi file GeoJSON ke dalam array
    //                     $petaKawasan[] = file_get_contents($filePath);
    //                     $namaKawasan[] = $kawasan->nama_kawasan;
    //                 }
    //             }
    //         } else {
    //             // Jika tidak ada kawasan, set petaKawasan ke null
    //             $petaKawasan = null;
    //             $namaKawasan = null;
    //         }
    //     }

    //     foreach ($dataMemorandum as $program) {

    //         if ($program->tagging_program != "") {
    //             $jsonProgram = FCPATH . 'geoJson/' . $program->geojtagging_programson;
    //             $petaProgram = file_get_contents($jsonProgram);
    //         } else {
    //             $petaProgram = "";
    //         }
    //         $lat = $program->latitude;
    //         $long = $program->longitude;
    //     }


    //     $data = [
    //         'kawasans' => $dataKawasan,
    //         'p_memo' => $dataMemorandum,
    //         'peta_kawasan' => $petaKawasan,
    //         'namaKawasan' => $namaKawasan,
    //         'peta_program' => $petaProgram,
    //         'latitude' => $lat,
    //         'longitude' => $long,
    //         'satuan' => $dataSatuan

    //     ];
    //     $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
    //     $this->template->write('title', 'Detail Program RPIW');
    //     $this->template->load('/templates/main', '/pages/memorandum/detailProgram', $data);
    // }

    // // Sipro 2025

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
    // //2025
    public function get_daftar_program_tahunan()
    {
        $id_role = user()->id_role;
        $provinsi_id = $this->request->getPost('provinsi');
        $unor_id = $this->request->getPost('unor');
        $sumber = $this->request->getPost('sumber');
        $daftar_program_tahunan = $this->daftarProgTahunanModel->getDaftarProgramTahunan($provinsi_id, $unor_id, $sumber);


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
        $program = $this->programModel->findAll();
        $kegiatan = $this->kegiatanModel->findAll();;
        $kro = $this->kroModel->findAll();;
        $ro = $this->roModel->findAll();;
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
        $anggaran   = $this->request->getPost('anggaran');
        $id_satuan   = $this->request->getPost('id_satuan');
        $volume   = $this->request->getPost('volume');
        $thn_pelaksanaan = $this->request->getPost('thn_pelaksanaan');
        $kebutuhan_dukungan_kl = $this->request->getPost('kebutuhan_dukungan_kl');
        $geotag = $this->request->getPost('geotag');
        $reviu_puswil = $this->request->getPost('reviu_puswil');


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
            'anggaran'          => $anggaran,
            'id_satuan'         => $id_satuan,
            'kebutuhan_dukungan_kl' => $kebutuhan_dukungan_kl,
            'geotag'            => $geotag,
            'reviu_puswil'      => $reviu_puswil,
            'volume'            => $volume,
            'thn_pelaksanaan'   => $thn_pelaksanaan,
            'catatan_memorandum' => json_encode($catatan, JSON_UNESCAPED_UNICODE)
        ];
        // Update data
        $this->kabkotProgramTahunanModel->where('id_prog_tahunan', $id)->delete();
        $this->kawasanProgramTahunanModel->where('id_prog_tahunan', $id)->delete();
        foreach ($kabkot as $data) {
            $this->kabkotProgramTahunanModel->insert(['id_prog_tahunan' => $id, 'id_kabkot' => $data]);
        }
        foreach ($kawasan as $data) {
            $this->kawasanProgramTahunanModel->insert(['id_prog_tahunan' => $id, 'id_kawasan' => $data]);
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
        $id_renaksi =  $progTahunan->id_renaksi;
        $renaksi = $this->renaksiModel->find($id_renaksi);
        $newmp = $renaksi->mp - 1;
        $this->renaksiModel->update($id_renaksi, ['mp' => $newmp]);
        $this->progTahunanModel->where('id_prog_tahunan', $id)->delete();

        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    }

    // public function daftar_renaksi()
    // {

    //     $dataKawasan = $this->kawasanRpiwModel->getKawasan();
    //     $dataProvinsi = $this->provinsiModel->getProvinsi();
    //     $dataUnor = $this->unorModel->getUnor();
    //     $data = [
    //         'kawasan' => $dataKawasan,
    //         'provinsi' => $dataProvinsi,
    //         'unor' => $dataUnor
    //     ];
    //     $this->template->write('title', 'Rencana Aksi');
    //     $this->template->load('/templates/main', '/pages/memorandum/daftar_renaksi', $data);
    // }

    // public function get_daftar_renaksi()
    // {
    //     $id_role = user()->id_role;
    //     $provinsi_id = $this->request->getPost('provinsi');
    //     $unor_id = $this->request->getPost('unor');
    //     $kawasan = $this->request->getPost('sumber');
    //     $status = $this->request->getPost('status');
    //     $daftarRenaksi = $this->daftarRenaksiModel->getDaftarRenaksi($provinsi_id, $unor_id, $kawasan, $status);
    //     $data = [
    //         'daftar_renaksi' => $daftarRenaksi,
    //         'can_view' => has_permission_menu($id_role, '/rpiw/daftar_renaksi', 'can_view'),
    //         'can_edit' => has_permission_menu($id_role, '/rpiw/daftar_renaksi', 'can_edit'),
    //         'can_delete' => has_permission_menu($id_role, '/rpiw/daftar_renaksi', 'can_delete')
    //     ];
    //     return view('/pages/memorandum/tabel/tabel_daftar_renaksi', $data);
    // }
    // public function input_renaksi($id)
    // {
    //     $data = $this->daftarRenaksiModel->find($id);
    //     $stackholder = $this->stakholderModel->orderBy('id_kategori')->orderBy('id_stakeholder')->findAll();
    //     $namaList = array_column($stackholder, 'short_stakeholder');
    //     $id_prov = $data->id_provinsi;
    //     $kabkot = $this->kabkotModel->where('id_prov', $id_prov)->findAll();
    //     $kawasan = $this->kawasanModel->where('id_provinsi', $id_prov)->findAll();
    //     $program = $this->programModel->findAll();
    //     $kegiatan = $this->kegiatanModel->findAll();;
    //     $kro = $this->kroModel->findAll();;
    //     $ro = $this->roModel->findAll();;
    //     $pendanaan = $this->pendanaanModel->findAll();

    //     if (!$data) {
    //         return $this->response->setStatusCode(404)->setBody('Data tidak ditemukan');
    //     }
    //     return view('/pages/memorandum/ModalInputRenaksi', ['kawasan' => $kawasan, 'data' => $data,  'namaList' => $namaList, 'kabkot' => $kabkot, 'pendanaan' => $pendanaan, 'program' => $program, 'kegiatan' => $kegiatan, 'kro' => $kro, 'ro' => $ro]);
    // }


    // public function input_memo_renaksi($id)
    // {
    //     $kabkot = $this->request->getPost('kabkot');
    //     $kawasan = $this->request->getPost('kawasan');
    //     $data = $this->request->getPost();
    //     // --- Pastikan ID Unor dua digit ---
    //     $id_unor = $data['id_unor'];
    //     $prefix = 'MP' . '.' . $data['id_provinsi'] . '.' . $id_unor . '.';
    //     $search = 'MP' . '.' . $data['id_provinsi'] . '.' . $id_unor . '.0';
    //     // --- Ambil uniq_id terakhir berdasarkan id_provinsi ---
    //     $row = $this->memoModel
    //         ->like('id_memorandum', $search)
    //         ->orderBy('id_memorandum', 'DESC')
    //         ->first();

    //     if ($row) {
    //         // Ambil angka uniq terakhir dan tambah 1
    //         $last_id = (int) substr($row->id_memorandum, -4);
    //         $uniq_id = str_pad($last_id + 1, 4, '0', STR_PAD_LEFT);
    //     } else {
    //         $uniq_id = '0001';
    //     }
    //     // Gabungkan prefix + uniq
    //     $id_memorandum = $prefix . $uniq_id;

    //     // --- Handle Volume dan Anggaran per Tahun ---
    //     $volumeData = [];
    //     $anggaranData = [];

    //     $tahunMulai = (int) $this->request->getPost('tahun_mulai');
    //     $tahunSelesai = (int) $this->request->getPost('tahun_selesai');

    //     if ($tahunMulai && $tahunSelesai && $tahunSelesai >= $tahunMulai) {
    //         for ($tahun = $tahunMulai; $tahun <= $tahunSelesai; $tahun++) {
    //             $index = $tahun - $tahunMulai + 1;
    //             $volumeKey = 'volume_' . $index;
    //             $anggaranKey = 'anggaran_' . $index;

    //             $volumeData[$volumeKey] = $this->request->getPost($volumeKey);
    //             $anggaranData[$anggaranKey] = $this->request->getPost($anggaranKey);
    //         }
    //     }

    //     // --- Handle Catatan (Array Nama + Catatan) ---
    //     $namaArr = $this->request->getPost('catatan_nama');
    //     $textArr = $this->request->getPost('catatan_text');

    //     $catatan = [];
    //     if ($namaArr && $textArr) {
    //         foreach ($namaArr as $i => $nama) {
    //             if (!empty($nama) && isset($textArr[$i]) && trim($textArr[$i]) !== '') {
    //                 $catatan[] = [
    //                     'nama'    => $nama,
    //                     'catatan' => $textArr[$i]
    //                 ];
    //             }
    //         }
    //     }

    //     // --- Handle kabkot (multi-select) ---
    //     // $kabkot = $this->request->getPost('id_kabkot'); // bisa berupa array atau string
    //     // if (is_array($kabkot)) {
    //     //     $kabkot = json_encode($kabkot, JSON_UNESCAPED_UNICODE); // ubah ke JSON string
    //     // }

    //     // --- Susun data tambahan ---
    //     $data2 = [
    //         'id_memorandum'       => $id_memorandum,
    //         'catatan_memorandum'  => json_encode($catatan, JSON_UNESCAPED_UNICODE),
    //         'sumber'              => 'RPIW'
    //     ];

    //     // --- Gabungkan semua data ---
    //     $dataToInsert = array_merge($data, $volumeData, $anggaranData, $data2);


    //     // --- Update nilai mp pada renaksi ---
    //     $newmp = (int) $data['mp'] + 1;
    //     $this->renaksiModel->update($data['id_renaksi'], ['mp' => $newmp]);
    //     if ($kabkot) {
    //         foreach ($kabkot as $data) {
    //             $this->kabkotMemoModel->insert(['id_memorandum' => $id_memorandum, 'id_kabkot' => $data]);
    //         }
    //     }
    //     if ($kawasan) {
    //         foreach ($kawasan as $data) {
    //             $this->kawasanMemoModel->insert(['id_memorandum' => $id_memorandum, 'id_kawasan' => $data]);
    //         }
    //     }
    //     // --- Simpan ke tabel memorandum ---
    //     $this->memoModel->insert($dataToInsert);

    //     return $this->response->setJSON(['success' => true]);
    // }

    // public function getKegiatanByProgram($id_program)
    // {
    //     $data = $this->kegiatanModel
    //         ->where('id_program', $id_program)
    //         ->findAll();
    //     return $this->response->setJSON($data);
    // }

    // public function getKroByKegiatan($id_kegiatan)
    // {
    //     $data = $this->kroModel
    //         ->where('id_kegiatan', $id_kegiatan)
    //         ->findAll();
    //     return $this->response->setJSON($data);
    // }

    // public function getRoByKro($id_kro)
    // {
    //     $data = $this->roModel
    //         ->where('id_kro', $id_kro)
    //         ->findAll();
    //     return $this->response->setJSON($data);
    // }

    // public function getSatuanByRo($id_ro)
    // {
    //     $ro = $this->roModel->getVolumeRo($id_ro);

    //     if ($ro) {
    //         return $this->response->setJSON([
    //             'id_satuan'   => $ro->id_satuan,
    //             'nama_satuan' => $ro->nama_satuan
    //         ]);
    //     } else {
    //         return $this->response->setJSON(null);
    //     }
    // }
}
