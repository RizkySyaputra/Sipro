<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\Api\ApiFkwModel;
use App\Models\Api\ApiFkbModel;
use App\Models\Konreg\FkwModel;
use App\Models\Konreg\FkbModel;
use App\Models\Api\ApiRakortekModel;
use CodeIgniter\HTTP\ResponseInterface;

class ApiController extends BaseController
{

    // public function api_post_unor_fkb()
    // {
    //     $data = $this->request->getJSON(true);
    //     $clientType = $this->request->client->type ?? 'unknown';
    //     // Pastikan field yang dibutuhkan ada
    //     if ($clientType === 'SDA') {
    //         // logika untuk sistem SDA
    //         $data['id_unor'] = "6";
    //     } elseif ($clientType === 'BM') {
    //         // logika untuk sistem BM
    //         $data['id_unor'] = "4";
    //     } elseif ($clientType === 'CK') {
    //         // logika untuk sistem CK
    //         $data['id_unor'] = "5";
    //     }

    //     // Pastikan field yang dibutuhkan ada
    //     if (!isset($data['id_provinsi']) || !isset($data['id_unor'])) {
    //         return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
    //             ->setJSON(['status' => 'error', 'message' => 'Field id_provinsi dan id_unor harus diisi']);
    //     }

    //     // Ambil nomor urut terakhir (misalnya dari model)
    //     $model = new ApiFkbModel();

    //     $latest = $model
    //         ->where('id_provinsi', $data['id_provinsi'])
    //         ->where('id_unor', $data['id_unor'])
    //         ->orderBy('id_fkb', 'DESC')
    //         ->first();

    //     $lastNumber = 0;
    //     if ($latest && isset($latest['id_fkb'])) {
    //         $parts = explode('-', $latest['id_fkb']);
    //         if (count($parts) === 5) {
    //             $lastNumber = (int) $parts[4];
    //         }
    //     }
    //     $id_unor = str_pad($data['id_unor'], 2, '0', STR_PAD_LEFT);
    //     $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
    //     $data['id_fkb'] = 'API-FKB-' . $data['id_provinsi'] . '-' . $id_unor . '-' . $newNumber;

    //     //geoJson
    //     if (isset($data['geotag']) && is_array($data['geotag'])) {
    //         $data['geotag'] = json_encode($data['geotag']);
    //     }

    //     if (!$model->insert($data)) {
    //         return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
    //             ->setJSON(['status' => 'error', 'message' => $model->errors()]);
    //     }

    //     return $this->response->setStatusCode(ResponseInterface::HTTP_CREATED)
    //         ->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan']);
    // }


    // public function api_post_unor_fkw()
    // {
    //     $data = $this->request->getJSON(true);
    //     $clientType = $this->request->client->type ?? 'unknown';
    //     // Pastikan field yang dibutuhkan ada
    //     if ($clientType === 'SDA') {
    //         // logika untuk sistem SDA
    //         $data['id_unor'] = "6";
    //     } elseif ($clientType === 'BM') {
    //         // logika untuk sistem BM
    //         $data['id_unor'] = "4";
    //     } elseif ($clientType === 'CK') {
    //         // logika untuk sistem CK
    //         $data['id_unor'] = "5";
    //     }
    //     // Pastikan field yang dibutuhkan ada
    //     if (!isset($data['id_provinsi']) || !isset($data['id_unor'])) {
    //         return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
    //             ->setJSON(['status' => 'error', 'message' => 'Field id_provinsi dan id_unor harus diisi']);
    //     }

    //     // Ambil nomor urut terakhir (misalnya dari model)
    //     $model = new ApiFkwModel();

    //     $latest = $model
    //         ->where('id_provinsi', $data['id_provinsi'])
    //         ->where('id_unor', $data['id_unor'])
    //         ->orderBy('id_fkw', 'DESC')
    //         ->first();

    //     $lastNumber = 0;
    //     if ($latest && isset($latest['id_fkw'])) {
    //         $parts = explode('-', $latest['id_fkw']);
    //         if (count($parts) === 5) {
    //             $lastNumber = (int) $parts[4];
    //         }
    //     }
    //     $id_unor = str_pad($data['id_unor'], 2, '0', STR_PAD_LEFT);
    //     $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
    //     $data['id_fkw'] = 'API-FKW-' . $data['id_provinsi'] . '-' . $id_unor . '-' . $newNumber;
    //     $data['anggaran'] = $data['rpm'] + $data['phln'] + $data['sbsn'];

