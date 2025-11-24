<?php

namespace App\Controllers;

use App\Models\Master\ProgramModel;
use App\Models\Master\ProvinsiModel;
use App\Models\Master\KegiatanModel;
use App\Models\Master\KroModel;
use App\Models\Master\RoModel;
use App\Models\Master\UserModel;
use App\Models\Master\RoleModel;
use App\Models\Master\NomenklaturModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\CLI\Console;
use CodeIgniter\Router\Router;

class Master extends BaseController
{
    protected $programModel;
    protected $kegiatanModel;
    protected $kroModel;
    protected $roModel;
    protected $userModel;
    protected $provinsiModel;
    protected $roleModel;
    protected $nomenklaturModel;
    public function __construct()
    {
        $this->programModel = new ProgramModel();
        $this->kegiatanModel = new KegiatanModel();
        $this->kroModel = new KroModel();
        $this->roModel = new RoModel();
        $this->userModel = new UserModel();
        $this->provinsiModel = new ProvinsiModel();
        $this->roleModel = new RoleModel();
        $this->nomenklaturModel = new NomenklaturModel();

        helper('permission');
    }

    public function index()
    {
        $this->template->write('title', 'Login');
        return view('login');
    }
    public function tabel()
    {
        return view('/tables/regular');
    }
    //adding 06102025_sendi
    public function nomenklatur()
    {
        $dataProgram    = $this->programModel->getProgram();
        // $dataKegiatan   = $this->kegiatanModel->getKegiatan();
        // $dataKro        = $this->kroModel->getKro();
        // $dataRo         = $this->roModel->getRo();

        $data = [
            'program'   => $dataProgram,
            // 'kegiatan'  => $dataKegiatan,
            // 'kro'       => $dataKro,
            // 'ro'        => $dataRo
        ];
        $this->template->write('title', 'List Nomenklatur Kegiatan');
        $this->template->load('/templates/main', '/pages/master/nomenklatur', $data);
    }

    public function get_nomenklatur()
    {
        $program_id = $this->request->getPost('program');
        $kegiatan_id = $this->request->getPost('kegiatan');
        $kro_id = $this->request->getPost('kro');
        $ro_id = $this->request->getPost('ro');

        if (empty($program_id) && empty($kegiatan_id) && empty($kro_id) && empty($ro_id)) {

            $data = [
                'nomenklaturs' => [],
            ];
        } else {
            $nomenklaturs = $this->nomenklaturModel->getNomenklatur($program_id, $kegiatan_id, $kro_id, $ro_id);
            $data = [
                'nomenklaturs' => $nomenklaturs,
            ];
        }

        return view('/pages/master/tabel/tabel_nomenklatur', $data);
    }

    public function get_detail_nomenklatur($id_ro)
    {
        // $program_id = $this->request->getGet('program');
        // $kegiatan_id = $this->request->getGet('kegiatan');
        // $kro_id = $this->request->getGet('kro');
        // $ro_id = $this->request->getGet('ro');

        // $nomenklatur = $this->nomenklaturModel->getDetailNomenklatur($program_id, $kegiatan_id, $kro_id, $ro_id);

        // return $this->response->setJSON($nomenklatur);

        $nomenklatur = $this->nomenklaturModel->getDetailNomenklatur($id_ro);
        if (!$nomenklatur) {
            return $this->response->setStatusCode(404)->setBody('Data tidak ditemukan');
        }
        return view('/pages/master/ModalNomenklaturView', ['nomenklatur' => $nomenklatur]);
    }

