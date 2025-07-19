<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LeafletDraw extends BaseController
{
    public function index()
    {
        $geojsonFile = FCPATH . 'geoJson/KP_Bedugul_DeliniasiFull.geojson';
        $geojsonFile2 = FCPATH . 'geoJson/Bali_KawasanPrioritas_All.geojson';
        $geojsonData = file_get_contents($geojsonFile);
        $geojsonData2 = file_get_contents($geojsonFile2);
        $data = [
            'peta1' => $geojsonData,
            'peta2' => $geojsonData2
        ];
        return view('leaflet_draw', $data);
    }
}
