<?php

namespace App\Controllers;

use App\Models\Rpiw\ProgramRpiwModel;
use App\Models\Rpiw\KawasanRpiwModel;
use App\Models\Memorandum\ProgramModel;
use App\Models\Master\ProvinsiModel;
use App\Models\Master\UnorModel;
use App\Models\Master\PendanaanModel;
use App\Models\Master\SatuanModel;
use App\Models\Master\PejabatModel;
use App\Models\Master\TtdModel;
use App\Models\Desk\CatatanKawasanModel;
use App\Models\Desk\BaModel;
use App\Models\Master\MpModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Dompdf\Dompdf;
use Dompdf\Options;
use \Mpdf\Mpdf;

class DeskController extends BaseController
{
    protected $provinsiModel;
    protected $programRpiwModel;
    protected $kawasanRpiwModel;
    protected $unorModel;
    protected $pendanaanModel;
    protected $rekapProgram;
    protected $programModel;
    protected $satuanModel;
    protected $catatanModel;
    protected $pejabatModel;
    protected $ttdModel;
    protected $baModel;


    public function __construct()
    {
        $this->programModel = new ProgramModel();
        $this->programRpiwModel = new ProgramRpiwModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->unorModel = new UnorModel();
        $this->pendanaanModel = new PendanaanModel();
        $this->kawasanRpiwModel = new KawasanRpiwModel();
        $this->satuanModel = new SatuanModel();
        $this->catatanModel = new CatatanKawasanModel();
        $this->pejabatModel = new PejabatModel();
        $this->ttdModel = new TtdModel();
        $this->baModel = new BaModel();
    }
    public function kawasan()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $data = [
            'provinsi' => $dataProvinsi,
        ];

