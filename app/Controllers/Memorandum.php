<?php

namespace App\Controllers;

use App\Models\Rpiw\ProgramRpiwModel;
use App\Models\Rpiw\KawasanRpiwModel;
use App\Models\Memorandum\ProgramModel;
use App\Models\Master\ProvinsiModel;
use App\Models\Master\UnorModel;
use App\Models\Master\PendanaanModel;
use App\Models\Master\SatuanModel;
use App\Models\Master\MpModel;
use CodeIgniter\Controller;
use PhpParser\Node\Expr\Instanceof_;

use function PHPUnit\Framework\returnCallback;

class Memorandum extends BaseController
{
    protected $programRpiwModel;
    protected $kawasanRpiwModel;
    protected $provinsiModel;
    protected $unorModel;
    protected $pendanaanModel;
    protected $rekapProgram;
    protected $programModel;
    protected $satuanModel;
    protected $mpModel;
    public function __construct()
    {
        $this->programModel = new ProgramModel();
        $this->programRpiwModel = new ProgramRpiwModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->unorModel = new UnorModel();
        $this->pendanaanModel = new PendanaanModel();
        $this->kawasanRpiwModel = new KawasanRpiwModel();
        $this->satuanModel = new SatuanModel();
        $this->mpModel = new MpModel();
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
}
