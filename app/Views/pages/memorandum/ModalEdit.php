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

    /* Hilangkan ruang kosong (search box) di Select2 multiple yang tertutup */
    .select2-container--default .select2-search--inline .select2-search__field {
        width: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
        border: none !important;
    }

    /* Supaya tidak muncul input kosong di bawah pilihan */
    .select2-container--default .select2-selection--multiple {
        min-height: 10px;
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
</style>


<form id="editMemoForm">
    <?= csrf_field() ?>
    <input type="hidden" name="id_memorandum" value="<?= $memo->id_memorandum ?? '' ?>">

    <div class="card-body">
        <div class="row g-3">
            <!-- Kolom kiri -->
            <div class="col-md-6">
                <label class="catatan-text"><strong>ID Memorandum Program</strong></label>
                <p><?= esc($memo->id_memorandum ?? '') ?></p>
                <div class="form-group">
                    <label class="catatan-text"><strong>Program</strong></label>
                    <select class="form-control" name="id_program" id="select-program">
                        <option value="">Pilih Program</option>
                        <?php foreach ($program as $item): ?>
                            <option value="<?= esc($item['id_program']) ?>"
                                <?= ($memo->id_program ?? '') == $item['id_program'] ? 'selected' : '' ?>>
                                <?= esc($item['id_program'] . ' - ' . $item['nm_program']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="catatan-text"><strong>Kegiatan</strong></label>
                    <select class="form-control" name="id_kegiatan" id="select-kegiatan">
                        <option value="<?= $memo->id_kegiatan ?>">
                            <?= $memo->id_kegiatan . ' - ' . $memo->nm_kegiatan ?>
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="catatan-text"><strong>KRO</strong></label>
                    <select class="form-control" name="id_kro" id="select-kro">
                        <option value="<?= $memo->id_kro ?>">
                            <?= $memo->id_kro . ' - ' . $memo->nm_kro ?>
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="catatan-text"><strong>RO</strong></label>
                    <select class="form-control" name="id_ro" id="select-ro">
                        <option value="<?= $memo->id_ro ?>">
                            <?= $memo->id_ro . ' - ' . $memo->nm_ro ?>
                        </option>
                    </select>
                </div>

                <label class="catatan-text"><strong>Pekerjaan</strong></label>
                <input type="text" class="form-control" name="pekerjaan" value="<?= esc($memo->pekerjaan ?? '') ?>">

                <label class="catatan-text"><strong>Unit Organisasi</strong></label>
                <p><?= esc($memo->unor ?? '') ?></p>

                <label class="catatan-text"><strong>Provinsi</strong></label>
                <p><?= esc($memo->provinsi ?? '') ?></p>

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
                <label class="catatan-text"><strong>Lokasi</strong></label>
                <input type="text" class="form-control" name="lokasi" value="<?= esc($memo->lokasi ?? '') ?>">
                </ul>
            </div>

            <!-- Kolom kanan -->
            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <div class="form-group">
                        <label class="catatan-text"><strong>Satuan Volume</strong></label>
                        <input type="text" class="form-control-plaintext" name="nama_satuan"
                            value="<?= esc($memo->nama_satuan ?? '') ?>" disabled>
                        <input type="text" class="form-control-plaintext" name="id_satuan"
                            value="<?= esc($memo->id_satuan ?? '') ?>" hidden>
                    </div>
                    <label class="catatan-text"><strong>Justifikasi</strong></label>
                    <textarea class="form-control" name="justifikasi" rows="3"><?= esc($memo->justifikasi ?? '') ?></textarea>

                    <label class="catatan-text"><strong>Tahun Mulai</strong></label>
                    <input type="number" class="form-control" name="tahun_mulai" value="<?= esc($memo->tahun_mulai ?? '') ?>">

                    <label class="catatan-text"><strong>Tahun Selesai</strong></label>
                    <input type="number" class="form-control" name="tahun_selesai" value="<?= esc($memo->tahun_selesai ?? '') ?>">



                    <label class="mt-3 catatan-text"><strong>Geotagging</strong></label>
                    <input type="text" class="form-control" name="peta_kawasan" value="<?= esc($memo->peta_kawasan ?? '') ?>">

                    <label class="catatan-text"><strong>Sumber Data</strong></label>
                    <input type="text" class="form-control" name="sumber" value="<?= esc($memo->sumber ?? '') ?>">
                </ul>
            </div>

            <!-- Catatan Memorandum -->
            <div class="col-md-12">

                <?php
                $tahunMulai   = isset($memo->tahun_mulai) ? (int)$memo->tahun_mulai : 0;
                $tahunSelesai = isset($memo->tahun_selesai) ? (int)$memo->tahun_selesai : 0;

                if ($tahunMulai && $tahunSelesai && $tahunSelesai >= $tahunMulai):
                ?>
                    <div class="card shadow-sm mt-3">
                        <div class="card-header bg-light">
                            <strong><i class="fas fa-table me-2"></i> Volume, Anggaran, dan Pendanaan per Tahun</strong>
                        </div>
                        <div class="card-body p-2">
                            <table class="table table-sm table-bordered table-hover table-striped mb-0 align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th width="80">Tahun</th>
                                        <th>Volume</th>
                                        <th>Anggaran (Ribu)</th>
                                        <th>Pendanaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($tahun = $tahunMulai; $tahun <= $tahunSelesai; $tahun++):
                                        $index = $tahun - $tahunMulai + 1; ?>
                                        <tr>
                                            <td><?= $tahun ?></td>
                                            <td>
                                                <input type="number" step="0.01" class="form-control form-control-sm"
                                                    name="volume_<?= $index ?>"
                                                    value="<?= esc($memo->{'volume_' . $index} ?? '') ?>">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm anggaran-format"
                                                    name="anggaran_<?= $index ?>"
                                                    value="<?= esc($memo->{'anggaran_' . $index} ?? '') ?>">
                                            </td>
                                            <td>
                                                <select style="width: 100%;" class="form-control form-control-sm" name="id_pendanaan_<?= $index ?>" id="select-pendanaan<?= $index ?>">
                                                    <option value="<?= ($memo->{'id_pendanaan_' . $index} ?? '') ?>" selected><?= ($memo->{'pendanaan_' . $index} ?? '') ?></option>
                                                    <?php foreach ($pendanaan as $item): ?>
                                                        <?php if ($item['id_pendanaan'] == $memo->{'id_pendanaan_' . $index} ?? '') continue; ?>
                                                        <option value="<?= esc($item['id_pendanaan']) ?>"><?= esc($item['sumber_pendanaan']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
                <hr>

                <h6><i class="fas fa-sticky-note me-2 catatan-text"></i><strong> Catatan Memorandum</strong></h6>
                <div id="catatanWrapper">
                    <?php
                    $catatanData = json_decode($memo->catatan_memorandum ?? '[]', true);
                    if (!$catatanData) $catatanData = [];
                    foreach ($catatanData as $item):
                    ?>
                        <div class="catatan-item mb-2">
                            <select class="form-select nama-pencatat" name="catatan_nama[]">
                                <option value="">-- Pilih Pencatat --</option>
                                <?php foreach ($namaList as $nama): ?>
                                    <option value="<?= esc($nama) ?>" <?= ($item['nama'] ?? '') === $nama ? 'selected' : '' ?>>
                                        <?= esc($nama) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <textarea class="form-control mt-1" name="catatan_text[]" rows="2"><?= esc($item['catatan'] ?? '') ?></textarea>
                            <button type="button" class="btn btn-sm btn-danger mt-1 remove-catatan">Hapus</button>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="btn btn-sm btn-primary mt-2" id="tambahCatatan">Tambah Catatan</button>
            </div>
        </div>
    </div>


    <div class="text-end mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Simpan Perubahan
        </button>
    </div>
</form>

<script>
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
    $('#select-program, #select-kegiatan, #select-kro, #select-ro, #select-pendanaan1,#select-pendanaan2,#select-pendanaan3,#select-pendanaan4,#select-pendanaan5').select2();
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

            let options = '<option value="">-- Pilih Stakeholder --</option>';
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
            // Ambil posisi kursor
            let cursorPos = this.selectionStart;
            let val = $(this).val().replace(/\D/g, '');

            if (val) {
                $(this).val(new Intl.NumberFormat('id-ID').format(val));
            } else {
                $(this).val('');
            }

            // Kembalikan posisi kursor agar tidak lompat
            this.setSelectionRange(cursorPos, cursorPos);
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