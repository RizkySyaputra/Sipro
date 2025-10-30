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
            <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i> Detail Memorandum</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <label class="catatan-text"><strong>ID Memorandum Program</strong></label>
                        <p><?= esc($memo->id_memorandum ?? '-') ?></p>

                        <label class="catatan-text"><strong>PN</strong></label>
                        <p><?= esc($memo->nama_pn ?? ' - ') ?></p>
                        <label class="catatan-text"><strong>PP</strong></label>
                        <p><?= esc($memo->nama_pp ?? ' - ') ?></p>
                        <label class="catatan-text"><strong>KP</strong></label>
                        <p><?= esc($memo->nama_kp ?? ' - ') ?></p>
                        <label class="catatan-text"><strong>ProP</strong></label>
                        <p><?= esc($memo->nama_prop ?? ' - ') ?></p>
                        <label class="catatan-text"><strong>Program</strong></label>
                        <p><?= esc($memo->id_program . '-' . $memo->nm_program ?? ' - ') ?></p>

                        <label class="catatan-text"><strong>Kegiatan</strong></label>
                        <p><?= esc($memo->id_kegiatan . '-' . $memo->nm_kegiatan ?? ' - ') ?></p>

                        <label class="catatan-text"><strong>KRO</strong></label>
                        <p><?= esc($memo->id_kro . '-' . $memo->nm_kro ?? ' - ') ?></p>

                        <label class="catatan-text"><strong>RO</strong></label>
                        <p><?= esc($memo->id_ro . '-' . $memo->nm_ro ?? ' - ') ?></p>

                        <label class="catatan-text"><strong>Pekerjaan</strong></label>
                        <p><?= esc($memo->pekerjaan ?? '-') ?></p>

                        <label class="catatan-text"><strong>Unit Organisasi</strong></label>
                        <p><?= esc($memo->unor ?? '-') ?></p>

                        <label class="catatan-text"><strong>Provinsi</strong></label>
                        <p><?= esc($memo->provinsi ?? '-') ?></p>

                        <label class="catatan-text"><strong>Tematik</strong></label>
                        <label class="catatan-text"><strong>Kawasan</strong></label>
                        <p><?= esc($memo->kawasan ?? '-') ?></p>
                        <p><?= esc($memo->tematik ?? '-') ?></p>
                        <label class="catatan-text"><strong>Kab/kot</strong></label>
                        <p><?= esc($memo->kabkot ?? '-') ?></p>

                        <!-- <label class="catatan-text"><strong>Kab/Kot</strong></label>
                        <?php if (!empty($kabkot)): ?>
                            <?php foreach ($kabkot as $item): ?>
                                <p><?= esc($item->kab_kot ?? '-') ?></p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>-</p>
                        <?php endif; ?> -->


                        <label class="catatan-text"><strong>Lokasi</strong></label>
                        <p><?= esc($memo->lokasi ?? '-') ?></p>

                    </ul>
                </div>

                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <label class="catatan-text"><strong>Justifikasi</strong></label>
                        <p><?= esc($memo->justifikasi ?? '-') ?></p>

                        <label class="catatan-text"><strong>Tahun Mulai</strong></label>
                        <p><?= esc($memo->tahun_mulai ?? '-') ?></p>

                        <label class="catatan-text"><strong>Tahun Selesai</strong></label>
                        <p><?= esc($memo->tahun_selesai ?? '-') ?></p>

                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <strong><i class="fas fa-table me-2"></i> Volume, Anggaran, dan Pendanaan per Tahun</strong>
                            </div>
                            <div class="card-body p-2">
                                <table class="table table-sm table-bordered table-hover table-striped mb-0 align-middle text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="80">Tahun</th>
                                            <th>Volume</th>
                                            <th>Anggaran</th>
                                            <th>Pendanaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        list($periodeMulai, $periodeSelesai) = explode('-', $memo->periode);
                                        $periodeMulai   = (int) $periodeMulai;
                                        $periodeSelesai = (int) $periodeSelesai;
                                        $tahunMulai     = (int) $memo->tahun_mulai;

                                        $i = ($tahunMulai - $tahunMulai) + 1;
                                        $total_volume = 0;
                                        $total_anggaran = 0;

                                        for ($tahun = $memo->tahun_mulai; $tahun <= $memo->tahun_selesai; $tahun++):
                                            $volumeKey   = 'volume_' . $i;
                                            $anggaranKey = 'anggaran_' . $i;
                                            $pendanaanKey = 'pendanaan_' . $i;

                                            $volume     = $memo->$volumeKey ?? 0;
                                            $anggaran   = $memo->$anggaranKey ?? 0;
                                            $pendanaan  = $memo->$pendanaanKey ?? '-';

                                            $total_volume   += $volume;
                                            $total_anggaran += $anggaran;
                                        ?>
                                            <tr>
                                                <td><?= $tahun ?></td>
                                                <td><?= $volume . ' ' . $memo->nama_satuan ?></td>
                                                <td><?= number_format($anggaran, 0, ',', '.') ?></td>
                                                <td><?= esc($pendanaan) ?></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endfor; ?>
                                        <tr class="table-secondary fw-bold">
                                            <td>Total</td>
                                            <td><?= $total_volume . ' ' . $memo->nama_satuan ?></td>
                                            <td><?= number_format($total_anggaran, 0, ',', '.') ?></td>
                                            <td>-</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <small class="text-muted"><i>*catatan: anggaran dalam satuan ribu</i></small>
                            </div>
                        </div>


                        <label class="catatan-text"><strong>Geotagging</strong></label>
                        <p><?= esc($memo->peta_kawasan ?? '-') ?></p>

                        <label class="catatan-text"><strong>Sumber Data</strong></label>
                        <p><?= esc($memo->sumber ?? '-') ?></p>

                        <!-- <?php
                                // Hitung total volume
                                $totalVolume = 0;
                                for ($i = 1; $i <= 5; $i++) {
                                    $field = 'volume_' . $i;
                                    $totalVolume += ($memo->$field ?? 0);
                                }
                                // Hitung total biaya
                                $biaya_total = 0;
                                for ($i = 1; $i <= 5; $i++) {
                                    $biaya = 'anggaran_' . $i;
                                    $biaya_total += ($memo->$biaya ?? 0);
                                }
                                ?>
                        <li class="list-group-item">
                            <div class="p-2 bg-light border rounded text-success fw-bold fs-5">
                                Volume Total: <?= $totalVolume . ' ' . esc($memo->nama_satuan) ?>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="p-2 bg-light border rounded text-success fw-bold fs-5">
                                Biaya Total: Rp <?= number_format($biaya_total ?? 0, 0, ',', '.') ?>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <strong>Peta Kawasan:</strong><br>
                            <?php if (!empty($memo->peta_kawasan)): ?>
                                <img src="<?= base_url('uploads/peta/' . $memo->peta_kawasan) ?>" alt="Peta Kawasan" class="img-fluid rounded mt-2 shadow-sm">
                            <?php else: ?>
                                <span>-</span>
                            <?php endif; ?>
                        </li> -->


                    </ul>
                </div>
                <div class="col-md-12">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <label class="catatan-text"><strong>Catatan Memorandum:</strong></label>
                            <?php if (!empty($memo->catatan_memorandum)): ?>
                                <?php
                                $catatanList = json_decode($memo->catatan_memorandum, true);
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