    //     //create geoJson
    //     if (isset($data['geotag']) && is_array($data['geotag'])) {
    //         $data['geotag'] = json_encode($data['geotag']);
    //     }

    //     if (!$model->insert($data)) {
    //         return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
    //             ->setJSON(['status' => 'error', 'message' => $model->errors()]);
    //     }

    //     return $this->response->setStatusCode(ResponseInterface::HTTP_CREATED)
    //         ->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan']);
    // }


    // public function insert_api_rakortek()
    // {
    //     $data = $this->request->getJSON(true);

    //     $model = new ApiRakortekModel();

    //     if (!$model->insert($data)) {
    //         return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
    //             ->setJSON(['status' => 'error', 'message' => $model->errors()]);
    //     }

    //     return $this->response->setStatusCode(ResponseInterface::HTTP_CREATED)
    //         ->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan']);
    // }

    // public function api_put_unor_fkb($id_fkb)
    // {
    //     $data = $this->request->getJSON(true);
    //     $model = new ApiFkbModel();
    //     $clientType = $this->request->client->type ?? 'unknown';
    //     // Pastikan field yang dibutuhkan ada
    //     if ($clientType === 'SDA') {
    //         // logika untuk sistem SDA
    //         $data['id_unor'] = "6";
    //     } elseif ($clientType === 'BM') {
    //         // logika untuk sistem BM
    //         $data['id_unor'] = "4";
    //     } elseif ($clientType === 'CK') {
    //         // logika untuk sistem CK
    //         $data['id_unor'] = "5";
    //     }
    //     $data['anggaran'] = $data['rpm'] + $data['phln'] + $data['sbsn'];
    //     // Validasi minimal field penting
    //     if (!isset($data['id_provinsi'])) {
    //         return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
    //             ->setJSON(['status' => 'error', 'message' => 'Field id_provinsi dan id_unor harus diisi']);
    //     }

    //     // Update geotag jika ada
    //     if (isset($data['geotag']) && is_array($data['geotag'])) {
    //         $data['geotag'] = json_encode($data['geotag']);
    //     }
    //     if ($model->where('id_sumber', $id_fkb)->countAllResults() == 0) {
    //         return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
    //             ->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    //     }
    //     if (!$model->where('id_sumber', $id_fkb)->set($data)->update()) {
    //         return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
    //             ->setJSON(['status' => 'error', 'message' => $model->errors()]);
    //     }

    //     return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
    //         ->setJSON(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
    // }

    // public function api_put_unor_fkw($id_fkw)
    // {
    //     $data = $this->request->getJSON(true);
    //     $model = new ApiFkwModel();
    //     $clientType = $this->request->client->type ?? 'unknown';
    //     // Pastikan field yang dibutuhkan ada
    //     if ($clientType === 'SDA') {
    //         // logika untuk sistem SDA
    //         $data['id_unor'] = "6";
    //     } elseif ($clientType === 'BM') {
    //         // logika untuk sistem BM
    //         $data['id_unor'] = "4";
    //     } elseif ($clientType === 'CK') {
    //         // logika untuk sistem CK
    //         $data['id_unor'] = "5";
    //     }
    //     // Validasi minimal field penting
    //     if (!isset($data['id_provinsi'])) {
    //         return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
    //             ->setJSON(['status' => 'error', 'message' => 'Field id_provinsi dan id_unor harus diisi']);
    //     }

    //     // Update geotag jika ada
    //     if (isset($data['geotag']) && is_array($data['geotag'])) {
    //         $data['geotag'] = json_encode($data['geotag']);
    //     }

    //     if ($model->where('id_sumber', $id_fkw)->countAllResults() == 0) {
    //         return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
    //             ->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    //     }
    //     if (!$model->where('id_sumber', $id_fkw)->set($data)->update()) {
    //         return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
    //             ->setJSON(['status' => 'error', 'message' => $model->errors()]);
    //     }

    //     return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
    //         ->setJSON(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
    // }

    // public function api_get_unor_fkb($id_sumber = null)
    // {

