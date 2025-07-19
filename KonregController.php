<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Master\UsulanProvinsiModel;
use App\Models\Master\PnModel;
use App\Models\Master\PpModel;
use App\Models\Master\KpModel;
use App\Models\Master\PropModel;
use App\Models\Master\ProvinsiModel;
use App\Models\Master\UnorModel;
use App\Models\Api\ApiRakortekModel;
use App\Models\Api\ApiUnorModel;
use App\Models\Memorandum\ProgramModel;
use App\Models\Master\PendanaanModel;
use App\Models\Master\SatuanModel;
use App\Models\Rpiw\KawasanRpiwModel;
use App\Models\Konreg\FkwModel;
use App\Models\Konreg\FkbModel;
use App\Models\Konreg\UnorFkwModel;
use App\Models\Konreg\UnorFkbModel;
use App\Models\Master\TematikModel;
use App\Models\Master\KroModel;
use App\Models\Master\RoModel;
use App\Models\Master\KegiatanModel;
use App\Models\Master\PejabatModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KonregController extends BaseController
{
    protected $usulanProvinsiModel;
    protected $PpModel;
    protected $kpModel;
    protected $propModel;
    protected $provinsiModel;
    protected $unorModel;
    protected $pnModel;
    protected $apiRakortek;
    protected $apiUnor;
    protected $programModel;
    protected $pendanaanModel;
    protected $kawasanRpiwModel;
    protected $satuanModel;
    protected $FkwModel;
    protected $FkbModel;
    protected $UnorFkwModel;
    protected $UnorFkbModel;
    protected $TematikModel;
    protected $programMasterModel;
    protected $kroModel;
    protected $roModel;
    protected $kegiatanModel;
    protected $pejabatModel;


    public function __construct()
    {
        $this->usulanProvinsiModel = new UsulanProvinsiModel();
        $this->PpModel = new PpModel();
        $this->kpModel = new KpModel();
        $this->propModel = new PropModel();
        $this->propModel = new PropModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->unorModel = new UnorModel();
        $this->pnModel = new PnModel();
        $this->apiRakortek = new ApiRakortekModel();
        $this->programModel = new ProgramModel();
        $this->pendanaanModel = new PendanaanModel();
        $this->kawasanRpiwModel = new KawasanRpiwModel();
        $this->satuanModel = new SatuanModel();
        $this->FkwModel = new FkwModel();
        $this->FkbModel = new FkbModel();
        $this->UnorFkwModel = new UnorFkwModel();
        $this->UnorFkbModel = new UnorFkbModel();
        $this->TematikModel = new TematikModel();
        $this->kroModel = new KroModel();
        $this->roModel = new RoModel();
        $this->kegiatanModel = new KegiatanModel();
        $this->pejabatModel = new PejabatModel();
    }

    public function dataRakortek()
    {
        $id_provinsi = user()->id_provinsi;
        $dataUnor = $this->unorModel->getUnor();
        $program = $this->apiRakortek->getProgram($id_provinsi);
        $desk = $this->request->getGet('desk');
        if ($id_provinsi !== null) {
            // Username cocok dengan nama provinsi, ID sudah ditemukan
            $provinsi_model = model('App\Models\Master\ProvinsiModel')->where('id', $id_provinsi)->first();
        } else {
            // Username tidak cocok dengan nama provinsi manapun
            $provinsi_model  = model('App\Models\Master\ProvinsiModel')->findAll();
        }
        $data = [
            'provinsi' => $provinsi_model,
            'unor' => $dataUnor,
            'program' => $program,
            'desk' => $desk
        ];
        $this->template->write('title', 'Data Rakortek');
        $this->template->load('/templates/main', '/pages/konreg/rakortek/program_rakortek', $data);
    }
    public function filter_dataRakortek()
    {
        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kesepakatan = $this->request->getPost('kesepakatan');
        $kesepakatan_desk = $this->request->getPost('kesepakatan_desk');
        $desk = $this->request->getGet('desk');
        // Lakukan query berdasarkan filter yang diterapkan
        $program = $this->apiRakortek->getProgram($provinsi_id, $unor_id, $kesepakatan, $kesepakatan_desk);
        $data = [
            'program' => $program,
            'desk' => $desk
        ];
        // Load view dan kembalikan hanya bagian tabel
        return view('/pages/konreg/rakortek/tabel/tabel_programRakortek', $data); // Pastikan view hanya memuat tbody
    }

    public function dataApiUnor()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        $dataPn = $this->pnModel->findAll();
        $data = [
            'pn' => $dataPn,
            'provinsi' => $dataProvinsi,
            'unor' => $dataUnor
        ];
        $this->template->write('title', 'Data Api Unor');
        $this->template->load('/templates/main', '/pages/konreg/dataApiUnor', $data);
    }
    public function filter_dataApiUnor()
    {
        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $pn_id = $this->request->getPost('id_pn');


        // Lakukan query berdasarkan filter yang diterapkan
        $usulan = $this->apiUnor->getData($provinsi_id, $unor_id, $pn_id);
        $data = [
            'usulan' => $usulan,
        ];
        // Load view dan kembalikan hanya bagian tabel
        return view('/pages/konreg/tabel/dataUnor', $data); // Pastikan view hanya memuat tbody
    }
    public function detail_dataUnor($id)
    {
        $dataUsulan = $this->apiUnor->getDataDetail($id);
        $data = [
            'usulan' => $dataUsulan,
        ];
        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Detail Data Unor');
        $this->template->load('/templates/main', '/pages/konreg/detail_data_unor', $data);
    }
    public function detail_dataRakortek($id)
    {
        $programDetail = $this->apiRakortek->getDataDetail($id);
        $data = [
            'program' => $programDetail,
        ];
        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Detail Data Rakortek');
        $this->template->load('/templates/main', '/pages/konreg/rakortek/program_rakortek_detail', $data);
    }

    //pradesk

    public function program()
    {
        $id_provinsi = user()->id_provinsi;
        // $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        $dataPendanaan = $this->pendanaanModel->getPendanaan();
        if ($id_provinsi !== null) {
            // Username cocok dengan nama provinsi, ID sudah ditemukan
            $dataProvinsi = model('App\Models\Master\ProvinsiModel')->where('id', $id_provinsi)->first();
        } else {
            // Username tidak cocok dengan nama provinsi manapun
            $dataProvinsi  = model('App\Models\Master\ProvinsiModel')->getProvinsi();
        }
        // dd($dataProvinsi);
        $data = [
            'provinsi' => $dataProvinsi,
            'unor' => $dataUnor,
            'pendanaan' => $dataPendanaan
        ];
        $this->template->write('title', 'Pradesk Rakorbangwil');
        $this->template->load('/templates/main', '/pages/konreg/pradesk/rakorbangwil_program', $data);
    }

    public function get_program()
    {

        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kawasan_id = $this->request->getPost('kawasan');
        $pradesk   = $this->request->getPost('pradesk');
        $desk = 1;
        $pendanaan_id = 1;
        $sumber = $this->request->getPost('sumber');
        $programs = $this->programModel->getProgramMemo($provinsi_id, $unor_id, $kawasan_id, $desk, $sumber, $pendanaan_id, 1, $pradesk);
        $kawasans = $this->kawasanRpiwModel->getKawasanAll();
        $kawasanAll = []; // $programs menjadi array object 
        foreach ($kawasans as $kawasan) {
            $kawasanAll[$kawasan->kode_program][] = $kawasan;
        }
        $data = [
            'p_memo' => $programs,
            'kawasans' => $kawasanAll,
        ];
        return view('/pages/konreg/pradesk/tabel/tabel_rakorbangwil', $data);
    }


    public function programDeskDetail($id_memo)
    {
        $dataFkw = $this->FkwModel->findAll();
        $dataFkb = $this->FkbModel->findAll();
        $dataSatuan = $this->satuanModel->getSatuan();
        $dataTematik = $this->TematikModel->findAll();
        $fkw_found = false;
        $dataKawasan = "";

        // Cek dulu di FKW
        foreach ($dataFkw as $fkw) {
            if ($fkw['id_sumber'] == $id_memo) {
                $dataKonreg = $this->FkwModel->getProgramFkwById_sumber($id_memo);
                $fkw_found = true;
                $jenis_data = "fkw";
                break; // Langsung berhenti, ga perlu cek FKB
            }
        }

        // Kalau tidak ditemukan di FKW, baru cek di FKB
        if (!$fkw_found) {
            foreach ($dataFkb as $fkb) {
                if ($fkb['id_sumber'] == $id_memo) {

                    $dataKonreg = $this->FkbModel->getProgramFkbById_sumber($id_memo);
                    $fkw_found = true;
                    $jenis_data = "fkb";


                    break;
                }
            }
        }

        // Kalau tidak ditemukan di dua-duanya
        if (!$fkw_found) {
            $jenis_data = "baru";
            $dataKonreg = "";
        }
        $dataProgram = $this->programModel->getProgramMemorandumById($id_memo);
        $id_rpiw = $dataProgram[0]->id_rpiw;
        $dataKawasan = $this->kawasanRpiwModel->getKawasanById($id_rpiw);


        $data = [
            'p_memo' => $dataProgram,
            'konreg' => $dataKonreg,
            'satuan' => $dataSatuan,
            'tematik' => $dataTematik,
            'kawasans' => $dataKawasan,
            'jenis_data' => $jenis_data
        ];

        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Detail Program Rakorbangwil');
        $this->template->load('/templates/main', '/pages/konreg/pradesk/rakorbangwil_detail', $data);
    }

    public function programDeskEdit($id_memo)
    {
        $dataFkw = $this->FkwModel->findAll();
        $dataFkb = $this->FkbModel->findAll();
        $dataSatuan = $this->satuanModel->getSatuan();
        $dataTematik = $this->TematikModel->findAll();
        $kegiatan = $this->kegiatanModel->findALl();
        $kro = $this->kroModel->findALl();
        $ro = $this->roModel->findALl();
        $fkw_found = false;
        $dataKawasan = "";

        // Cek dulu di FKW
        foreach ($dataFkw as $fkw) {
            if ($fkw['id_sumber'] == $id_memo) {
                $dataKonreg = $this->FkwModel->getProgramFkwById_sumber($id_memo);
                $fkw_found = true;
                $jenis_data = "fkw";
                break; // Langsung berhenti, ga perlu cek FKB
            }
        }

        // Kalau tidak ditemukan di FKW, baru cek di FKB
        if (!$fkw_found) {
            foreach ($dataFkb as $fkb) {
                if ($fkb['id_sumber'] == $id_memo) {

                    $dataKonreg = $this->FkbModel->getProgramFkbById_sumber($id_memo);
                    $fkw_found = true;
                    $jenis_data = "fkb";
                    break;
                }
            }
        }

        // Kalau tidak ditemukan di dua-duanya
        if (!$fkw_found) {
            $jenis_data = "baru";
            $dataKonreg = "";
        }
        $dataProgram = $this->programModel->getProgramMemorandumById($id_memo);
        $id_rpiw = $dataProgram[0]->id_rpiw;
        $dataKawasan = $this->kawasanRpiwModel->getKawasanById($id_rpiw);


        $data = [
            'p_memo' => $dataProgram,
            'konreg' => $dataKonreg,
            'satuan' => $dataSatuan,
            'tematik' => $dataTematik,
            'kawasans' => $dataKawasan,
            'jenis_data' => $jenis_data,
            'kegiatan' => $kegiatan,
            'kro' => $kro,
            'ro' => $ro
        ];

        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Detail Program Rakorbangwil');
        $this->template->load('/templates/main', '/pages/konreg/pradesk/rakorbangwil_edit', $data);
    }

    public function inputRakorbangwil()
    {
        $jenis_program   = $this->request->getPost('jenis_program');

        // fields
        $id_sumber          = $this->request->getPost('id_mprogram'); // sesuai kolom id_sumber
        $tahun_diusulkan    = "2025";
        $kd_prog            = $this->request->getPost('kd_prog');
        $kd_kgiat           = $this->request->getPost('kd_kgiat');
        $kd_kro             = $this->request->getPost('kd_kro');
        $kd_ro              = $this->request->getPost('kd_ro');
        $id_provinsi        = $this->request->getPost('id_provinsi');
        $id_unor            = $this->request->getPost('id_unor');
        $pekerjaan          = $this->request->getPost('nama_program');
        $volume             = $this->request->getPost('volume');
        $id_satuan          = $this->request->getPost('id_satuan');
        $id_kawasan         = $this->request->getPost('id_kawasan');
        $id_kabkot          = null;
        $lokasi             = $this->request->getPost('lokasi');
        $anggaran           = $this->request->getPost('anggaran');
        $tahun_pelaksanaan  = "2026";
        $id_pembiayaan      = $this->request->getPost('id_pembiayaan');
        $catatan            = $this->request->getPost('catatan_desk');
        $renc_induk         = $this->request->getPost('renc_induk');
        $dok_renc_induk     = $this->request->getPost('file_ri');
        $fs                 = $this->request->getPost('fs');;
        $dok_fs             = $this->request->getPost('file_fs');;
        $ded                = $this->request->getPost('ded');
        $dok_ded            = $this->request->getPost('file_ded');
        $dokling            = $this->request->getPost('dokling');
        $dok_dokling        = $this->request->getPost('file_dokling');
        $lahan              = $this->request->getPost('lahan');
        $dok_lahan          = $this->request->getPost('file_lahan');
        $pasca_kons         = $this->request->getPost('pasca_kons');
        $dok_pasca_kons     = $this->request->getPost('file_pasca_kontruksi');
        $terima_bantuan     = $this->request->getPost('terima_bantuan');
        $dok_terima_bantuan = $this->request->getPost('file_menerima_bantuan');
        $id_tematik         = $this->request->getPost('id_tematik');
        $geotag             = null;
        $uraian_geotag      = null;
        $sumber             = "Rakorbangwil";
        $catatan_pradesk    = $this->request->getPost('catatan_pradesk');
        $catatan_desk       = null;
        $no_prioritas       = null;
        $kode_kabkot        = null;
        $rpm                = $this->request->getPost('anggaran');
        $phln               = null;
        $sbsn               = null;
        $waktu_pelaksanaan  = "2026";
        $jenis_data         = $this->request->getPost('jenis_data');

        if ($jenis_data == "fkw") {
            $data = [
                'volume'             => $volume,
                'id_satuan'          => $id_satuan,
                'anggaran'           => $anggaran,
                'catatan_pradesk'    => $catatan_pradesk,
                'rpm'                => $rpm,
                'id_sumber'          => $id_sumber,
                'kd_prog'            => $kd_prog,
                'kd_kgiat'           => $kd_kgiat,
                'kd_kro'             => $kd_kro,
                'kd_ro'              => $kd_ro,
                'id_tematik'         => $id_tematik,
            ];
            // Ambil data dari request (POST misalnya)
            // Lakukan update
            $this->FkwModel->where('id_sumber', $id_sumber)->set($data)->update();
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data FKW berhasil diperbarui'
            ]);
        } elseif ($jenis_data == "fkb") {
            $data = [
                'volume'             => $volume,
                'id_satuan'          => $id_satuan,
                'anggaran'           => $anggaran,
                'catatan_pradesk'    => $catatan_pradesk,
                'rpm'                => $rpm,
                'id_sumber'          => $id_sumber,
                'kd_prog'            => $kd_prog,
                'kd_kgiat'           => $kd_kgiat,
                'kd_kro'             => $kd_kro,
                'kd_ro'              => $kd_ro,
                'renc_induk'         => $renc_induk,
                'fs'                 => $fs,
                'ded'                => $ded,
                'dokling'            => $dokling,
                'lahan'              => $lahan,
                'pasca_kons'         => $pasca_kons,
                'terima_bantuan'     => $terima_bantuan,
                'id_tematik'         => $id_tematik,
            ];
            // Ambil data dari request (POST misalnya)
            // Lakukan update

            $this->FkbModel->where('id_sumber', $id_sumber)->set($data)->update();
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data FKW berhasil diperbarui'
            ]);
        }

        if ($jenis_program == "FKW") {
            // Format prefix FKW
            $id_unor = str_pad($id_unor, 2, '0', STR_PAD_LEFT);
            $prefix = 'FKW' . '-' . $id_provinsi . '-' . $id_unor . '-';

            // Ambil uniq_id terakhir berdasarkan id_provinsi
            $row   = $this->FkwModel->like('id_fkw', $prefix)->orderBy('id_fkw', 'DESC')->first();

            if ($row) {
                // Ambil angka uniq terakhir dan tambah 1
                $last_id = (int) substr($row["id_fkw"], -4); // ambil 4 digit terakhir
                $uniq_id = str_pad($last_id + 1, 4, '0', STR_PAD_LEFT);
            } else {
                // Mulai dari 0001
                $uniq_id = '0001';
            }

            // Gabungkan semua
            $id_FKW = $prefix . $uniq_id;

            $data = [
                'id_fkw'                => $id_FKW,
                'id_provinsi'        => $id_provinsi,
                'id_unor'            => $id_unor,
                'pekerjaan'          => $pekerjaan,
                'lokasi'             => $lokasi,
                'uraian_geotag'      => $uraian_geotag,
                'volume'             => $volume,
                'id_satuan'          => $id_satuan,
                'anggaran'           => $anggaran,
                'id_pembiayaan'      => $id_pembiayaan,
                'waktu_pelaksanaan'  => $waktu_pelaksanaan,
                'catatan_pradesk'    => $catatan_pradesk,
                'sumber'             => $sumber,
                'tahun_diusulkan'    => $tahun_diusulkan,
                'kode_kabkot'        => $kode_kabkot,
                'catatan'            => $catatan,
                'rpm'                => $rpm,
                'phln'               => $phln,
                'sbsn'               => $sbsn,
                'id_sumber'          => $id_sumber,
                'kd_prog'            => $kd_prog,
                'kd_kgiat'           => $kd_kgiat,
                'kd_kro'             => $kd_kro,
                'kd_ro'              => $kd_ro,
                'id_tematik'         => $id_tematik,
                'geotag'             => $geotag,
                'FKS'                => 1,
                'catatan_desk'       => $catatan_desk,
                'no_prioritas'       => $no_prioritas,
            ];
            $this->FkwModel->insert($data);
            $this->programModel->update($id_sumber, ['pradesk_konreg' => 1]);
            return redirect()->to(base_url('daftarRakorbangwil'));
        } elseif ($jenis_program == "FKB") {
            $id_unor = str_pad($id_unor, 2, '0', STR_PAD_LEFT);


            // Format prefix FKB
            $prefix = 'FKB' . '-' . $id_provinsi . '-' . $id_unor . '-';

            // Ambil uniq_id terakhir berdasarkan id_provinsi
            $row   = $this->FkbModel->like('id_fkb', $prefix)->orderBy('id_fkb', 'DESC')->first();

            if ($row) {
                // Ambil angka uniq terakhir dan tambah 1
                $last_id = (int) substr($row["id_fkb"], -4); // ambil 4 digit terakhir
                $uniq_id = str_pad($last_id + 1, 4, '0', STR_PAD_LEFT);
            } else {
                // Mulai dari 0001
                $uniq_id = '0001';
            }

            // Gabungkan semua
            $id_fkb = $prefix . $uniq_id;


            $data = [
                'id_fkb'                => $id_fkb,
                'id_sumber'             => $id_sumber,
                'tahun_diusulkan'       => $tahun_diusulkan,
                'kd_prog'               => $kd_prog,
                'kd_kgiat'              => $kd_kgiat,
                'kd_kro'                => $kd_kro,
                'kd_ro'                 => $kd_ro,
                'id_provinsi'           => $id_provinsi,
                'id_unor'               => $id_unor,
                'pekerjaan'             => $pekerjaan,
                'volume'                => $volume,
                'id_satuan'             => $id_satuan,
                'id_kawasan'            => $id_kawasan,
                'id_kabkot'             => $id_kabkot,
                'lokasi'                => $lokasi,
                'anggaran'              => $anggaran,
                'tahun_pelaksanaan'     => $tahun_pelaksanaan,
                'id_pembiayaan'         => $id_pembiayaan,
                'catatan'               => $catatan,
                'renc_induk'            => $renc_induk,
                'dok_renc_induk'        => $dok_renc_induk,
                'fs'                    => $fs,
                'dok_fs'                => $dok_fs,
                'ded'                   => $ded,
                'dok_ded'               => $dok_ded,
                'dokling'               => $dokling,
                'dok_dokling'           => $dok_dokling,
                'lahan'                 => $lahan,
                'dok_lahan'             => $dok_lahan,
                'pasca_kons'            => $pasca_kons,
                'dok_pasca_kons'        => $dok_pasca_kons,
                'terima_bantuan'        => $terima_bantuan,
                'dok_terima_bantuan'    => $dok_terima_bantuan,
                'id_tematik'            => $id_tematik,
                'geotag'                => $geotag,
                'uraian_geotag'         => $uraian_geotag,
                'sumber'                => $sumber,
                'catatan_pradesk'       => $catatan_pradesk,
                'FKS'                   => 1,
                'catatan_desk'          => $catatan_desk,
                'no_prioritas'          => $no_prioritas,
            ];

            $this->FkbModel->insert($data);
            $this->programModel->update($id_sumber, ['pradesk_konreg' => 2]);
            return redirect()->to(base_url('daftarRakorbangwil'));
        } elseif ($jenis_program == "FKB1") {
            $id_unor = str_pad($id_unor, 2, '0', STR_PAD_LEFT);
            // Format prefix FKB
            $prefix = 'FKB' . '-' . $id_provinsi . '-' . $id_unor . '-';

            // Ambil uniq_id terakhir berdasarkan id_provinsi
            $row   = $this->FkbModel->like('id_fkb', $prefix)->orderBy('id_fkb', 'DESC')->first();

            if ($row) {
                // Ambil angka uniq terakhir dan tambah 1
                $last_id = (int) substr($row["id_fkb"], -4); // ambil 4 digit terakhir
                $uniq_id = str_pad($last_id + 1, 4, '0', STR_PAD_LEFT);
            } else {
                // Mulai dari 0001
                $uniq_id = '0001';
            }

            // Gabungkan semua
            $id_fkb = $prefix . $uniq_id;
            $data = [
                'id_fkb'                => $id_fkb,
                'id_sumber'             => $id_sumber,
                'tahun_diusulkan'       => $tahun_diusulkan,
                'kd_prog'               => $kd_prog,
                'kd_kgiat'              => $kd_kgiat,
                'kd_kro'                => $kd_kro,
                'kd_ro'                 => $kd_ro,
                'id_provinsi'           => $id_provinsi,
                'id_unor'               => $id_unor,
                'pekerjaan'             => $pekerjaan,
                'volume'                => $volume,
                'id_satuan'             => $id_satuan,
                'id_kawasan'            => $id_kawasan,
                'id_kabkot'             => $id_kabkot,
                'lokasi'                => $lokasi,
                'anggaran'              => $anggaran,
                'tahun_pelaksanaan'     => $tahun_pelaksanaan,
                'id_pembiayaan'         => $id_pembiayaan,
                'catatan'               => $catatan,
                'renc_induk'            => $renc_induk,
                'dok_renc_induk'        => $dok_renc_induk,
                'fs'                    => $fs,
                'dok_fs'                => $dok_fs,
                'ded'                   => $ded,
                'dok_ded'               => $dok_ded,
                'dokling'               => $dokling,
                'dok_dokling'           => $dok_dokling,
                'lahan'                 => $lahan,
                'dok_lahan'             => $dok_lahan,
                'pasca_kons'            => $pasca_kons,
                'dok_pasca_kons'        => $dok_pasca_kons,
                'terima_bantuan'        => $terima_bantuan,
                'dok_terima_bantuan'    => $dok_terima_bantuan,
                'id_tematik'            => $id_tematik,
                'geotag'                => $geotag,
                'uraian_geotag'         => $uraian_geotag,
                'sumber'                => $sumber,
                'catatan_pradesk'       => $catatan_pradesk,
                'FKS'                   => 0,
                'catatan_desk'          => $catatan_desk,
                'no_prioritas'          => $no_prioritas,
            ];

            $this->FkbModel->insert($data);
            $this->programModel->update($id_sumber, ['pradesk_konreg' => 3]);
            return redirect()->to(base_url('daftarRakorbangwil'));
        } elseif ($jenis_program == "ditangguhkan") {
            $query = $this->programModel->update($id_sumber, ['pradesk_konreg' => 4, 'catatan_pradesk_konreg' => $catatan_pradesk]);
            return redirect()->to(base_url('daftarRakorbangwil'));
        }
    }
    //Unor Api Temp //

    public function unor_program_fkw()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        $dataPendanaan = $this->pendanaanModel->getPendanaan();

        $data = [
            'provinsi' => $dataProvinsi,
            'unor' => $dataUnor,
            'pendanaan' => $dataPendanaan
        ];
        $this->template->write('title', 'Program Unor FKW');
        $this->template->load('/templates/main', '/pages/konreg/unor/program_fkw', $data);
    }

    public function unor_get_program_fkw()
    {

        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kesepakatan = $this->request->getPost('kesepakatan');
        $sumber = $this->request->getPost('sumber');
        $programs = $this->UnorFkwModel->getProgram($provinsi_id, $unor_id, $kesepakatan, $sumber);
        $data = [
            'p_fkw' => $programs
        ];
        return view('/pages/konreg/unor/tabel/tabel_programFkw', $data);
    }

    public function unor_programFkwDetail($id_fkw)
    {
        $programs = $this->UnorFkwModel->getProgramFkwById($id_fkw);
        $data = [
            'p_fkw' => $programs
        ];
        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Detail Program Rakorbangwil');
        $this->template->load('/templates/main', '/pages/konreg/unor/program_fkw_detail', $data);
    }


    public function unor_program_fkb()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        $dataPendanaan = $this->pendanaanModel->getPendanaan();

        $data = [
            'provinsi' => $dataProvinsi,
            'unor' => $dataUnor,
            'pendanaan' => $dataPendanaan
        ];
        $this->template->write('title', 'Program Unor FKB');
        $this->template->load('/templates/main', '/pages/konreg/unor/program_fkb', $data);
    }

    public function unor_get_program_fkb()
    {
        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $sumber = $this->request->getPost('sumber');
        $kesepakatan = $this->request->getPost('kesepakatan');
        $programs = $this->UnorFkbModel->getProgram($provinsi_id, $unor_id, $kesepakatan, $sumber);
        $sumber = $this->request->getPost('sumber');
        $data = [
            'p_fkb' => $programs
        ];
        return view('/pages/konreg/unor/tabel/tabel_programFkb', $data);
    }

    public function unor_programFkbDetail($id_kfb)
    {
        $programs = $this->UnorFkbModel->getProgramFkbById($id_kfb);

        $data = [
            'p_fkb' => $programs
        ];
        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Detail Program Konreg FKB');
        $this->template->load('/templates/main', '/pages/konreg/unor/program_fkb_detail', $data);
    }



    //Program Konreg //



    public function program_fkw()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        $dataPendanaan = $this->pendanaanModel->getPendanaan();
        $desk = $this->request->getGet("desk");
        $data = [
            'provinsi' => $dataProvinsi,
            'unor' => $dataUnor,
            'pendanaan' => $dataPendanaan,
            'desk' => $desk
        ];
        $this->template->write('title', 'Program Konreg FKW');
        $this->template->load('/templates/main', '/pages/konreg/program/program_fkw', $data);
    }

    public function get_program_fkw()
    {

        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kesepakatan = $this->request->getPost('kesepakatan');
        $sumber = $this->request->getPost('sumber');
        $programs = $this->FkwModel->getProgram($provinsi_id, $unor_id, $kesepakatan, $sumber);
        $desk = $this->request->getGet("desk");
        $data = [
            'p_fkw' => $programs,
            'desk' => $desk
        ];


        return view('/pages/konreg/program/tabel/tabel_programFkw', $data);
    }

    public function programFkwDetail($id_fkw)
    {
        $programs = $this->FkwModel->getProgramFkwById($id_fkw);

        $data = [
            'p_fkw' => $programs
        ];

        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Detail Program Rakorbangwil');
        $this->template->load('/templates/main', '/pages/konreg/program/program_fkw_detail', $data);
    }
    public function programFkwEdit($id_fkw)
    {
        $programs = $this->FkwModel->getProgramFkwById($id_fkw);
        $id_program = $programs[0]->kd_prog;
        $id_provinsi = $programs[0]->id_provinsi;
        $kegiatan = $this->kegiatanModel->where('kdprogram', $id_program)->findALl();
        $kro = $this->kroModel->findALl();
        $ro = $this->roModel->findALl();
        $dataSatuan = $this->satuanModel->getSatuan();
        $dataTematik = $this->TematikModel->findAll();


        $data = [
            'p_fkw' => $programs,
            'kegiatan' => $kegiatan,
            'kro' => $kro,
            'ro' => $ro,
            'satuan' => $dataSatuan,
            'tematik' => $dataTematik,
            'kabkot'     => model('App\Models\Master\KabkotModel')->where('provinsi', $id_provinsi)->findAll()
        ];
        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Detail Program Rakorbangwil');
        $this->template->load('/templates/main', '/pages/konreg/program/program_fkw_edit', $data);
    }

    public function prosesEditFkw()
    {
        $id_fkw = $this->request->getPost('id_fkw');
        $nama_pekerjaan = $this->request->getPost('nama_pekerjaan');
        $kd_kgiat = $this->request->getPost('kd_kgiat');
        $kd_kro = $this->request->getPost('kd_kro');
        $kd_ro = $this->request->getPost('kd_ro');
        $lokasi = $this->request->getPost('lokasi');
        $volume = $this->request->getPost('volume');
        $id_kabkot = $this->request->getPost('id_kabkot');
        $id_satuan = $this->request->getPost('id_satuan');
        $rpm = $this->request->getPost('rpm');
        $phln = $this->request->getPost('phln');
        $sbsn = $this->request->getPost('sbsn');
        $anggaran = $this->request->getPost('anggaran');
        $tahun_pengerjaan = $this->request->getPost('tahun_pengerjaan');
        $id_pendanaan = $this->request->getPost('id_pendanaan');
        $catatan_desk = $this->request->getPost('catatan_desk');
        $kesepakatan = $this->request->getPost('kesepakatan');
        $id_tematik = $this->request->getPost('id_tematik');

        // Simpan ke database sesuai kebutuhan kamu
        $data = [
            'pekerjaan' => $nama_pekerjaan,
            'kd_kgiat' => $kd_kgiat,
            'kd_kro' => $kd_kro,
            'kd_ro' => $kd_ro,
            'lokasi' => $lokasi,
            'volume' => $volume,
            'id_satuan' => $id_satuan,
            'rpm' => $rpm,
            'phln' => $phln,
            'sbsn' => $sbsn,
            'anggaran' => $anggaran,
            'waktu_pelaksanaan' => $tahun_pengerjaan,
            'id_pembiayaan' => $id_pendanaan,
            'catatan_desk' => $catatan_desk,
            'FKS' => $kesepakatan,
            'id_tematik' => $id_tematik,
            'kode_kabkot' => $id_kabkot
        ];
        // Misal update database

        if ($this->FkwModel->where('id_fkw', $id_fkw)->set($data)->update()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data FKW berhasil diperbarui'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data FKW gagal diperbarui'
            ]);
        }
    }


    public function program_fkb()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        $dataPendanaan = $this->pendanaanModel->getPendanaan();

        $desk = $this->request->getGet("desk");
        $data = [
            'provinsi' => $dataProvinsi,
            'unor' => $dataUnor,
            'pendanaan' => $dataPendanaan,
            'desk' => $desk
        ];
        $this->template->write('title', 'Program Konreg FKB');
        $this->template->load('/templates/main', '/pages/konreg/program/program_fkb', $data);
    }

    public function get_program_fkb()
    {
        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kesepakatan = $this->request->getPost('kesepakatan');
        $sumber = $this->request->getPost('sumber');
        $programs = $this->FkbModel->getProgram($provinsi_id, $unor_id, $kesepakatan, $sumber);
        $desk = $this->request->getGet("desk");
        $data = [
            'p_fkb' => $programs,
            'desk' => $desk
        ];
        return view('/pages/konreg/program/tabel/tabel_programFkb', $data);
    }

    public function programFkbDetail($id_fkb)
    {
        $programs = $this->FkbModel->getProgramFkbById($id_fkb);

        $data = [
            'p_fkb' => $programs
        ];
        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Detail Program Konreg FKB');
        $this->template->load('/templates/main', '/pages/konreg/program/program_fkb_detail', $data);
    }
    public function programFkbEdit($id_fkb)
    {
        $programs = $this->FkbModel->getProgramFkbById($id_fkb);
        $id_program = $programs[0]->kd_prog;
        $id_provinsi = $programs[0]->id_provinsi;
        $kegiatan = $this->kegiatanModel->where('kdprogram', $id_program)->findALl();
        $kro = $this->kroModel->findALl();
        $ro = $this->roModel->findALl();
        $dataSatuan = $this->satuanModel->getSatuan();
        $dataTematik = $this->TematikModel->findAll();
        $desk = $this->request->getGet('desk');


        $data = [
            'p_fkb' => $programs,
            'kegiatan' => $kegiatan,
            'kro' => $kro,
            'ro' => $ro,
            'satuan' => $dataSatuan,
            'tematik' => $dataTematik,
            'desk' => $desk,
            'kabkot'   => model('App\Models\Master\KabkotModel')->where('provinsi', $id_provinsi)->findAll(),
        ];

        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Detail Program Konreg FKB');
        $this->template->load('/templates/main', '/pages/konreg/program/program_fkb_edit', $data);
    }
    public function prosesEditFkb()
    {
        $desk = $this->request->getGet("desk");
        $id_fkb = $this->request->getPost('id_fkb');
        $nama_pekerjaan = $this->request->getPost('nama_pekerjaan');
        $kd_kgiat = $this->request->getPost('kd_kgiat');
        $kd_kro = $this->request->getPost('kd_kro');
        $kd_ro = $this->request->getPost('kd_ro');
        $lokasi = $this->request->getPost('lokasi');
        $volume = $this->request->getPost('volume');
        $id_kabkot = $this->request->getPost('id_kabkot');
        $id_satuan = $this->request->getPost('id_satuan');
        $anggaran = $this->request->getPost('anggaran');
        $tahun_pengerjaan = $this->request->getPost('tahun_pengerjaan');
        $id_pendanaan = $this->request->getPost('id_pendanaan');
        $catatan_desk = $this->request->getPost('catatan_desk');
        $kesepakatan = $this->request->getPost('kesepakatan');
        $renc_induk = $this->request->getPost('renc_induk');
        $fs = $this->request->getPost('fs');
        $ded = $this->request->getPost('ded');
        $dokling = $this->request->getPost('dokling');
        $lahan = $this->request->getPost('lahan');
        $pasca_kons = $this->request->getPost('pasca_kons');
        $terima_bantuan = $this->request->getPost('terima_bantuan');
        $id_tematik = $this->request->getPost('id_tematik');

        $opsiKesiapan = ['renc_induk', 'fs', 'dokling', 'ded', 'lahan', 'pasca_kons', 'terima_bantuan'];
        // Simpan ke database sesuai kebutuhan kamu
        $data = [
            'pekerjaan' => $nama_pekerjaan,
            'kd_kgiat' => $kd_kgiat,
            'kd_kro' => $kd_kro,
            'kd_ro' => $kd_ro,
            'lokasi' => $lokasi,
            'volume' => $volume,
            'id_satuan' => $id_satuan,
            'anggaran' => $anggaran,
            'tahun_pelaksanaan' => $tahun_pengerjaan,
            'id_pembiayaan' => $id_pendanaan,
            'renc_induk' => $renc_induk,
            'fs' => $fs,
            'ded' => $ded,
            'dokling' => $dokling,
            'lahan' => $lahan,
            'pasca_kons' => $pasca_kons,
            'terima_bantuan' => $terima_bantuan,
            'catatan_desk' => $catatan_desk,
            'FKS' => $kesepakatan,
            'id_tematik' => $id_tematik,
            'id_kabkot' => $id_kabkot
        ];

        foreach ($opsiKesiapan as $field) {
            if ($data[$field] === 'Siap') {
                $file = $this->request->getFile('file_' . $field);
                $existingFile = $this->request->getPost('existing_file_' . $field);
                if ($file->getSize() > 20 * 1024 * 1024) {
                    return redirect()->back()->withInput()->with('error', 'Ukuran file ' . strtoupper($field) . ' terlalu besar. Maksimum 20MB.');
                }

                if ($file && $file->isValid() && !$file->hasMoved()) {
                    // File baru diunggah
                    $newName = $id_fkb . '-' . '-' . $field . '_' . time() . '_' . $file->getRandomName();
                    $file->move(FCPATH . 'uploads/usulan_dokumen/', $newName);
                    $data['dok_' . $field] = $newName;
                }
                // elseif (!empty($existingFile)) {
                //     // Tidak upload baru, tapi file lama masih ada
                //     $data[$field . '_dokumen'] = $existingFile;
                // } else {
                //     // Tidak upload dan tidak ada file lama
                //     return redirect()->back()
                //         ->withInput()
                //         ->with('error', 'File untuk ' . strtoupper($field) . ' belum diunggah.');
                // }
            } else {
                // Jika status bukan "Siap", kosongkan dokumen
                $data['dok_' . $field] = null;
            }
        }
        // Misal update database
        if ($this->FkbModel->where('id_fkb', $id_fkb)->set($data)->update()) {
            if ($desk) {
                return redirect()->to(base_url('/program-konreg/fkb?desk=konreg'))->with('success', 'Program berhasil diubah.');
            } else {
                return redirect()->to(base_url('/program-konreg/fkb'))->with('success', 'Program berhasil diubah.');
            }
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data FKB gagal diperbarui'
            ]);
        }
    }

    public function daftar_pejabat_konreg()
    {
        $data['pejabat'] = $this->pejabatModel->getPejabat();
        $this->template->write('title', 'Daftar Pejabat Konreg');
        $this->template->load('/templates/main', '/pages/konreg/desk/daftar_pejabat', $data);
    }

    public function export_to_excel()
    {

        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kawasan_id = $this->request->getPost('kawasan');
        $pradesk   = $this->request->getPost('pradesk');
        $desk = 1;
        $pendanaan_id = 1;
        $sumber = $this->request->getPost('sumber');
        $programs = $this->programModel->getProgramMemo($provinsi_id, $unor_id, $kawasan_id, $desk, $sumber, $pendanaan_id, 1, $pradesk);
        $kawasans = $this->kawasanRpiwModel->getKawasanAll();
        $kawasanAll = []; // $programs menjadi array object 
        foreach ($kawasans as $kawasan) {
            $kawasanAll[$kawasan->kode_program][] = $kawasan;
        }

        // Buat Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Provinsi');
        $sheet->setCellValue('C1', 'Unor');
        $sheet->setCellValue('D1', 'Nama Program');
        $sheet->setCellValue('E1', 'Kawasan');
        $sheet->setCellValue('F1', 'Lokasi');
        $sheet->setCellValue('G1', 'Justifikasi');
        $sheet->setCellValue('H1', 'Kesiapan RC');
        $sheet->setCellValue('I1', 'Volume');
        $sheet->setCellValue('J1', 'Satuan');
        $sheet->setCellValue('K1', 'Biaya');
        $sheet->setCellValue('L1', 'Sumber Pendanaan');
        $sheet->setCellValue('M1', 'Kategori');
        $sheet->setCellValue('N1', 'Sumber Data');
        $sheet->setCellValue('O1', 'Catatan BPIW');
        $sheet->setCellValue('P1', 'Catatan Unor');
        $sheet->setCellValue('Q1', 'Catatan Desk');
        $sheet->setCellValue('R1', 'Kesepakatan');
        $sheet->setCellValue('S1', 'Pradesk');

        // Isi data ke dalam sheet
        $row = 2; // Baris data dimulai dari baris ke-2
        foreach ($programs as $index => $program) {

            //mengambil kawasan
            if (isset($kawasans[$program->id_rpiw])) {
                $kawasanData = '';
                $rows = count($kawasans[$program->id_rpiw]);
                if ($rows > 1) {
                    $i = 1;
                    $ii = '.';
                } else {
                    $i = '';
                    $ii = '';
                }
                foreach ($kawasans[$program->id_rpiw] as $kawasan) {
                    $kawasanData .= $i++ . $ii . $kawasan->nama_kawasan . ' ';
                }
            } else {
                $kawasanData  = "Non Kawasan";
            }

            //

            if ($program->pradesk_konreg == 0) {
                $pradesk = "Belum Dibahas";
            } elseif ($program->pradesk_konreg == 1) {
                $pradesk = "FKW";
            } elseif ($program->pradesk_konreg == 2) {
                $pradesk = "FKB";
            } elseif ($program->pradesk_konreg == 3) {
                $pradesk = "FKB Dengan Catatan";
            } elseif ($program->pradesk_konreg == 4) {
                $pradesk = "Ditangguhkan";
            }
            //
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $program->provinsi);
            $sheet->setCellValue('C' . $row, $program->unor);
            $sheet->setCellValue('D' . $row, $program->nama_program ?? '-');
            $sheet->setCellValue('E' . $row, $kawasanData ?? '-');
            $sheet->setCellValue('F' . $row, $program->lokasi ?? '-');
            $sheet->setCellValue('G' . $row, $program->justifikasi ?? '-');
            $sheet->setCellValue('H' . $row, $program->kesiapan_rc ?? '-');
            $sheet->setCellValue('I' . $row, $program->volume);
            $sheet->setCellValue('J' . $row, $program->nama_satuan);
            $sheet->setCellValue('K' . $row, $program->biaya ?? '-');
            $sheet->setCellValue('L' . $row, $program->sumber_pendanaan ?? '-');
            $sheet->setCellValue('M' . $row, $program->nama_mp ?? '-');
            $sheet->setCellValue('N' . $row, $program->source_data ?? '-');
            $sheet->setCellValue('O' . $row, $program->catatan_bpiw ?? '-');
            $sheet->setCellValue('P' . $row, $program->catatan_unor ?? '-');
            $sheet->setCellValue('Q' . $row, $program->catatan_desk2 ?? '-');
            $sheet->setCellValue('R' . $row, $program->kesepakatan ?? '-');
            $sheet->setCellValue('S' . $row, $pradesk ?? '-');
            $row++;
        }

        // Simpan file sebagai output langsung
        $writer = new Xlsx($spreadsheet);
        $filename = 'Program_Tahunan' . date('Y-m-d_H-i-s') . '.xlsx';

        // Header untuk download file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Tulis file ke output
        $writer->save('php://output');
        exit;
    }

    public function export_to_excel_rakortek()
    {

        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kesepakatan = $this->request->getPost('kesepakatan');

        // Lakukan query berdasarkan filter yang diterapkan
        $programs = $this->apiRakortek->getProgram($provinsi_id, $unor_id, $kesepakatan);

        // Buat Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID Usulan');
        $sheet->setCellValue('C1', 'Provinsi');
        $sheet->setCellValue('D1', 'Unor');
        $sheet->setCellValue('E1', 'Tematik');
        $sheet->setCellValue('F1', 'PN');
        $sheet->setCellValue('G1', 'PP');
        $sheet->setCellValue('H1', 'KP');
        $sheet->setCellValue('I1', 'Prop');
        $sheet->setCellValue('J1', 'Kementerian');
        $sheet->setCellValue('K1', 'Usulan');
        $sheet->setCellValue('L1', 'Volume Rakortek');
        $sheet->setCellValue('M1', 'Satuan');
        $sheet->setCellValue('N1', 'Alokasi Rakortek');
        $sheet->setCellValue('O1', 'Kesepakatan');
        $sheet->setCellValue('P1', 'Note Rakortek');



        // Isi data ke dalam sheet
        $row = 2; // Baris data dimulai dari baris ke-2
        foreach ($programs as $index => $program) {
            //
            $sheet->setCellValue('A' . $row, $index + 1); // No
            $sheet->setCellValue('B' . $row, $program->id_usulan ?? '-');
            $sheet->setCellValue('C' . $row, $program->provinsi ?? '-');
            $sheet->setCellValue('D' . $row, $program->unor ?? '-');
            $sheet->setCellValue('E' . $row, $program->tematik ?? '-');
            $sheet->setCellValue('F' . $row, $program->nama_pn ?? '-');
            $sheet->setCellValue('G' . $row, $program->nama_pp ?? '-');
            $sheet->setCellValue('H' . $row, $program->nama_kp ?? '-');
            $sheet->setCellValue('I' . $row, $program->nama_prop ?? '-');
            $sheet->setCellValue('J' . $row, $program->kementerian ?? '-');
            $sheet->setCellValue('K' . $row, $program->usulan ?? '-');
            $sheet->setCellValue('L' . $row, $program->volume_rakortek ?? '-');
            $sheet->setCellValue('M' . $row, $program->nama_satuan ?? '-');
            $sheet->setCellValue('N' . $row, $program->alokasi_rakortek ?? '-');
            $approvalText = ($program->approval_rakortek == 4) ? 'Tidak Terbahas' : (($program->approval_rakortek == 1) ? 'Direkomendasikan' : (($program->approval_rakortek == 2) ? 'Tidak Direkomendasikan' : (($program->approval_rakortek == 3) ? 'Direkomendasikan dengan Catatan' : '-')));
            $sheet->setCellValue('O' . $row, $approvalText);
            $sheet->setCellValue('P' . $row, $program->note_rakortek ?? '-');
            $row++;
        }

        // Simpan file sebagai output langsung
        $writer = new Xlsx($spreadsheet);
        $filename = 'Program_Rakortek' . date('Y-m-d_H-i-s') . '.xlsx';

        // Header untuk download file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Tulis file ke output
        $writer->save('php://output');
        exit;
    }
    public function export_to_excel_fkb()
    {

        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kesepakatan = $this->request->getPost('kesepakatan');

        // Lakukan query berdasarkan filter yang diterapkan
        $programs = $this->FkbModel->getProgram($provinsi_id, $unor_id, $kesepakatan);

        // Buat Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID FKB');
        $sheet->setCellValue('C1', 'ID Sumber');
        $sheet->setCellValue('D1', 'Tahun Diusulkan');
        $sheet->setCellValue('E1', 'Kode Program');
        $sheet->setCellValue('F1', 'Kode Kegiatan');
        $sheet->setCellValue('G1', 'Kode KRO');
        $sheet->setCellValue('H1', 'Kode RO');
        $sheet->setCellValue('I1', 'Provinsi');
        $sheet->setCellValue('J1', 'Unor');
        $sheet->setCellValue('K1', 'Pekerjaan');
        $sheet->setCellValue('L1', 'Volume');
        $sheet->setCellValue('M1', 'Satuan');
        $sheet->setCellValue('N1', 'Kawasan');
        $sheet->setCellValue('O1', 'Kab/Kota');
        $sheet->setCellValue('P1', 'Lokasi');
        $sheet->setCellValue('Q1', 'Anggaran');
        $sheet->setCellValue('R1', 'Tahun Pelaksanaan');
        $sheet->setCellValue('S1', 'Pembiayaan');
        $sheet->setCellValue('T1', 'Catatan');
        $sheet->setCellValue('U1', 'Rencana Induk');
        $sheet->setCellValue('V1', 'FS');
        $sheet->setCellValue('W1', 'DED');
        $sheet->setCellValue('X1', 'Dokumen Lingkungan');
        $sheet->setCellValue('Y1', 'Lahan');
        $sheet->setCellValue('Z1', 'Pasca Konstruksi');
        $sheet->setCellValue('AA1', 'Terima Bantuan');
        $sheet->setCellValue('AB1', 'Tematik');
        $sheet->setCellValue('AC1', 'Geotag');
        $sheet->setCellValue('AD1', 'Uraian Geotag');
        $sheet->setCellValue('AE1', 'Sumber');
        $sheet->setCellValue('AF1', 'Catatan Pradesk');
        $sheet->setCellValue('AG1', 'FKS');
        $sheet->setCellValue('AH1', 'Catatan Desk');
        $sheet->setCellValue('AI1', 'No Prioritas');





        // Isi data ke dalam sheet
        $row = 2; // Baris data dimulai dari baris ke-2
        foreach ($programs as $index => $program) {
            //
            $sheet->setCellValue('A' . $row, $index + 1); // No
            $sheet->setCellValue('B' . $row, $program->id_fkb ?? '-');
            $sheet->setCellValue('C' . $row, $program->id_sumber ?? '-');
            $sheet->setCellValue('D' . $row, $program->tahun_diusulkan ?? '-');
            $sheet->setCellValue('E' . $row, $program->nmprogram ?? '-');
            $sheet->setCellValue('F' . $row, $program->nmgiat ?? '-');
            $sheet->setCellValue('G' . $row, $program->nmkro ?? '-');
            $sheet->setCellValue('H' . $row, $program->nmro ?? '-');
            $sheet->setCellValue('I' . $row, $program->provinsi ?? '-');
            $sheet->setCellValue('J' . $row, $program->unor ?? '-');
            $sheet->setCellValue('K' . $row, $program->pekerjaan ?? '-');
            $sheet->setCellValue('L' . $row, $program->volume ?? '-');
            $sheet->setCellValue('M' . $row, $program->nama_satuan ?? '-');
            $sheet->setCellValue('N' . $row, $program->nama_kawasan ?? '-');
            $sheet->setCellValue('O' . $row, $program->id_kabkot ?? '-');
            $sheet->setCellValue('P' . $row, $program->lokasi ?? '-');
            $sheet->setCellValue('Q' . $row, $program->anggaran ?? '-');
            $sheet->setCellValue('R' . $row, $program->tahun_pelaksanaan ?? '-');
            $sheet->setCellValue('S' . $row, $program->sumber_pendanaan ?? '-');
            $sheet->setCellValue('T' . $row, $program->catatan ?? '-');
            $sheet->setCellValue('U' . $row, $program->renc_induk ?? '-');
            $sheet->setCellValue('V' . $row, $program->fs ?? '-');
            $sheet->setCellValue('W' . $row, $program->ded ?? '-');
            $sheet->setCellValue('X' . $row, $program->dokling ?? '-');
            $sheet->setCellValue('Y' . $row, $program->lahan ?? '-');
            $sheet->setCellValue('Z' . $row, $program->pasca_kons ?? '-');
            $sheet->setCellValue('AA' . $row, $program->terima_bantuan ?? '-');
            $sheet->setCellValue('AB' . $row, $program->tematik ?? '-');
            $sheet->setCellValue('AC' . $row, $program->geotag ?? '-');
            $sheet->setCellValue('AD' . $row, $program->uraian_geotag ?? '-');
            $sheet->setCellValue('AE' . $row, $program->sumber ?? '-');
            $sheet->setCellValue('AF' . $row, $program->catatan_pradesk ?? '-');

            // FKS (mapping angka ke teks)
            $approvalText = ($program->FKS == 0) ? 'Non FKS/Belum Terbahas' : (($program->FKS == 1) ? 'FKS' : (($program->FKS == 2) ? 'Ditangguhkan' : '-'));
            $sheet->setCellValue('AG' . $row, $approvalText);

            $sheet->setCellValue('AH' . $row, $program->catatan_desk ?? '-');
            $sheet->setCellValue('AI' . $row, $program->no_prioritas ?? '-');

            $row++;
        }
        // Simpan file sebagai output langsung
        $writer = new Xlsx($spreadsheet);
        $filename = 'Program_Rakortek' . date('Y-m-d_H-i-s') . '.xlsx';

        // Header untuk download file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Tulis file ke output
        $writer->save('php://output');
        exit;
    }

    public function export_to_excel_fkw()
    {

        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kesepakatan = $this->request->getPost('kesepakatan');
        $sumber = $this->request->getPost('sumber');

        // Lakukan query berdasarkan filter yang diterapkan
        $programs = $this->FkwModel->getProgram($provinsi_id, $unor_id, $kesepakatan, $sumber);

        // Buat Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID FKW');
        $sheet->setCellValue('C1', 'ID Sumber');
        $sheet->setCellValue('D1', 'Tahun Diusulkan');
        $sheet->setCellValue('E1', 'Kode Program');
        $sheet->setCellValue('F1', 'Kode Kegiatan');
        $sheet->setCellValue('G1', 'Kode KRO');
        $sheet->setCellValue('H1', 'Kode RO');
        $sheet->setCellValue('I1', 'Provinsi');
        $sheet->setCellValue('J1', 'Unor');
        $sheet->setCellValue('K1', 'Pekerjaan');
        $sheet->setCellValue('L1', 'Volume');
        $sheet->setCellValue('M1', 'Satuan');
        $sheet->setCellValue('N1', 'Kode Kab/Kot');
        $sheet->setCellValue('O1', 'Lokasi');
        $sheet->setCellValue('P1', 'RPM');
        $sheet->setCellValue('Q1', 'PHLN');
        $sheet->setCellValue('R1', 'SBSN');
        $sheet->setCellValue('S1', 'Anggaran');
        $sheet->setCellValue('T1', 'Waktu Pelaksanaan');
        $sheet->setCellValue('U1', 'Pembiayaan');
        $sheet->setCellValue('V1', 'Catatan');
        $sheet->setCellValue('W1', 'Tematik');
        $sheet->setCellValue('X1', 'Geotag');
        $sheet->setCellValue('Y1', 'Uraian Geotag');
        $sheet->setCellValue('Z1', 'Sumber');
        $sheet->setCellValue('AA1', 'Catatan Pradesk');
        $sheet->setCellValue('AB1', 'FKS');
        $sheet->setCellValue('AC1', 'Catatan Desk');
        $sheet->setCellValue('AD1', 'No Prioritas');




        // Isi data ke dalam sheet
        $row = 2; // Baris data dimulai dari baris ke-2
        foreach ($programs as $index => $program) {
            //
            $sheet->setCellValue('A' . $row, $index + 1); // No
            $sheet->setCellValue('B' . $row, $program->id_fkw ?? '-');
            $sheet->setCellValue('C' . $row, $program->id_sumber ?? '-');
            $sheet->setCellValue('D' . $row, $program->tahun_diusulkan ?? '-');
            $sheet->setCellValue('E' . $row, $program->nmprogram ?? '-');
            $sheet->setCellValue('F' . $row, $program->nmgiat ?? '-');
            $sheet->setCellValue('G' . $row, $program->nmkro ?? '-');
            $sheet->setCellValue('H' . $row, $program->nmro ?? '-');
            $sheet->setCellValue('I' . $row, $program->provinsi ?? '-');
            $sheet->setCellValue('J' . $row, $program->unor ?? '-');
            $sheet->setCellValue('K' . $row, $program->pekerjaan ?? '-');
            $sheet->setCellValue('L' . $row, $program->volume ?? '-');
            $sheet->setCellValue('M' . $row, $program->nama_satuan ?? '-');
            $sheet->setCellValue('N' . $row, $program->kabko ?? '-');
            $sheet->setCellValue('O' . $row, $program->lokasi ?? '-');
            $sheet->setCellValue('P' . $row, $program->rpm ?? '-');
            $sheet->setCellValue('Q' . $row, $program->phln ?? '-');
            $sheet->setCellValue('R' . $row, $program->sbsn ?? '-');
            $sheet->setCellValue('S' . $row, $program->anggaran ?? '-');
            $sheet->setCellValue('T' . $row, $program->waktu_pelaksanaan ?? '-');
            $sheet->setCellValue('U' . $row, $program->sumber_pendanaan ?? '-');
            $sheet->setCellValue('V' . $row, $program->catatan ?? '-');
            $sheet->setCellValue('W' . $row, $program->tematik ?? '-');
            $sheet->setCellValue('X' . $row, $program->geotag ?? '-');
            $sheet->setCellValue('Y' . $row, $program->uraian_geotag ?? '-');
            $sheet->setCellValue('Z' . $row, $program->sumber ?? '-');
            $sheet->setCellValue('AA' . $row, $program->catatan_pradesk ?? '-');
            $approvalText = ($program->FKS == 4) ? 'Non FKS/Belum Terbahas' : (($program->FKS == 1) ? 'FKS' : (($program->FKS == 2) ? 'Ditangguhkan' : '-'));
            $sheet->setCellValue('AB' . $row, $approvalText);
            $sheet->setCellValue('AC' . $row, $program->catatan_desk ?? '-');
            $sheet->setCellValue('AD' . $row, $program->no_prioritas ?? '-');

            $row++;
        }

        // Simpan file sebagai output langsung
        $writer = new Xlsx($spreadsheet);
        $filename = 'Program_Rakortek' . date('Y-m-d_H-i-s') . '.xlsx';

        // Header untuk download file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Tulis file ke output
        $writer->save('php://output');
        exit;
    }
    public function get_kegiatan()
    {
        $id_prop = $this->request->getPost('prop');
        $kegiatan = $this->propModel->getKegiatan($id_prop);
        return $this->response->setJSON($kegiatan);
    }

    public function get_kro()
    {

        // $id_prop = $this->request->getPost('prop');
        // $kro = $this->propModel->getkro($id_prop);
        // return $this->response->setJSON($kro);
        //
        $kode_kegiatan = $this->request->getPost('kgiat');
        // $kode_kegiatan = "FC.7687";
        $kd_giat = explode('.', $kode_kegiatan);
        $id = $kd_giat[1];
        $kro = $this->kroModel->where('kdgiat', $id)->findAll();
        return $this->response->setJSON($kro);
    }

    public function get_ro()
    {

        // $id_kro = $this->request->getPost('kro');
        // $id_prop = $this->request->getPost('prop');
        // $ro = $this->propModel->getRo($id_kro, $id_prop);
        // return $this->response->setJSON($ro);
        //
        $kode_kro = $this->request->getPost('kro');
        $kd_kro = explode('.', $kode_kro);
        $id = $kd_kro[2];
        $kgiat = $kd_kro[1];
        $ro = $this->roModel->where('kdkro', $id)->where('kdgiat', $kgiat)->findAll();
        return $this->response->setJSON($ro);
    }


    public function api_to_fkb()
    {
        $tempData = $this->UnorFkbModel->findAll();
        // Ambil data dari tabel temporary

        if (empty($tempData)) {
            return 'Tidak ada data di tabel sementara.';
        }
        $i = 1;
        foreach ($tempData as $row) {
            $id_unor = str_pad($row['id_unor'], 2, '0', STR_PAD_LEFT);
            $prefix = 'FKB' . '-' . $row['id_provinsi'] . '-' . $id_unor . '-';

            // Ambil uniq_id terakhir berdasarkan id_provinsi
            $rows   = $this->FkbModel->like('id_fkb', $prefix)->orderBy('id_fkb', 'DESC')->first();
            if ($rows) {
                // Ambil angka uniq terakhir dan tambah 1
                $last_id = (int) substr($rows["id_fkb"], -4); // ambil 4 digit terakhir
                $uniq_id = str_pad($last_id + 1, 4, '0', STR_PAD_LEFT);
            } else {
                // Mulai dari 0001
                $uniq_id = '0001';
            }

            // Gabungkan semua
            $id_FKB = $prefix . $uniq_id;
            // Tabel tujuan
            $this->FkbModel->insert([
                'id_fkb'              => $id_FKB,
                'id_sumber'           => $row['id_sumber'],
                'sumber'              => $row['sumber'],
                'tahun_diusulkan'     => $row['tahun_diusulkan'],
                'kd_prog'             => $row['kd_prog'],
                'kd_kgiat'            => $row['kd_kgiat'],
                'kd_kro'              => $row['kd_kro'],
                'kd_ro'               => $row['kd_ro'],
                'id_provinsi'         => $row['id_provinsi'],
                'id_unor'             => $row['id_unor'],
                'pekerjaan'           => $row['pekerjaan'],
                'volume'              => $row['volume'],
                'id_satuan'           => $row['id_satuan'],
                'id_kawasan'          => $row['id_kawasan'],
                'id_kabkot'           => $row['id_kabkot'],
                'lokasi'              => $row['lokasi'],
                'anggaran'            => $row['anggaran'],
                'tahun_pelaksanaan'   => $row['tahun_pelaksanaan'],
                'id_pembiayaan'       => $row['id_pembiayaan'],
                'catatan'             => $row['catatan'],
                'renc_induk'          => $row['renc_induk'],
                'dok_renc_induk'      => $row['dok_renc_induk'],
                'fs'                  => $row['fs'],
                'dok_fs'              => $row['dok_fs'],
                'ded'                 => $row['ded'],
                'dok_ded'             => $row['dok_ded'],
                'dokling'             => $row['dokling'],
                'dok_dokling'         => $row['dok_dokling'],
                'lahan'               => $row['lahan'],
                'dok_lahan'           => $row['dok_lahan'],
                'pasca_kons'          => $row['pasca_kons'],
                'dok_pasca_kons'      => $row['dok_pasca_kons'],
                'terima_bantuan'      => $row['terima_bantuan'],
                'dok_terima_bantuan'  => $row['dok_terima_bantuan'],
                'id_tematik'          => $row['id_tematik'],
                'geotag'              => $row['geotag'],
                'uraian_geotag'       => $row['uraian_geotag'],
                'FKS'       => 0
            ]);
            $i++;
        }
        dd($i);
        return 'Data berhasil dipindahkan dari tabel fkb_temp ke fkb_real.';
    }
    public function api_to_fkw()
    {
        // Ambil data dari tabel temporary
        $tempData = $this->UnorFkwModel->findAll();

        // Cek apakah ada data
        if (empty($tempData)) {
            return 'Tidak ada data di tabel sementara.';
        }
        $i = 1;
        foreach ($tempData as $row) {
            $id_unor = str_pad($row['id_unor'], 2, '0', STR_PAD_LEFT);
            $prefix = 'FKW' . '-' . $row['id_provinsi'] . '-' . $id_unor . '-';

            // Ambil uniq_id terakhir berdasarkan id_provinsi
            $rows   = $this->FkwModel->like('id_fkw', $prefix)->orderBy('id_fkw', 'DESC')->first();
            if ($rows) {
                // Ambil angka uniq terakhir dan tambah 1
                $last_id = (int) substr($rows["id_fkw"], -4); // ambil 4 digit terakhir
                $uniq_id = str_pad($last_id + 1, 4, '0', STR_PAD_LEFT);
            } else {
                // Mulai dari 0001
                $uniq_id = '0001';
            }

            // Gabungkan semua
            $id_FKW = $prefix . $uniq_id;
            // Insert ke tabel real
            $this->FkwModel->insert([
                'id_fkw'            => $id_FKW,
                'id_sumber'         => $row['id_sumber'],
                'sumber'            => $row['sumber'],
                'tahun_diusulkan'   => $row['tahun_diusulkan'],
                'kd_prog'           => $row['kd_prog'],
                'kd_kgiat'          => $row['kd_kgiat'],
                'kd_kro'            => $row['kd_kro'],
                'kd_ro'             => $row['kd_ro'],
                'id_provinsi'       => $row['id_provinsi'],
                'id_unor'           => $row['id_unor'],
                'pekerjaan'         => $row['pekerjaan'],
                'volume'            => $row['volume'],
                'id_satuan'         => $row['id_satuan'],
                'kode_kabkot'       => $row['kode_kabkot'],
                'lokasi'            => $row['lokasi'],
                'rpm'               => $row['rpm'],
                'phln'              => $row['phln'],
                'sbsn'              => $row['sbsn'],
                'anggaran'          => $row['anggaran'],
                'waktu_pelaksanaan' => $row['waktu_pelaksanaan'],
                'id_pembiayaan'     => $row['id_pembiayaan'],
                'catatan'           => $row['catatan'],
                'id_tematik'        => $row['id_tematik'],
                'geotag'            => $row['geotag'],
                'uraian_geotag'     => $row['uraian_geotag'],
                'FKS'       => 0
            ]);
            $i++;
        }
        dd($i);
        return 'Data berhasil dipindahkan dari tabel temporary ke real.';
    }

    //rakortek

    public function edit_dataRakortek($id)
    {
        $desk = $this->request->getGet("desk");
        $provinsi_model  = model('App\Models\Master\ProvinsiModel')->findAll();
        // Username tidak cocok dengan nama provinsi manapun
        $unor_model  = model('App\Models\Master\UnorModel')->getUnor();

        $dataRakortek = model('App\Models\Api\ApiRakortekModel')->getDataDetail($id);
        $data = [
            'rakortek' => $dataRakortek,
            'pn'     => model('App\Models\Master\PnModel')->findAll(),
            'pp'     => model('App\Models\Master\PpModel')->findAll(),
            'kp'     => model('App\Models\Master\KpModel')->findAll(),
            'prop'   => model('App\Models\Master\PropModel')->findAll(),
            'satuan' => model('App\Models\Master\SatuanModel')->findAll(),
            'program'     => model('App\Models\Master\ProgramModel')->findAll(),
            'kegiatan'     => model('App\Models\Master\KegiatanModel')->findAll(),
            'kro'     => model('App\Models\Master\KroModel')->findAll(),
            'ro'     => model('App\Models\Master\RoModel')->findAll(),
            'kabkot'     => model('App\Models\Master\KabkotModel')->findAll(),
            'provinsi'   => $provinsi_model,
            'unor'   => $unor_model,
            'desk' => $desk
        ];

        // dd($dataUsulan);
        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Edit Usulan Provinsi');
        $this->template->load('/templates/main', '/pages/konreg/rakortek/edit', $data);
    }
    public function prosesEditRakortek()
    {

        $desk = $this->request->getGet("desk");
        $data = $this->request->getPost();

        // fields
        $id_sumber          = $this->request->getPost('id_usulan'); // sesuai kolom id_sumber
        $tahun_diusulkan    = "2025";
        $kd_kgiat           = $this->request->getPost('kd_kgiat');
        $kd_kro             = $this->request->getPost('kd_kro');
        $kd_ro              = $this->request->getPost('kd_ro');
        $id_provinsi        = $this->request->getPost('id_provinsi');
        $id_unor            = $this->request->getPost('id_unor');
        $kd_prog            = model('App\Models\Master\programModel')->select('kdprogram')->where('id_unor', $id_unor)->first();
        $pekerjaan          = $this->request->getPost('nama_program');
        $volume             = $this->request->getPost('volume');
        $id_satuan          = $this->request->getPost('id_satuan');
        $id_kawasan         = $this->request->getPost('id_kawasan');
        $id_kabkot          = $this->request->getPost('id_kabkot');
        $lokasi             = $this->request->getPost('lokasi');
        $anggaran           = $this->request->getPost('anggaran');
        $tahun_pelaksanaan  = $this->request->getPost('tahun_pengerjaan');
        $id_pembiayaan      = $this->request->getPost('id_pendanaan');
        $catatan_Unor        = $this->request->getPost('catatan_unor');
        $catatan_fup        = $this->request->getPost('catatan_pembahasan');



        // if (empty($data['existing_file_ri']) && empty($data['ri_dokumen'])) {
        //     echo "";
        // } elseif (!empty($data['existing_file_ri']) && empty($data['ri_dokumen'])) {
        //     $data['existing_file_ri'];
        // } elseif (!empty($data['existing_file_ri']) && !empty($data['ri_dokumen'])) {
        //     $data['ri_dokumen'];
        // }
        $dok_renc_induk     = empty($data['existing_file_ri']) && empty($data['ri_dokumen']) ? "" : (!empty($data['existing_file_ri']) && empty($data['ri_dokumen']) ? $data['existing_file_ri'] : $data['ri_dokumen']);
        $fs                 = $this->request->getPost('fs');;
        $dok_fs             = empty($data['existing_file_fs']) && empty($data['fs_dokumen'])
            ? ''
            : (!empty($data['existing_file_fs']) && empty($data['fs_dokumen'])
                ? $data['existing_file_fs']
                : $data['fs_dokumen']);
        $ded                = $this->request->getPost('ded');
        $dok_ded            = empty($data['existing_file_ded']) && empty($data['ded_dokumen'])
            ? ''
            : (!empty($data['existing_file_ded']) && empty($data['ded_dokumen'])
                ? $data['existing_file_ded']
                : $data['ded_dokumen']);

        $dokling            = $this->request->getPost('dokling');
        $dok_dokling        = empty($data['existing_file_dokling']) && empty($data['dokling_dokumen'])
            ? ''
            : (!empty($data['existing_file_dokling']) && empty($data['dokling_dokumen'])
                ? $data['existing_file_dokling']
                : $data['dokling_dokumen']);
        $lahan              = $this->request->getPost('lahan');
        $dok_lahan          = empty($data['existing_file_lahan']) && empty($data['lahan_dokumen'])
            ? ''
            : (!empty($data['existing_file_lahan']) && empty($data['lahan_dokumen'])
                ? $data['existing_file_lahan']
                : $data['lahan_dokumen']);
        $pasca_kons         = $this->request->getPost('pasca_kontruksi');
        $dok_pasca_kons     = empty($data['existing_file_pasca_kontruksi']) && empty($data['pasca_kontruksi_dokumen'])
            ? ''
            : (!empty($data['existing_file_pasca_kontruksi']) && empty($data['pasca_kontruksi_dokumen'])
                ? $data['existing_file_pasca_kontruksi']
                : $data['pasca_kontruksi_dokumen']);

        $terima_bantuan     = $this->request->getPost('menerima_bantuan');
        $dok_terima_bantuan = empty($data['existing_file_menerima_bantuan']) && empty($data['menerima_bantuan_dokumen'])
            ? ''
            : (!empty($data['existing_file_menerima_bantuan']) && empty($data['menerima_bantuan_dokumen'])
                ? $data['existing_file_menerima_bantuan']
                : $data['menerima_bantuan_dokumen']);
        $id_tematik         = $this->request->getPost('id_tematik');
        $geotag             = null;
        $uraian_geotag      = null;
        $sumber             = "Rakortek";
        $catatan_FUP    = $this->request->getPost('catatan_fup');
        $kode_kabkot        = $this->request->getPost('id_kabkot');
        $waktu_pelaksanaan  = "2026";


        if ($desk) {

            if ($data['kesepakatan'] == 1) {
                // Format prefix FKW
                $id_unor = str_pad($id_unor, 2, '0', STR_PAD_LEFT);
                $prefix = 'FKW' . '-' . $id_provinsi . '-' . $id_unor . '-';

                // Ambil uniq_id terakhir berdasarkan id_provinsi
                $row   = $this->FkwModel->like('id_fkw', $prefix)->orderBy('id_fkw', 'DESC')->first();

                if ($row) {
                    // Ambil angka uniq terakhir dan tambah 1
                    $last_id = (int) substr($row["id_fkw"], -4); // ambil 4 digit terakhir
                    $uniq_id = str_pad($last_id + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    // Mulai dari 0001
                    $uniq_id = '0001';
                }

                // Gabungkan semua
                $id_FKW = $prefix . $uniq_id;

                $inputan = [
                    'id_fkw'                => $id_FKW,
                    'id_provinsi'        => $id_provinsi,
                    'id_unor'            => $id_unor,
                    'pekerjaan'          => $pekerjaan,
                    'lokasi'             => $lokasi,
                    'volume'             => $volume,
                    'id_satuan'          => $id_satuan,
                    'anggaran'           => $anggaran,
                    'id_pembiayaan'      => $id_pembiayaan,
                    'waktu_pelaksanaan'  => $tahun_pelaksanaan,
                    'catatan_pradesk'    => $catatan_fup,
                    'sumber'             => $sumber,
                    'tahun_diusulkan'    => $tahun_diusulkan,
                    'kode_kabkot'        => $kode_kabkot,
                    'catatan'            => $catatan_Unor,
                    'id_sumber'          => $id_sumber,
                    'kd_prog'            => $kd_prog,
                    'kd_kgiat'           => $kd_kgiat,
                    'kd_kro'             => $kd_kro,
                    'kd_ro'              => $kd_ro,
                    'id_tematik'         => $id_tematik,
                    'FKS'                => 0,
                ];
                // dd($inputan);
                $this->FkwModel->insert($inputan);
            } elseif ($data['kesepakatan'] == 2) {
                $id_unor = str_pad($id_unor, 2, '0', STR_PAD_LEFT);


                // Format prefix FKB
                $prefix = 'FKB' . '-' . $id_provinsi . '-' . $id_unor . '-';

                // Ambil uniq_id terakhir berdasarkan id_provinsi
                $row   = $this->FkbModel->like('id_fkb', $prefix)->orderBy('id_fkb', 'DESC')->first();

                if ($row) {
                    // Ambil angka uniq terakhir dan tambah 1
                    $last_id = (int) substr($row["id_fkb"], -4); // ambil 4 digit terakhir
                    $uniq_id = str_pad($last_id + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    // Mulai dari 0001
                    $uniq_id = '0001';
                }

                // Gabungkan semua
                $id_fkb = $prefix . $uniq_id;

                $inputan = [
                    'id_fkb'                => $id_fkb,
                    'id_sumber'             => $id_sumber,
                    'tahun_diusulkan'       => $tahun_diusulkan,
                    'kd_prog'               => $kd_prog,
                    'kd_kgiat'              => $kd_kgiat,
                    'kd_kro'                => $kd_kro,
                    'kd_ro'                 => $kd_ro,
                    'id_provinsi'           => $id_provinsi,
                    'id_unor'               => $id_unor,
                    'pekerjaan'             => $pekerjaan,
                    'volume'                => $volume,
                    'id_satuan'             => $id_satuan,
                    'id_kawasan'            => $id_kawasan,
                    'id_kabkot'             => $id_kabkot,
                    'lokasi'                => $lokasi,
                    'anggaran'              => $anggaran,
                    'tahun_pelaksanaan'     => $tahun_pelaksanaan,
                    'id_pembiayaan'         => $id_pembiayaan,
                    'catatan'               => $catatan_Unor,
                    'id_tematik'            => $id_tematik,
                    'geotag'                => $geotag,
                    'uraian_geotag'         => $uraian_geotag,
                    'sumber'                => $sumber,
                    'catatan_pradesk'       => $catatan_fup,
                    'FKS'                   => 0
                ];
                $this->FkbModel->insert($inputan);
            }
            $this->apiRakortek->where('id_usulan', $data['id_usulan'])->set($data)->update();
            return redirect()->to(base_url('/Rakortek?desk=konreg'))->with('success', 'Usulan berhasil diubah.');
        } else {
            $this->apiRakortek->where('id_usulan', $data['id_usulan'])->set($data)->update();
            return redirect()->to(base_url('/Rakortek'))->with('success', 'Usulan berhasil diubah.');
        }
    }
    public function berita_acara()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $pejabat = $this->pejabatModel->getPejabat();
        $unor = $this->unorModel->getUnor();
        $data = [
            'provinsi' => $dataProvinsi,
            'pejabat' => $pejabat,
            'unor' => $unor,
        ];

        $this->template->load('/templates/main', '/pages/konreg/daftar_ba', $data);
    }

    public function generateBA($id_provinsi, $id_unor, $tanggal) //ganti dengan id provinsi
    {

        // Ambil data dari database
        $provinsi = $this->provinsiModel->find($id_provinsi); // Ganti dengan nama tabel Anda
        $unor = $this->unorModel->find($id_unor); // Ganti dengan nama tabel Anda
        // $kawasandesk = $this->programModel->getProgramKawasan($id_provinsi);
        // $catatan_provinsi = $this->catatanModel->getCatatanbyProvinsi($id_provinsi);
        // $pejabat = $this->baModel->getPejabatById($id_provinsi);
        $programsFKW = $this->FkwModel->getProgramFKW($id_provinsi, $id_unor, 1);
        $programsFKB = $this->FkbModel->getProgramFKB($id_provinsi, $id_unor, 1);
        $laporanFKW = $this->FkwModel->getProgramLaporan1($id_provinsi, $id_unor, 1);
        $laporanFKB = $this->FkbModel->getProgramLaporan1($id_provinsi, $id_unor, 1);


        // $kawasans = $this->kawasanRpiwModel->getKawasanAll();
        // $kawasanAll = []; // $programs menjadi array object 
        // foreach ($kawasans as $kawasan) {
        //     $kawasanAll[$kawasan->kode_program][] = $kawasan;
        // }
        // Load view template untuk PDF
        $html = view('BA_Konreg', [
            'provinsi' => $provinsi,
            'unor' => $unor,
            'fkw' => $programsFKW,
            'fkb' => $programsFKB,
            'tanggal' => $tanggal,
            'laporanfkw' => $laporanFKW,
            'laporanfkb' => $laporanFKB
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

        $mpdf->SetHTMLFooter('<div style="text-align: center;">© 2025 - Berita Acara Provinsi ' . ucwords($provinsi["provinsi"]) . ' | Ditjen' .  ucwords($unor["unor"]) . ' | Halaman {PAGENO} dari {nbpg}</div>');
        $mpdf->WriteHTML($html);

        // Output PDF ke browser
        return $this->response->setHeader('Content-Type', 'application/pdf')
            ->setBody($mpdf->Output('berita_acara.pdf', 'I')); // 'I' untuk menampilkan, 'D' untuk mengunduh
    }
}
