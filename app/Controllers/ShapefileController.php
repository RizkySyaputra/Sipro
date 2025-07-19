<?php

namespace App\Controllers;

use App\Services\ShapefileService;
use Config\Format;
use Shapefile\Shapefile;
use Shapefile\ShapefileException;
use Shapefile\ShapefileReader;

class ShapefileController extends BaseController
{
    public function showMap()
    {
        $Shapefile = new ShapefileReader('/Applications/MAMP/htdocs/sipro24/public/geoJson/KP_Bedugul_DeliniasiFull');
        $geoJson = $Shapefile->fetchRecord()->getGeoJSON();
        print_r($geoJson);
        // print_r($Shapefile->getShapeType(shapefile::FORMAT_STR));
        // Get Shape Type
        echo "Shape Type : ";
        echo $Shapefile->getShapeType() . " - " . $Shapefile->getShapeType(Shapefile::FORMAT_STR);
        echo "\n\n";

        // Get number of Records
        echo "Records : ";
        print_r($Shapefile->getTotRecords());
        echo "\n\n";

        // Get Bounding Box
        echo "Bounding Box : ";
        print_r($Shapefile->getBoundingBox());
        echo "\n\n";

        // Get PRJ
        echo "PRJ : ";
        print_r($Shapefile->getPRJ());
        echo "\n\n";

        // Get Charset
        echo "Charset : ";
        print_r($Shapefile->getCharset());
        echo "\n\n";

        // Get DBF Fields
        echo "DBF Fields : ";
        print_r($Shapefile->getFields());
        echo "\n\n";
        die;

        try {
            // Open Shapefile
            // Read all the records
            while ($Geometry = $Shapefile->fetchRecord()) {
                // Skip the record if marked as "deleted"
                if ($Geometry->isDeleted()) {
                    continue;
                }

                // Print Geometry as an Array
                // print_r($Geometry->getArray());

                // // Print Geometry as WKT
                // print_r($Geometry->getWKT());

                // Print Geometry as GeoJSON
                print_r($Geometry->getGeoJSON());

                // Print DBF data
                // print_r($Geometry->getDataArray());
            }
        } catch (ShapefileException $e) {
            // Print detailed error information
            echo "Error Type: " . $e->getErrorType()
                . "\nMessage: " . $e->getMessage()
                . "\nDetails: " . $e->getDetails();
        }
    }

    public function viewMap()
    {
        return view('shapefile_view');
    }
}