    //     $model = new ApiFkbModel();
    //     $clientType = $this->request->client->type ?? 'unknown';
    //     if ($clientType === 'SDA') {
    //         // logika untuk sistem SDA
    //         $id_unor = "6";
    //     } elseif ($clientType === 'BM') {
    //         // logika untuk sistem BM
    //         $id_unor = "4";
    //     } elseif ($clientType === 'CK') {
    //         // logika untuk sistem CK
    //         $id_unor = "5";
    //     }
    //     if ($id_sumber) {
    //         $data = $model->where('id_unor', $id_unor)->where('id_sumber', $id_sumber)->findAll();
    //         if (!$data) {
    //             return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
    //                 ->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    //         }

    //         // return $this->response->setJSON(['data' => $id_unor]);
    //         return $this->response->setJSON(['status' => 'success', 'data' => $data]);
    //     }

    //     $allData =  $model->where('id_unor', $id_unor)->findAll();
    //     // return $this->response->setJSON(['data' => $id_unor]);
    //     return $this->response->setJSON(['status' => 'success', 'data' => $allData]);
    // }

    // public function api_get_unor_fkw($id_sumber = null)
    // {
    //     $model = new ApifkwModel();
    //     $clientType = $this->request->client->type ?? 'unknown';
    //     if ($clientType === 'SDA') {
    //         // logika untuk sistem SDA
    //         $id_unor = "6";
    //     } elseif ($clientType === 'BM') {
    //         // logika untuk sistem BM
    //         $id_unor = "4";
    //     } elseif ($clientType === 'CK') {
    //         // logika untuk sistem CK
    //         $id_unor = "5";
    //     }
    //     if ($id_sumber && $id_unor) {
    //         $data = $model->where('id_unor', $id_unor)->where('id_sumber', $id_sumber)->findAll();
    //         if (!$data) {
    //             return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
    //                 ->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    //         }

    //         // return $this->response->setJSON(['data' => $id_unor]);
    //         return $this->response->setJSON(['status' => 'success', 'data' => $data]);
    //     }

    //     $allData = $model->where('id_unor', $id_unor)->findAll();

    //     return $this->response->setJSON(['status' => 'success', 'data' => $allData]);
    // }

    // public function api_delete_unor_fkb($id_sumber)
    // {
    //     $model = new ApiFkbModel();
    //     $clientType = $this->request->client->type ?? 'unknown';
    //     if ($clientType === 'SDA') {
    //         // logika untuk sistem SDA
    //         $id_unor = "6";
    //     } elseif ($clientType === 'BM') {
    //         // logika untuk sistem BM
    //         $id_unor = "4";
    //     } elseif ($clientType === 'CK') {
    //         // logika untuk sistem CK
    //         $id_unor = "5";
    //     }
    //     $data = $model->where('id_unor', $id_unor)->where('id_sumber', $id_sumber)->findAll();

    //     if (!$data) {
    //         return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
    //             ->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    //     }

    //     if (!$model->where('id_unor', $id_unor)->where('id_sumber', $id_sumber)->delete()) {
    //         return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
    //             ->setJSON(['status' => 'error', 'message' => 'Gagal menghapus data']);
    //     }

    //     return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    // }

    // public function api_delete_unor_fkw($id_sumber)
    // {
    //     $model = new ApifkwModel();
    //     $clientType = $this->request->client->type ?? 'unknown';
    //     if ($clientType === 'SDA') {
    //         // logika untuk sistem SDA
    //         $id_unor = "6";
    //     } elseif ($clientType === 'BM') {
    //         // logika untuk sistem BM
    //         $id_unor = "4";
    //     } elseif ($clientType === 'CK') {
    //         // logika untuk sistem CK
    //         $id_unor = "5";
    //     }
    //     $data = $model->where('id_unor', $id_unor)->where('id_sumber', $id_sumber)->findAll();

    //     if (!$data) {
    //         return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
    //             ->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    //     }

    //     if (!$model->where('id_unor', $id_unor)->where('id_sumber', $id_sumber)->delete()) {
    //         return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
    //             ->setJSON(['status' => 'error', 'message' => 'Gagal menghapus data']);
    //     }

    //     return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    // }




    // public function importFromApiRakortek()
    // {
    //     helper('filesystem');

    //     $url = "https://sisdur.dit.krisna.systems/api/v1/selaras-tematik-usulan/2026?apikey=ce79901f-463b-4133-a77f-42e575b252d6";

