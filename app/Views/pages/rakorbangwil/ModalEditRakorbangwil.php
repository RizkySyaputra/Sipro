<style>
    /* fancy kesepakatan */
    .fancy-kesepakatan {
        font-size: 18px !important;
        padding: 14px 18px !important;
        border-radius: 10px !important;
        font-weight: bold;
        border: 2px solid #0d6efd !important;
        background: #f0f6ff !important;
    }

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
                    <label class="catatan-text"><strong>ID Program Tahunan Program</strong></label>
                    <p><?= esc($progTahunan->id_prog_tahunan ?? '-') ?></p>

                    <label class="catatan-text"><strong>PN</strong></label>
                    <p><?= esc($progTahunan->id_pn . ' - ' . $progTahunan->nama_pn ?? ' - ') ?></p>
                    <label class="catatan-text"><strong>PP</strong></label>
                    <p><?= esc($progTahunan->id_pp . ' - ' . $progTahunan->nama_pp ?? ' - ') ?></p>
                    <label class="catatan-text"><strong>KP</strong></label>
                    <p><?= esc($progTahunan->id_kp . ' - ' . $progTahunan->nama_kp ?? ' - ') ?></p>
                    <label class="catatan-text"><strong>ProP</strong></label>
                    <p><?= esc($progTahunan->id_prop . ' - ' . $progTahunan->nama_prop ?? ' - ') ?></p>
                    <label class="catatan-text"><strong>Program</strong></label>
                    <p><?= esc($progTahunan->id_program . '-' . $progTahunan->nm_program ?? ' - ') ?></p>

                    <div class="form-group">
                        <label class="catatan-text"><strong>Kegiatan</strong></label>
                        <select class="form-control" name="id_kegiatan" id="select-kegiatan">
                            <!-- <option value="<?= $progTahunan->id_kegiatan ?>">
                                <?= $progTahunan->id_kegiatan . ' - ' . $progTahunan->nm_kegiatan ?> -->
                            <?php foreach ($kegiatan as $item): ?>
                                <option value="<?= esc($item['id_kegiatan']) ?>"
                                    <?= ($progTahunan->id_kegiatan ?? '') == $item['id_kegiatan'] ? 'selected' : '' ?>>
                                    <?= esc($item['id_kegiatan'] . ' - ' . $item['nm_kegiatan']) ?>
                                </option>
                            <?php endforeach; ?>
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

                    <label class="catatan-text"><strong>Unit Organisasi</strong></label>
                    <p><?= esc($progTahunan->unor ?? '-') ?></p>

                    <label class="catatan-text"><strong>Provinsi</strong></label>
                    <p><?= esc($progTahunan->provinsi ?? '-') ?></p>

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
                    <label class="catatan-text"><strong>Tematik</strong></label>
                    <p><?= esc($progTahunan->tematik ?? '-') ?></p>
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
                    <label class="catatan-text"><strong>Justifikasi</strong></label>
                    <p><?= esc($progTahunan->justifikasi ?? '-') ?></p>

                    <label class="catatan-text"><strong>Tahun Pelaksanaan</strong></label>
                    <p><?= esc($progTahunan->thn_pelaksanaan ?? '-') ?></p>


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
                    <label class="catatan-text"><strong>Geotagging</strong></label>
                    <p><?= esc($progTahunan->geotag ?? '-') ?></p>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Tipe Pekerjaan</strong></label>
                        <select class="form-control" name="tipe_pekerjaan" id="select-tipe">

                            <!-- Selected Current Value -->
                            <option value="<?= esc($progTahunan->tipe_pekerjaan) ?>">
                                <?= esc($progTahunan->tipe_pekerjaan) ?>
                            </option>

                            <!-- Hide if same as current -->
                            <?php if ($progTahunan->tipe_pekerjaan !== 'FISIK'): ?>
                                <option value="FISIK">Fisik</option>
                            <?php endif; ?>

                            <?php if ($progTahunan->tipe_pekerjaan !== 'NON FISIK'): ?>
                                <option value="NON FISIK">Non Fisik</option>
                            <?php endif; ?>

                        </select>
                    </div>
                    <label class="catatan-text"><strong>Sumber Data</strong></label>
                    <p><?= esc($progTahunan->sumber ?? '-') ?></p>

                    <label class="catatan-text"><strong>K/L terkait</strong></label>
                    <p><?= esc($progTahunan->kl ?? '-') ?></p>

                    <label class="catatan-text"><strong>Kebutuhan Dukungan K/L</strong></label>
                    <p><?= esc($progTahunan->kebutuhan_dukungan_kl ?? '-') ?></p>

                    <label class="catatan-text"><strong>Catatan Pra Rakorbangwil</strong></label>
                    <p><?= esc($progTahunan->catatan_pra_rakorbangwil ?? '-') ?></p>
                    <label class="catatan-text"><strong>Kebutuhan Dukungan Pemda</strong></label>
                    <p><?= esc($progTahunan->catatan_konfrm_pemda ?? '-') ?></p>
                    <label class="catatan-text"><strong>Catatan Pemda</strong></label>
                    <p><?= esc($progTahunan->catatan_pemda ?? '-') ?></p>
                </ul>
            </div>

        </div>
    </div>
    <!-- Catatan Memorandum -->
    <div class="col-md-12">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
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
            </li>
        </ul>
    </div>
    <!-- ============================ -->
    <!-- BAGIAN CATATAN DESK RAKORBANGWIL -->
    <!-- ============================ -->

    <hr class="mt-4">

    <h6><i class="fas fa-comments me-2"></i><strong>Catatan Desk Rakorbangwil</strong></h6>

    <div id="deskWrapper">
        <?php
        $deskData = json_decode($progTahunan->catatan_desk_rakorbangwil ?? '[]', true);
        if (!$deskData) $deskData = [];
        foreach ($deskData as $item):
        ?>
            <div class="catatan-item mb-2">
                <select class="form-select nama-pencatat-desk" name="desk_nama[]">
                    <option value="">-- Pilih Pencatat --</option>
                    <?php foreach ($namaList as $nama): ?>
                        <option value="<?= esc($nama) ?>" <?= ($item['nama'] ?? '') === $nama ? 'selected' : '' ?>>
                            <?= esc($nama) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <textarea class="form-control mt-1" name="desk_text[]" rows="2"><?= esc($item['catatan'] ?? '') ?></textarea>

                <button type="button" class="btn btn-sm btn-danger mt-1 remove-desk">Hapus</button>
            </div>
        <?php endforeach; ?>
    </div>

    <button type="button" class="btn btn-sm btn-success mt-2" id="tambahDesk">
        <i class="fas fa-plus"></i> Tambah Catatan Desk
    </button>



    <!-- ============================ -->
    <!-- BAGIAN KESEPAKATAN -->
    <!-- ============================ -->

    <hr class="mt-4">

    <h6><i class="fas fa-handshake me-2"></i><strong>Kesepakatan</strong></h6>

    <select class="form-control form-control-lg fancy-kesepakatan"
        name="kesepakatan" id="select-kesepakatan">

        <?php foreach ($kesepakatan as $item): ?>
            <option value="<?= esc($item['id_kesepakatan']) ?>"
                <?= ($progTahunan->desk_rakorbangwil ?? '') == $item['id_kesepakatan'] ? 'selected' : '' ?>>
                <?= esc($item['kesepakatan']) ?>
            </option>
        <?php endforeach; ?>

    </select>




    <div class="text-end mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Simpan Perubahan
        </button>
    </div>
