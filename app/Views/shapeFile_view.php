<!DOCTYPE html>
<html>

<head>
    <title>Map with Leaflet</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #map {
            height: 600px;
        }
    </style>
</head>

<body>
    <div id="map"></div>
    <script>
        var map = L.map('map').setView([0, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        fetch('/shapefile')
            .then(response => response.json())
            .then(data => {
                L.geoJSON(data).addTo(map);
            });
    </script>
</body>

</html>