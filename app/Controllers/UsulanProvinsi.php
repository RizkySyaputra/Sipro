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
use App\Models\Master\ProgramModel;
use App\Models\Master\KroModel;
use App\Models\Master\RoModel;
use App\Models\Master\KegiatanModel;
use App\Models\Master\SatuanModel;
use App\Models\Konreg\KawasanModel;
use App\Models\Konreg\FkwModel;
use App\Models\Konreg\FkbModel;
use CodeIgniter\CLI\Console;
use PHPUnit\TextUI\XmlConfiguration\RemoveCoverageElementProcessUncoveredFilesAttribute;

class UsulanProvinsi extends BaseController
{
    protected $usulanProvinsiModel;
    protected $PpModel;
    protected $kpModel;
    protected $propModel;
    protected $provinsiModel;
    protected $unorModel;
    protected $programModel;
    protected $pnModel;
    protected $kroModel;
    protected $roModel;
    protected $kegiatanModel;
    protected $kawasanRpiwModel;
    protected $satuanModel;
    protected $FkwModel;
    protected $FkbModel;

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
        $this->kroModel = new KroModel();
        $this->roModel = new RoModel();
        $this->programModel = new ProgramModel();
        $this->kegiatanModel = new KegiatanModel();
        $this->kawasanRpiwModel = new KawasanModel();
        $this->satuanModel = new SatuanModel();
        $this->FkwModel = new FkwModel();
        $this->FkbModel = new FkbModel();
    }

    public function index()
    {
        // View form
        $id_provinsi = user()->id_provinsi;
        $id_unor = user()->id_unor;
        $jumlahData = 0;
        if (!empty($id_provinsi)) {
            $jumlahData = $this->usulanProvinsiModel
                ->where('id_provinsi', $id_provinsi)
                ->where('is_active', 1)
                ->countAllResults();
            // Username cocok dengan nama provinsi, ID sudah ditemukan
            $provinsi_model = model('App\Models\Master\ProvinsiModel')->where('id', $id_provinsi)->first();
            $kawasan_model = model('App\Models\Konreg\kawasanModel')->where('id_provinsi', $id_provinsi)->findAll();
        } else {
            // Username tidak cocok dengan nama provinsi manapun
            $provinsi_model  = model('App\Models\Master\ProvinsiModel')->findAll();
            $kawasan_model = model('App\Models\Konreg\kawasanModel')->findAll();
        }
        if (!empty($id_unor)) {
            $new_unor = "0" . $id_unor;
            // Username cocok dengan nama provinsi, ID sudah ditemukan
            $unor_model = model('App\Models\Master\UnorModel')->where('id', $new_unor)->first();
        } else {
            // Username tidak cocok dengan nama provinsi manapun
            $unor_model  = model('App\Models\Master\UnorModel')->getUnor();
        }


        $data = [
            'pn'     => model('App\Models\Master\PnModel')->findAll(),
            'pp'     => model('App\Models\Master\PpModel')->findAll(),
            'kp'     => model('App\Models\Master\KpModel')->findAll(),
            'prop'   => model('App\Models\Master\PropModel')->findAll(),
            'satuan' => model('App\Models\Master\SatuanModel')->findAll(),
            'mp'     => model('App\Models\Master\MpModel')->findAll(),
            'program'     => model('App\Models\Master\ProgramModel')->findAll(),
            'kegiatan'     => model('App\Models\Master\KegiatanModel')->findAll(),
            'kro'     => model('App\Models\Master\KroModel')->findAll(),
            'ro'     => model('App\Models\Master\RoModel')->findAll(),
            'kabkot'     => model('App\Models\Master\KabkotModel')->where('provinsi', $id_provinsi)->findAll(),
            'kawasan'   => $kawasan_model,
            'provinsi'   => $provinsi_model,
            'unor'   => $unor_model,
            'jumlah_data' => $jumlahData

        ];
        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Input Usulan Provinsi');
        $this->template->load('/templates/main', '/pages/konreg/provinsi/inputProvinsi', $data);
    }

    public function input()
    {
        $data = $this->request->getPost();
        // Validasi ID Provinsi
        $id_provinsi = $data['id_provinsi'] ?? null;
        if (!$id_provinsi) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'ID Provinsi tidak valid.');
        }
        $data['user_id'] = user()->id;
        $data['is_active'] = 1;

        // Cek jumlah maksimal data per provinsi
        $jumlahData = $this->usulanProvinsiModel
            ->where('id_provinsi', $id_provinsi)
            ->where('is_active', 1)
            ->countAllResults();

        if ($jumlahData >= 5) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Input gagal: Data usulan untuk provinsi ini sudah mencapai batas maksimal (5).');
        }

        // // Daftar field kesiapan yang berhubungan dengan file
        $opsiKesiapan = ['ri', 'fs', 'dokling', 'ded', 'lahan', 'pasca_kontruksi', 'menerima_bantuan'];

        foreach ($opsiKesiapan as $field) {
            if ($data[$field] === 'Siap') {
                $file = $this->request->getFile('file_' . $field);

                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $newName = $data['id_provinsi'] . '-' . $data['nama_pekerjaan'] . '-' . $field . '_' . time() . '_' . $file->getRandomName();
                    $file->move(FCPATH . 'uploads/usulan_dokumen/', $newName);


                    $data[$field . '_dokumen'] = $newName;
                }
            }
        }
        $kd_program = model('App\Models\Master\ProgramModel')->where('id_unor', $data['id_unor'])->first();
        $data['kd_prog'] = $kd_program['kdprogram'];
        $id_unor = $data['id_unor'];
        //cek id-FUP
        $id_unor = str_pad($id_unor, 2, '0', STR_PAD_LEFT);
        $prefix = 'FUP' . '-' . $id_provinsi . '-' . $id_unor . '-';

        // Ambil uniq_id terakhir berdasarkan id_provinsi
        $row   = $this->usulanProvinsiModel->like('id_usulan', $prefix)->orderBy('id_usulan', 'DESC')->first();

        if ($row) {
            // Ambil angka uniq terakhir dan tambah 1
            $last_id = (int) substr($row["id_usulan"], -4); // ambil 4 digit terakhir
            $uniq_id = str_pad($last_id + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // Mulai dari 0001
            $uniq_id = '0001';
        }

        // Gabungkan semua
        $id_usulan = $prefix . $uniq_id;
        $data["id_usulan"] = $id_usulan;

        // Simpan ke database
        try {

            $this->usulanProvinsiModel->insert($data);
            return redirect()->to('/usulanprovinsi')->with('success', 'Usulan berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }


    //ambil PN berdasarkan id_PN
    public function getPN()
    {
        $id_pn = $this->request->getPost('id_pn');
        $pn = $this->pnModel->where('id_pn', $id_pn)->first();
        return $this->response->setJSON($pn);
    }
    // Ambil PP berdasarkan id_pp
    // public function getPP()
    // {
    //     $id_pp = $this->request->getPost('id_pp');
    //     $pp = $this->PpModel->where('id_pp', $id_pp)->findAll();
    //     return $this->response->setJSON($pp);
    // }
    public function getPP()
    {
        $id_pp = $this->request->getPost('id_pp');

        // Debug log
        log_message('debug', 'Menerima id_pp: ' . $id_pp);

        $data = $this->PpModel->where('id_pp', $id_pp)->first();

        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setJSON([]);
        }
    }

    // Ambil KP berdasarkan PP
    public function getKP()
    {
        $id_kp = $this->request->getPost('id_kp');
        $kp = $this->kpModel->where('id_kp', $id_kp)->first();
        return $this->response->setJSON($kp);
    }

    // Ambil PROP berdasarkan KP
    public function getPROP()
    {
        $id_kp = $this->request->getPost('id_kp');
        $prop = $this->propModel->getbyKP($id_kp);
        return $this->response->setJSON($prop);
    }


    public function listUsulan()
    {
        $id_provinsi = user()->id_provinsi;
        $id_unor = 0 . user()->id_unor;
        $usulan = $this->usulanProvinsiModel->getUsulan($id_provinsi);
        $desk = $this->request->getGet("desk");
        if ($id_provinsi !== null) {
            // Username cocok dengan nama provinsi, ID sudah ditemukan
            $provinsi_model = model('App\Models\Master\ProvinsiModel')->where('id', $id_provinsi)->first();
        } else {
            // Username tidak cocok dengan nama provinsi manapun
            $provinsi_model  = model('App\Models\Master\ProvinsiModel')->findAll();
        }


        if ($id_unor <> 0) {
            // Username cocok dengan nama provinsi, ID sudah ditemukan
            $unor_model = model('App\Models\Master\UnorModel')->where('id', $id_unor)->first();
        } else {
            // Username tidak cocok dengan nama provinsi manapun
            $unor_model  = model('App\Models\Master\UnorModel')->getUnor();
        }

        $dataPn = $this->pnModel->findAll();
        $data = [
            'usulan' => $usulan,
            'pn' => $dataPn,
            'provinsi' => $provinsi_model,
            'unor' => $unor_model,
            'desk' => $desk
        ];
        $this->template->write('title', 'List Usulan Provinsi');
        $this->template->load('/templates/main', '/pages/konreg/provinsi/listUsulan', $data);
    }
    public function filter_data()
    {
        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $pn_id = $this->request->getPost('id_pn');
        $kesepakatan = $this->request->getPost('kesepakatan');
        $desk = $this->request->getGet("desk");
        // Lakukan query berdasarkan filter yang diterapkan
        $usulan = $this->usulanProvinsiModel->getUsulan($provinsi_id, $unor_id, $pn_id, $kesepakatan);
        $data = [
            'usulan' => $usulan,
            'id_provinsi' => $provinsi_id,
            'desk' => $desk
        ];
        // Load view dan kembalikan hanya bagian tabel
        return view('/pages/konreg/provinsi/tabel/tabel_usulan', $data); // Pastikan view hanya memuat tbody
    }
    public function detail($id)
    {
        $dataUsulan = $this->usulanProvinsiModel->getUsulanDetail($id);
        $desk = $this->request->getGet("desk");
        $data = [
            'usulan' => $dataUsulan,
            'desk' => $desk
        ];

        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Detail Usulan Provinsi');
        $this->template->load('/templates/main', '/pages/konreg/provinsi/detail', $data);
    }

    public function edit($id)
    {
        $desk = $this->request->getGet("desk");
        // View form
        $id_provinsi = user()->id_provinsi;
        $id_unor = user()->id_unor;
        if (!empty($id_provinsi)) {
            // Username cocok dengan nama provinsi, ID sudah ditemukan
            $provinsi_model = model('App\Models\Master\ProvinsiModel')->where('id', $id_provinsi)->first();
            $kawasan_model = model('App\Models\Konreg\kawasanModel')->where('id_provinsi', $id_provinsi)->findAll();
        } else {
            // Username tidak cocok dengan nama provinsi manapun
            $provinsi_model  = model('App\Models\Master\ProvinsiModel')->findAll();
            $kawasan_model = model('App\Models\Konreg\kawasanModel')->findAll();
        }
        if (!empty($id_unor)) {
            $new_unor = "0" . $id_unor;
            // Username cocok dengan nama provinsi, ID sudah ditemukan
            $unor_model = model('App\Models\Master\UnorModel')->where('id', $new_unor)->first();
        } else {
            // Username tidak cocok dengan nama provinsi manapun
            $unor_model  = model('App\Models\Master\UnorModel')->getUnor();
        }

        $dataUsulan = $this->usulanProvinsiModel->getUsulanDetail($id);

        $data = [
            'usulan' => $dataUsulan,
            'pn'     => model('App\Models\Master\PnModel')->findAll(),
            'pp'     => model('App\Models\Master\PpModel')->findAll(),
            'kp'     => model('App\Models\Master\KpModel')->findAll(),
            'prop'   => model('App\Models\Master\PropModel')->findAll(),
            'satuan' => model('App\Models\Master\SatuanModel')->findAll(),
            'mp'     => model('App\Models\Master\MpModel')->findAll(),
            'program'     => model('App\Models\Master\ProgramModel')->findAll(),
            'kegiatan'     => model('App\Models\Master\KegiatanModel')->findAll(),
            'kro'     => model('App\Models\Master\KroModel')->findAll(),
            'ro'     => model('App\Models\Master\RoModel')->findAll(),
            'kabkot'     => model('App\Models\Master\KabkotModel')->where('provinsi', $id_provinsi)->findAll(),
            'kawasan'   => $kawasan_model,
            'provinsi'   => $provinsi_model,
            'unor'   => $unor_model,
            'desk' => $desk
        ];

        // dd($dataUsulan);
        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Edit Usulan Provinsi');
        $this->template->load('/templates/main', '/pages/konreg/provinsi/edit', $data);
    }

    public function prosesEdit()
    {

        $desk = $this->request->getGet("desk");
        $data = $this->request->getPost();

        $opsiKesiapan = ['ri', 'fs', 'dokling', 'ded', 'lahan', 'pasca_kontruksi', 'menerima_bantuan'];

        foreach ($opsiKesiapan as $field) {
            if ($data[$field] === 'Siap') {
                $file = $this->request->getFile('file_' . $field);
                $existingFile = $this->request->getPost('existing_file_' . $field);
                if ($file->getSize() > 20 * 1024 * 1024) {
                    return redirect()->back()->withInput()->with('error', 'Ukuran file ' . strtoupper($field) . ' terlalu besar. Maksimum 20MB.');
                }

                if ($file && $file->isValid() && !$file->hasMoved()) {
                    // File baru diunggah
                    $newName = $data['id_provinsi'] . '-' . $data['id_usulan'] . '-' . $field . '_' . time() . '_' . $file->getRandomName();
                    $file->move(FCPATH . 'uploads/usulan_dokumen/', $newName);
                    $data[$field . '_dokumen'] = $newName;
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
                $data[$field . '_dokumen'] = null;
            }
        }
        // fields
        $id_sumber          = $this->request->getPost('id_usulan'); // sesuai kolom id_sumber
        $tahun_diusulkan    = "2025";
        $kd_prog            = $this->request->getPost('kd_prog');
        $kd_kgiat           = $this->request->getPost('kd_kgiat');
        $kd_kro             = $this->request->getPost('kd_kro');
        $kd_ro              = $this->request->getPost('kd_ro');
        $id_provinsi        = $this->request->getPost('id_provinsi');
        $id_unor            = $this->request->getPost('id_unor');
        $pekerjaan          = $this->request->getPost('nama_pekerjaan');
        $volume             = $this->request->getPost('volume');
        $id_satuan          = $this->request->getPost('id_satuan');
        $id_kawasan         = $this->request->getPost('id_kawasan');
        $id_kabkot          = $this->request->getPost('id_kabkot');
        $lokasi             = $this->request->getPost('lokasi');
        $anggaran           = $this->request->getPost('anggaran');
        $tahun_pelaksanaan  = $this->request->getPost('tahun_pengerjaan');
        $id_pembiayaan      = $this->request->getPost('id_pembiayaan');
        $catatan_Unor        = $this->request->getPost('catatan_unor');
        $renc_induk         = $this->request->getPost('ri');

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
        $sumber             = "Usulan Provinsi";
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
                    'catatan_pradesk'    => $catatan_FUP,
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
                    'catatan_pradesk'       => $catatan_FUP,
                    'FKS'                   => 0
                ];
                $this->FkbModel->insert($inputan);
            }
            $this->usulanProvinsiModel->where('id_usulan', $data['id_usulan'])->set($data)->update();
            return redirect()->to(base_url('/listUsulan?desk=konreg'))->with('success', 'Usulan berhasil diubah.');
        } else {
            $this->usulanProvinsiModel->where('id_usulan', $data['id_usulan'])->set($data)->update();
            return redirect()->to(base_url('/listUsulan'))->with('success', 'Usulan berhasil diubah.');
        }
    }

    public function delete($id)
    {
        try {
            $this->usulanProvinsiModel->where('id_usulan', $id)->set('is_active', 0)->update();

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Usulan berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    // pra desk

    public function daftarProvinsi()
    {
        $provinsiUsername = user()->username;
        $data_provinsi = model('App\Models\Master\ProvinsiModel')->findAll();
        $id_provinsi = null;
        foreach ($data_provinsi as $provinsi) {
            if ($provinsi['provinsi'] == $provinsiUsername) {
                $id_provinsi = $provinsi['id']; // atau sesuaikan nama kolom ID
                break;
            }
        }
        if ($id_provinsi !== null) {
            // Username cocok dengan nama provinsi, ID sudah ditemukan
            $provinsi_model = model('App\Models\Master\ProvinsiModel')->where('id', $id_provinsi)->first();
        } else {
            // Username tidak cocok dengan nama provinsi manapun
            $provinsi_model  = model('App\Models\Master\ProvinsiModel')->findAll();
        }
        $dataUnor = $this->unorModel->getUnor();
        $dataPn = $this->pnModel->findAll();
        $data = [
            'pn' => $dataPn,
            'provinsi' => $provinsi_model,
            'unor' => $dataUnor
        ];
        $this->template->write('title', 'List Usulan Provinsi');
        $this->template->load('/templates/main', '/pages/konreg/pradesk/listUsulanProvinsi', $data);
    }
    public function filter_data_provinsi()
    {
        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $pn_id = $this->request->getPost('id_pn');

        // Lakukan query berdasarkan filter yang diterapkan
        $usulan = $this->usulanProvinsiModel->getUsulan($provinsi_id, $unor_id, $pn_id);
        $data = [
            'usulan' => $usulan,
            'id_provinsi' => $provinsi_id
        ];
        // Load view dan kembalikan hanya bagian tabel
        return view('/pages/konreg/pradesk/tabel/tabel_usulan_provinsi', $data); // Pastikan view hanya memuat tbody
    }
    public function addCatatan()
    {
        $id_usulan = $this->request->getPost('id');
        $catatan = $this->request->getPost('catatan_unor');
        $model  = new ('App\Models\Master\UsulanProvinsiModel');
        $success = $model->updateCatatanUnor($id_usulan, $catatan);
        if ($success) {
            session()->setFlashdata('success', 'Catatan berhasil disimpan.');
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan catatan.');
        }

        return redirect()->back();
    }
    public function get_kawasan()
    {

        $provinsi_id = $this->request->getPost('provinsi_id');
        $kawasan = $this->kawasanRpiwModel->where('id_provinsi', $provinsi_id)->findAll();
        return $this->response->setJSON($kawasan);
    }

    public function get_kegiatan()
    {
        $id_prop = $this->request->getPost('prop');
        $kegiatan = $this->propModel->getKegiatan($id_prop);
        return $this->response->setJSON($kegiatan);
    }

    public function get_kro()
    {

        $id_prop = $this->request->getPost('prop');
        $kro = $this->propModel->getkro($id_prop);
        return $this->response->setJSON($kro);
        //
        //     $kode_kegiatan = $this->request->getPost('kd_kgiat');
        //     $kd_giat = explode('.', $kode_kegiatan);
        //     $id = $kd_giat[1];
        //     $kro = $this->kroModel->where('kdgiat', $id)->findAll();
        //     return $this->response->setJSON($kro);
    }

    public function get_ro()
    {

        $id_kro = $this->request->getPost('kro');
        $id_prop = $this->request->getPost('prop');
        $ro = $this->propModel->getRo($id_kro, $id_prop);
        return $this->response->setJSON($ro);
        //
        // $kode_kro = $this->request->getPost('kd_kro');
        // $kd_kro = explode('.', $kode_kro);
        // $id = $kd_kro[2];
        // $ro = $this->roModel->where('kdkro', $id)->findAll();
        // return $this->response->setJSON($ro);
    }

    public function get_satuan()
    {
        $kode_ro = $this->request->getPost('kd_ro');

        $ro = $this->roModel->where('kdro', $kode_ro)->first();
        $id_satuan = $ro['kdsatuan'];
        $satuan = $this->satuanModel->where('id_satuan', $id_satuan)->findAll();
        // dd($satuan);
        return $this->response->setJSON($satuan);
    }
    public function get_program()
    {
        $id_prop = $this->request->getPost('prop');
        $program = $this->propModel->getProgram($id_prop);
        return $this->response->setJSON($program);
    }
    // public function get_prop()
    // {
    //     $id_kp = $this->request->getPost('id_kp');
    //     $prop = $this->propModel->distinct()->where('id_kp', $id_kp)->findAll();
    //     // dd($prop);
    //     return $this->response->setJSON($prop);
    // }
}
