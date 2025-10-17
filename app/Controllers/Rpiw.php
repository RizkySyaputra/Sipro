<?php

namespace App\Controllers;


use App\Models\Rpiw\ProgramRpiwModel;
use App\Models\Rpiw\KawasanRpiwModel;
use App\Models\Rpiw\RekapProgramModel;
use App\Models\Master\ProvinsiModel;
use App\Models\Master\UnorModel;
use App\Models\Master\PendanaanModel;
use PhpParser\Node\Stmt\Echo_;
use Shapefile\ShapefileException;
use Shapefile\ShapefileReader;
use App\Models\Rpiw\DaftarRenaksiModel;
use App\Models\Rpiw\RenaksiModel;

class Rpiw extends BaseController
{
    protected $programRpiwModel;
    protected $kawasanRpiwModel;
    protected $provinsiModel;
    protected $unorModel;
    protected $pendanaanModel;
    protected $rekapProgram;
    protected $daftarRenaksiModel;
    protected $renaksiModel;
    public function __construct()
    {
        $this->programRpiwModel = new ProgramRpiwModel();
        $this->kawasanRpiwModel = new KawasanrpiwModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->unorModel = new UnorModel();
        $this->pendanaanModel = new PendanaanModel();
        $this->rekapProgram = new RekapProgramModel();
        $this->daftarRenaksiModel = new daftarRenaksiModel();
        $this->renaksiModel = new renaksiModel();
        helper('permission');
    }
    public function index()
    {
        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kawasan_id = $this->request->getPost('kawasan');
        $programs = $this->programRpiwModel->getProgramRpiw($provinsi_id, $unor_id, $kawasan_id);
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
        $this->template->write('title', 'Master Program RPIW');
        $this->template->load('/templates/main', '/pages/rpiw/p_rpiw', $data);
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
        $this->template->load('/templates/main', '/pages/rpiw/detail', $data);
    }

    public function kawasan()
    {
        $data = [
            'p_kawasan' => $this->kawasanRpiwModel->getKawasanRpiw()
        ];

        $this->template->write('title', 'Kawasan Prioritas RPIW');
        $this->template->load('/templates/main', '/pages/rpiw/p_kawasan', $data);
    }

    public function detail_kawasan($id)
    {
        $dataKawasan = new KawasanRpiwModel();

        // Mengambil data berdasarkan ID alfanumerik
        $data = [
            'p_kawasan' => $dataKawasan->getKawasanRpiwDetail($id)
        ];
        $this->template->write('title', 'Detail Kawasan Prioritas');
        $this->template->load('/templates/main', '/pages/rpiw/detail_kawasan', $data);
    }

    public function upload_geojson()
    {
        $file = $this->request->getFile('geojson');
        if ($file->isValid() && !$file->hasMoved()) {
            // Ubah nama file menjadi unik
            $newName = uniqid() . '_' . $file->getName();
            $file->move('geoJson', $newName);
            // dd($file->move('public/geoJson', $newName));
            // // dd($file->move('public/geoJson', $newName));

            // Simpan nama file ke database
            $data = [
                'file_name' => $newName,
            ];
            $this->db->table('peta_kawasan')->insert($data);
            dd($newName);
            return redirect()->back()->with('success', 'File uploaded successfully!');
        } else {
            dd($file);
            return redirect()->back()->with('error', 'File upload failed.');
        }
    }

    public function report()
    {
        //post filter
        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kawasan_id = $this->request->getPost('kawasan');
        $pendanaan_id = $this->request->getPost('pendanaan');
        //
        $rekap_programs = $this->rekapProgram->getRekapProgram($provinsi_id, $unor_id, $kawasan_id, $pendanaan_id);
        $kawasans = $this->kawasanRpiwModel->getKawasanAll();
        $dataKawasan = $this->kawasanRpiwModel->getKawasanRpiw();
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        $dataPendanaan = $this->pendanaanModel->getPendanaan();
        $lastUpdated = $this->rekapProgram->getLastUpdate();
        $lastUpdatedList = $this->rekapProgram->getLastUpdateList();
        $kawasanAll = []; // $programs menjadi array object 
        foreach ($kawasans as $kawasan) {
            $kawasanAll[$kawasan->kode_program][] = $kawasan;
        }
        $data = [
            'rekap_program' => $rekap_programs,
            'kawasans' => $kawasanAll,
            'kawasan' => $dataKawasan,
            'provinsi' => $dataProvinsi,
            'unor' => $dataUnor,
            'pendanaan' => $dataPendanaan,
            'last_updated' => $lastUpdated,
            'list_date' => $lastUpdatedList
        ];
        $this->template->write('title', 'Report Program');
        $this->template->load('/templates/main', 'pages/rpiw/report_rpiw', $data);
    }
    public function rekap()
    {
        $this->rekapProgram->insertRekapProgram();
    }

    //2025
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
        $this->template->load('/templates/main', '/pages/rpiw/daftar_renaksi', $data);
    }

    public function get_daftar_renaksi()
    {
        $id_role = user()->id_role;
        $provinsi_id = $this->request->getPost('provinsi');
        $unor_id = $this->request->getPost('unor');
        $kawasan = $this->request->getPost('sumber');
        $daftarRenaksi = $this->daftarRenaksiModel->getDaftarRenaksi($provinsi_id, $unor_id, $kawasan);
        $data = [
            'daftar_renaksi' => $daftarRenaksi,
            'can_view' => has_permission_menu($id_role, '/rpiw/daftar_renaksi', 'can_view'),
            'can_edit' => has_permission_menu($id_role, '/rpiw/daftar_renaksi', 'can_edit'),
            'can_delete' => has_permission_menu($id_role, '/rpiw/daftar_renaksi', 'can_delete')
        ];
        return view('/pages/rpiw/tabel/tabel_daftar_renaksi', $data);
    }

    // --- VIEW DETAIL ---
    public function view($id)
    {
        $data = $this->daftarRenaksiModel->find($id);
        if (!$data) {
            return $this->response->setStatusCode(404)->setBody('Data tidak ditemukan');
        }
        return view('/pages/rpiw/ModalView', ['data' => $data]);
    }

    public function edit($id)
    {
        $data = $this->daftarRenaksiModel->find($id);
        if (!$data) {
            return $this->response->setStatusCode(404)->setBody('Data tidak ditemukan');
        }
        return view('/pages/rpiw/ModalEdit', ['data' => $data]);
    }


    public function update($id)
    {
        $data = $this->request->getPost();
        $this->renaksiModel->update($id, $data);

        return $this->response->setJSON(['success' => true]);
    }


    // --- DELETE ---
    public function delete($id = null)
    {
        if ($this->request->getMethod(true) !== 'DELETE') {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Metode tidak valid']);
        }

        $memo = $this->renaksiModel->find($id);
        if (!$memo) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }

        $this->renaksiModel->where('id_renaksi', $id)->delete();

        return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    }
}
