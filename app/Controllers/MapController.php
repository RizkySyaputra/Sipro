<?php

namespace App\Controllers;

use Shapefile\ShapefileException;
use Shapefile\ShapefileReader;

class MapController extends BaseController
{
    public function index()
    {
        $Shapefile = new ShapefileReader('/Applications/MAMP/htdocs/sipro24/public/geoJson/KP_Gilimanuk_DesaTerdampak');
        $geoJson = $Shapefile->fetchRecord()->getGeoJSON();


        $geojsonFile = FCPATH . 'shp/KP_Bedugul_DeliniasiFull.geojson'; // Ganti dengan nama file GeoJSON kamu
        // Cek apakah file ada
        // if (!file_exists($geojsonFile)) {
        //     return view('errors/html/error_404'); // Tampilkan error 404 jika file tidak ditemukan
        // }

        // // Baca file GeoJSON
        // $geojsonData = file_get_contents($geojsonFile);

        return view('map', ['geojsonData' => $geojsonFile]);
    }
}