    //     $response = file_get_contents($url);
    //     if ($response === false) {
    //         return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'Gagal mengambil data API']);
    //     }

    //     $data = json_decode($response, true);
    //     if (!$data || !isset($data['data'])) {
    //         return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => 'Format data tidak valid']);
    //     }

    //     $model = new ApiRakortekModel();
    //     $inserted = 0;

    //     foreach ($data['data'] as $item) {
    //         $model->insert([
    //             'provinsi'            => $item['provinsi'] ?? null,
    //             'tematik'             => $item['tematik'] ?? null,
    //             'pn'                  => $item['pn'] ?? null,
    //             'pp'                  => $item['pp'] ?? null,
    //             'kp'                  => $item['kp'] ?? null,
    //             'prop'                => $item['prop'] ?? null,
    //             'kementerian'         => $item['kementerian'] ?? null,
    //             'usulan'              => $item['usulan'] ?? null,
    //             'usulan_id'           => $item['usulan_id'] ?? null,
    //             'source_ro'           => $item['source_ro'] ?? null,
    //             'source_ro_id'        => $item['source_ro_id'] ?? null,
    //             'satuan'              => $item['satuan'] ?? null,
    //             'criterias_usulan'    => json_encode($item['criterias_usulan'] ?? []),
    //             'lokasi_usulan_ids'   => json_encode($item['lokasi_usulan_ids'] ?? []),
    //             'lokasi_rakortek_ids' => json_encode($item['lokasi_rakortek_ids'] ?? []),
    //             'volume_ro'           => $item['volume_ro'] ?? 0,
    //             'volume_usulan'       => $item['volume_usulan'] ?? 0,
    //             'volume_rakortek'     => $item['volume_rakortek'] ?? 0,
    //             'alokasi_usulan'      => $item['alokasi_usulan'] ?? 0,
    //             'alokasi_rakortek'    => $item['alokasi_rakortek'] ?? 0,
    //             'approval_rakortek'   => $item['approval_rakortek'] ?? null,
    //             'note_rakortek'       => $item['note_rakortek'] ?? null,
    //         ]);
    //         $inserted++;
    //     }

    //     return $this->response->setJSON([
    //         'status' => 'success',
    //         'message' => "Import selesai. Total data dimasukkan: $inserted"
    //     ]);
    // }

    public function get_unor_fkw($id_sumber = null)
    {
        $model = new fkwModel();
        $clientType = $this->request->client->type ?? 'unknown';
        if ($clientType === 'SDA') {
            // logika untuk sistem SDA
            $id_unor = "6";
        } elseif ($clientType === 'BM') {
            // logika untuk sistem BM
            $id_unor = "4";
        } elseif ($clientType === 'CK') {
            // logika untuk sistem CK
            $id_unor = "5";
        }
        if ($id_sumber && $id_unor) {
            $data = $model->where('id_unor', $id_unor)->where('id_sumber', $id_sumber)->findAll();
            if (!$data) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            }

            // return $this->response->setJSON(['data' => $id_unor]);
            return $this->response->setJSON(['status' => 'success', 'data' => $data]);
        }

        $allData = $model->where('id_unor', $id_unor)->findAll();

        return $this->response->setJSON(['status' => 'success', 'data' => $allData]);
    }

    public function get_unor_fkb($id_sumber = null)
    {

        $model = new FkbModel();
        $clientType = $this->request->client->type ?? 'unknown';
        if ($clientType === 'SDA') {
            // logika untuk sistem SDA
            $id_unor = "6";
        } elseif ($clientType === 'BM') {
            // logika untuk sistem BM
            $id_unor = "4";
        } elseif ($clientType === 'CK') {
            // logika untuk sistem CK
            $id_unor = "5";
        }
        if ($id_sumber) {
            $data = $model->where('id_unor', $id_unor)->where('id_sumber', $id_sumber)->findAll();
            if (!$data) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            }

            // return $this->response->setJSON(['data' => $id_unor]);
            return $this->response->setJSON(['status' => 'success', 'data' => $data]);
        }

        $allData =  $model->where('id_unor', $id_unor)->findAll();
        // return $this->response->setJSON(['data' => $id_unor]);
        return $this->response->setJSON(['status' => 'success', 'data' => $allData]);
    }
}
