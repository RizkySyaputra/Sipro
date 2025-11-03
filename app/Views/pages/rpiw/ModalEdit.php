<style>
    input:disabled,
    textarea:disabled,
    select:disabled {
        background-color: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
        border: 1px solid #d1d1d1 !important;
    }

    input:not(:disabled),
    textarea:not(:disabled),
    select:not(:disabled) {
        border: 1px solid #000000ff !important;
        box-shadow: none !important;
        transition: border-color 0.2s ease-in-out;
    }

    input:not(:disabled):focus,
    textarea:not(:disabled):focus,
    select:not(:disabled):focus {
        border-color: #000000ff !important;
        box-shadow: 0 0 3px rgba(0, 123, 255, 0.3);
        outline: none;
    }

    input[readonly],
    textarea[readonly] {
        background-color: #f8f9fa;
        border: 1px solid #ccc;
        color: #6c757d;
    }

    .form-control,
    .form-select {
        border-radius: 6px;
        padding: 6px 10px;
    }

    .catatan-text {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        margin-bottom: 3px;
    }
</style>

<form id="editMemoForm">
    <?= csrf_field() ?>
    <input type="hidden" name="id_memorandum" value="<?= $data->id_renaksi ?>">

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-3">

                <!-- Kiri -->
                <div class="col-md-6">
                    <label class="catatan-text"><strong>ID Rencana Aksi</strong></label>
                    <p><?= esc($data->id_renaksi ?? '') ?></p>
                    <label class="catatan-text"><strong>Nama Program</strong></label>
                    <input type="text" class="form-control" name="pekerjaan" value="<?= esc($data->pekerjaan) ?>">

                    <label class="catatan-text"><strong>Provinsi</strong></label>
                    <p><?= esc($data->provinsi) ?></p>

                    <label class="catatan-text"><strong>Unit Organisasi</strong></label>
                    <p><?= esc($data->unor) ?></p>

                    <label class="catatan-text"><strong>Kawasan Prioritas</strong></label>
                    <p><?= esc($data->kawasan) ?></p>

                    <label class="catatan-text"><strong>Lokasi</strong></label>
                    <input type="text" class="form-control" name="lokasi" value="<?= esc($data->lokasi) ?>">

                    <label class="catatan-text"><strong>Justifikasi</strong></label>
                    <textarea class="form-control" name="justifikasi" rows="3"><?= esc($data->justifikasi) ?></textarea>

                    <label class="catatan-text"><strong>Volume</strong></label>
                    <input type="number" step="0.01" class="form-control" name="volume" value="<?= esc($data->volume) ?>">

                    <label class="catatan-text"><strong>Biaya</strong></label>
                    <input type="text" class="form-control anggaran-format" name="biaya" value="<?= esc($data->biaya) ?>">
                </div>

                <!-- Kanan -->
                <div class="col-md-6">

                    <label class="catatan-text"><strong>Sumber Pendanaan</strong></label>
                    <p><?= esc($data->sumber_pendanaan) ?></p>

                    <label class="catatan-text"><strong>Periode</strong></label>
                    <p><?= esc($data->periode) ?></p>

                    <label class="catatan-text"><strong>Tahun Mulai</strong></label>
                    <input type="number" class="form-control" name="tahun_mulai" value="<?= esc($data->tahun_mulai) ?>">

                    <label class="catatan-text"><strong>Tahun Selesai</strong></label>
                    <input type="number" class="form-control" name="tahun_selesai" value="<?= esc($data->tahun_selesai) ?>">
                </div>

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