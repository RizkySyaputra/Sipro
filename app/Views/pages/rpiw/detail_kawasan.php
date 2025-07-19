<div class="col-md-12">
    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-text">
                <?php foreach ($p_kawasan as $p_kawasan) : ?>
                    <h4 class="card-title">Detail <?= $p_kawasan->nama_kawasan; ?> </h4>
            </div>
        </div>
        <div class="card-body ">
            <form method="get" action="/" class="form-horizontal">
                <div class="row">
                    <label class="col-sm-2 col-form-label">Kode Kawasan</label>
                    <div class="col-sm-10">

                        <div class="form-group">
                            <input type="text" class="form-control" value="<?= $p_kawasan->kode_kawasan; ?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Provinsi</label>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?= $p_kawasan->provinsi; ?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Nama Kawasan</label>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?= $p_kawasan->nama_kawasan ?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Peta Kawasan</label>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div id="peta"></div>
                        </div>
                        <?php $longitude = $p_kawasan->longitude ?>
                        <?php $latitude = $p_kawasan->latitude ?>
                        <?php $peta = $p_kawasan->peta_kawasan;
                        $jsonkawasan = FCPATH . 'geoJson/' . $peta;
                        $petaKawasan = file_get_contents($jsonkawasan);
                        ?>
                    <?php endforeach ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi peta
        var latprov = <?= $latitude; ?>;
        var longprov = <?= $longitude; ?>;
        var peta = L.map('peta').setView([latprov, longprov], 9); // Set lat, long, dan zoom level

        // Tambahkan layer peta dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 30,
            attribution: '© OpenStreetMap'
        }).addTo(peta);

        // Memeriksa dan menginisialisasi geojsonData
        var geojsonData = <?= $petaKawasan; ?>;
        L.geoJSON(geojsonData).addTo(peta);
        geojsonLayer = L.geoJSON(geojsonData).addTo(peta);
        var bounds = geojsonLayer.getBounds();
        peta.fitBounds(bounds);
    });
</script>