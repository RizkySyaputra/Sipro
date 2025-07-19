<?php

namespace App\Services;

use Shapefile\ShapefileReader;

class ShapefileService
{
    protected $shapefilePath;

    public function __construct($shapefilePath)
    {
        $this->shapefilePath = $shapefilePath;
    }

    public function getGeoJson()
    {
        $reader = new ShapefileReader($this->shapefilePath);
        $features = [];

        foreach ($reader as $feature) {
            $attributes = $feature['attributes'];
            $geometry = $feature['geometry'];

            $features[] = [
                'type' => 'Feature',
                'geometry' => $geometry,
                'properties' => $attributes
            ];
        }

        return [
            'type' => 'FeatureCollection',
            'features' => $features
        ];
    }
}
