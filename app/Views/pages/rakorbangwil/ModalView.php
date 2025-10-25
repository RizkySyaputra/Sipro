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
    <!-- Detail Memorandum -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i> Detail Program Tahunan</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <label class="catatan-text"><strong>ID Program Tahunan Program</strong></label>
                        <p><?= esc($prog_tahunan->id_prog_tahunan ?? '-') ?></p>

                        <label class="catatan-text"><strong>PN</strong></label>
                        <p><?= esc($prog_tahunan->nama_pn ?? ' - ') ?></p>
                        <label class="catatan-text"><strong>PP</strong></label>
                        <p><?= esc($prog_tahunan->nama_pp ?? ' - ') ?></p>
                        <label class="catatan-text"><strong>KP</strong></label>
                        <p><?= esc($prog_tahunan->nama_kp ?? ' - ') ?></p>
                        <label class="catatan-text"><strong>ProP</strong></label>
                        <p><?= esc($prog_tahunan->nama_prop ?? ' - ') ?></p>
                        <label class="catatan-text"><strong>Program</strong></label>
                        <p><?= esc($prog_tahunan->id_program . '-' . $prog_tahunan->nm_program ?? ' - ') ?></p>

                        <label class="catatan-text"><strong>Kegiatan</strong></label>
                        <p><?= esc($prog_tahunan->id_kegiatan . '-' . $prog_tahunan->nm_kegiatan ?? ' - ') ?></p>

                        <label class="catatan-text"><strong>KRO</strong></label>
                        <p><?= esc($prog_tahunan->id_kro . '-' . $prog_tahunan->nm_kro ?? ' - ') ?></p>

                        <label class="catatan-text"><strong>RO</strong></label>
                        <p><?= esc($prog_tahunan->id_ro . '-' . $prog_tahunan->nm_ro ?? ' - ') ?></p>

                        <label class="catatan-text"><strong>Pekerjaan</strong></label>
                        <p><?= esc($prog_tahunan->pekerjaan ?? '-') ?></p>

                        <label class="catatan-text"><strong>Unit Organisasi</strong></label>
                        <p><?= esc($prog_tahunan->unor ?? '-') ?></p>

                        <label class="catatan-text"><strong>Provinsi</strong></label>
                        <p><?= esc($prog_tahunan->provinsi ?? '-') ?></p>

                        <label class="catatan-text"><strong>Tematik</strong></label>
                        <p><?= esc($prog_tahunan->tematik ?? '-') ?></p>
                        <label class="catatan-text"><strong>Kawasan</strong></label>
                        <p><?= esc($prog_tahunan->kawasan ?? '-') ?></p>
                        <label class="catatan-text"><strong>Kab/kot</strong></label>
                        <p><?= esc($prog_tahunan->kabkot ?? '-') ?></p>

                        <!-- <label class="catatan-text"><strong>Kab/Kot</strong></label>
                        <?php if (!empty($kabkot)): ?>
                            <?php foreach ($kabkot as $item): ?>
                                <p><?= esc($item->kab_kot ?? '-') ?></p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>-</p>
                        <?php endif; ?> -->


                        <label class="catatan-text"><strong>Lokasi</strong></label>
                        <p><?= esc($prog_tahunan->lokasi ?? '-') ?></p>

                    </ul>
                </div>

                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <label class="catatan-text"><strong>Justifikasi</strong></label>
                        <p><?= esc($prog_tahunan->justifikasi ?? '-') ?></p>

                        <label class="catatan-text"><strong>Tahun Mulai</strong></label>
                        <p><?= esc($prog_tahunan->thn_pelaksanaan ?? '-') ?></p>


                        <label class="catatan-text"><strong>Sumber Pendaan</strong></label>
                        <p><?= esc($prog_tahunan->sumber_pendanaan ?? '-') ?></p>

                        <label class="catatan-text"><strong>Anggaran (ribu)</strong></label>
                        <p>Rp. <?= number_format($prog_tahunan->anggaran, 0, ',', '.') ?></p>

                        <label class="catatan-text"><strong>Volume</strong></label>
                        <p><?= esc($prog_tahunan->volume . ' ' . $prog_tahunan->nama_satuan ?? '-') ?></p>

                        <label class="catatan-text"><strong>Geotagging</strong></label>
                        <p><?= esc($prog_tahunan->geotag ?? '-') ?></p>

                        <label class="catatan-text"><strong>Sumber Data</strong></label>
                        <p><?= esc($prog_tahunan->sumber ?? '-') ?></p>

                        <label class="catatan-text"><strong>Kebutuhan Dukungan KL</strong></label>
                        <p><?= esc($prog_tahunan->kebutuhan_dukungan_kl ?? '-') ?></p>

                        <label class="catatan-text"><strong>Reviu Puswil</strong></label>
                        <p><?= esc($prog_tahunan->reviu_puswil ?? '-') ?></p>

                        <!-- <label class="catatan-text"><strong>Catatan memorandum:</strong></label>
                        <p><?= esc($prog_tahunan->catatan_memorandum ?? '-') ?></p> -->

                    </ul>
                </div>
                <div class="col-md-12">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <label class="catatan-text"><strong>Catatan Memorandum:</strong></label>
                            <?php if (!empty($prog_tahunan->catatan_memorandum)): ?>
                                <?php
                                $catatanList = json_decode($prog_tahunan->catatan_memorandum, true);
                                ?>
                                <?php if (!empty($catatanList)): ?>
                                    <div class="mt-2">
                                        <?php foreach ($catatanList as $item): ?>
                                            <div class="catatan-item">
                                                <div class="catatan-nama"><?= esc($item['nama']) ?>:</div>
                                                <p class="catatan-text"><?= esc($item['catatan']) ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="text-muted mt-1">-</div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="text-muted mt-1">-</div>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


</div>