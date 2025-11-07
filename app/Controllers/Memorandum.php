<?php

namespace App\Controllers;

use App\Models\Rpiw\ProgramRpiwModel;
use App\Models\Rpiw\KawasanRpiwModel;
use App\Models\Memorandum\DaftarMemoModel;
use App\Models\Memorandum\MemoModel;
use App\Models\Master\ProvinsiModel;
use App\Models\Master\UnorModel;
use App\Models\Master\PendanaanModel;
use App\Models\Master\SatuanModel;
use App\Models\Master\MpModel;
use App\Models\Master\StackholderModel;
use App\Models\Master\KabkotModel;
use App\Models\Master\KabkotMemoModel;
use App\Models\Master\KawasanMemoModel;
use App\Models\Master\KawasanModel;
use App\Models\Master\ProgramModel;
use App\Models\Master\KegiatanModel;
use App\Models\Master\KroModel;
use App\Models\Master\RoModel;
use CodeIgniter\Controller;
use PhpParser\Node\Expr\Instanceof_;
use App\Models\Rpiw\DaftarRenaksiModel;
use App\Models\Rpiw\RenaksiModel;
use App\Models\Memorandum\ReportMemoModel;

use function PHPUnit\Framework\returnCallback;

class Memorandum extends BaseController
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
    protected $rekapProgram;
    protected $programModel;
    protected $kegiatanModel;
    protected $kroModel;
    protected $roModel;
    protected $daftarMemoModel;
    protected $memoModel;
    protected $satuanModel;
    protected $mpModel;
    protected $daftarRenaksiModel;
    protected $renaksiModel;
    protected $stakholderModel;
    protected $reportMemoModel;
    public function __construct()

    {
        $this->programModel = new ProgramModel();
        $this->kegiatanModel = new KegiatanModel();
        $this->kroModel = new KroModel();
        $this->roModel = new RoModel();
        $this->daftarMemoModel = new DaftarMemoModel();
        $this->memoModel = new MemoModel();
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
        $this->kawasanModel = new KawasanModel();
        $this->kawasanMemoModel = new KawasanMemoModel();
        $this->reportMemoModel = new ReportMemoModel();

        helper('permission');
    }
    public function index()
    {
        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kawasan_id = $this->request->getPost('kawasan');
        $tahun_anggaran = $this->request->getPost('tahun_anggaran');
        $residu = $this->request->getPost('residu');
        $dataKawasan = $this->kawasanRpiwModel->getKawasan();
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        if (isset($unor_id) || isset($provinsi_id) || isset($kawasan_id)) {
            $programs = $this->programRpiwModel->getProgramRpiw($provinsi_id, $unor_id, $kawasan_id, $tahun_anggaran, $residu);
            $kawasans = $this->kawasanRpiwModel->getKawasanAll();
            $kawasanAll = []; // $programs menjadi array object 
            foreach ($kawasans as $kawasan) {
                $kawasanAll[$kawasan->kode_program][] = $kawasan;
            }
            $data = [
                'p_rpiw' => $programs,
                'kawasans' => $kawasanAll,
                'kawasan' => $dataKawasan,
                'provinsi' => $dataProvinsi,
                'unor' => $dataUnor,
            ];
            $this->template->write('title', 'Memorandum Program');
            $this->template->load('/templates/main', '/pages/memorandum/program', $data);
        } else {
            $data = [
                'kawasan' => $dataKawasan,
                'provinsi' => $dataProvinsi,
                'unor' => $dataUnor,
                'tahun' => $tahun_anggaran
            ];
            $this->template->write('title', 'Memorandum Program');
            // $this->template->add_js('assets/js/memorandum/program.js');
            $this->template->load('/templates/main', '/pages/memorandum/program', $data);
        }
    }
    public function get_program()
    {

        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kawasan_id = $this->request->getPost('kawasan');
        $programs = $this->programModel->getProgramMemo($provinsi_id, $unor_id, $kawasan_id);
        $kawasans = $this->kawasanRpiwModel->getKawasanAll();
        $kawasanAll = []; // $programs menjadi array object 
        foreach ($kawasans as $kawasan) {
            $kawasanAll[$kawasan->kode_program][] = $kawasan;
        }
        $data = [
            'p_memo' => $programs,
            'kawasans' => $kawasanAll,
        ];
        return view('/pages/memorandum/tabel/tabel_memorandum', $data);
    }
    public function filter_data()
    {
        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kawasan_id = $this->request->getPost('kawasan');
        $residu = $this->request->getPost('residu');
        $tahun_anggaran = $this->request->getPost('tahun_anggaran');

        // Lakukan query berdasarkan filter yang diterapkan
        $programs = $this->programRpiwModel->getProgramRpiw($provinsi_id, $unor_id, $kawasan_id, $tahun_anggaran, $residu);
        $kawasans = $this->kawasanRpiwModel->getKawasanAll();
        $kawasanAll = []; // $programs menjadi array object 
        foreach ($kawasans as $kawasan) {
            $kawasanAll[$kawasan->kode_program][] = $kawasan;
        }
        $data = [
            'p_rpiw' => $programs,
            'kawasans' => $kawasanAll,
            'tahun' => $tahun_anggaran
        ];
        // Load view dan kembalikan hanya bagian tabel
        return view('/pages/memorandum/tabel/tabel_program', $data); // Pastikan view hanya memuat tbody
    }

    public function get_kawasan()
    {
        $provinsi_id = $this->request->getPost('provinsi_id');
        $kawasan = $this->kawasanRpiwModel->getKawasanByProvinsi($provinsi_id);
        return $this->response->setJSON($kawasan);
    }

    public function detail($id)
    {
        $dataProgram = $this->programRpiwModel->getProgramRpiwDetail($id);
        $dataKawasan = $this->kawasanRpiwModel->getKawasanById($id);
        $dataSatuan = $this->satuanModel->getSatuan();
        $dataMp = $this->mpModel->getMp();

        // Array untuk menampung data geojson
        $petaKawasan = [];
        $namaKawasan = [];

        foreach ($dataKawasan as $kawasan) {
            if ($kawasan->kode_kawasan != 0) {
                // Cek apakah peta_kawasan ada
                if (!empty($kawasan->peta_kawasan)) {
                    $filePath = FCPATH . 'geoJson/' . $kawasan->peta_kawasan;
                    // Cek jika file peta_kawasan ada
                    if (file_exists($filePath)) {
                        // Masukkan isi file GeoJSON ke dalam array
                        $petaKawasan[] = file_get_contents($filePath);
                        $namaKawasan[] = $kawasan->nama_kawasan;
                    }
                }
            } else {
                // Jika tidak ada kawasan, set petaKawasan ke null
                $petaKawasan = null;
                $namaKawasan = null;
            }
        }

        foreach ($dataProgram as $program) {
            if ($program->tagging_program != "") {
                $jsonProgram = FCPATH . 'geoJson/' . $program->geojtagging_programson;
                $petaProgram = file_get_contents($jsonProgram);
            } else {
                $petaProgram = "";
            }
            $lat = $program->latitude;
            $long = $program->longitude;
        }


        $data = [
            'kawasans' => $dataKawasan,
            'p_rpiw' => $dataProgram,
            'peta_kawasan' => $petaKawasan,
            'namaKawasan' => $namaKawasan,
            'peta_program' => $petaProgram,
            'latitude' => $lat,
            'longitude' => $long,
            'satuan' => $dataSatuan,
            'mp' => $dataMp

        ];
        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Detail Program RPIW');
        $this->template->load('/templates/main', '/pages/memorandum/detail', $data);
    }
    public function insert()
    {
        $provinsi_id = $this->request->getPost('id_provinsi');
        $unor_id = $this->request->getPost('id_unor');
        $program_id = $this->request->getPost('id_program');
        $nama_program = $this->request->getPost('nama_program');
        $lokasi = $this->request->getPost('lokasi');
        $justifikasi = $this->request->getPost('justifikasi');
        $kesiapan_rc = $this->request->getPost('kesiapan_rc');
        $volume = $this->request->getPost('volume');
        $id_satuan = $this->request->getPost('id_satuan');
        $biaya = $this->request->getPost('biaya');
        $id_pendanaan = $this->request->getPost('id_pendanaan');
        $tagging_mp = $this->request->getPost('tagging_mp');
        $tahun_anggaran = $this->request->getPost('tahun_anggaran');
        $prefix_id_program =  '26' . $provinsi_id . $unor_id;
        //proses cek id yang sudah ada
        $id_mprogram_db = $this->programModel->getIdProgramMemo($prefix_id_program);
        $existing_ids = array_map(function ($row) use ($prefix_id_program) {
            return (int)substr($row->id_mprogram, strlen($prefix_id_program));
        }, $id_mprogram_db);
        // Jika ada ID yang sudah ada, cari angka berurutan berikutnya yang unik
        if (!empty($existing_ids)) {
            // Cari angka akhir terbesar dan tambahkan 1
            $max_sequence = max($existing_ids);
            $new_sequence = $max_sequence + 1;
        } else {
            // Jika belum ada ID dengan prefix_id_program ini, mulai dari 1
            $new_sequence = 1;
        }

        // Gabungkan menjadi ID baru
        $new_id_mprogram = $prefix_id_program . $new_sequence;

        $this->programModel->addMemorandumProgram(
            $new_id_mprogram,
            $provinsi_id,
            $unor_id,
            $program_id,
            $nama_program,
            $lokasi,
            $justifikasi,
            $kesiapan_rc,
            $volume,
            $biaya,
            $id_satuan,
            $id_pendanaan,
            $tagging_mp,
            $tahun_anggaran
        );
        return redirect()->to('/daftar_program');
    }

    public function addCatatan()
    {
        $jenis = $this->request->getPost('jenis');
        $id_mprogram = $this->request->getPost('id_mprogram');
        $bpiw = $this->request->getPost('bpiw');
        $unor = $this->request->getPost('unor');
        $kl = $this->request->getPost('kl');
        $nama_program = $this->request->getPost('nama_program');
        $id_satuan = $this->request->getPost('id_satuan');
        $volume = $this->request->getPost('volume');
        $biaya = $this->request->getPost('biaya');
        $kesiapan_rc = $this->request->getPost('rc');
        $desk = $this->request->getPost('desk');
        $id_pendanaan = $this->request->getPost('id_pendanaan');
        $catatan_desk2 = $this->request->getPost('catatan_desk2');
        $desk2 = $this->request->getPost('desk2');
        $desk2 = ($desk2 == "x") ? null : $desk2;

        $this->programModel->add_catatan($id_mprogram, $bpiw, $unor, $catatan_desk2, $nama_program,  $volume, $id_satuan, $biaya, $kesiapan_rc, $desk, $id_pendanaan, $desk2);
        if ($jenis == "desk") {
            return redirect()->to(base_url('desk_program'));
        }
        return redirect()->to(base_url('daftar_program'));
        //return redirect()->back();
    }
    public function listProgram()
    {
        // $unor_id = $this->request->getPost('unor');
        // $provinsi_id = $this->request->getPost('provinsi');
        // $kawasan_id = $this->request->getPost('kawasan');
        // $tahun_anggaran = $this->request->getPost('tahun_anggaran');
        // $programs = $this->programModel->getProgramMemo($provinsi_id, $unor_id, $kawasan_id, $tahun_anggaran);
        // $kawasans = $this->kawasanRpiwModel->getKawasanAll();
        $dataKawasan = $this->kawasanRpiwModel->getKawasan();
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        // $kawasanAll = []; // $programs menjadi array object 
        // foreach ($kawasans as $kawasan) {
        //     $kawasanAll[$kawasan->kode_program][] = $kawasan;
        // }
        $data = [
            'kawasan' => $dataKawasan,
            'provinsi' => $dataProvinsi,
            'unor' => $dataUnor
        ];
        $this->template->write('title', 'List Memorandom Program');
        $this->template->load('/templates/main', '/pages/memorandum/listProgram', $data);
    }

    public function programMemorandumDetail($id_memo)
    {
        $dataMemorandum = $this->programModel->getProgramMemorandumById($id_memo);
        $id_rpiw = $dataMemorandum[0]->id_rpiw;
        $dataKawasan = $this->kawasanRpiwModel->getKawasanById($id_rpiw);
        $dataSatuan = $this->satuanModel->getSatuan();
        // $dataKawasan = $this->kawasanRpiwModel->getKawasanById($id_rpiw);
        // Array untuk menampung data geojson
        $petaKawasan = [];
        $namaKawasan = [];

        foreach ($dataKawasan as $kawasan) {
            if ($kawasan->kode_kawasan != 0) {
                // Cek apakah peta_kawasan ada
                if (!empty($kawasan->peta_kawasan)) {
                    $filePath = FCPATH . 'geoJson/' . $kawasan->peta_kawasan;
                    // Cek jika file peta_kawasan ada
                    if (file_exists($filePath)) {
                        // Masukkan isi file GeoJSON ke dalam array
                        $petaKawasan[] = file_get_contents($filePath);
                        $namaKawasan[] = $kawasan->nama_kawasan;
                    }
                }
            } else {
                // Jika tidak ada kawasan, set petaKawasan ke null
                $petaKawasan = null;
                $namaKawasan = null;
            }
        }

        foreach ($dataMemorandum as $program) {

            if ($program->tagging_program != "") {
                $jsonProgram = FCPATH . 'geoJson/' . $program->geojtagging_programson;
                $petaProgram = file_get_contents($jsonProgram);
            } else {
                $petaProgram = "";
            }
            $lat = $program->latitude;
            $long = $program->longitude;
        }


        $data = [
            'kawasans' => $dataKawasan,
            'p_memo' => $dataMemorandum,
            'peta_kawasan' => $petaKawasan,
            'namaKawasan' => $namaKawasan,
            'peta_program' => $petaProgram,
            'latitude' => $lat,
            'longitude' => $long,
            'satuan' => $dataSatuan

        ];
        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Detail Program RPIW');
        $this->template->load('/templates/main', '/pages/memorandum/detailProgram', $data);
    }

    // Sipro 2025

    public function daftar_memo()
    {

        $dataKawasan = $this->kawasanRpiwModel->getKawasan();
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        $data = [
            'kawasan' => $dataKawasan,
            'provinsi' => $dataProvinsi,
            'unor' => $dataUnor
        ];
        $this->template->write('title', 'Program Jangka Menengah');
        $this->template->load('/templates/main', '/pages/memorandum/daftar_memo', $data);
    }
    //2025
    public function get_daftar_memo()
    {
        $id_role = user()->id_role;
        $provinsi_id = $this->request->getPost('provinsi');
        $unor_id = $this->request->getPost('unor');
        $sumber = $this->request->getPost('sumber');
        $daftarMemo = $this->daftarMemoModel->getDaftarMemo($provinsi_id, $unor_id, $sumber);
        $data = [
            'daftar_memo' => $daftarMemo,
            'can_view' => has_permission_menu($id_role, '/memorandum/daftar_memo', 'can_view'),
            'can_edit' => has_permission_menu($id_role, '/memorandum/daftar_memo', 'can_edit'),
            'can_delete' => has_permission_menu($id_role, '/memorandum/daftar_memo', 'can_delete')
        ];
        return view('/pages/memorandum/tabel/tabel_daftar_memo', $data);
    }

    // --- VIEW DETAIL ---
    public function view($id)
    {
        $memo = $this->daftarMemoModel->find($id);
        $kabkot = $this->kabkotMemoModel->getKabkotMemo($id);

        if (!$memo) {
            return $this->response->setStatusCode(404)->setBody('Data tidak ditemukan');
        }
        return view('/pages/memorandum/ModalView', ['memo' => $memo, 'kabkot' => $kabkot]);
    }

    public function edit($id)
    {

        $t_memo = $this->memoModel->find($id);

        $memo = $this->daftarMemoModel->find($id);
        $selectedKawasan = [];

        if (!empty($memo->kawasan)) {
            $selectedKawasan = array_map('trim', explode(',', $memo->kawasan));
        }
        $selectedKabkot = [];

        if (!empty($memo->kabkot)) {
            $selectedKabkot = array_map('trim', explode(',', $memo->kabkot));
        }
        $stackholder = $this->stakholderModel->orderBy('id_kategori')->orderBy('id_stakeholder')->findAll();
        $namaList = array_column($stackholder, 'short_stakeholder');
        $id_prov = $t_memo->id_provinsi;
        $kabkotmemo = $this->kabkotMemoModel->getKabkotMemo($id);
        $kabkot = $this->kabkotModel->where('id_prov', $id_prov)->findAll();
        $program = $this->programModel->where('id_unor', $memo->id_unor)->findAll();
        $kegiatan = $this->kegiatanModel->where('id_program', $memo->id_program)->findAll();
        $kro = $this->kroModel->findAll();;
        $ro = $this->roModel->findAll();;
        $pendanaan = $this->pendanaanModel->findAll();
        $kawasan = $this->kawasanModel->where('id_provinsi', $id_prov)->findAll();

        if (!$memo) {
            return $this->response->setStatusCode(404)->setBody('Data tidak ditemukan');
        }
        return view('/pages/memorandum/ModalEdit', ['selectedKabkot' => $selectedKabkot, 'selectedKawasan' => $selectedKawasan, 'kawasan' => $kawasan, 'memo' => $memo, 't_memo' => $t_memo, 'namaList' => $namaList, 'kabkot' => $kabkot, 'pendanaan' => $pendanaan, 'program' => $program, 'kegiatan' => $kegiatan, 'kro' => $kro, 'ro' => $ro, 'kabkotmemo' => $kabkotmemo]);
    }


    public function update($id)
    {
        $memoModel = new MemoModel();

        // Ambil input lain
        $kabkot = $this->request->getPost('kabkot');
        $kawasan = $this->request->getPost('kawasan');
        $pekerjaan     = $this->request->getPost('pekerjaan');
        $lokasi        = $this->request->getPost('lokasi');
        $justifikasi   = $this->request->getPost('justifikasi');
        $tahun_mulai   = $this->request->getPost('tahun_mulai');
        $tahun_selesai = $this->request->getPost('tahun_selesai');
        // Ambil volume dan anggaran per tahun
        $tahunMulai   = (int) $this->request->getPost('tahun_mulai');
        $tahunSelesai = (int) $this->request->getPost('tahun_selesai');

        $volumeData = [];
        $anggaranData = [];
        $pendanaanData = [];
        if ($tahunMulai && $tahunSelesai && $tahunSelesai >= $tahunMulai) {
            for ($tahun = $tahunMulai; $tahun <= $tahunSelesai; $tahun++) {
                $index = $tahun - $tahunMulai + 1;

                $volumeKey = 'volume_' . $index;
                $anggaranKey = 'anggaran_' . $index;
                $pendanaanKey = 'id_pendanaan_' . $index;

                $volumeData[$volumeKey] = $this->request->getPost($volumeKey);
                $anggaranData[$anggaranKey] = $this->request->getPost($anggaranKey);
                $pendanaanData[$pendanaanKey] = $this->request->getPost($pendanaanKey);
            }
        }



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
            'pekerjaan'         => $pekerjaan,
            'lokasi'            => $lokasi,
            'justifikasi'       => $justifikasi,
            'tahun_mulai'       => $tahun_mulai,
            'tahun_selesai'     => $tahun_selesai,
            'catatan_memorandum' => json_encode($catatan, JSON_UNESCAPED_UNICODE)
        ];
        $dataToUpdate = array_merge($dataToUpdate, $volumeData, $anggaranData, $pendanaanData);
        // Update data
        $this->kabkotMemoModel->where('id_memorandum', $id)->delete();
        $this->kawasanMemoModel->where('id_memorandum', $id)->delete();
        foreach ($kabkot as $data) {
            $this->kabkotMemoModel->insert(['id_memorandum' => $id, 'id_kabkot' => $data]);
        }
        foreach ($kawasan as $data) {
            $this->kawasanMemoModel->insert(['id_memorandum' => $id, 'id_kawasan' => $data]);
        }
        if ($memoModel->update($id, $dataToUpdate)) {
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

        $memo = $this->memoModel->find($id);
        if (!$memo) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
        $id_renaksi =  $memo->id_renaksi;
        $renaksi = $this->renaksiModel->find($id_renaksi);
        if ($renaksi) {
            $newmp = $renaksi->mp - 1;
            $this->renaksiModel->update($id_renaksi, ['mp' => $newmp]);
        }
        $this->memoModel->where('id_memorandum', $id)->delete();

        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    }

    public function daftar_renaksi()
    {

        $dataKawasan = $this->kawasanRpiwModel->getKawasan();
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        $data = [
            'kawasan' => $dataKawasan,
            'provinsi' => $dataProvinsi,
            'unor' => $dataUnor
        ];
        $this->template->write('title', 'Rencana Aksi');
        $this->template->load('/templates/main', '/pages/memorandum/daftar_renaksi', $data);
    }

    public function get_daftar_renaksi()
    {
        $id_role = user()->id_role;
        $provinsi_id = $this->request->getPost('provinsi');
        $unor_id = $this->request->getPost('unor');
        $kawasan = $this->request->getPost('sumber');
        $status = $this->request->getPost('status');
        $daftarRenaksi = $this->daftarRenaksiModel->getDaftarRenaksi($provinsi_id, $unor_id, $kawasan, $status);
        $data = [
            'daftar_renaksi' => $daftarRenaksi,
            'can_view' => has_permission_menu($id_role, '/memorandum/daftar_renaksi', 'can_view'),
            'can_edit' => has_permission_menu($id_role, '/memorandum/daftar_renaksi', 'can_edit'),
            'can_delete' => has_permission_menu($id_role, '/memorandum/daftar_renaksi', 'can_delete')
        ];
        return view('/pages/memorandum/tabel/tabel_daftar_renaksi', $data);
    }
    public function input_renaksi($id)
    {
        $data = $this->daftarRenaksiModel->find($id);
        $stackholder = $this->stakholderModel->orderBy('id_kategori')->orderBy('id_stakeholder')->findAll();
        $namaList = array_column($stackholder, 'short_stakeholder');
        $id_prov = $data->id_provinsi;
        $kabkot = $this->kabkotModel->where('id_prov', $id_prov)->findAll();
        $kawasan = $this->kawasanModel->where('id_provinsi', $id_prov)->findAll();
        $program = $this->programModel->findAll();
        $kegiatan = $this->kegiatanModel->findAll();;
        $kro = $this->kroModel->findAll();;
        $ro = $this->roModel->findAll();;
        $pendanaan = $this->pendanaanModel->findAll();

        if (!$data) {
            return $this->response->setStatusCode(404)->setBody('Data tidak ditemukan');
        }
        return view('/pages/memorandum/ModalInputRenaksi', ['kawasan' => $kawasan, 'data' => $data,  'namaList' => $namaList, 'kabkot' => $kabkot, 'pendanaan' => $pendanaan, 'program' => $program, 'kegiatan' => $kegiatan, 'kro' => $kro, 'ro' => $ro]);
    }


    public function input_memo_renaksi($id)
    {
        $kabkot = $this->request->getPost('kabkot');
        $kawasan = $this->request->getPost('kawasan');
        $data = $this->request->getPost();
        // --- Pastikan ID Unor dua digit ---
        $id_unor = $data['id_unor'];
        $prefix = 'MP' . '.' . $data['id_provinsi'] . '.' . $id_unor . '.';
        $search = 'MP' . '.' . $data['id_provinsi'] . '.' . $id_unor . '.0';
        // --- Ambil uniq_id terakhir berdasarkan id_provinsi ---
        $row = $this->memoModel
            ->like('id_memorandum', $search)
            ->orderBy('id_memorandum', 'DESC')
            ->first();

        if ($row) {
            // Ambil angka uniq terakhir dan tambah 1
            $last_id = (int) substr($row->id_memorandum, -4);
            $uniq_id = str_pad($last_id + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $uniq_id = '0001';
        }
        // Gabungkan prefix + uniq
        $id_memorandum = $prefix . $uniq_id;

        // --- Handle Volume dan Anggaran per Tahun ---
        $volumeData = [];
        $anggaranData = [];

        $tahunMulai = (int) $this->request->getPost('tahun_mulai');
        $tahunSelesai = (int) $this->request->getPost('tahun_selesai');

        if ($tahunMulai && $tahunSelesai && $tahunSelesai >= $tahunMulai) {
            for ($tahun = $tahunMulai; $tahun <= $tahunSelesai; $tahun++) {
                $index = $tahun - $tahunMulai + 1;
                $volumeKey = 'volume_' . $index;
                $anggaranKey = 'anggaran_' . $index;

                $volumeData[$volumeKey] = $this->request->getPost($volumeKey);
                $anggaranData[$anggaranKey] = $this->request->getPost($anggaranKey);
            }
        }

        // --- Handle Catatan (Array Nama + Catatan) ---
        $namaArr = $this->request->getPost('catatan_nama');
        $textArr = $this->request->getPost('catatan_text');

        $catatan = [];
        if ($namaArr && $textArr) {
            foreach ($namaArr as $i => $nama) {
                if (!empty($nama) && isset($textArr[$i]) && trim($textArr[$i]) !== '') {
                    $catatan[] = [
                        'nama'    => $nama,
                        'catatan' => $textArr[$i]
                    ];
                }
            }
        }

        // --- Handle kabkot (multi-select) ---
        // $kabkot = $this->request->getPost('id_kabkot'); // bisa berupa array atau string
        // if (is_array($kabkot)) {
        //     $kabkot = json_encode($kabkot, JSON_UNESCAPED_UNICODE); // ubah ke JSON string
        // }

        // --- Susun data tambahan ---
        $data2 = [
            'id_memorandum'       => $id_memorandum,
            'catatan_memorandum'  => json_encode($catatan, JSON_UNESCAPED_UNICODE),
            'sumber'              => 'RPIW'
        ];

        // --- Gabungkan semua data ---
        $dataToInsert = array_merge($data, $volumeData, $anggaranData, $data2);


        // --- Update nilai mp pada renaksi ---
        $newmp = (int) $data['mp'] + 1;
        $this->renaksiModel->update($data['id_renaksi'], ['mp' => $newmp]);
        if ($kabkot) {
            foreach ($kabkot as $data) {
                $this->kabkotMemoModel->insert(['id_memorandum' => $id_memorandum, 'id_kabkot' => $data]);
            }
        }
        if ($kawasan) {
            foreach ($kawasan as $data) {
                $this->kawasanMemoModel->insert(['id_memorandum' => $id_memorandum, 'id_kawasan' => $data]);
            }
        }
        // --- Simpan ke tabel memorandum ---
        $this->memoModel->insert($dataToInsert);

        return $this->response->setJSON(['success' => true]);
    }

    public function getKegiatanByProgram($id_program)
    {
        $data = $this->kegiatanModel
            ->where('id_program', $id_program)
            ->findAll();
        return $this->response->setJSON($data);
    }

    public function getKroByKegiatan($id_kegiatan)
    {
        $data = $this->kroModel
            ->where('id_kegiatan', $id_kegiatan)
            ->findAll();
        return $this->response->setJSON($data);
    }

    public function getRoByKro($id_kro)
    {
        $data = $this->roModel
            ->where('id_kro', $id_kro)
            ->findAll();
        return $this->response->setJSON($data);
    }

    public function getSatuanByRo($id_ro)
    {
        $ro = $this->roModel->getVolumeRo($id_ro);

        if ($ro) {
            return $this->response->setJSON([
                'id_satuan'   => $ro->id_satuan,
                'nama_satuan' => $ro->nama_satuan
            ]);
        } else {
            return $this->response->setJSON(null);
        }
    }

    public function laporan1()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();

        $data = [
            'provinsi'             => $dataProvinsi
        ];

        $this->template->write('title', 'Laporan Kawasan Per Provinsi');
        $this->template->load('/templates/main', '/pages/memorandum/report_kawasan_provinsi', $data);
    }

    public function filter_laporan1()
    {

        $tahun_anggaran = $this->request->getPost('tahun_anggaran');


        if (!empty($tahun_anggaran)) {
            $kawasanPerProvinsi = $this->reportMemoModel->getReportKawasanPerProvinsi($tahun_anggaran);

            $data = [
                'kawasan_per_provinsi' => $kawasanPerProvinsi,
            ];
        } else {
            $data = [
                'kawasan_per_provinsi' => []
            ];
        }
        return view('/pages/memorandum/tabel/tabel_report_kawasan_provinsi', $data);
    }

    public function laporan2()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();

        $data = [
            'provinsi'             => $dataProvinsi
        ];

        $this->template->write('title', 'Laporan Kawasan Per Provinsi Per PN');
        $this->template->load('/templates/main', '/pages/memorandum/report_kawasan_provinsi_per_pn', $data);
    }

    public function filter_laporan2()
    {

        $tahun_anggaran = $this->request->getPost('tahun_anggaran');


        if (!empty($tahun_anggaran)) {
            $kawasanPerProvinsiPerPN = $this->reportMemoModel->getReportKawasanPerProvinsiPerPN($tahun_anggaran);

            $data = [
                'kawasan_per_provinsi_per_pn' => $kawasanPerProvinsiPerPN,
            ];
        } else {
            $data = [
                'kawasan_per_provinsi_per_pn' => []
            ];
        }
        return view('/pages/memorandum/tabel/tabel_report_kawasan_provinsi_per_pn', $data);
    }

    public function laporan3()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();

        $data = [
            'provinsi'  => $dataProvinsi
        ];

        $this->template->write('title', 'Laporan Kawasan Per Provinsi Per Unor');
        $this->template->load('/templates/main', '/pages/memorandum/report_kawasan_provinsi_per_unor', $data);
    }

    public function filter_laporan3()
    {

        $tahun_anggaran = $this->request->getPost('tahun_anggaran');


        if (!empty($tahun_anggaran)) {
            $kawasanPerProvinsiPerUnor = $this->reportMemoModel->getReportKawasanPerProvinsiPerUnor($tahun_anggaran);

            $data = [
                'kawasan_per_provinsi_per_unor' => $kawasanPerProvinsiPerUnor,
            ];
        } else {
            $data = [
                'kawasan_per_provinsi_per_unor' => []
            ];
        }
        return view('/pages/memorandum/tabel/tabel_report_kawasan_provinsi_per_unor', $data);
    }
    public function laporan4()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();

        $data = [
            'provinsi'  => $dataProvinsi
        ];

        $this->template->write('title', 'Laporan Anggaran Per Provinsi');
        $this->template->load('/templates/main', '/pages/memorandum/report_anggaran_per_provinsi', $data);
    }

    public function filter_laporan4()
    {

        $tahun_anggaran = $this->request->getPost('tahun_anggaran');
        $unor = $this->request->getPost('unor');
        $pn = $this->request->getPost('pn');


        if (empty($tahun_anggaran) && empty($unor) && empty($pn)) {
            $data = [
                'anggaran_per_provinsi' => []
            ];
        } else {
            $anggaranPerProvinsi = $this->reportMemoModel->getReportAnggaranPerProvinsi($tahun_anggaran, $unor, $pn);

            $data = [
                'anggaran_per_provinsi' => $anggaranPerProvinsi,
            ];
        }
        return view('/pages/memorandum/tabel/tabel_report_anggaran_per_provinsi', $data);
    }

    public function laporan5()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();

        $data = [
            'provinsi'  => $dataProvinsi
        ];

        $this->template->write('title', 'Laporan Infrastruktur PU terhadap PN');
        $this->template->load('/templates/main', '/pages/memorandum/report_infrastruktur_pu_per_pn', $data);
    }

    public function filter_laporan5()
    {

        $tahun_anggaran = $this->request->getPost('tahun_anggaran');


        if (!empty($tahun_anggaran)) {
            $infrastrukturPUPerPN = $this->reportMemoModel->getReportInfrastrukturPUPerPN($tahun_anggaran);

            $data = [
                'infrastruktur_pu_per_pn' => $infrastrukturPUPerPN,
            ];
        } else {
            $data = [
                'infrastruktur_pu_per_pn' => []
            ];
        }
        return view('/pages/memorandum/tabel/tabel_report_infrastruktur_pu_per_pn', $data);
    }
}
