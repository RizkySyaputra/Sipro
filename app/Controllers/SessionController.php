<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class SessionController extends Controller
{
    public function SetTahun()
    {
        $tahun = $this->request->getPost('tahun_pelaksana');
        if ($tahun) {
            session()->set('tahun_pelaksana', $tahun);
            return $this->response->setJSON(['status' => 'success', 'tahun' => $tahun]);
        } else {
            return $this->response->setJSON(['status' => 'error']);
        }
    }
}
