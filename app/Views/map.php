<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta dengan OpenLayers</title>
    <link rel="stylesheet" href="https://openlayers.org/en/latest/css/ol.css">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #map {
            width: 100%;
            height: 100vh;
        }
    </style>
</head>

<body>

    <div id="map"></div>

    <script src="https://openlayers.org/en/latest/build/ol.js"></script>
    <script>
        // Ambil data GeoJSON dari variabel PHP
        const geoJsonData = <?php echo $geojsonData; ?>;

        // Buat peta
        const map = new ol.Map({
            target: 'map',
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM()
                }),
                new ol.layer.Vector({
                    source: new ol.source.Vector({
                        features: new ol.format.GeoJSON().readFeatures(geoJsonData, {
                            dataProjection: 'EPSG:4326', // Proyeksi data GeoJSON
                            featureProjection: 'EPSG:3857' // Proyeksi peta
                        })
                    })
                })
            ],
            view: new ol.View({
                center: ol.proj.fromLonLat([112.765, -7.255]),
                zoom: 13
            })
        });
    </script>

</body>

</html>