<style>
    /* Warna abu-abu untuk field disabled */
    input:disabled,
    textarea:disabled,
    select:disabled {
        background-color: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
    }
</style>

<form id="editMemoForm">
    <?= csrf_field() ?>
    <input type="hidden" name="id_memorandum" value="<?= $data->id_renaksi ?>">

    <div class="row g-3">
        <!-- Kolom kiri -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Nama Program</label>
                <input type="text" class="form-control" name="pekerjaan" value="<?= esc($data->pekerjaan) ?>">
            </div>
            <div class="form-group">
                <label>Provinsi</label>
                <input type="text" class="form-control-plaintext" name="provinsi" value="<?= esc($data->provinsi) ?>" disabled>
            </div>
            <div class="form-group">
                <label>Unit Organisasi</label>
                <input type="text" class="form-control-plaintext" name="unor" value="<?= esc($data->unor) ?>" disabled>
            </div>
            <div class="form-group">
                <label>Kawasan Prioritas</label>
                <input type="text" class="form-control-plaintext" name="kawasan" value="<?= esc($data->kawasan) ?>" disabled>
            </div>
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" class="form-control" name="lokasi" value="<?= esc($data->lokasi) ?>">
            </div>
            <div class="form-group">
                <label>Justifikasi</label>
                <textarea class="form-control" name="justifikasi" rows="3"><?= esc($data->justifikasi) ?></textarea>
            </div>
            <div class="form-group">
                <label>Sumber Pendanaan</label>
                <input type="text" class="form-control-plaintext" name="sumber" value="<?= esc($data->sumber_pendanaan) ?>" disabled>
            </div>
            <div class="form-group">
                <label>Tahun Perencanaan (Periode)</label>
                <input type="text" class="form-control-plaintext" name="periode" value="<?= esc($data->periode) ?>" disabled>
            </div>
            <div class="form-group">
                <label>Tahun Mulai</label>
                <input type="number" class="form-control" name="tahun_mulai" value="<?= esc($data->tahun_mulai) ?>">
            </div>
            <div class="form-group">
                <label>Tahun Selesai</label>
                <input type="number" class="form-control" name="tahun_selesai" value="<?= esc($data->tahun_selesai) ?>">
            </div>
        </div>

        <!-- Kolom kanan -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Satuan Volume</label>
                <input type="text" class="form-control-plaintext" name="nama_satuan" value="<?= esc($data->nama_satuan) ?>" disabled>
            </div>

            <hr>
            <h6><i class="fas fa-cubes me-2"></i> Volume per Tahun</h6>
            <?php
            $tahunMulai   = (int) $data->tahun_mulai;
            $tahunSelesai = (int) $data->tahun_selesai;

            for ($tahun = $tahunMulai; $tahun <= $tahunSelesai; $tahun++):
                $index = $tahun - $tahunMulai + 1;
            ?>
                <div class="form-group">
                    <label>Volume <?= $tahun ?></label>
                    <input type="number" step="0.01" class="form-control"
                        name="volume_<?= $index ?>"
                        value="<?= esc($data->{'volume_' . $index} ?? '') ?>">
                </div>
            <?php endfor; ?>

            <hr>
            <h6><i class="fas fa-coins me-2"></i> Anggaran per Tahun</h6>
            <?php
            for ($tahun = $tahunMulai; $tahun <= $tahunSelesai; $tahun++):
                $index = $tahun - $tahunMulai + 1;
                $nilaiAnggaran = $data->{'anggaran_' . $index} ?? 0;
            ?>
                <div class="form-group">
                    <label>Anggaran <?= $tahun ?> (Rp)</label>
                    <input type="text" class="form-control anggaran-format"
                        name="anggaran_<?= $index ?>"
                        value="<?= $nilaiAnggaran ?>">
                </div>
            <?php endfor; ?>

            <hr>
            <div class="form-group">
                <label>Catatan Memorandum</label>
                <textarea class="form-control" name="catatan_memorandum" rows="3"></textarea>
            </div>
        </div>
    </div>

    <div class="text-end mt-3">
        <button type="submit" class="btn btn-warning">
            <i class="fas fa-plus me-1"></i> Input Memorandum
        </button>
    </div>
</form>