    public function export_to_excel()
    {
        // Ambil data filter dari request POST
        $program_id = $this->request->getPost('program');
        $kegiatan_id = $this->request->getPost('kegiatan');
        $kro_id = $this->request->getPost('kro');
        $ro_id = $this->request->getPost('ro');

        // Ambil data berdasarkan filter
        $nomenklaturs = $this->nomenklaturModel->getNomenklatur($program_id, $kegiatan_id, $kro_id, $ro_id);

        // Buat Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Program');
        $sheet->setCellValue('C1', 'Nama Program');
        $sheet->setCellValue('D1', 'Kode Kegiatan');
        $sheet->setCellValue('E1', 'Nama Kegiatan');
        $sheet->setCellValue('F1', 'Kode KRO');
        $sheet->setCellValue('G1', 'Nama KRO');
        $sheet->setCellValue('H1', 'Kode RO');
        $sheet->setCellValue('I1', 'Nama RO');
        $sheet->setCellValue('J1', 'Satuan');
        $sheet->setCellValue('K1', 'Periode');

        // Membuat teks header menjadi bold
        $sheet->getStyle('A1:K1')->getFont()->setBold(true);

        // Atur kolom agar auto size
        foreach (range('A', 'K') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Isi data ke dalam sheet
        $row = 2; // Baris data dimulai dari baris ke-2
        foreach ($nomenklaturs as $index => $nm) {

            //
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $nm->id_program);
            $sheet->setCellValue('C' . $row, $nm->nm_program);
            $sheet->setCellValue('D' . $row, $nm->id_kegiatan);
            $sheet->setCellValue('E' . $row, $nm->nm_kegiatan);
            $sheet->setCellValue('F' . $row, $nm->id_kro);
            $sheet->setCellValue('G' . $row, $nm->nm_kro);
            $sheet->setCellValue('H' . $row, $nm->id_ro);
            $sheet->setCellValue('I' . $row, $nm->nm_ro);
            $sheet->setCellValue('J' . $row, $nm->nama_satuan);
            $sheet->setCellValue('K' . $row, $nm->periode);
            $row++;
        }

        // Simpan file sebagai output langsung
        $writer = new Xlsx($spreadsheet);
        $filename = 'Filter_Nomenklatur_Kegiatan_' . date('Y-m-d_H-i-s') . '.xlsx';

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


    public function get_kegiatan()
    {
        $id_program = $this->request->getPost('id_program');
        $kegiatan = $this->kegiatanModel->getKegiatan($id_program);
        return $this->response->setJSON($kegiatan);
    }

    public function get_kro()
    {

        $id_kegiatan = $this->request->getPost('id_kegiatan');
        $kro = $this->kroModel->getkro($id_kegiatan);
        return $this->response->setJSON($kro);
    }

    public function get_ro()
    {

        $id_kro = $this->request->getPost('id_kro');
        $ro = $this->roModel->getRo($id_kro);
        return $this->response->setJSON($ro);
    }
    // public function program()
    // {
    //     $data = [
    //         'programs' => $this->programModel->getProgram()
    //     ];
    //     $this->template->write('title', 'Master Program');
    //     $this->template->load('/templates/main', '/pages/master/program', $data);
    // }
    // public function kawasan()
    // {
    //     $data = [
    //         'kegiatan' => $this->kegiatanModel->getKegiatan()
    //     ];
    //     $this->template->write('title', 'Master Kegiatan');
    //     $this->template->load('/templates/main', '/pages/master/kawasan', $data);
    // }
    // public function kro()
    // {
    //     $data = [
    //         'kro' => $this->kroModel->getKro()
    //     ];
    //     $this->template->write('title', 'Master KRO');
    //     $this->template->load('/templates/main', '/pages/master/kro', $data);
    // }
    // public function ro()
    // {
    //     $data = [
    //         'ro' => $this->roModel->getro()
    //     ];
    //     $this->template->write('title', 'Master RO');
    //     $this->template->load('/templates/main', '/pages/master/ro', $data);
    // }
    public function form()
    {
        return view('/pages/addProgram');
    }
    public function provinsi()
    {
        $data = [
            'provinsi' => $this->provinsiModel->getProvinsi()
        ];
        $this->template->write('title', 'Master Provinsi');
        $this->template->load('/templates/main', '/pages/master/provinsi', $data);
    }
    public function user()
    {
        $id_role = user()->id_role;
        $data = [
            'user' => $this->userModel->getUser(),
            'role' => $this->roleModel->getRole(),
            'can_view' => has_permission_menu($id_role, '/user', 'can_view'),
            'can_edit' => has_permission_menu($id_role, '/user', 'can_edit'),
            'can_delete' => has_permission_menu($id_role, '/user', 'can_delete')
        ];

        $this->template->write('title', 'Master User');
        $this->template->load('/templates/main', '/pages/master/user', $data);
    }


    public function update_user()
    {
        if ($this->request->isAJAX()) { // Pastikan request berasal dari AJAX
            $user_id = $this->request->getPost('id');
            $role_id = $this->request->getPost('role_id');

            // Pastikan data tidak kosong
            if (empty($user_id) || empty($role_id)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'User ID dan Role ID tidak boleh kosong'
                ]);
            }

            $update = $this->userModel->editrole($user_id, $role_id);
            if ($update) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Role berhasil diperbarui'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui role'
                ]);
            }
        }

        return $this->response->setStatusCode(400)->setJSON([
            'success' => false,
            'message' => 'Invalid request'
        ]);
    }

    public function delete_user($id)
    {
        $userModel = new UserModel();

        // Cek apakah user dengan ID tersebut ada
        $user = $userModel->find($id);
        if (!$user) {
            return redirect()->to('/user')->with('error', 'User tidak ditemukan.');
        }

        // Hapus user
        $userModel->delete($id);

        return redirect()->to('/user')->with('success', 'User berhasil dihapus.');
    }

    public function test()
    {
        return view('/test');
        $this->template->add_js('assets/js/test.js');
        // $this->template->write('title', 'Master User');
        // $this->template->load('/templates/main', 'test');
    }
}
