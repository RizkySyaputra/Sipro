<style>
    /* Hilangkan ruang kosong (search box) di Select2 multiple yang tertutup */
    .select2-container--default .select2-search--inline .select2-search__field {
        width: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
        border: none !important;
    }

    /* Supaya tidak muncul input kosong di bawah pilihan */
    .select2-container--default .select2-selection--multiple {
        min-height: 38px;
        /* sesuaikan tinggi agar pas */
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }

    /* Sedikit perbaikan visual agar tampilan rapi */
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        margin-top: 4px;
        margin-bottom: 4px;
    }

    /* Warna abu-abu untuk field disabled */
    input:disabled,
    textarea:disabled,
    select:disabled {
        background-color: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
    }

    .catatan-item {
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
    }

    .catatan-text {
        text-align: justify;
        color: #333;
        margin: 0;
        white-space: pre-line;
    }
</style>
<style>
    /* Warna abu-abu untuk field disabled */
    input:disabled,
    textarea:disabled,
    select:disabled {
        background-color: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
        border: 1px solid #d1d1d1 !important;
        /* tetap ada border halus */
    }

    /* Tambahkan border untuk semua input yang bisa diedit */
    input:not(:disabled),
    textarea:not(:disabled),
    select:not(:disabled) {
        border: 1px solid #000000ff !important;
        /* warna border biru */
        box-shadow: none !important;
        transition: border-color 0.2s ease-in-out;
    }

    /* Efek saat fokus (klik) */
    input:not(:disabled):focus,
    textarea:not(:disabled):focus,
    select:not(:disabled):focus {
        border-color: #000000ff !important;
        /* biru lebih gelap saat fokus */
        box-shadow: 0 0 3px rgba(0, 123, 255, 0.3);
        outline: none;
    }

    /* Agar field readonly tetap terlihat tapi tidak seperti editable */
    input[readonly],
    textarea[readonly] {
        background-color: #f8f9fa;
        border: 1px solid #ccc;
        color: #6c757d;
    }

    /* Style tambahan agar form tampak rapi */
    .form-control,
    .form-select {
        border-radius: 6px;
        padding: 6px 10px;
    }

    .catatan-item {
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
    }

    .catatan-text {
        text-align: justify;
        color: #333;
        margin: 0;
        white-space: pre-line;
    }
</style>


