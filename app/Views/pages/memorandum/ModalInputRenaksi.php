<style>
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

<form id="inputRenaksiForm">
    <?= csrf_field() ?>
    <input type="hidden" name="id_renaksi" value="<?= $data->id_renaksi ?? '' ?>">
    <!-- <input type="hidden" name="id_program" value="<?= $data->id_program ?? '' ?>">
    <input type="hidden" name="id_kegiatan" value="<?= $data->id_kegiatan ?? '' ?>">
    <input type="hidden" name="id_kro" value="<?= $data->id_kro ?? '' ?>">
    <input type="hidden" name="id_ro" value="<?= $data->id_ro ?? '' ?>"> -->

    <div class="row g-3">
        <!-- Kolom kiri -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="catatan-text"><strong>Id Renaksi</strong></label>
                <p><?= esc($data->id_renaksi ?? '') ?></p>
            </div>
            <!--  -->
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
                    <option value="">Pilih Kegiatan</option>
                    <!-- akan diisi lewat AJAX -->
                </select>
            </div>

            <div class="form-group">
                <label class="catatan-text"><strong>KRO</strong></label>
                <select class="form-control" name="id_kro" id="select-kro">
                    <option value="">Pilih KRO</option>
                    <!-- akan diisi lewat AJAX -->
                </select>
            </div>

            <div class="form-group">
                <label class="catatan-text"><strong>RO</strong></label>
                <select class="form-control" name="id_ro" id="select-ro">
                    <option value="">Pilih RO</option>
                    <!-- akan diisi lewat AJAX -->
                </select>
            </div>

            <div class="form-group">
                <label class="catatan-text"><strong>Nama Program</strong></label>
                <input type="text" class="form-control" name="periode" value="2025-2029" hidden>
                <input type="text" class="form-control" name="id_renaksi" value="<?= esc($data->id_renaksi ?? '') ?>" hidden>
                <input type="text" class="form-control" name="mp" value="<?= esc($data->mp ?? '') ?>" hidden>
                <input type="text" class="form-control" name="pekerjaan" value="<?= esc($data->pekerjaan ?? '') ?>">
            </div>
            <div class="form-group">
                <label class="catatan-text"><strong>Provinsi</strong></label>
                <input type="text" class="form-control-plaintext" name="provinsi" value="<?= esc($data->provinsi ?? '') ?>" disabled>
                <input type="text" class="form-control-plaintext" name="id_provinsi" value="<?= esc($data->id_provinsi ?? '') ?>" hidden>
            </div>

            <div class="form-group">
                <label class="catatan-text"><strong>Kabupaten / Kota</strong></label>
                <select class="form-control" name="kabkot[]" id="select-kabkot" multiple>
                    <?php foreach ($kabkot as $item): ?>
                        <!-- <option value="<?= $item['id'] ?>"><?= $item['kab_kot'] ?></option> -->
                        <option value="<?= $item['id'] ?>"
                            <?= in_array($item['id'], (array)($data->kabkot ?? [])) ? 'selected' : '' ?>>
                            <?= esc($item['kab_kot']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <small class="text-muted">Tekan <b>Ctrl</b> (atau <b>Cmd</b> di Mac) untuk memilih lebih dari satu.</small>
            </div>



            <div class="form-group">
                <label class="catatan-text"><strong>Unit Organisasi</strong></label>
                <input type="text" class="form-control-plaintext" name="unor" value="<?= esc($data->unor ?? '') ?>" disabled>
                <input type="text" class="form-control-plaintext" name="id_unor" value="<?= esc($data->id_unor ?? '') ?>" hidden>
            </div>
            <div class="form-group">
                <label class="catatan-text"><strong>kawasan</strong></label>
                <select class="form-control" name="kawasan[]" id="select-kawasan" multiple>
                    <?php foreach ($kawasan as $item): ?>
                        <!-- <option value="<?= $item['kode_kawasan'] ?>"><?= $item['nama_kawasan'] ?></option> -->
                        <option value="<?= $item['kode_kawasan'] ?>"
                            <?= in_array($item['kode_kawasan'], (array)($data->kawasan ?? [])) ? 'selected' : '' ?>>
                            <?= esc($item['nama_kawasan']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <small class="text-muted">Tekan <b>Ctrl</b> (atau <b>Cmd</b> di Mac) untuk memilih lebih dari satu.</small>
            </div>
            <!-- <div class="form-group">
                <label class="catatan-text"><strong>Kawasan Prioritas</strong></label>
                <input type="text" class="form-control-plaintext" name="kawasan" value="<?= esc($data->kawasan ?? '') ?>" disabled>
            </div> -->
            <div class="form-group">
                <label class="catatan-text"><strong>Lokasi</strong></label>
                <input type="text" class="form-control" name="lokasi" value="<?= esc($data->lokasi ?? '') ?>">
            </div>
            <div class="form-group">
                <label class="catatan-text"><strong>Justifikasi</strong></label>
                <textarea class="form-control" name="justifikasi" rows="3"><?= esc($data->justifikasi ?? '') ?></textarea>
            </div>
            <div class="form-group">
                <label class="catatan-text"><strong>Tahun Mulai</strong></label>
                <input type="number" class="form-control" name="tahun_mulai" value="<?= esc($data->tahun_mulai ?? '') ?>">
            </div>
            <div class="form-group">
                <label class="catatan-text"><strong>Tahun Selesai</strong></label>
                <input type="number" class="form-control" name="tahun_selesai" value="<?= esc($data->tahun_selesai ?? '') ?>">
            </div>
        </div>

        <!-- Kolom kanan -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="catatan-text"><strong>Satuan Volume</strong></label>
                <input type="text" class="form-control-plaintext" name="nama_satuan" value="<?= esc($data->nama_satuan ?? '') ?>" disabled>
                <input type="text" class="form-control-plaintext" name="id_satuan" value="<?= esc($data->id_satuan ?? '') ?>" hidden>
            </div>
            <div class="mb-2">
                <label class="catatan-text"><strong>Anggaran RPIW(ribu)</strong></label>
                <p>Rp. <?= number_format($data->biaya, 0, ',', '.') ?> </p>
            </div>

            <?php
            $tahunMulai   = isset($data->tahun_mulai) ? (int)$data->tahun_mulai : 0;
            $tahunSelesai = isset($data->tahun_selesai) ? (int)$data->tahun_selesai : 0;

            if ($tahunMulai && $tahunSelesai && $tahunSelesai >= $tahunMulai):
            ?>
                <hr>
                <h6><label class="catatan-text"><strong> Volume per Tahun</strong></h6>
                <?php for ($tahun = $tahunMulai; $tahun <= $tahunSelesai; $tahun++):
                    $index = $tahun - $tahunMulai + 1; ?>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Volume <?= $tahun ?></strong></label>
                        <input type="number" step="0.01" class="form-control"
                            name="volume_<?= $index ?>"
                            value="<?= esc($data->{'volume_' . $index} ?? '') ?>">
                    </div>
                <?php endfor; ?>

                <hr>
                <h6><i class="fas fa-coins me-2"></i> Anggaran per Tahun</h6>
                <?php for ($tahun = $tahunMulai; $tahun <= $tahunSelesai; $tahun++):
                    $index = $tahun - $tahunMulai + 1;
                    $nilaiAnggaran = $data->{'anggaran_' . $index} ?? '';
                ?>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Sumber Pendanaan</strong></label>
                        <select class="form-control" name="id_pendanaan_<?= $index ?>" id="select-pendanaan<?= $index ?>">
                            <option value="">Pilih Sumber</option>
                            <?php foreach ($pendanaan as $item): ?>
                                <option value="<?= $item['id_pendanaan'] ?>"><?= $item['sumber_pendanaan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="catatan-text"><strong>Anggaran <?= $tahun ?> (Rp) </strong></label>
                        <input type="text" class="form-control anggaran-format"
                            name="anggaran_<?= $index ?>"
                            value="<?= $nilaiAnggaran ?>">
                    </div>

                <?php endfor; ?>
            <?php endif; ?>

        </div>
    </div>
    <div class="col-md-12">
        <hr>
        <h6><i class="fas fa-sticky-note me-2"></i> Catatan Memorandum</h6>
        <div id="catatanWrapper">
            <?php
            $catatanData = json_decode($data->catatan_memorandum ?? '[]', true);
            if (!$catatanData) $catatanData = [];
            foreach ($catatanData as $item):
            ?>
                <div class="catatan-item mb-2">
                    <select class="form-select nama-pencatat" name="catatan_nama[]">
                        <option value="">-- Pilih Pencatat --</option>
                        <?php foreach ($namaList as $nama): ?>
                            <option value="<?= esc($nama['short_stakeholder']) ?>" <?= ($item['nama'] ?? '') === $nama['short_stakeholder'] ? 'selected' : '' ?>>
                                <?= esc($nama['short_stakeholder']) ?>
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
    <div class="text-end mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Input Sebagai Memorandum
        </button>
    </div>
</form>
<script>
    $(document).ready(function() {
        // Helper untuk reset dropdown
        function resetDropdown(selector, placeholder = 'Pilih...') {
            $(selector).html(`<option value="">${placeholder}</option>`);
        }

        // Helper untuk tampilkan "Loading..." saat ambil data
        function showLoading(selector) {
            $(selector).html('<option value="">Loading...</option>');
        }

        // Saat memilih PROGRAM → ambil KEGIATAN
        $('#select-program').on('change', function() {
            const id_program = $(this).val();
            resetDropdown('#select-kegiatan', 'Pilih Kegiatan');
            resetDropdown('#select-kro', 'Pilih KRO');
            resetDropdown('#select-ro', 'Pilih RO');

            if (id_program) {
                showLoading('#select-kegiatan'); // tampilkan loading
                $.getJSON('<?= base_url("memorandum/getKegiatanByProgram") ?>/' + id_program)
                    .done(function(data) {
                        let options = '<option value="">Pilih Kegiatan</option>';
                        $.each(data, function(i, item) {
                            options += `<option value="${item.id_kegiatan}">${item.id_kegiatan} - ${item.nm_kegiatan}</option>`;
                        });
                        $('#select-kegiatan').html(options);
                    })
                    .fail(function() {
                        $('#select-kegiatan').html('<option value="">Gagal memuat data</option>');
                    });
            }
        });

        // Saat memilih KEGIATAN → ambil KRO
        $('#select-kegiatan').on('change', function() {
            const id_kegiatan = $(this).val();
            resetDropdown('#select-kro', 'Pilih KRO');
            resetDropdown('#select-ro', 'Pilih RO');

            if (id_kegiatan) {
                showLoading('#select-kro');
                $.getJSON('<?= base_url("memorandum/getKroByKegiatan") ?>/' + id_kegiatan)
                    .done(function(data) {
                        let options = '<option value="">Pilih KRO</option>';
                        $.each(data, function(i, item) {
                            options += `<option value="${item.id_kro}">${item.id_kro} - ${item.nm_kro}</option>`;
                        });
                        $('#select-kro').html(options);
                    })
                    .fail(function() {
                        $('#select-kro').html('<option value="">Gagal memuat data</option>');
                    });
            }
        });

        // Saat memilih KRO → ambil RO
        $('#select-kro').on('change', function() {
            const id_kro = $(this).val();
            resetDropdown('#select-ro', 'Pilih RO');

            if (id_kro) {
                showLoading('#select-ro');
                $.getJSON('<?= base_url("memorandum/getRoByKro") ?>/' + id_kro)
                    .done(function(data) {
                        let options = '<option value="">Pilih RO</option>';
                        $.each(data, function(i, item) {
                            options += `<option value="${item.id_ro}">${item.id_ro} - ${item.nm_ro}</option>`;
                        });
                        $('#select-ro').html(options);
                    })
                    .fail(function() {
                        $('#select-ro').html('<option value="">Gagal memuat data</option>');
                    });
            }
        });

        // Kosongkan dropdown turunan saat awal load
        resetDropdown('#select-kegiatan', 'Pilih Kegiatan');
        resetDropdown('#select-kro', 'Pilih KRO');
        resetDropdown('#select-ro', 'Pilih RO');
    });
</script>


<script>
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
        $('.nama-pencatat').select2();
        $('#select-program, #select-kegiatan, #select-kro, #select-ro, #select-pendanaan1,#select-pendanaan2,#select-pendanaan3,#select-pendanaan4,#select-pendanaan5').select2();
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
    })();


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
        $('#inputRenaksiForm').on('submit', function() {
            $('.anggaran-format').each(function() {
                let raw = $(this).val().replace(/\./g, '');
                $(this).val(raw);
            });
        });

    });
</script>