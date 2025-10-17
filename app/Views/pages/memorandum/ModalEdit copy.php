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
    <input type="hidden" name="id_memorandum" value="<?= $memo->id_memorandum ?>">

    <div class="row g-3">
        <!-- Kolom kiri -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Nama Program</label>
                <input type="text" class="form-control" name="pekerjaan" value="<?= esc($memo->pekerjaan) ?>">
            </div>
            <div class="form-group">
                <label>Provinsi</label>
                <input type="text" class="form-control-plaintext" name="provinsi" value="<?= esc($memo->provinsi) ?>" disabled>
            </div>
            <div class="form-group">
                <label>Unit Organisasi</label>
                <input type="text" class="form-control-plaintext" name="unor" value="<?= esc($memo->unor) ?>" disabled>
            </div>
            <div class="form-group">
                <label>Kawasan Prioritas</label>
                <input type="text" class="form-control-plaintext" name="kawasan" value="<?= esc($memo->kawasan) ?>" disabled>
            </div>
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" class="form-control" name="lokasi" value="<?= esc($memo->lokasi) ?>">
            </div>
            <div class="form-group">
                <label>Justifikasi</label>
                <textarea class="form-control" name="justifikasi" rows="3"><?= esc($memo->justifikasi) ?></textarea>
            </div>
            <div class="form-group">
                <label>Sumber Pendanaan</label>
                <input type="text" class="form-control-plaintext" name="sumber" value="<?= esc($memo->sumber) ?>" disabled>
            </div>
            <div class="form-group">
                <label>Tahun Perencanaan (Periode)</label>
                <input type="text" class="form-control-plaintext" name="periode" value="<?= esc($memo->periode) ?>" disabled>
            </div>
            <div class="form-group">
                <label>Tahun Mulai</label>
                <input type="number" class="form-control" name="tahun_mulai" value="<?= esc($memo->tahun_mulai) ?>">
            </div>
            <div class="form-group">
                <label>Tahun Selesai</label>
                <input type="number" class="form-control" name="tahun_selesai" value="<?= esc($memo->tahun_selesai) ?>">
            </div>
        </div>

        <!-- Kolom kanan -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Satuan Volume</label>
                <input type="text" class="form-control-plaintext" name="nama_satuan" value="<?= esc($memo->nama_satuan) ?>" disabled>
            </div>

            <hr>
            <h6><i class="fas fa-cubes me-2"></i> Volume per Tahun</h6>
            <?php
            $tahunMulai   = (int) $memo->tahun_mulai;
            $tahunSelesai = (int) $memo->tahun_selesai;

            for ($tahun = $tahunMulai; $tahun <= $tahunSelesai; $tahun++):
                $index = $tahun - $tahunMulai + 1;
            ?>
                <div class="form-group">
                    <label>Volume <?= $tahun ?></label>
                    <input type="number" step="0.01" class="form-control"
                        name="volume_<?= $index ?>"
                        value="<?= esc($memo->{'volume_' . $index} ?? '') ?>">
                </div>
            <?php endfor; ?>

            <hr>
            <h6><i class="fas fa-coins me-2"></i> Anggaran per Tahun</h6>
            <?php
            for ($tahun = $tahunMulai; $tahun <= $tahunSelesai; $tahun++):
                $index = $tahun - $tahunMulai + 1;
                $nilaiAnggaran = $memo->{'anggaran_' . $index} ?? 0;
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
                <textarea class="form-control" name="catatan_memorandum" rows="3"><?= esc($memo->catatan_memorandum) ?></textarea>
            </div>
        </div>
    </div>

    <div class="text-end mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Simpan Perubahan
        </button>
    </div>
</form>