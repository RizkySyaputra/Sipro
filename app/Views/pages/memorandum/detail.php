<style>
        /* Menjamin textarea tidak memiliki scrollbar */
        .form-control-tes {
            resize: none;
            overflow: hidden;
            min-height: 60px;
        }
    </style>
<?php foreach ($p_rpiw as $p_rpiw) : ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-white" style="background-color: #222cb1;">
                <h4 style="text-align: center;">Form Input Memorandum Program</h4>
            </div>
            <div class="card-body">
                <form action="/add_memorandum" method="POST">
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> Program / Kegiatan</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="nama_program" class="form-control" value="<?= $p_rpiw->nama_program; ?>" required>
                            <input hidden type="text" name="id_program" class="form-control" value="<?= $p_rpiw->id_program; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Provinsi</strong></div>
                        <div class="col-sm-9">
                            <input type="hidden" name="id_provinsi" value="<?= $p_rpiw->id_provinsi; ?>" />
                            <input type="text" class="form-control" disabled value="<?= $p_rpiw->provinsi; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">

                        <div class="col-sm-3 font-weight-bold"><strong>Unit Organisasi</strong></div>
                        <div class="col-sm-9">
                            <input type="hidden" name="id_unor" value="<?= $p_rpiw->id_unor; ?>" />
                            <input type="text" disabled class="form-control" id="id_unor" value="<?= $p_rpiw->unor; ?>">
                            <!-- <span><?= $p_rpiw->unor; ?></span> -->
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Kawasan Prioritas</strong></div>
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
                                    echo ' <input type="text" disabled class="form-control" id="id_unor" value="' . $i++ . $ii . $kawasan->nama_kawasan . '">';
                                    // echo $i++ . $ii . $kawasan->nama_kawasan . '<br>';
                                }
                                ?>

                            <?php else: ?>
                                Non Kawasan
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Lokasi</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="lokasi" class="form-control" value="<?= $p_rpiw->lokasi; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Justifikasi</strong></div>
                        <div class="col-sm-9">
                            <textarea  name="justifikasi" class="form-control" required><?= $p_rpiw->justifikasi ?></textarea>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Kesiapan RC</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="kesiapan_rc" class="form-control" value="<?= $p_rpiw->kesiapan_rc; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Volume</strong></div>
                        <div class="col-sm-3 d-flex align-items-center">
                            <input type="text" id="volume" name="volume" class="form-control me-2" value="<?= $p_rpiw->volume; ?>" required>
                            <select name="id_satuan" id="list-satuan" class="form-control">
                                <option selected value="<?= $p_rpiw->id_satuan; ?>"><?= $p_rpiw->nama_satuan; ?></option>
                                <?php foreach ($satuan as $satuan) : ?>
                                    <?php if ($satuan["id_satuan"] == $p_rpiw->id_satuan) {
                                        continue;
                                    } ?>
                                    <option value="<?= $satuan["id_satuan"] ?>"><?= $satuan["nama_satuan"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Anggaran (dalam ribu)</strong></div>
                        <div class="col-sm-9">
                            <input type="text" id="biaya" name="biaya" class="form-control" value="<?= $p_rpiw->biaya; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Sumber Pendanaan</strong></div>
                        <div class="col-sm-9">
                            <select name="id_pendanaan" class="form-control" required>
                                <option value="1" <?= $p_rpiw->sumber_pendanaan == 'APBN' ? 'selected' : ''; ?>>APBN</option>
                                <option value="2" <?= $p_rpiw->sumber_pendanaan == 'APBD' ? 'selected' : ''; ?>>APBD</option>
                                <option value="3" <?= $p_rpiw->sumber_pendanaan == 'Swasta' ? 'selected' : ''; ?>>Swasta</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Major Project</strong> </div>
                        <div class="col-sm-9">
                        <select name="tagging_mp" id="list-mp" class="form-control">
                                <option selected value="<?= $p_rpiw->tagging_mp; ?>"><?= $p_rpiw->nama_mp; ?></option>
                                <?php foreach ($mp as $mp) : ?>
                                    <?php if ($mp["id_mp"] == $p_rpiw->tagging_mp) {
                                        continue;
                                    } ?>
                                    <option value="<?= $mp["id_mp"] ?>"><?= $mp["nama_mp"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                           
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Tahun Anggaran</strong></div>
                        <div class="col-sm-9">
                            <input type="hidden" name="tahun_anggaran" value="2026" />
                            <input type="text" class="form-control" disabled value="2026">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Peta Kawasan</strong></div>
                        <div class="col-sm-9"><?php if ($peta_kawasan == true): ?>
                                <div id="peta"></div>
                            <?php elseif ($peta_kawasan == false) : ?>
                                <P>Peta Kawasan Belum Tersedia </P>
                                <!-- 
                                //fitur menabmbahkan file geojson
                                <form action="/Rpiw/upload_geojson" method="post" enctype="multipart/form-data">
                                <input type="file" name="geojson" accept=".geojson" required>
                                <button type="submit">Tambah Peta</button>
                                </form> 
                                -->
                                <div id="peta">
                                <?php else : ?>
                                    <P>Non Kawasan </P>
                                    <div id="peta">
                                    <?php endif ?>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 text-center">

                            <button type="submit" class="btn filter" onclick='swal({ title:"Terima Kasih!", text: "Data Berhasil disimpan !", type: "success", buttonsStyling: false, confirmButtonClass: "btn btn-success"})'>Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php endforeach ?>


<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
<script src="https://unpkg.com/leaflet-measure/dist/leaflet-measure.js"></script>
<script>
    $(document).ready(function() {

        function autoResize(textarea) {
            textarea.style.height = "auto"; // Reset tinggi sebelum menyesuaikan
            textarea.style.height = (textarea.scrollHeight) + "px"; // Menyesuaikan tinggi dengan konten
        }
        

        $('#list-satuan').select2();
        // Inisialisasi peta
        var latprov = <?= $latitude; ?>;
        var longprov = <?= $longitude; ?>;
        var peta = L.map('peta').setView([latprov, longprov], 9); // Set lat, long, dan zoom level

        // Tambahkan layer peta dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 30,
            attribution: '© OpenStreetMap'
        }).addTo(peta);
        // Membuat object untuk menyimpan layer-layer geojson
        var overlayMaps = {};
        var combinedBounds = L.latLngBounds();
        // Menampilkan peta kawasan (jika ada)
        <?php if ($peta_kawasan) : ?>
            //
            <?php foreach ($peta_kawasan as $index => $geojsonData) : ?>
                // Masukkan data GeoJSON ke dalam layer
                var kawasanLayer = L.geoJSON(<?= $geojsonData; ?>).addTo(peta);

                // Menambahkan layer ini ke kontrol overlay
                overlayMaps["<?= $namaKawasan[$index]; ?>"] = kawasanLayer;
                var bounds = kawasanLayer.getBounds();
                combinedBounds.extend(bounds);
            <?php endforeach; ?>

            // Menyesuaikan batas peta berdasarkan kawasan pertama (optional)
            // var firstLayer = L.geoJSON(<?= $peta_kawasan[0]; ?>);
            // var bounds = firstLayer.getBounds();
            peta.fitBounds(combinedBounds);
        <?php endif ?>
        // Menambahkan kontrol layer untuk memilih lapisan peta
        L.control.layers(null, overlayMaps).addTo(peta);

        <?php if ($peta_program) : ?>

            var geojsonData2 = <?= $peta_program; ?>;
            L.geoJSON(geojsonData2).addTo(peta);
        <?php endif ?>

        function autoResize(textarea) {
            textarea.style.height = 'auto'; // Reset height
            textarea.style.height = textarea.scrollHeight + 'px'; // Set height to scroll height
        }

        const input = document.getElementById('volume');
        const input2 = document.getElementById('biaya');

        // Fungsi untuk memvalidasi input
        input.addEventListener('input', function(e) {
         // Hanya karakter yang diizinkan: angka (0-9) dan titik (.)
         const value = e.target.value;

         // Mengganti input dengan hanya angka dan titik
          e.target.value = value.replace(/[^0-9.]/g, '');
        });


        // Fungsi untuk memvalidasi input
        input2.addEventListener('input', function(e) {
       // Hanya karakter yang diizinkan: angka (0-9)
          const value = e.target.value;

          // Mengganti input dengan hanya angka dan titik
          e.target.value = value.replace(/[^0-9]/g, '');
});
    });
</script>