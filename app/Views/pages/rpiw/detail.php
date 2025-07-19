<?php foreach ($p_rpiw as $p_rpiw) : ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 style="text-align: center;"> Detail Program </h4>
            </div>
            <div class="card-body">
                <!-- <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">ID Program</div>
                    <div class="col-sm-9"><?= $p_rpiw->id_program; ?></div>
                </div> -->
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Nama Program</div>
                    <div class="col-sm-9"><?= $p_rpiw->nama_program; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Provinsi</div>
                    <div class="col-sm-9"><?= $p_rpiw->provinsi; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Unit Organisasi</div>
                    <div class="col-sm-9"><?= $p_rpiw->unor; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Kawasan Prioritas</div>
                    <div class="col-sm-9">
                        <?php if (isset($kawasans)): ?>
                            <?php
                            $rows = count($kawasans);
                            if ($rows > 1) {
                                $i = 1;
                                $ii = '.';
                            } else {
                                $i = '';
                                $ii = '';
                            }
                            foreach ($kawasans as $kawasan) {
                                echo $i++ . $ii . $kawasan->nama_kawasan . '<br>';
                            }
                            ?>
                        <?php else: ?>
                            Non Kawasan
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Lokasi</div>
                    <div class="col-sm-9"><?= $p_rpiw->lokasi; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Justifikasi</div>
                    <div class="col-sm-9"><?= $p_rpiw->justifikasi; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Kesiapan RC</div>
                    <div class="col-sm-9"><?= $p_rpiw->kesiapan_rc; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Volume</div>
                    <div class="col-sm-9"><?= $p_rpiw->volume . ' ';
                                            echo $p_rpiw->nama_satuan; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Biaya (dalam ribu)</div>
                    <div class="col-sm-9"><?php $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                                            echo $format->formatCurrency($p_rpiw->biaya, 'IDR'); ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Sumber Pendanaan</div>
                    <div class="col-sm-9"><?= $p_rpiw->sumber_pendanaan; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Tahun Mulai</div>
                    <div class="col-sm-9"><?= $p_rpiw->tahun_mulai; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Tahun Selesai</div>
                    <div class="col-sm-9"><?= $p_rpiw->tahun_selesai; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Kategori</div>
                    <div class="col-sm-9"><?= $p_rpiw->nama_mp; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Peta Kawasan</div>
                    <div class="col-sm-9"><?php if ($peta_kawasan == true): ?>
                            <div id="peta"></div>
                        <?php elseif ($peta_kawasan == false) : ?>
                            <P>Peta Kawasan Belum Tersedia </P>
                            <!-- <form action="/Rpiw/upload_geojson" method="post" enctype="multipart/form-data">
                                <input type="file" name="geojson" accept=".geojson" required>
                                <button type="submit">Tambah Peta</button>
                            </form> -->
                            <div id="peta">
                            <?php else : ?>
                                <P>Non Kawasan </P>
                                <div id="peta">
                                <?php endif ?>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>


<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
<script src="https://unpkg.com/leaflet-measure/dist/leaflet-measure.js"></script>
<script>
    // Inisialisasi peta
    var latprov = <?= $latitude; ?>;
    var longprov = <?= $longitude; ?>;
    var peta = L.map('peta').setView([latprov, longprov], 9); // Set lat, long, dan zoom level

    // Tambahkan layer peta dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 30,
        attribution: '© OpenStreetMap'
    }).addTo(peta);
</script>
<?php if ($peta_kawasan) : ?>
    <script>
        // Memeriksa dan menginisialisasi geojsonData
        var geojsonData = <?= $peta_kawasan; ?>;

        L.geoJSON(geojsonData).addTo(peta);
        geojsonLayer = L.geoJSON(geojsonData).addTo(peta);
        var bounds = geojsonLayer.getBounds();
        peta.fitBounds(bounds);

        // untuk menampilkan list layer
        // var overlayMaps = {
        //     "Kawasan": L.geoJSON(geojsonData),
        //     "Program": L.geoJSON(geojsonData2)
        // };

        // L.control.layers(null, overlayMaps).addTo(peta);
    </script>
<?php endif ?>
<?php if ($peta_program) : ?>
    <script>
        var geojsonData2 = <?= $peta_program; ?>;
        L.geoJSON(geojsonData2).addTo(peta);
    </script>
<?php endif ?>