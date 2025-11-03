<style>
    .catatan-text {
        text-align: justify;
        color: #333;
        margin: 0;
        white-space: pre-line;
    }
</style>
<div class="container-fluid">
    <!-- Detail Memorandum -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i> Detail Rencana Aksi</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="mb-2">
                        <label class="catatan-text"><strong>ID Renaksi RPIW</strong></label>
                        <p><?= esc($data->id_renaksi ?? '-') ?></p>
                    </div>

                    <div class="mb-2">
                        <label class="catatan-text"><strong>Pekerjaan</strong></label>
                        <p><?= esc($data->pekerjaan ?? '-') ?></p>
                    </div>

                    <div class="mb-2">
                        <label class="catatan-text"><strong>Unit Organisasi</strong></label>
                        <p><?= esc($data->unor ?? '-') ?></p>
                    </div>

                    <div class="mb-2">
                        <label class="catatan-text"><strong>Provinsi</strong></label>
                        <p><?= esc($data->provinsi ?? '-') ?></p>
                    </div>

                    <div class="mb-2">
                        <label class="catatan-text"><strong>Kawasan</strong></label>
                        <p><?= esc($data->kawasan ?? '-') ?></p>
                    </div>

                    <div class="mb-2">
                        <label class="catatan-text"><strong>Lokasi</strong></label>
                        <p><?= esc($data->lokasi ?? '-') ?></p>
                    </div>

                    <div class="mb-2">
                        <label class="catatan-text"><strong>Justifikasi</strong></label>
                        <p><?= esc($data->justifikasi ?? '-') ?></p>
                    </div>

                    <div class="mb-2">
                        <label class="catatan-text"><strong>Periode</strong></label>
                        <p><?= esc($data->periode ?? '-') ?></p>
                    </div>
                    <div class="mb-2">
                        <label class="catatan-text"><strong>Tahun Mulai</strong></label>
                        <p><?= esc($data->tahun_mulai ?? '-') ?></p>
                    </div>

                    <div class="mb-2">
                        <label class="catatan-text"><strong>Tahun Selesai</strong></label>
                        <p><?= esc($data->tahun_selesai ?? '-') ?></p>
                    </div>
                    <div class="mb-2">
                        <label class="catatan-text"><strong>Volume</strong></label>
                        <p><?= esc($data->volume ?? '-') ?> <?= esc($data->nama_satuan ?? '-') ?></p>
                    </div>

                    <div class="mb-2">
                        <label class="catatan-text"><strong>Anggaran(ribu)</strong></label>
                        <p>Rp. <?= number_format($data->biaya, 0, ',', '.') ?> </p>
                    </div>

                    <div class="mb-2">
                        <label class="catatan-text"><strong>Sumber Pendanaan</strong></label>
                        <p><?= esc($data->sumber_pendanaan ?? '-') ?></p>
                    </div>


                    <!-- 
                    <div class="mb-2">
                        <label class="catatan-text"><strong>Peta Kawasan</strong></label>
                        <?php if (!empty($data->peta_kawasan)): ?>
                            <img src="<?= base_url('uploads/peta/' . $data->peta_kawasan) ?>" alt="Peta Kawasan" class="img-fluid rounded mt-2 shadow-sm">
                        <?php else: ?>
                            <p>-</p>
                        <?php endif; ?>
                    </div> -->



                </div>
            </div>
        </div>
    </div>
</div>