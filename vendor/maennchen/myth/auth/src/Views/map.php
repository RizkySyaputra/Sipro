<!DOCTYPE html>
<html>

<head>
    <title>Map View</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 600px;
        }
    </style>
</head>

<body>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        var map = L.map('map').setView([0, 0], 2);

        // Add tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Load GeoJSON data
        fetch('/map/getGeoJson')
            .then(response => response.json())
            .then(data => {
                L.geoJSON(data).addTo(map);
            })
            .catch(error => console.error('Error loading GeoJSON data:', error));
    </script>
</body>

</html>