</form>
<script>
    // Hilangkan select2 dari kesepakatan (WAJIB)
    $('#select-tipe, #select-kegiatan, #select-kro, #select-ro, #select-pendanaan').select2();

    // ============================
    // DINAMIS: CATATAN DESK RAKORBANGWIL
    // ============================
    (function() {

        if (typeof window.namaList === "undefined") {
            window.namaList = <?= json_encode($namaList) ?>;
        }

        const deskWrapper = document.getElementById('deskWrapper');
        const tambahDesk = document.getElementById('tambahDesk');

        function createDeskItem(nama = "", catatan = "") {

            const div = document.createElement("div");
            div.classList.add("catatan-item", "mb-2");

            // select nama
            const select = document.createElement("select");
            select.classList.add("form-select", "nama-pencatat-desk");
            select.name = "desk_nama[]";

            let options = '<option value="">-- Pilih Nama --</option>';
            window.namaList.forEach(n => {
                options += `<option value="${n}" ${n===nama?'selected':''}>${n}</option>`;
            });
            select.innerHTML = options;

            // textarea catatan
            const textarea = document.createElement("textarea");
            textarea.classList.add("form-control", "mt-1");
            textarea.name = "desk_text[]";
            textarea.rows = 2;
            textarea.value = catatan;

            // tombol hapus
            const removeBtn = document.createElement("button");
            removeBtn.type = "button";
            removeBtn.classList.add("btn", "btn-sm", "btn-danger", "mt-1", "remove-desk");
            removeBtn.innerText = "Hapus";

            div.appendChild(select);
            div.appendChild(textarea);
            div.appendChild(removeBtn);

            deskWrapper.appendChild(div);

            // aktifkan select2
            $(select).select2({
                placeholder: "-- Pilih Nama --",
                width: "100%",
                allowClear: true
            });
        }

        // Tombol tambah desk
        tambahDesk.addEventListener("click", function() {
            createDeskItem();
        });

        // Tombol hapus desk
        $(document).on("click", ".remove-desk", function() {
            const parent = $(this).closest(".catatan-item");
            const sel = parent.find("select");
            if (sel.data("select2")) sel.select2("destroy");
            parent.remove();
        });

        // select2 untuk catatan desk lama
        $('.nama-pencatat-desk').select2({
            placeholder: "-- Pilih Nama --",
            width: '100%',
            allowClear: true
        });

    })();

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
    });
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