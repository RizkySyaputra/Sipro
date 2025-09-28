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
                        <li class="list-group-item"><strong>Nama Program:</strong> <?= esc($memo->pekerjaan ?? '-') ?></li>
                        <li class="list-group-item"><strong>Provinsi:</strong> <?= esc($memo->provinsi ?? '-') ?></li>
                        <li class="list-group-item"><strong>Unit Organisasi:</strong> <?= esc($memo->unor ?? '-') ?></li>
                        <li class="list-group-item"><strong>Kawasan Prioritas:</strong> <?= esc($memo->kawasan ?? '-') ?></li>
                        <li class="list-group-item"><strong>Lokasi:</strong> <?= esc($memo->lokasi ?? '-') ?></li>
                        <li class="list-group-item"><strong>Justifikasi:</strong> <?= esc($memo->justifikasi ?? '-') ?></li>
                        <li class="list-group-item"><strong>Sumber Pendanaan:</strong> <?= esc($memo->sumber ?? '-') ?></li>
                        <li class="list-group-item"><strong>Tahun Perencanaan:</strong> <?= esc($memo->periode ?? '-') ?></li>
                        <li class="list-group-item"><strong>Tahun:</strong> <?= esc($memo->tahun_mulai ?? '-') ?> - <?= esc($memo->tahun_selesai ?? '-') ?></li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <?php
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
                        </li>
                        <li class="list-group-item"><strong>Catatan Memorandum:</strong><br>
                            <span class="text-muted"><?= esc($memo->catatan_memorandum ?? '-') ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Volume & RPM -->
    <div class="row g-3">
        <!-- Volume -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <strong><i class="fas fa-cubes me-2"></i> Volume per Tahun</strong>
                </div>
                <div class="card-body p-2">
                    <table class="table table-sm table-bordered table-hover table-striped mb-0">
                        <tbody>
                            <?php
                            list($periodeMulai, $periodeSelesai) = explode('-', $memo->periode);
                            $periodeMulai   = (int) $periodeMulai;
                            $periodeSelesai = (int) $periodeSelesai;
                            $tahunMulai = (int) $memo->tahun_mulai;

                            $i = ($tahunMulai - $periodeMulai) + 1;
                            $total_volume = 0;

                            for ($tahun = $memo->tahun_mulai; $tahun <= $memo->tahun_selesai; $tahun++):
                                $volumeKey = 'volume_' . $i;
                                $nilai = $memo->$volumeKey ?? 0;
                                $total_volume += $nilai;
                            ?>
                                <tr>
                                    <td width="80"><?= $tahun ?></td>
                                    <td><?= $nilai . ' ' . $memo->nama_satuan ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endfor; ?>
                            <tr class="table-secondary fw-bold">
                                <td>Total</td>
                                <td><?= $total_volume . ' ' . $memo->nama_satuan ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- RPM -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <strong><i class="fas fa-coins me-2"></i> RPM (Rp)</strong>
                </div>
                <div class="card-body p-2">
                    <table class="table table-sm table-bordered table-hover table-striped mb-0">
                        <tbody>
                            <?php
                            $j = ($tahunMulai - $periodeMulai) + 1;
                            $total_rpm = 0;

                            for ($tahun = $memo->tahun_mulai; $tahun <= $memo->tahun_selesai; $tahun++):
                                $anggaranKey = 'anggaran_' . $j;
                                $nilai = $memo->$anggaranKey ?? 0;
                                $total_rpm += $nilai;
                            ?>
                                <tr>
                                    <td width="80"><?= $tahun ?></td>
                                    <td>Rp <?= number_format($nilai, 0, ',', '.') ?></td>
                                </tr>
                                <?php $j++; ?>
                            <?php endfor; ?>
                            <tr class="table-secondary fw-bold">
                                <td>Total</td>
                                <td>Rp <?= number_format($total_rpm, 0, ',', '.') ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <small class="text-muted"><i>*catatan: dalam satuan ribu</i></small>
                </div>
            </div>
        </div>
    </div>
</div>