        $this->template->load('/templates/main', '/pages/desk/kawasan', $data);
    }

    public function getCatatanKawasan()
    {
        $id_provinsi = $this->request->getPost('provinsi_id');
        $catatan_provinsi = $this->catatanModel->getCatatanbyProvinsi($id_provinsi);

        return $this->response->setJSON(['catatan' => $catatan_provinsi]);
    }
    public function get_kawasan_program()
    {
        $id_provinsi = $this->request->getPost('provinsi_id');
        $kawasan_program = $this->programModel->getProgramKawasan($id_provinsi);
        $data = [
            'kawasan_p' => $kawasan_program
        ];
        return view('/pages/desk/tabel/tabel_kawasan', $data);
    }

    public function program()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        $dataPendanaan = $this->pendanaanModel->getPendanaan();

        $data = [
            'provinsi' => $dataProvinsi,
            'unor' => $dataUnor,
            'pendanaan' => $dataPendanaan
        ];
        $this->template->write('title', 'List Desk Program');
        $this->template->load('/templates/main', '/pages/desk/desk_program', $data);
    }

    public function get_program()
    {

        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kawasan_id = $this->request->getPost('kawasan');
        $pendanaan_id = $this->request->getPost('pendanaan_id');
        $desk = 1;
        $sumber = $this->request->getPost('sumber');
        $programs = $this->programModel->getProgramMemo($provinsi_id, $unor_id, $kawasan_id, $desk, $sumber, $pendanaan_id);
        $kawasans = $this->kawasanRpiwModel->getKawasanAll();
        $kawasanAll = []; // $programs menjadi array object 
        foreach ($kawasans as $kawasan) {
            $kawasanAll[$kawasan->kode_program][] = $kawasan;
        }
        $data = [
            'p_memo' => $programs,
            'kawasans' => $kawasanAll,
        ];
        return view('/pages/desk/tabel/tabel_program', $data);
    }


    public function programDeskDetail($id_memo)
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
        $this->template->write('title', 'Detail Program Memorandum');
        $this->template->load('/templates/main', '/pages/desk/desk_detail', $data);
    }
    public function export_to_excel()
    {
        // Ambil data filter dari request POST
        $unor_id = $this->request->getPost('unor');
        $provinsi_id = $this->request->getPost('provinsi');
        $kawasan_id = $this->request->getPost('kawasan');
        $pendanaan_id = $this->request->getPost('pendanaan_id');
        $desk = 1;
        $sumber = $this->request->getPost('sumber');

        // Ambil data berdasarkan filter
        $programs = $this->programModel->getProgramMemo($provinsi_id, $unor_id, $kawasan_id, $desk, $sumber, $pendanaan_id);
        $kawasans = $this->kawasanRpiwModel->getKawasanAll();
        $kawasanAll = []; // $programs menjadi array object 
        foreach ($kawasans as $kawasan) {
            $kawasanAll[$kawasan->kode_program][] = $kawasan;
        }
        $kawasans = $kawasanAll;


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
            //mengambil keseparakatan
            $desk2Value = $program->desk2;

            if ($desk2Value === null) {
                $desk2Text = 'belum dibahas';
            } elseif ($desk2Value == 0) {
                $desk2Text = 'ditangguhkan';
            } elseif ($desk2Value == 1) {
                $desk2Text = 'diakomodasi';
            } else {
                $desk2Text = '-';  // Nilai default jika tidak memenuhi kondisi di atas
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
            $sheet->setCellValue('R' . $row, $desk2Text ?? '-');
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
    public function add_catatan_provinsi()
    {
        $id_provinsi = $this->request->getPost('provinsi_id');
        $catatan_provinsi = $this->catatanModel->getCatatanbyProvinsi($id_provinsi);
        $catatan = $this->request->getPost('catatan');
        if ($catatan_provinsi != null) {
            $this->catatanModel->editCatatan($id_provinsi, $catatan);
        } else {
            $this->catatanModel->addCatatan($id_provinsi, $catatan);
        }
        return redirect()->to(base_url('desk_kawasan'));
    }

    public function add_pejabat()
    {
        $this->template->add_css('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', 'link', false, true);
        $this->template->write('title', 'Tambah Pejabat');
        $this->template->load('/templates/main', '/pages/desk/add_pejabat');
    }
    public function daftar_pejabat()
    {
        $data['pejabat'] = $this->pejabatModel->getPejabat();
        $this->template->write('title', 'Daftar Pejabat');
        $this->template->load('/templates/main', '/pages/desk/daftar_pejabat', $data);
    }

    public function pejabat_edit($id_pejabat)
    {
        $pejabat = $this->pejabatModel->getPejabatbyId($id_pejabat);
        $data = ['pejabat' => $pejabat];
        $this->template->load('/templates/main', '/pages/desk/edit_pejabat', $data);
    }
    public function add_ttd()
    {
        $data['pejabat'] = $this->pejabatModel->getPejabat();
        $this->template->write('title', 'Tambah Tanda Tangan');
        $this->template->load('/templates/main', '/pages/desk/add_ttd', $data);
    }

    public function add_ttd_new()
    {
        // Memuat helper form dan validasi
        helper(['form', 'url']);
        $validation = \Config\Services::validation();
        // Validasi form

        if ($this->request->getMethod() == 'POST' && $this->validate([
            'id_pejabat' => 'required',
            'tanda_tangan' => 'uploaded[tanda_tangan]|is_image[tanda_tangan]|max_size[tanda_tangan,1024]',
        ])) {
            // Mendapatkan file yang diupload
            $fileTandaTangan = $this->request->getFile('tanda_tangan');

            // Mengecek apakah file valid
            if ($fileTandaTangan->isValid() && ! $fileTandaTangan->hasMoved()) {
                // Mengenerate nama file unik
                $newName = $fileTandaTangan->getRandomName();

                // Menyimpan file ke folder 'tdd'
                $fileTandaTangan->move(ROOTPATH . 'public/assets/tdd', $newName);
                // Menyimpan data ke database
                $data = [
                    'pejabat_id' => $this->request->getPost('id_pejabat'),
                    'tanda_tangan' => $newName,  // Menyimpan nama file di database
                ];

                // Menyimpan data ke tabel tanda_tangan
                $this->ttdModel->insert($data);

                // Mengarahkan ke halaman berhasil atau menampilkan pesan sukses
                return redirect()->to(base_url('tanda_tangan/daftar')); // Ganti dengan URL tujuan setelah berhasil
            } else {
                echo "error 1";
                die;
                // Jika file tidak valid
                return redirect()->back()->withInput()->with('error', 'File yang diupload bukan gambar atau terjadi kesalahan.');
            }
        } else {
            echo "error 2";
            die;
            // Jika validasi gagal
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }
    }
    public function daftar_ttd()
    {
        $p_ttd = $this->pejabatModel->getTtdPejabat();
        $data = [
            'p_ttd' => $p_ttd
        ];
        $this->template->write('title', 'Daftar Tanda Tangan');
        $this->template->load('/templates/main', '/pages/desk/daftar_ttd', $data);
    }
    public function add_pejabat_new()
    {
        // Memuat helper form dan validasi
        helper(['form', 'url']);
        $validation = \Config\Services::validation();
        // Validasi form

        if ($this->request->getMethod() == 'POST' && $this->validate([
            'tanda_tangan' => 'uploaded[tanda_tangan]|is_image[tanda_tangan]|max_size[tanda_tangan,1024]',
        ])) {
            // Mendapatkan file yang diupload
            $fileTandaTangan = $this->request->getFile('tanda_tangan');

            // Mengecek apakah file valid
            if ($fileTandaTangan->isValid() && ! $fileTandaTangan->hasMoved()) {
                // Mengenerate nama file unik
                $newName = $fileTandaTangan->getRandomName();

                // Menyimpan file ke folder 'tdd'
                $fileTandaTangan->move(ROOTPATH . 'public/assets/ttd', $newName);
                // Menyimpan data ke database
                $data = [
                    'nip'             => $this->request->getPost('nip'),
                    'nama_pejabat'    => $this->request->getPost('nama_pejabat'),
                    'jabatan'         => $this->request->getPost('jabatan'),
                    'unit_kerja'      => $this->request->getPost('unit_kerja'),
                    'unit_organisasi' => $this->request->getPost('unit_organisasi'),
                    'instansi'        => $this->request->getPost('instansi'),
                    'email'           => $this->request->getPost('email'),
                    'no_telp'         => $this->request->getPost('no_telp'),
                    'tanda_tangan'    => $newName
                ];

                if ($this->pejabatModel->insert($data)) {
                    return redirect()->to(base_url('/pejabat/daftar'))->with('success', 'Data pejabat berhasil ditambahkan.');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data pejabat.');
                }
            } else {
                // Jika file tidak valid
                return redirect()->back()->withInput()->with('error', 'File yang diupload bukan gambar atau terjadi kesalahan.');
            }
        } else {
            $data = [
                'nip'             => $this->request->getPost('nip'),
                'nama_pejabat'    => $this->request->getPost('nama_pejabat'),
                'jabatan'         => $this->request->getPost('jabatan'),
                'unit_kerja'      => $this->request->getPost('unit_kerja'),
                'unit_organisasi' => $this->request->getPost('unit_organisasi'),
                'instansi'        => $this->request->getPost('instansi'),
                'email'           => $this->request->getPost('email'),
                'no_telp'         => $this->request->getPost('no_telp'),
                'tanda_tangan'    => 'nonttd.png'
            ];
            if ($this->pejabatModel->insert($data)) {
                return redirect()->to(base_url('/pejabat/daftar'))->with('success', 'Data pejabat berhasil ditambahkan.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data pejabat.');
            }
        }
    }

    public function edit_pejabat()
    {
        // Memuat helper form dan validasi
        helper(['form', 'url']);
        $validation = \Config\Services::validation();
        // Validasi form


        if ($this->request->getMethod() == 'POST' && $this->validate([
            'tanda_tangan' => 'uploaded[tanda_tangan]|is_image[tanda_tangan]|max_size[tanda_tangan,1024]',
        ])) {
            // Mendapatkan file yang diupload
            $fileTandaTangan = $this->request->getFile('tanda_tangan');

            // Mengecek apakah file valid
            if ($fileTandaTangan->isValid() && ! $fileTandaTangan->hasMoved()) {
                // Mengenerate nama file unik
                $newName = $fileTandaTangan->getRandomName();

                // Menyimpan file ke folder 'tdd'
                $fileTandaTangan->move(ROOTPATH . 'public/assets/ttd', $newName);
                // Menyimpan data ke database
            }
        } else {
            $newName = $this->request->getPost('ttd_lama');
        }
        $id_pejabat = $this->request->getPost('id_pejabat');
        $data = [
            'nip'             => $this->request->getPost('nip'),
            'nama_pejabat'    => $this->request->getPost('nama_pejabat'),
            'jabatan'         => $this->request->getPost('jabatan'),
            'unit_kerja'      => $this->request->getPost('unit_kerja'),
            'unit_organisasi' => $this->request->getPost('unit_organisasi'),
            'instansi'        => $this->request->getPost('instansi'),
            'email'           => $this->request->getPost('email'),
            'no_telp'         => $this->request->getPost('no_telp'),
            'tanda_tangan'    => $newName
        ];

        if ($this->pejabatModel->update($id_pejabat, $data)) {
            return redirect()->to(base_url('/pejabat/daftar'))->with('success', 'Data pejabat berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data pejabat.');
        }
    }
    public function pejabat_detail($id_pejabat)

    {
        $pejabat = $this->pejabatModel->find($id_pejabat); // Ambil data berdasarkan ID
        if ($pejabat) {
            return view('pejabat/detail_modal', ['pejabat' => $pejabat]); // Kembalikan view
        } else {
            return "Data tidak ditemukan."; // Pesan error
        }
    }



    public function generatePdf3($id_unor, $tanggal) //ganti dengan id provinsi
    {
        // Ambil data dari database
        if ($id_unor == 11 || $id_unor == "null") {
            $provinsi_id = $this->request->getPost('provinsi');
            $kawasan_id = $this->request->getPost('kawasan');
            $pendanaan_id = 1;
            $desk = 1;
            $sumber = $this->request->getPost('sumber');
            $sda = $this->programModel->getProgramMemo($provinsi_id, 06, $kawasan_id, $desk, $sumber, $pendanaan_id, 1);
            $bm = $this->programModel->getProgramMemo($provinsi_id, 04, $kawasan_id, $desk, $sumber, $pendanaan_id, 1);
            $ck = $this->programModel->getProgramMemo($provinsi_id, 05, $kawasan_id, $desk, $sumber, $pendanaan_id, 1);
            $kawasans = $this->kawasanRpiwModel->getKawasanAll();
            $kesepakatan = 1;
            $sumber_data = $this->request->getPost('sumber');
            $laporan1 = $this->programModel->getProgramLaporan1($kesepakatan, $sumber_data, $pendanaan_id);
            $kawasanAll = []; // $programs menjadi array object 
            foreach ($kawasans as $kawasan) {
                $kawasanAll[$kawasan->kode_program][] = $kawasan;
            }
            $html = view('pdfTemplate3', [
                'tanggal' => $tanggal,
                'sda' => $sda,
                'bm' => $bm,
                'ck' => $ck,
                'kawasans' => $kawasanAll,
                'laporan1' => $laporan1

            ]);
        } else {
            $unor = $this->unorModel->find($id_unor);
            $unor_id = $id_unor;
            $provinsi_id = $this->request->getPost('provinsi');
            $kawasan_id = $this->request->getPost('kawasan');
            $pendanaan_id = 1;
            $desk = 1;
            $sumber = $this->request->getPost('sumber');
            $programs = $this->programModel->getProgramMemo($provinsi_id, $unor_id, $kawasan_id, $desk, $sumber, $pendanaan_id, 1);
            $kawasans = $this->kawasanRpiwModel->getKawasanAll();
            $kesepakatan = 1;
            $sumber_data = $this->request->getPost('sumber');
            $laporan1 = $this->programModel->getProgramLaporan1($kesepakatan, $sumber_data, $pendanaan_id);
            $kawasanAll = []; // $programs menjadi array object 
            foreach ($kawasans as $kawasan) {
                $kawasanAll[$kawasan->kode_program][] = $kawasan;
            }
            // $programs = $this->programModel->getProgramMemo($id_provinsi, '', '', 1);
            // Load view template untuk PDF
            $html = view('pdfTemplate2', [
                'unor' => $unor,
                'tanggal' => $tanggal,
                'p_memo' => $programs,
                'kawasans' => $kawasanAll,
                'laporan1' => $laporan1

            ]);
        }

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

        $mpdf->SetHTMLFooter('<div style="text-align: center;">Halaman {PAGENO} dari {nbpg}</div>');
        $mpdf->WriteHTML($html);

        // Output PDF ke browser
        return $this->response->setHeader('Content-Type', 'application/pdf')
            ->setBody($mpdf->Output('berita_acara.pdf', 'I')); // 'I' untuk menampilkan, 'D' untuk mengunduh
    }
    public function generatePdf2($id_provinsi, $tanggal) //ganti dengan id provinsi
    {

        // Ambil data dari database
        $provinsi = $this->provinsiModel->find($id_provinsi); // Ganti dengan nama tabel Anda
        $kawasandesk = $this->programModel->getProgramKawasan($id_provinsi);
        $catatan_provinsi = $this->catatanModel->getCatatanbyProvinsi($id_provinsi);
        $pejabat = $this->baModel->getPejabatById($id_provinsi);
        $programs = $this->programModel->getProgramMemo($id_provinsi, '', '', 1);
        $kawasans = $this->kawasanRpiwModel->getKawasanAll();
        $kawasanAll = []; // $programs menjadi array object 
        foreach ($kawasans as $kawasan) {
            $kawasanAll[$kawasan->kode_program][] = $kawasan;
        }
        // Load view template untuk PDF
        $html = view('pdfTemplate', [
            'provinsi' => $provinsi,
            'kawasan' => $kawasandesk,
            'programs' => $programs,
            'kawasans' => $kawasanAll,
            'catatanKawasan' => $catatan_provinsi,
            'pejabat' => $pejabat,
            'tanggal' => $tanggal
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

        $mpdf->SetHTMLFooter('<div style="text-align: center;">© 2024 - Berita Acara Provinsi ' . ucwords($provinsi["provinsi"]) . ' | Halaman {PAGENO} dari {nbpg}</div>');
        $mpdf->WriteHTML($html);

        // Output PDF ke browser
        return $this->response->setHeader('Content-Type', 'application/pdf')
            ->setBody($mpdf->Output('berita_acara.pdf', 'I')); // 'I' untuk menampilkan, 'D' untuk mengunduh
    }

    public function berita_acara()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $pejabat = $this->pejabatModel->getPejabat();
        $data = [
            'provinsi' => $dataProvinsi,
            'pejabat' => $pejabat
        ];

        $this->template->load('/templates/main', '/pages/desk/daftar_ba', $data);
    }
    public function berita_acara2()
    {
        $dataUnor = $this->unorModel->getUnor();

        $data = [
            'unor' => $dataUnor
        ];

        $this->template->load('/templates/main', '/pages/desk/daftar_ba2', $data);
    }
    public function get_pejabat_ba()
    {
        $id_provinsi = $this->request->getPost('provinsi_id');
        $pejabat = $this->baModel->getPejabatById($id_provinsi);
        $data = [
            'pejabat' => $pejabat
        ];

        return view('/pages/desk/tabel/tabel_pejabat_ttd', $data);
    }
    public function delete_pejabat($id)
    {
        $this->baModel->delete_pejabat($id);
        $this->berita_acara();
    }

    // public function add_pejabat_ba()
    // {
    //     $id_provinsi = $this->request->getPost('provinsi_id');
    //     $id_jabatan = $this->request->getPost('pejabat_id');
    //     $data = [
    //         'id_provinsi' => $id_provinsi,
    //         'id_pejabat' => $id_jabatan
    //     ];
    //     $this->baModel->insert($data);
    //     $this->berita_acara();
    // }


    public function add_pejabat_ba()
    {
        if ($this->request->getMethod() === 'POST') {
            $pejabatId = $this->request->getPost('pejabat_id');
            $provinsiId = $this->request->getPost('provinsi_id');

            // Proses penyimpanan data
            $data = [
                'id_pejabat' => $pejabatId,
                'id_provinsi' => $provinsiId,
            ];

            $isSaved = $this->baModel->insert($data);

            if ($isSaved) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menyimpan data.']);
            }
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Metode tidak valid.']);
    }


    //
    public function laporan1()
    {
        $dataPendanaan = $this->pendanaanModel->getPendanaan();

        $data = [
            'pendanaan' => $dataPendanaan
        ];
        $this->template->write('title', 'Laporan Desk');
        $this->template->load('/templates/main', '/pages/desk/laporan1', $data);
    }
    public function laporan2()
    {
        $dataPendanaan = $this->pendanaanModel->getPendanaan();
        $dataUnor = $this->unorModel->getUnor();

        $data = [
            'pendanaan' => $dataPendanaan,
            'unor' => $dataUnor
        ];
        $this->template->write('title', 'Laporan Desk');
        $this->template->load('/templates/main', '/pages/desk/laporan2', $data);
    }

    public function get_program_laporan1()
    {
        $kesepakatan = $this->request->getPost('desk2');
        if ($kesepakatan == 0) {
            $kesepakatan == "x";
        }
        $sumber_data = $this->request->getPost('sumber');
        $pendanaan = $this->request->getPost('pendanaan_id');
        $laporan1 = $this->programModel->getProgramLaporan1($kesepakatan, $sumber_data, $pendanaan);
        // Kirim data ke view
        $data = [
            'laporan1' => $laporan1
        ];

        // dd($data);

        return view('/pages/desk/tabel/tabel_laporan1', $data);
    }
    public function get_program_laporan2()
    {

        $unor = $this->request->getPost('unor');
        $sumber_data = $this->request->getPost('sumber');
        $pendanaan = $this->request->getPost('pendanaan_id');
        $laporan2 = $this->programModel->getProgramLaporan2($unor, $sumber_data, $pendanaan);

        // Kirim data ke view
        $data = [
            'laporan2' => $laporan2,
        ];
        return view('/pages/desk/tabel/tabel_laporan2', $data);
    }

    public function excel_laporan1()
    {
        $kesepakatan = $this->request->getPost('desk2');
        if ($kesepakatan == 0) {
            $kesepakatan == "x";
        }
        $sumber_data = $this->request->getPost('sumber');
        $pendanaan = $this->request->getPost('pendanaan_id');
        $laporan1 = $this->programModel->getProgramLaporan1($kesepakatan, $sumber_data, $pendanaan);
        // Kirim data ke view
        $data = [
            'laporan1' => $laporan1
        ];

        // Buat Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        // Header baris pertama
        $sheet->setCellValue('A1', 'No');
        $sheet->mergeCells('A1:A2'); // Gabungkan untuk rowspan

        $sheet->setCellValue('B1', 'Provinsi');
        $sheet->mergeCells('B1:B2'); // Gabungkan untuk rowspan

        $sheet->setCellValue('C1', 'Ditjen Sumber Daya Air');
        $sheet->mergeCells('C1:D1'); // Gabungkan untuk colspan

        $sheet->setCellValue('E1', 'Ditjen Bina Marga');
        $sheet->mergeCells('E1:F1'); // Gabungkan untuk colspan

        $sheet->setCellValue('G1', 'Ditjen Cipta Karya');
        $sheet->mergeCells('G1:H1'); // Gabungkan untuk colspan

        $sheet->setCellValue('I1', 'Total Program');
        $sheet->mergeCells('I1:I2'); // Gabungkan untuk rowspan

        $sheet->setCellValue('J1', 'Total Anggaran');
        $sheet->mergeCells('J1:J2'); // Gabungkan untuk rowspan

        // Header baris kedua
        $sheet->setCellValue('C2', 'Program');
        $sheet->setCellValue('D2', 'Anggaran (Ribu)');

        $sheet->setCellValue('E2', 'Program');
        $sheet->setCellValue('F2', 'Anggaran (Ribu)');

        $sheet->setCellValue('G2', 'Program');
        $sheet->setCellValue('H2', 'Anggaran (Ribu)');

        $styleArray = [
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFD3D3D3', // Warna abu-abu
                ],
            ],
        ];

        $sheet->getStyle('A1:J2')->applyFromArray($styleArray);
        $sheet->getRowDimension('1')->setRowHeight(25); // Sesuaikan tinggi baris pertama
        $sheet->getRowDimension('2')->setRowHeight(20); // Sesuaikan tinggi baris kedua

        // Menambahkan lebar kolom agar terlihat rapi
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('H')->setWidth(15);
        $sheet->getColumnDimension('I')->setWidth(15);
        $sheet->getColumnDimension('J')->setWidth(15);


        // Isi data ke dalam sheet
        $row = 3; // Baris awal untuk data setelah header
        $no = 1;  // Nomor urut

        foreach ($laporan1 as $laporan1) {
            // Nomor urut
            $sheet->setCellValue('A' . $row, $no++);

            // Nama Provinsi
            $sheet->setCellValue('B' . $row, $laporan1->provinsi);

            // Ditjen Sumber Daya Air
            $sheet->setCellValue('C' . $row, $laporan1->program_sda ?? 0);
            $sheet->setCellValue('D' . $row, number_format($laporan1->anggaran_sda ?? 0, 0, ',', '.'));

            // Ditjen Bina Marga
            $sheet->setCellValue('E' . $row, $laporan1->program_bm ?? 0);
            $sheet->setCellValue('F' . $row, number_format($laporan1->anggaran_bm ?? 0, 0, ',', '.'));

            // Ditjen Cipta Karya
            $sheet->setCellValue('G' . $row, $laporan1->anggaran_ck ?? 0);
            $sheet->setCellValue('H' . $row, number_format($laporan1->program_ck ?? 0, 0, ',', '.'));

            // Total Program dan Total Anggaran
            $sheet->setCellValue('I' . $row, $laporan1->program ?? 0);
            $sheet->setCellValue('J' . $row, number_format($laporan1->anggaran ?? 0, 0, ',', '.'));

            $row++; // Pindah ke baris berikutnya
        }
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

    public function excel_laporan2()
    {

        $unor = $this->request->getPost('unor');
        $sumber_data = $this->request->getPost('sumber');
        $pendanaan = $this->request->getPost('pendanaan_id');
        $laporan2 = $this->programModel->getProgramLaporan2($unor, $sumber_data, $pendanaan);


        // Buat Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        // Header baris pertama
        $sheet->setCellValue('A1', 'No');
        $sheet->mergeCells('A1:A2'); // Gabungkan untuk rowspan

        $sheet->setCellValue('B1', 'Provinsi');
        $sheet->mergeCells('B1:B2'); // Gabungkan untuk rowspan

        $sheet->setCellValue('C1', 'Belum dibahas');
        $sheet->mergeCells('C1:D1'); // Gabungkan untuk colspan

        $sheet->setCellValue('E1', 'diakomodasi');
        $sheet->mergeCells('E1:F1'); // Gabungkan untuk colspan

        $sheet->setCellValue('G1', 'ditangguhkan');
        $sheet->mergeCells('G1:H1'); // Gabungkan untuk colspan

        $sheet->setCellValue('I1', 'Total Program');
        $sheet->mergeCells('I1:I2'); // Gabungkan untuk rowspan

        $sheet->setCellValue('J1', 'Total Anggaran');
        $sheet->mergeCells('J1:J2'); // Gabungkan untuk rowspan

        // Header baris kedua
        $sheet->setCellValue('C2', 'Program');
        $sheet->setCellValue('D2', 'Anggaran (Ribu)');

        $sheet->setCellValue('E2', 'Program');
        $sheet->setCellValue('F2', 'Anggaran (Ribu)');

        $sheet->setCellValue('G2', 'Program');
        $sheet->setCellValue('H2', 'Anggaran (Ribu)');

        $styleArray = [
            'font' => [
                'bold' => true,
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFD3D3D3', // Warna abu-abu
                ],
            ],
        ];

        $sheet->getStyle('A1:J2')->applyFromArray($styleArray);
        $sheet->getRowDimension('1')->setRowHeight(25); // Sesuaikan tinggi baris pertama
        $sheet->getRowDimension('2')->setRowHeight(20); // Sesuaikan tinggi baris kedua

        // Menambahkan lebar kolom agar terlihat rapi
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('H')->setWidth(15);
        $sheet->getColumnDimension('I')->setWidth(15);
        $sheet->getColumnDimension('J')->setWidth(15);


        // Isi data ke dalam sheet
        $row = 3; // Baris awal untuk data setelah header
        $no = 1;  // Nomor urut

        foreach ($laporan2 as $laporan2) {
            // Nomor urut
            $sheet->setCellValue('A' . $row, $no++);

            // Nama Provinsi
            $sheet->setCellValue('B' . $row, $laporan2->provinsi);

            // Ditjen Sumber Daya Air
            $sheet->setCellValue('C' . $row, $laporan2->program_bblm_dibahas ?? 0);
            $sheet->setCellValue('D' . $row, number_format($laporan2->anggaran_blm_dibahas ?? 0, 0, ',', '.'));

            // Ditjen Bina Marga
            $sheet->setCellValue('E' . $row, $laporan2->program_dilanjutkan ?? 0);
            $sheet->setCellValue('F' . $row, number_format($laporan2->anggaran_dilanjutkan ?? 0, 0, ',', '.'));

            // Ditjen Cipta Karya
            $sheet->setCellValue('G' . $row, $laporan2->program_ditangguhkan ?? 0);
            $sheet->setCellValue('H' . $row, number_format($laporan2->anggaran_ditangguhkan ?? 0, 0, ',', '.'));

            // Total Program dan Total Anggaran
            $sheet->setCellValue('I' . $row, $laporan2->program ?? 0);
            $sheet->setCellValue('J' . $row, number_format($laporan2->anggaran ?? 0, 0, ',', '.'));

            $row++; // Pindah ke baris berikutnya
        }
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

    public function nomenklatur()
    {
        $dataProvinsi = $this->provinsiModel->getProvinsi();
        $dataUnor = $this->unorModel->getUnor();
        $dataPendanaan = $this->pendanaanModel->getPendanaan();

        $data = [
            'provinsi' => $dataProvinsi,
            'unor' => $dataUnor,
            'pendanaan' => $dataPendanaan
        ];
        $this->template->write('title', 'List Desk Program');
        $this->template->load('/templates/main', '/pages/desk/list_program', $data);
    }

    public function add_nomenklatur($id_memo)
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
        $this->template->write('title', 'Detail Program Memorandum');
        $this->template->load('/templates/main', '/pages/desk/nomenklatur', $data);
    }
}
