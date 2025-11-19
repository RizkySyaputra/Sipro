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


<form id="editMemoForm" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="text" name="id_pejabat" value="<?= $pejabat[0]->id_pejabat ?>" hidden>

    <div class="card-body">
        <div class="row g-3">
            <!-- Kolom kiri -->
            <div class="col-md-6">
                <label class="catatan-text"><strong>ID Pejabat</strong></label>
                <p><?= esc($pejabat[0]->id_pejabat  ?? '') ?></p>
                <div class="form-group">
                    <label class="catatan-text"><strong>NIP</strong></label>
                    <input type="text" name="nip" class="form-control" value="<?= $pejabat[0]->nip ?>">
                </div>

                <div class="form-group">
                    <label class="catatan-text"><strong>Nama Pejabat</strong></label>
                    <input type="text" name="nama_pejabat" class="form-control" value="<?= $pejabat[0]->nama_pejabat ?>">
                </div>

                <div class="form-group">
                    <label class="catatan-text"><strong>Jabatan</strong></label>
                    <input type="text" name="jabatan" class="form-control" value="<?= $pejabat[0]->jabatan ?>">
                </div>

                <div class="form-group">
                    <label class="catatan-text"><strong>Unit Kerja</strong></label>
                    <input type="text" name="unit_kerja" class="form-control" value="<?= $pejabat[0]->unit_kerja ?>">
                </div>
                <label class="catatan-text"><strong>Unor</strong></label>
                <input type="text" name="unit_organisasi" class="form-control" value="<?= esc($pejabat[0]->unit_organisasi ?? '')  ?>">
            </div>
            <div class="col-md-6">
                <label class="catatan-text"><strong>Instansi</strong></label>
                <input type="text" name="instansi" class="form-control" value="<?= $pejabat[0]->instansi ?>">
                <label class="catatan-text"><strong>Email</strong></label>
                <input type="text" name="email" class="form-control" value="<?= $pejabat[0]->email ?>">
                <label class="catatan-text"><strong>No. Telepon</strong></label>
                <input type="text" name="no_telp" class="form-control" value="<?= $pejabat[0]->no_telp ?>">
                <label class="catatan-text"><strong>Tanda Tangan</strong></label>
                <!-- <div class="col-sm-3 font-weight-bold"><strong>Tanda Tangan</strong></div> -->
                <div class="col-sm-9">
                    <input type="text" name="ttd_lama" value="<?= $pejabat[0]->tanda_tangan ?>" hidden>
                    <img src="<?= base_url('assets/ttd/' . $pejabat[0]->tanda_tangan) ?>" alt="Tanda Tangan Pejabat" class="img-thumbnail" style="max-width: 200px;">

                    <input type="file" name="tanda_tangan" class="form-control" accept="image/*">
                </div>

            </div>
        </div>


        <div class="text-end mt-3">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Simpan Perubahan
            </button>
        </div>
</form>