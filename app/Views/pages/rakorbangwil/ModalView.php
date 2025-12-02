<style>
    .catatan-item {
        background-color: #f8f9fa;
        /* warna abu lembut */
        border-left: 4px solid #0d6efd;
        /* garis biru di kiri */
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 8px;
    }

    .catatan-nama {
        font-weight: 600;
        color: #0d6efd;
        margin-bottom: 4px;
    }

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
            <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i> Detail Program Tahunan</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <label class="catatan-text"><strong>ID Program Tahunan Program</strong></label>
                        <p><?= esc($prog_tahunan->id_prog_tahunan ?? '-') ?></p>

                        <label class="catatan-text"><strong>PN</strong></label>
                        <p><?= esc($prog_tahunan->id_pn . ' - ' . $prog_tahunan->nama_pn ?? ' - ') ?></p>
                        <label class="catatan-text"><strong>PP</strong></label>
                        <p><?= esc($prog_tahunan->id_pp . ' - ' . $prog_tahunan->nama_pp ?? ' - ') ?></p>
                        <label class="catatan-text"><strong>KP</strong></label>
                        <p><?= esc($prog_tahunan->id_kp . ' - ' . $prog_tahunan->nama_kp ?? ' - ') ?></p>
                        <label class="catatan-text"><strong>ProP</strong></label>
                        <p><?= esc($prog_tahunan->id_prop . ' - ' . $prog_tahunan->nama_prop ?? ' - ') ?></p>
                        <label class="catatan-text"><strong>Program</strong></label>
                        <p><?= esc($prog_tahunan->id_program . '-' . $prog_tahunan->nm_program ?? ' - ') ?></p>

                        <label class="catatan-text"><strong>Kegiatan</strong></label>
                        <p><?= esc($prog_tahunan->id_kegiatan . '-' . $prog_tahunan->nm_kegiatan ?? ' - ') ?></p>

                        <label class="catatan-text"><strong>KRO</strong></label>
                        <p><?= esc($prog_tahunan->id_kro . '-' . $prog_tahunan->nm_kro ?? ' - ') ?></p>

                        <label class="catatan-text"><strong>RO</strong></label>
                        <p><?= esc($prog_tahunan->id_ro . '-' . $prog_tahunan->nm_ro ?? ' - ') ?></p>

                        <label class="catatan-text"><strong>Pekerjaan</strong></label>
                        <p><?= esc($prog_tahunan->pekerjaan ?? '-') ?></p>

                        <label class="catatan-text"><strong>Unit Organisasi</strong></label>
                        <p><?= esc($prog_tahunan->unor ?? '-') ?></p>

                        <label class="catatan-text"><strong>Provinsi</strong></label>
                        <p><?= esc($prog_tahunan->provinsi ?? '-') ?></p>

                        <label class="catatan-text"><strong>Kawasan</strong></label>
                        <p><?= esc($prog_tahunan->kawasan ?? '-') ?></p>

                        <?php if (!empty($petaKawasan)): ?>
                            <div id="mapKawasanDetail"
                                style="height: 350px; width: 100%; border-radius:8px; margin-bottom: 15px; border:1px solid #ddd;">
                            </div>
                        <?php endif; ?>

                        <label class="catatan-text"><strong>Tematik</strong></label>
                        <p><?= esc($prog_tahunan->tematik ?? '-') ?></p>
                        <label class="catatan-text"><strong>Kab/kot</strong></label>
                        <p><?= esc($prog_tahunan->kabkot ?? '-') ?></p>

                        <!-- <label class="catatan-text"><strong>Kab/Kot</strong></label>
                        <?php if (!empty($kabkot)): ?>
                            <?php foreach ($kabkot as $item): ?>
                                <p><?= esc($item->kab_kot ?? '-') ?></p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>-</p>
                        <?php endif; ?> -->


                        <label class="catatan-text"><strong>Lokasi</strong></label>
                        <p><?= esc($prog_tahunan->lokasi ?? '-') ?></p>

                    </ul>
                </div>

                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <label class="catatan-text"><strong>Justifikasi</strong></label>
                        <p><?= esc($prog_tahunan->justifikasi ?? '-') ?></p>

                        <label class="catatan-text"><strong>Tahun Pelaksanaan</strong></label>
                        <p><?= esc($prog_tahunan->thn_pelaksanaan ?? '-') ?></p>


                        <label class="catatan-text"><strong>Sumber Pendanaan</strong></label>
                        <p><?= esc($prog_tahunan->sumber_pendanaan ?? '-') ?></p>

                        <label class="catatan-text"><strong>Anggaran (ribu)</strong></label>
                        <p>Rp. <?= number_format($prog_tahunan->anggaran, 0, ',', '.') ?></p>

                        <label class="catatan-text"><strong>Volume</strong></label>
                        <p><?= esc($prog_tahunan->volume . ' ' . $prog_tahunan->nama_satuan ?? '-') ?></p>

                        <label class="catatan-text"><strong>Geotagging</strong></label>
                        <p><?= esc($prog_tahunan->geotag ?? '-') ?></p>
                        <label class="catatan-text"><strong>Tipe Pekerjaan</strong></label>
                        <p><?= esc($prog_tahunan->tipe_pekerjaan ?? '-') ?></p>
                        <label class="catatan-text"><strong>Sumber Data</strong></label>
                        <p><?= esc($prog_tahunan->sumber ?? '-') ?></p>

                        <label class="catatan-text"><strong>KL terkait</strong></label>
                        <p><?= esc($prog_tahunan->kl ?? '-') ?></p>

                        <label class="catatan-text"><strong>Kebutuhan Dukungan KL</strong></label>
                        <p><?= esc($prog_tahunan->kebutuhan_dukungan_kl ?? '-') ?></p>

                        <label class="catatan-text"><strong>Catatan Pra Rakorbangwil</strong></label>
                        <p><?= esc($prog_tahunan->catatan_pra_rakorbangwil ?? '-') ?></p>
                        <label class="catatan-text"><strong>Kebutuhan Dukungan Pemda</strong></label>
                        <p><?= esc($prog_tahunan->catatan_konfrm_pemda ?? '-') ?></p>
                        <label class="catatan-text"><strong>Catatan Pemda</strong></label>
                        <p><?= esc($prog_tahunan->catatan_pemda ?? '-') ?></p>
                        <label class="catatan-text"><strong>Catatan Desk Rakorbangwil</strong></label>
                        <p><?= esc($prog_tahunan->catatan_desk_rakorbangwil ?? '-') ?></p>
                        <label class="catatan-text"><strong>Kesepakatan Rakorbangwil</strong></label>
                        <?php
                        $statusMap = [
                            "1" => "Diakomodir",
                            "2" => "Ditangguhkan",
                            "0" => "Belum dibahas"
                        ];

                        $val = $prog_tahunan->desk_rakorbangwil ?? '';

                        echo "<p>" . ($statusMap[$val] ?? "-") . "</p>";
                        ?>
                    </ul>
                </div>
                <div class="col-md-12">
                    <ul class="list-group list-group-flush">
                        <!-- <li class="list-group-item"> -->
                        <label class="catatan-text"><strong>Catatan Memorandum</strong></label>
                        <?php if (!empty($prog_tahunan->catatan_memorandum)): ?>
                            <?php
                            $catatanList = json_decode($prog_tahunan->catatan_memorandum, true);
                            ?>
                            <?php if (!empty($catatanList)): ?>
                                <div class="mt-2">
                                    <?php foreach ($catatanList as $item): ?>
                                        <div class="catatan-item">
                                            <div class="catatan-nama"><?= esc($item['nama']) ?>:</div>
                                            <p class="catatan-text"><?= esc($item['catatan']) ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-muted mt-1">-</div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="text-muted mt-1">-</div>
                        <?php endif; ?>
                        <!-- </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>