<form id="editMemoForm">
    <?= csrf_field() ?>
    <input type="hidden" name="id_prog_tahunan" value="<?= $progTahunan->id_prog_tahunan ?? '' ?>">

    <div class="card-body">
        <div class="row g-3">
            <!-- Kolom kiri -->
            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <div class="form-group">
                        <label class="catatan-text"><strong>ID Program Tahunan</strong></label>
                        <p><?= esc($progTahunan->id_prog_tahunan ?? '') ?></p>
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Program</strong></label>
                        <select class="form-control" name="id_program" id="select-program">
                            <option value="">Pilih Program</option>
                            <?php foreach ($program as $item): ?>
                                <option value="<?= esc($item['id_program']) ?>"
                                    <?= ($progTahunan->id_program ?? '') == $item['id_program'] ? 'selected' : '' ?>>
                                    <?= esc($item['id_program'] . ' - ' . $item['nm_program']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Kegiatan</strong></label>
                        <select class="form-control" name="id_kegiatan" id="select-kegiatan">
                            <option value="<?= $progTahunan->id_kegiatan ?>">
                                <?= $progTahunan->id_kegiatan . ' - ' . $progTahunan->nm_kegiatan ?>
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>KRO</strong></label>
                        <select class="form-control" name="id_kro" id="select-kro">
                            <option value="<?= $progTahunan->id_kro ?>">
                                <?= $progTahunan->id_kro . ' - ' . $progTahunan->nm_kro ?>
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>RO</strong></label>
                        <select class="form-control" name="id_ro" id="select-ro">
                            <option value="<?= $progTahunan->id_ro ?>">
                                <?= $progTahunan->id_ro . ' - ' . $progTahunan->nm_ro ?>
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Pekerjaan</strong></label>
                        <input type="text" class="form-control" name="pekerjaan" value="<?= esc($progTahunan->pekerjaan ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Unit Organisasi</strong></label>
                        <p><?= esc($progTahunan->unor ?? '') ?></p>
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Provinsi</strong></label>
                        <p><?= esc($progTahunan->provinsi ?? '') ?></p>
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Kawasan</strong></label>
                        <select class="form-control" name="kawasan[]" id="select-kawasan" multiple>
                            <?php foreach ($kawasan as $item): ?>
                                <!-- <option value="<?= $item['kode_kawasan'] ?>"><?= $item['nama_kawasan'] ?></option> -->
                                <option value="<?= $item['kode_kawasan'] ?>"
                                    <?= in_array($item['nama_kawasan'], $selectedKawasan) ? 'selected' : '' ?>>
                                    <?= esc($item['nama_kawasan']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted">Tekan <b>Ctrl</b> (atau <b>Cmd</b> di Mac) untuk memilih lebih dari satu.</small>
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Kabupaten / Kota</strong></label> <br>
                        <small class="text-muted">Tekan <b>Ctrl</b> (atau <b>Cmd</b> di Mac) untuk memilih lebih dari satu.</small>
                        <select class="form-control" name="kabkot[]" id="select-kabkot" multiple>
                            <?php foreach ($kabkot as $item): ?>
                                <option value="<?= $item['id'] ?>"
                                    <?= in_array($item['kab_kot'], $selectedKabkot) ? 'selected' : '' ?>>
                                    <?= esc($item['kab_kot']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Lokasi</strong></label>
                        <input type="text" class="form-control" name="lokasi" value="<?= esc($progTahunan->lokasi ?? '') ?>">
                    </div>
                </ul>
            </div>

            <!-- Kolom kanan -->
            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <div class="form-group">
                        <label class="catatan-text"><strong>Sumber Pendaan</strong></label>
                        <select style="width: 100%;" class="form-control form-control-sm" name="id_pendanaan" id="select-pendanaan">
                            <option value="<?= ($progTahunan->id_pendanaan ?? '') ?>" selected><?= ($progTahunan->sumber_pendanaan ?? '') ?></option>
                            <?php foreach ($pendanaan as $item): ?>
                                <?php if ($item['id_pendanaan'] == $progTahunan->id_pendanaan ?? '') continue; ?>
                                <option value="<?= esc($item['id_pendanaan']) ?>"><?= esc($item['sumber_pendanaan']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Anggaran(ribu)</strong></label>
                        <input type="text" class="form-control anggaran-format" name="anggaran" value="<?= esc($progTahunan->anggaran ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Satuan</strong></label>
                        <input type="text" class="form-control-plaintext" name="nama_satuan"
                            value="<?= esc($progTahunan->nama_satuan ?? '') ?>" disabled>
                        <input type="text" class="form-control-plaintext" name="id_satuan"
                            value="<?= esc($progTahunan->id_satuan ?? '') ?>" hidden>
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Volume</strong></label>
                        <input type="number" step="0.01" min="0" class="form-control form-control-sm"
                            name="volume"
                            value="<?= esc($progTahunan->volume ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Justifikasi</strong></label>
                        <textarea class="form-control" name="justifikasi" rows="3"><?= esc($progTahunan->justifikasi ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Tahun Pelaksanaan</strong></label>
                        <p><?= esc($progTahunan->thn_pelaksanaan ?? '') ?></p>
                        <input type="number" class="form-control" name="thn_pelaksanaan" value="<?= esc($progTahunan->thn_pelaksanaan ?? '') ?>" hidden>
                    </div>


                    <div class="form-group">
                        <label class="mt-3 catatan-text"><strong>Geotagging</strong></label>
                        <div class="input-group">
                            <p>Fitur Dalam Tahapan Pengembangan</p>
                            <!-- <textarea id="geotag" name="geotag" class="form-control" rows="2" readonly>
                            <?= esc($progTahunan->geotag ?? '') ?>
                            </textarea> -->

                            <!-- <button type="button" class="btn btn-success mt-2" id="btnOpenMap">
                            Pilih Lokasi di Peta
                        </button>
                            -->
                        </div>
                        <!-- <small class="text-muted">Klik tombol untuk memilih lokasi di peta.</small>  -->
                    </div>

                    <div class="form-group">
                        <label class="catatan-text"><strong>Sumber Data</strong></label>
                        <p><?= esc($progTahunan->sumber ?? '-') ?></p>
                        <input type="text" class="form-control" name="sumber" value="<?= esc($progTahunan->sumber ?? '-') ?>" hidden>
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Kebutuhan Dukungan KL</strong></label>
                        <textarea class="form-control" name="kebutuhan_dukungan_kl"><?= esc($progTahunan->kebutuhan_dukungan_kl ?? '-') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Reviu Puswil</strong></label>
                        <textarea class="form-control" name="reviu_puswil"><?= esc($progTahunan->reviu_puswil ?? '-') ?></textarea>
                    </div>
                </ul>
            </div>

        </div>
    </div>
    <!-- Catatan Memorandum -->
    <div class="col-md-12">

        <hr>

        <h6><i class="fas fa-sticky-note me-2 catatan-text"></i><strong> Catatan 2 memorandum</strong></h6>
        <div id="catatanWrapper">
            <?php
            $catatanData = json_decode($progTahunan->catatan_memorandum ?? '[]', true);
            if (!$catatanData) $catatanData = [];
            foreach ($catatanData as $item):
            ?>
                <div class="catatan-item mb-2">
                    <select class="form-select nama-pencatat" name="catatan_nama[]" disabled>
                        <option value="">-- Pilih Pencatat --</option>
                        <?php foreach ($namaList as $nama): ?>
                            <option value="<?= esc($nama) ?>" <?= ($item['nama'] ?? '') === $nama ? 'selected' : '' ?>>
                                <?= esc($nama) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <textarea readonly class="form-control mt-1" name="catatan_text[]" rows="2"><?= esc($item['catatan'] ?? '') ?></textarea>
                    <button type="button" class="btn btn-sm btn-danger mt-1 remove-catatan" hidden>Hapus</button>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="btn btn-sm btn-primary mt-2" id="tambahCatatan" hidden>Tambah Catatan</button>
    </div>


    <div class="text-end mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Simpan Perubahan
        </button>
    </div>
</form>

<!-- <div class="modal fade" id="modalMap" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Pilih Lokasi Geotag</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal">×</button>
            </div>
            <div class="modal-body" style="height: 450px;">
                <div id="mapSelect" style="height: 100%; width: 100%; border-radius:8px;"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div> -->

<!-- <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-draw@1.0.4/dist/leaflet.draw.css" />
<script src="https://cdn.jsdelivr.net/npm/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script> -->
<!-- Leaflet -->
<!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script> -->

<!-- Leaflet Draw -->
<!-- <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css" />
<script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script> -->
<script>
    // document.addEventListener("DOMContentLoaded", initMap);

    // $('#modalMap').on('hide.bs.modal', function() {
    //     // Hapus fokus dari peta atau elemen lain di dalam modal
    //     if (document.activeElement) {
    //         document.activeElement.blur();
    //     }
    // });

    // // === GEOTAGGING MAP (POINT / LINE / POLYGON) ===
    // var map, drawnItems, drawControl;
    // var savedGeo = document.getElementById('geotag').value;

    // function initMap() {
    //     map = L.map('mapSelect').setView([-2.5489, 118.0149], 5); // Indonesia center

    //     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //         maxZoom: 19
    //     }).addTo(map);

    //     // Layer tampung gambar
    //     drawnItems = new L.FeatureGroup();
    //     map.addLayer(drawnItems);

    //     // Jika sudah ada geotag tersimpan → gambarkan ulang
    //     if (savedGeo) {
    //         try {
    //             let geo = JSON.parse(savedGeo);
    //             let layer = L.geoJSON(geo).addTo(drawnItems);
    //             map.fitBounds(layer.getBounds());
    //         } catch (e) {
    //             console.log("GeoJSON tidak valid");
    //         }
    //     }

    //     // Toolbar draw control
    //     drawControl = new L.Control.Draw({
    //         edit: {
    //             featureGroup: drawnItems
    //         },
    //         draw: {
    //             polygon: true,
    //             polyline: true,
    //             rectangle: true,
    //             marker: true,
    //             circle: false
    //         }
    //     });
    //     map.addControl(drawControl);

    //     // Event saat menggambar baru
    //     map.on(L.Draw.Event.CREATED, function(e) {
    //         drawnItems.clearLayers(); // hanya simpan 1 objek
    //         drawnItems.addLayer(e.layer);
    //         saveGeo();
    //     });

    //     // Event edit/delete
    //     map.on(L.Draw.Event.EDITSTOP, saveGeo);
    //     map.on(L.Draw.Event.DELETED, saveGeo);
    // }

    // function saveGeo() {
    //     let geojson = drawnItems.toGeoJSON();
    //     document.getElementById('geotag').value = JSON.stringify(geojson);
    // }

    // document.getElementById('btnOpenMap').addEventListener('click', () => {
    //     $('#modalMap').modal('show');

    //     setTimeout(() => {
    //         if (!map) initMap();
    //         else map.invalidateSize();
    //     }, 300);
    // });


    $(document).ready(function() {
        // Saat pilih PROGRAM → ambil KEGIATAN
        $('#select-program').on('change', function() {
            const id_program = $(this).val();
            $('#select-kegiatan').html('<option value="">Loading...</option>');
            $('#select-kro').html('<option value="">Pilih KRO</option>');
            $('#select-ro').html('<option value="">Pilih RO</option>');

            if (id_program) {
                $.getJSON('<?= base_url("memorandum/getKegiatanByProgram") ?>/' + id_program, function(data) {
                    let options = '<option value="">Pilih Kegiatan</option>';
                    $.each(data, function(i, item) {
                        options += `<option value="${item.id_kegiatan}">${item.id_kegiatan} - ${item.nm_kegiatan}</option>`;
                    });
                    $('#select-kegiatan').html(options);
                });
            } else {
                $('#select-kegiatan').html('<option value="">Pilih Kegiatan</option>');
            }
        });

        // Saat pilih KEGIATAN → ambil KRO
        $('#select-kegiatan').on('change', function() {
            const id_kegiatan = $(this).val();
            $('#select-kro').html('<option value="">Loading...</option>');
            $('#select-ro').html('<option value="">Pilih RO</option>');

            if (id_kegiatan) {
                $.getJSON('<?= base_url("memorandum/getKroByKegiatan") ?>/' + id_kegiatan, function(data) {
                    let options = '<option value="">Pilih KRO</option>';
                    $.each(data, function(i, item) {
                        options += `<option value="${item.id_kro}">${item.id_kro} - ${item.nm_kro}</option>`;
                    });
                    $('#select-kro').html(options);
                });
            } else {
                $('#select-kro').html('<option value="">Pilih KRO</option>');
            }
        });

        // Saat pilih KRO → ambil RO
        $('#select-kro').on('change', function() {
            const id_kro = $(this).val();
            $('#select-ro').html('<option value="">Loading...</option>');

            if (id_kro) {
                $.getJSON('<?= base_url("memorandum/getRoByKro") ?>/' + id_kro, function(data) {
                    let options = '<option value="">Pilih RO</option>';
                    $.each(data, function(i, item) {
                        options += `<option value="${item.id_ro}">${item.id_ro} - ${item.nm_ro}</option>`;
                    });
                    $('#select-ro').html(options);
                });
            } else {
                $('#select-ro').html('<option value="">Pilih RO</option>');
            }
        });
    });

    $('#select-ro').on('change', function() {
        const id_ro = $(this).val();

        // Kosongkan dulu field satuan
        $('input[name="nama_satuan"]').val('');
        $('input[name="id_satuan"]').val('');

        if (id_ro) {
            $.getJSON('<?= base_url("memorandum/getSatuanByRo") ?>/' + id_ro)
                .done(function(data) {
                    if (data) {
                        $('input[name="nama_satuan"]').val(data.nama_satuan);
                        $('input[name="id_satuan"]').val(data.id_satuan);
                    } else {
                        $('input[name="nama_satuan"]').val('Tidak ditemukan');
                    }
                })
                .fail(function() {
                    $('input[name="nama_satuan"]').val('Gagal memuat data');
                });
        }
    });
</script>

<script>
    $('#select-program, #select-pendanaan, #select-kegiatan, #select-kro, #select-ro, #select-pendanaan1,#select-pendanaan2,#select-pendanaan3,#select-pendanaan4,#select-pendanaan5').select2();
    (function() {
        // Cek apakah namaList sudah ada, jika belum buat
        if (typeof window.namaList === 'undefined') {
            window.namaList = <?= json_encode($namaList) ?>;
        }

        const wrapper = document.getElementById('catatanWrapper');
        const tambahBtn = document.getElementById('tambahCatatan');

        // Fungsi untuk buat satu item catatan
        function createCatatanItem(nama = '', catatan = '') {
            const div = document.createElement('div');
            div.classList.add('catatan-item', 'mb-2');

            const select = document.createElement('select');
            select.classList.add('form-select', 'nama-pencatat');
            select.name = "catatan_nama[]";

            let options = '<option value="">-- Pilih Nama --</option>';
            window.namaList.forEach(n => {
                options += `<option value="${n}" ${n===nama?'selected':''}>${n}</option>`;
            });
            select.innerHTML = options;

            const textarea = document.createElement('textarea');
            textarea.classList.add('form-control', 'mt-1');
            textarea.name = "catatan_text[]";
            textarea.rows = 2;
            textarea.value = catatan;

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.classList.add('btn', 'btn-sm', 'btn-danger', 'mt-1', 'remove-catatan');
            removeBtn.innerText = 'Hapus';

            // removeBtn.addEventListener('click', () => {
            //     $(select).select2('destroy'); // destroy sebelum hapus
            //     div.remove();
            // });

            div.appendChild(select);
            div.appendChild(textarea);
            div.appendChild(removeBtn);

            wrapper.appendChild(div);

            // Inisialisasi Select2
            $(select).select2({
                placeholder: "-- Pilih Nama --",
                width: '100%',
                allowClear: true
            });
        }

        // Tambah catatan baru
        tambahBtn.addEventListener('click', () => {
            createCatatanItem();
        });
        // 🔹 Event delegation — tombol hapus catatan lama & baru
        $(document).on('click', '.remove-catatan', function() {
            const parentDiv = $(this).closest('.catatan-item');
            const select = parentDiv.find('select');
            if (select.data('select2')) {
                select.select2('destroy');
            }
            parentDiv.remove();
        });

        // Inisialisasi select2 untuk semua select lama
        $('.nama-pencatat').select2({
            placeholder: "-- Pilih Nama --",
            width: '100%',
            allowClear: true
        });

    })();

    $(document).ready(function() {
        $('#select-kabkot').select2({
            placeholder: "-- Pilih Kabupaten / Kota --",
            width: '100%',
            allowClear: true
        });
    });
    $(document).ready(function() {
        $('#select-kawasan').select2({
            placeholder: "-- Pilih Kawasan --",
            width: '100%',
            allowClear: true
        });
    });
    $(document).ready(function() {

        // 🔹 Format semua nilai awal saat halaman dimuat
        $('.anggaran-format').each(function() {
            let val = $(this).val().toString().replace(/\D/g, '');
            if (val) {
                $(this).val(new Intl.NumberFormat('id-ID').format(val));
            }
        });

        // 🔹 Format saat user mengetik
        $(document).on('input', '.anggaran-format', function() {
            let input = this;

            // Ambil angka saja
            let clean = input.value.replace(/[^\d]/g, "");

            // Format ribuan
            if (clean) {
                input.value = new Intl.NumberFormat('id-ID').format(clean);
            } else {
                input.value = "";
            }

            // Cursor selalu di akhir
            input.setSelectionRange(input.value.length, input.value.length);
        });





        // 🔹 Sebelum submit form, ubah jadi angka mentah tanpa titik
        $('#editMemoForm').on('submit', function() {
            $('.anggaran-format').each(function() {
                let raw = $(this).val().replace(/\./g, '');
                $(this).val(raw);
            });
        });

    });
</script>