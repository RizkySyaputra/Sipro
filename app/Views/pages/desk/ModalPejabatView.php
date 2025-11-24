<style>
    .catatan-item {
        background-color: #f8f9fa;
        /* warna abu lembut */
        border-left: 4px solid #0d6efd;
        /* garis biru di kiri */
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 8px;
    }

    .catatan-nama {
        font-weight: 600;
        color: #0d6efd;
        margin-bottom: 4px;
    }

    .catatan-text {
        text-align: justify;
        color: #333;
        margin: 0;
        white-space: pre-line;
    }
</style>

<div class="container-fluid">
    <!-- Detail Pejabat -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i> Detail Pejabat</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <label class="catatan-text"><strong>ID Pejabat</strong></label>
                        <p><?= esc($pejabat['id_pejabat']); ?></p>
                        <label class="catatan-text"><strong>NIP</strong></label>
                        <p><?= esc($pejabat['nip'] ?? ' - ') ?></p>
                        <label class="catatan-text"><strong>Nama</strong></label>
                        <p><?= esc($pejabat['nama_pejabat'] ?? ' - ') ?></p>
                        <label class="catatan-text"><strong>Jabatan</strong></label>
                        <p><?= esc($pejabat['jabatan'] ?? ' - ') ?></p>
                        <label class="catatan-text"><strong>Instansi</strong></label>
                        <p><?= esc($pejabat['instansi'] ?? ' - ') ?></p>
                </div>
                <div class="col-md-6">
                    <label class="catatan-text"><strong>Email</strong></label>
                    <p><?= esc($pejabat['email'] ?? ' - ') ?></p>
                    <label class="catatan-text"><strong>No. Telepon</strong></label>
                    <p><?= esc($pejabat['no_telp'] ?? ' - ') ?></p>
                    <label class="catatan-text"><strong>Tanda Tangan</strong></label> <br>
                    <img width="100%" src="<?= base_url('assets/ttd/' . ($pejabat['tanda_tangan'] ?? '')) ?>" alt="">

                </div>
            </div>
        </div>

    </div>
</div>