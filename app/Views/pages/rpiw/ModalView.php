<div class="container-fluid">
    <!-- Detail Memorandum -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i> Detail Rencana Aksi</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-12">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nama Program:</strong> <?= esc($data->pekerjaan ?? '-') ?></li>
                        <li class="list-group-item"><strong>Provinsi:</strong> <?= esc($data->provinsi ?? '-') ?></li>
                        <li class="list-group-item"><strong>Unit Organisasi:</strong> <?= esc($data->unor ?? '-') ?></li>
                        <li class="list-group-item"><strong>Kawasan Prioritas:</strong> <?= esc($data->kawasan ?? '-') ?></li>
                        <li class="list-group-item"><strong>Lokasi:</strong> <?= esc($data->lokasi ?? '-') ?></li>
                        <li class="list-group-item"><strong>Justifikasi:</strong> <?= esc($data->justifikasi ?? '-') ?></li>
                        <li class="list-group-item"><strong>Sumber Pendanaan:</strong> <?= esc($data->sumber_pendanaan ?? '-') ?></li>
                        <li class="list-group-item"><strong>Tahun Perencanaan:</strong> <?= esc($data->periode ?? '-') ?></li>
                        <li class="list-group-item"><strong>Tahun:</strong> <?= esc($data->tahun_mulai ?? '-') ?> - <?= esc($data->tahun_selesai ?? '-') ?></li>
                        <li class="list-group-item"><strong>Volume :</strong> <?= esc($data->volume ?? '-') ?> <?= esc($data->nama_satuan ?? '-') ?></li>
                        <li class="list-group-item"><strong>Anggaran :</strong> <?= esc($data->biaya ?? '-') ?> </li>
                        <li class="list-group-item">
                            <strong>Peta Kawasan:</strong><br>
                            <?php if (!empty($data->peta_kawasan)): ?>
                                <img src="<?= base_url('uploads/peta/' . $data->peta_kawasan) ?>" alt="Peta Kawasan" class="img-fluid rounded mt-2 shadow-sm">
                            <?php else: ?>
                                <span>-</span>
                            <?php endif; ?>
                        </li>
                    </ul>


                </div>
            </div>
        </div>
    </div>
</div>