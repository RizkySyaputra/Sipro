<?php foreach ($p_memo as $p_memo) : ?>
    <div class="container mt-5">
        <div class="card">
            <form action="<?= base_url('add_nomenklatur') ?>" method="post" id="myForm">

                <input type="text" name="jenis" value="desk" hidden>
                <input type="text" name="id_mprogram" value="<?= $p_memo->id_mprogram; ?>" hidden>
                <input type="text" name="desk" value="<?= $p_memo->desk; ?>" hidden>
                <div class="card-header bg-primary text-white">
                    <h4 style="text-align: center;"> Detail Kegiatan </h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Nama Program</div>
                        <div class="col-sm-9">
                            <input type="text" name="nama_program" class="form-control" value="<?= $p_memo->nama_program; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Provinsi</div>
                        <div class="col-sm-9"><?= $p_memo->provinsi; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Unit Organisasi</div>
                        <div class="col-sm-9"><?= $p_memo->unor; ?></div>
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
                        <div class="col-sm-9"><?= $p_memo->lokasi; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Justifikasi</div>
                        <div class="col-sm-9"><?= $p_memo->justifikasi; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Kesiapan RC</div>
                        <div class="col-sm-9">
                            <input type="text" name="rc" class="form-control" value="<?= $p_memo->kesiapan_rc; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Volume</div>
                        <div class="col-sm-3 d-flex align-items-center">
                        <?= $p_memo->volume . ' ';
                        echo $p_memo->nama_satuan; ?>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Biaya (dalam ribu)</div>
                        <div class="col-sm-9">
                        <?= $p_memo->nama_mp; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Sumber Pendanaan</div>
                        <div class="col-sm-9">
                        <?= $p_memo->nama_mp; ?>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Kategori</div>
                        <div class="col-sm-9"><?= $p_memo->nama_mp; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Sumber Data</div>
                        <div class="col-sm-9"><?= $p_memo->source_data; ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Catatan BPIW</div>
                        <div class="col-sm-9">
                        <?= $p_memo->nama_mp; ?>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Catatan Unor</div>
                        <div class="col-sm-9">
                        <?= $p_memo->nama_mp; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Catatan Desk</div>
                        <div class="col-sm-9">
                        <?= $p_memo->nama_mp; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Kesepakatan</div>
                        <div class="col-sm-9"><?= $p_memo->nama_mp; ?>

                            </select>
                        </div>
                    </div>
                    <!-- <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Peta Kawasan</div>
                        <div class="col-sm-9"><?php if ($peta_kawasan == true): ?>
                                <div id="peta"></div>
                            <?php elseif ($peta_kawasan == false) : ?>
                                <P>Peta Kawasan Belum Tersedia </P>

                                <div id="peta">
                                <?php else : ?>
                                    <P>Non Kawasan </P>
                                    <div id="peta">
                                    <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center">

                                    <button type="submit" class="btn filter" onclick='swal({ title:"Terima Kasih!", text: "Data Berhasil disimpan !", type: "success", buttonsStyling: false, confirmButtonClass: "btn btn-success"})'>Simpan Catatan</button>
                                </div>
                        </div>
                    </div> -->
                </div>
        </div>
        </form>
    </div>
<?php endforeach ?>


<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<!-- <script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script> -->
<!-- <script src="https://unpkg.com/leaflet-measure/dist/leaflet-measure.js"></script> -->
<script>
    function validasiInput(e) {
        let value = e.target.value;

        // Hanya angka dan titik yang diizinkan
        value = value.replace(/[^0-9.]/g, '');

        // Menghindari lebih dari satu titik
        if ((value.match(/\./g) || []).length > 1) {
            value = value.replace(/\./g, '');
        }

        // Update nilai input
        e.target.value = value;
    }

    // Menambahkan event listener untuk input
    volume.addEventListener('input', validasiInput);

    function formatAngka(value) {
        // Menghapus semua karakter non-digit
        value = value.replace(/\D/g, '');

        // Memformat angka dengan pemisah ribuan (titik)
        return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Mendapatkan elemen input
    const input = document.getElementById('biaya');

    // Memformat value saat input dimuat
    input.value = formatAngka(input.value);

    // Event listener untuk memformat input saat pengguna mengetik
    input.addEventListener('input', function(e) {
        // Memformat angka setelah pengguna mengetik
        e.target.value = formatAngka(e.target.value);
    })
    // Sebelum form disubmit, hapus pemisah ribuan
    document.getElementById('myForm').addEventListener('submit', function(e) {
        // Menghapus titik (pemisah ribuan) sebelum mengirimkan nilai
        const biayaInput = document.getElementById('biaya');
        biayaInput.value = biayaInput.value.replace(/\./g, ''); // Hapus titik

        // Form akan dikirim dengan nilai yang sudah diubah
    });
    //peta
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
</script>
<?php if ($peta_program) : ?>
    <script>
        var geojsonData2 = <?= $peta_program; ?>;
        L.geoJSON(geojsonData2).addTo(peta);
    </script>
<?php endif ?>