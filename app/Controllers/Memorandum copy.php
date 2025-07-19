<?php

namespace App\Controllers;

use App\Models\Rpiw\ProgramRpiwModel;
use App\Models\Rpiw\KawasanRpiwModel;
use App\Models\Memorandum\ProgramModel;
use App\Models\Master\ProvinsiModel;
use App\Models\Master\UnorModel;
use App\Models\Master\PendanaanModel;
use App\Models\Master\SatuanModel;
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
    public function __construct()
    {
        $this->programModel = new ProgramModel();
        $this->programRpiwModel = new ProgramRpiwModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->unorModel = new UnorModel();
        $this->pendanaanModel = new PendanaanModel();
        $this->kawasanRpiwModel = new KawasanRpiwModel();
    }
    public function index()
    {
        $this->template->write('title', 'Memorandum Program');
        $this->template->load('/templates/main', '/pages/memorandum/program');
        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kawasan_id = $this->request->getPost('kawasan');
        $tahun_anggara = $this->request->getPost('tahun_anggaran');
        $programs = $this->programRpiwModel->getProgramRpiw($provinsi_id, $unor_id, $kawasan_id, $tahun_anggara);
        $kawasans = $this->kawasanRpiwModel->getKawasanAll();
        $dataKawasan = $this->kawasanRpiwModel->getKawasan();
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        $kawasanAll = []; // $programs menjadi array object 
        foreach ($kawasans as $kawasan) {
            $kawasanAll[$kawasan->kode_program][] = $kawasan;
        }
        $data = [
            'p_rpiw' => $programs,
            'kawasans' => $kawasanAll,
            'kawasan' => $dataKawasan,
            'provinsi' => $dataProvinsi,
            'unor' => $dataUnor
        ];
        $this->template->write('title', 'Memorandum Program');
        $this->template->load('/templates/main', '/pages/memorandum/program', $data);
    }

    public function detail($id)
    {
        $dataProgram = $this->programRpiwModel->getProgramRpiwDetail($id);
        $dataKawasan = $this->kawasanRpiwModel->getKawasanById($id);
        foreach ($dataKawasan as $kawasan) {
            if ($kawasan->kode_kawasan != 0) {
                $peta = $kawasan->peta_kawasan;
                if (isset($peta)) {
                    $jsonkawasan = FCPATH . 'geoJson/' . $peta;
                    $petaKawasan = file_get_contents($jsonkawasan);
                } else {
                    $petaKawasan = false;
                }
            } else {
                $petaKawasan = null;
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
            'peta_program' => $petaProgram,
            'latitude' => $lat,
            'longitude' => $long

        ];

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
        $this->programModel->addMemorandumProgram(
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

    public function listProgram()
    {
        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kawasan_id = $this->request->getPost('kawasan');
        $tahun_anggaran = $this->request->getPost('tahun_anggaran');
        $programs = $this->programModel->getProgramMemo($provinsi_id, $unor_id, $kawasan_id, $tahun_anggaran);
        $kawasans = $this->kawasanRpiwModel->getKawasanAll();
        $dataKawasan = $this->kawasanRpiwModel->getKawasan();
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        $kawasanAll = []; // $programs menjadi array object 
        foreach ($kawasans as $kawasan) {
            $kawasanAll[$kawasan->kode_program][] = $kawasan;
        }
        $data = [
            'p_memo' => $programs,
            'kawasans' => $kawasanAll,
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
        foreach ($dataKawasan as $kawasan) {
            if ($kawasan->kode_kawasan != 0) {
                $peta = $kawasan->peta_kawasan;
                if (isset($peta)) {
                    $jsonkawasan = FCPATH . 'geoJson/' . $peta;
                    $petaKawasan = file_get_contents($jsonkawasan);
                } else {
                    $petaKawasan = false;
                }
            } else {
                $petaKawasan = null;
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
            'peta_program' => $petaProgram,
            'latitude' => $lat,
            'longitude' => $long

        ];

        $this->template->write('title', 'Detail Program RPIW');
        $this->template->load('/templates/main', '/pages/memorandum/detailProgram', $data);
    }
}