</div>
<script>
    (function() {
        // kalau tidak ada peta kawasan, jangan inisialisasi map
        const hasMap = <?= !empty($petaKawasan) ? 'true' : 'false' ?>;
        if (!hasMap) return;

        // pastikan Leaflet sudah ada (dipakai juga di edit)
        var mapKawasan = L.map('mapKawasanDetail').setView([-2.5, 118], 5);

        // basemap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18
        }).addTo(mapKawasan);

        // daftar file geojson kawasan dari PHP
        const kawasanFiles = <?= json_encode(
                                    array_map(fn($file) => base_url('geojson/' . $file), $petaKawasan)
                                ); ?>;

        const bounds = L.latLngBounds([]);

        kawasanFiles.forEach(url => {
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    const layer = L.geoJSON(data, {
                        style: {
                            color: "#2ecc71",
                            weight: 2,
                            fillColor: "#2ecc71",
                            fillOpacity: 0.25
                        }
                    }).addTo(mapKawasan);

                    bounds.extend(layer.getBounds());
                    mapKawasan.fitBounds(bounds);
                })
                .catch(err => console.error("Gagal load geojson kawasan:", err));
        });

        // untuk jaga-jaga kalau container awalnya sempit
        setTimeout(() => {
            mapKawasan.invalidateSize();
        }, 300);
    })();
</script>