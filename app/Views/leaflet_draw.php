<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaflet Draw Example</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw/dist/leaflet.draw.css" />
    <style>
        #map {
            height: 600px;
        }
    </style>
</head>

<body>
    <div id="map"></div>
    <button id="export">Ekspor ke GeoJSON</button>
    <pre id="geojson-output"></pre>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
    <script src="https://unpkg.com/leaflet-measure/dist/leaflet-measure.js"></script>
    <script>
        // Inisialisasi peta
        var map = L.map('map').setView([4.0405070151375, 96.649002928244], 8); // Set lat, long, dan zoom level

        // Tambahkan layer peta dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 30,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Data GeoJSON dari controller
        var geojsonData = <?= $peta1; ?>;
        var geojsonData2 = <?= $peta2; ?>;

        // Tambahkan data GeoJSON ke peta
        L.geoJSON(geojsonData).addTo(map);
        L.geoJSON(geojsonData2).addTo(map);
        // let geojsonData; // Variabel untuk menyimpan isi GeoJSON

        // // Mengambil file GeoJSON dari server
        // fetch('/geoJson/KP_Bedugul_DeliniasiFull.geojson')
        //     .then(response => {
        //         if (!response.ok) {
        //             throw new Error('Network response was not ok');
        //         }
        //         return response.json(); // Mengonversi response ke format JSON
        //     })
        //     .then(data => {
        //         geojsonData = data; // Menyimpan isi GeoJSON ke dalam variabel
        //         console.log('GeoJSON data:', geojsonData); // Menampilkan data GeoJSON di konsol
        //     })
        //     .catch(error => {
        //         console.error('Error loading GeoJSON:', error); // Menangani error
        //     });
        // var map = L.map('map').setView([-7.250445, 112.768845], 13);
        // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     maxZoom: 19,
        //     attribution: '© OpenStreetMap'
        // }).addTo(map);
        // L.geoJSON(geojsonData).addTo(map);
        // var anotherGeojsonData = {
        //     "type": "FeatureCollection",
        //     "features": [{
        //         "type": "Feature",
        //         "geometry": {
        //             "type": "Point",
        //             "coordinates": [112.766, -7.254]
        //         },
        //         "properties": {
        //             "name": "Titik Contoh"
        //         }
        //     }]
        // };

        // var polygonGeoJSON = {
        //     "type": "FeatureCollection",
        //     "features": [{
        //         "type": "Feature",
        //         "geometry": {
        //             "type": "Polygon",
        //             "coordinates": [
        //                 [
        //                     [112.764, -7.253],
        //                     [112.765, -7.253],
        //                     [112.765, -7.252],
        //                     [112.764, -7.252],
        //                     [112.764, -7.253]
        //                 ]
        //             ]
        //         },
        //         "properties": {
        //             "name": "Contoh Polygon"
        //         }
        //     }]
        // };


        // var overlayMaps = {
        //     "Polygon": L.geoJSON(polygonGeoJSON),
        //     "Titik": L.geoJSON(anotherGeojsonData),
        //     "file": L.geoJSON(fileGeojson)
        // };

        // L.control.layers(null, overlayMaps).addTo(map);



        // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     maxZoom: 19,
        // }).addTo(map);

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            edit: {
                featureGroup: drawnItems
            },
            draw: {
                polygon: true,
                polyline: true,
                rectangle: true,
                circle: true,
                marker: true
            }
        });
        map.addControl(drawControl);

        map.on(L.Draw.Event.CREATED, function(event) {
            var layer = event.layer;
            drawnItems.addLayer(layer);
        });

        // Fungsi untuk mengekspor GeoJSON
        document.getElementById('export').onclick = function() {
            var geojsonData = drawnItems.toGeoJSON();
            var geojsonString = JSON.stringify(geojsonData, null, 2);
            document.getElementById('geojson-output').textContent = geojsonString;

            // Jika ingin mendownload GeoJSON sebagai file
            var blob = new Blob([geojsonString], {
                type: 'application/json'
            });
            var url = URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = 'data.geojson';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        };
    </script>


</body>

</html>