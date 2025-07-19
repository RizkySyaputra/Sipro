<?php

namespace App\Controllers;

use Shapefile\ShapefileReader;
use Shapefile\ShapefileException;

class ShpController extends BaseController
{
    public function index()
    {
        $shpFile = FCPATH . 'shp/Bali_KawasanPrioritas_All.shps.shp'; // Ganti dengan path file SHP kamu
        // d(is_readable($shpFile));
        // d(is_writable($shpFile));
        // d(file_exists($shpFile));
        // die;
        // Cek apakah file ada dan dapat dibaca
        if (!file_exists($shpFile) || !is_readable($shpFile)) {
            return "File tidak ditemukan atau tidak dapat dibaca: " . $shpFile;
        }

        try {
            $reader = new ShapefileReader($shpFile);
            $features = [];

            foreach ($reader as $shape) {
                $features[] = [
                    'geometry' => $shape->getGeometry()->getCoordinates(),
                    'attributes' => $shape->getAttributes()
                ];
            }

            return view('map', ['features' => $features]);
        } catch (ShapefileException $e) {
            return "Terjadi kesalahan saat membuka file SHP: " . $e->getMessage();
        }
    }
}
