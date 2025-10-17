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
        <div class="col-md-12">
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
                <label>Volume</label>
                <input type="number" step="0.01" class="form-control"
                    name="volume"
                    value="<?= esc($data->volume) ?>" <?= $data->nama_satuan ?>>
            </div>
            <div class="form-group">
                <label>Biaya</label>
                <input type="text" class="form-control" name="sumber" value="<?= esc($data->biaya) ?>">
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
    </div>

    <div class="text-end mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Simpan Perubahan
        </button>
    </div>
</form>