<style>
    .catatan-text {
        text-align: justify;
        color: #333;
        margin: 0;
        white-space: pre-line;
    }
</style>
<div class="container-fluid">
    <!-- Detail Memorandum -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i> Detail Kawasan</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="mb-2">
                        <label class="catatan-text"><strong>Kode Kawasan</strong></label>
                        <p><?= esc($data[0]->kode_kawasan ?? '-') ?></p>
                    </div>

                    <div class="mb-2">
                        <label class="catatan-text"><strong>Kawasan</strong></label>
                        <p><?= esc($data[0]->nama_kawasan ?? '-') ?></p>
                    </div>

                    <div class="mb-2">
                        <label class="catatan-text"><strong>Provinsi</strong></label>
                        <p><?= esc($data[0]->provinsi ?? '-') ?></p>
                    </div>

                    <div class="mb-2">
                        <label class="catatan-text"><strong>Tematik</strong></label>
                        <p><?= esc($data[0]->tematik ?? '-') ?></p>
                    </div>


                    <div class="mb-2">
                        <label class="catatan-text"><strong>Peta Kawasan </strong></label>

                        <?php if (!empty($data[0]->peta_kawasan)): ?>
                            <div id="map" style="height: 400px; width: 100%; border-radius:10px;"></div>
                        <?php else: ?>
                            <p>-</p>
                        <?php endif; ?>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    <?php if (!empty($data[0]->peta_kawasan)): ?>
        fetch("<?= base_url('geoJson/' . $data[0]->peta_kawasan) ?>")
            .then(response => response.json())
            .then(geojson => {
                let map = L.map('map').setView([0, 120], 5);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 18
                }).addTo(map);

                let layer = L.geoJSON(geojson, {
                    style: {
                        color: 'red',
                        weight: 2,
                        fillColor: 'yellow',
                        fillOpacity: 0.5
                    }
                }).addTo(map);

                map.fitBounds(layer.getBounds());
            })
            .catch(err => console.error("Gagal load GeoJSON:", err));
    <?php endif; ?>
</script>