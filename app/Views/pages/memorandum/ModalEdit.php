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
</style>

<form id="editMemoForm">
    <?= csrf_field() ?>
    <input type="hidden" name="id_memorandum" value="<?= $memo->id_memorandum ?? '' ?>">

    <div class="row g-3">
        <!-- Kolom kiri -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Nama Program</label>
                <input type="text" class="form-control" name="pekerjaan" value="<?= esc($memo->pekerjaan ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Provinsi</label>
                <input type="text" class="form-control-plaintext" name="provinsi" value="<?= esc($memo->provinsi ?? '') ?>" disabled>
            </div>
            <div class="form-group">
                <label>Unit Organisasi</label>
                <input type="text" class="form-control-plaintext" name="unor" value="<?= esc($memo->unor ?? '') ?>" disabled>
            </div>
            <div class="form-group">
                <label>Kawasan Prioritas</label>
                <input type="text" class="form-control-plaintext" name="kawasan" value="<?= esc($memo->kawasan ?? '') ?>" disabled>
            </div>
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" class="form-control" name="lokasi" value="<?= esc($memo->lokasi ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Justifikasi</label>
                <textarea class="form-control" name="justifikasi" rows="3"><?= esc($memo->justifikasi ?? '') ?></textarea>
            </div>
            <div class="form-group">
                <label>Tahun Mulai</label>
                <input type="number" class="form-control" name="tahun_mulai" value="<?= esc($memo->tahun_mulai ?? '') ?>">
            </div>
            <div class="form-group">
                <label>Tahun Selesai</label>
                <input type="number" class="form-control" name="tahun_selesai" value="<?= esc($memo->tahun_selesai ?? '') ?>">
            </div>
        </div>

        <!-- Kolom kanan -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Satuan Volume</label>
                <input type="text" class="form-control-plaintext" name="nama_satuan" value="<?= esc($memo->nama_satuan ?? '') ?>" disabled>
            </div>

            <?php
            $tahunMulai   = isset($memo->tahun_mulai) ? (int)$memo->tahun_mulai : 0;
            $tahunSelesai = isset($memo->tahun_selesai) ? (int)$memo->tahun_selesai : 0;

            if ($tahunMulai && $tahunSelesai && $tahunSelesai >= $tahunMulai):
            ?>
                <hr>
                <h6><i class="fas fa-cubes me-2"></i> Volume per Tahun</h6>
                <?php for ($tahun = $tahunMulai; $tahun <= $tahunSelesai; $tahun++):
                    $index = $tahun - $tahunMulai + 1; ?>
                    <div class="form-group">
                        <label>Volume <?= $tahun ?></label>
                        <input type="number" step="0.01" class="form-control"
                            name="volume_<?= $index ?>"
                            value="<?= esc($memo->{'volume_' . $index} ?? '') ?>">
                    </div>
                <?php endfor; ?>

                <hr>
                <h6><i class="fas fa-coins me-2"></i> Anggaran per Tahun</h6>
                <?php for ($tahun = $tahunMulai; $tahun <= $tahunSelesai; $tahun++):
                    $index = $tahun - $tahunMulai + 1;
                    $nilaiAnggaran = $memo->{'anggaran_' . $index} ?? '';
                ?>
                    <div class="form-group">
                        <label>Anggaran <?= $tahun ?> (Rp)</label>
                        <input type="text" class="form-control anggaran-format"
                            name="anggaran_<?= $index ?>"
                            value="<?= $nilaiAnggaran ?>">
                    </div>
                <?php endfor; ?>
            <?php endif; ?>

            <hr>
            <h6><i class="fas fa-sticky-note me-2"></i> Catatan Memorandum</h6>
            <div id="catatanWrapper">
                <?php
                $catatanData = json_decode($memo->catatan_memorandum ?? '[]', true);
                if (!$catatanData) $catatanData = [];
                foreach ($catatanData as $item):
                ?>
                    <div class="catatan-item mb-2">
                        <select class="form-select nama-pencatat" name="catatan_nama[]">
                            <option value="">-- Pilih Nama --</option>
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

    <div class="text-end mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Simpan Perubahan
        </button>
    </div>
</form>
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
        $('.nama-pencatat').select2({
            placeholder: "-- Pilih Nama --",
            width: '100%',
            allowClear: true
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
        $('#editMemoForm').on('submit', function() {
            $('.anggaran-format').each(function() {
                let raw = $(this).val().replace(/\./g, '');
                $(this).val(raw);
            });
        });

    });
</script>