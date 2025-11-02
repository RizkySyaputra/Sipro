<div class="p-2">

    <?php if (!empty($list_program)): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm">
                <thead class="thead-light">
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Unor</th>
                        <th style="text-align: left;">Pekerjaan</th>
                        <th style="text-align: center;">Kawasan</th>
                        <th style="text-align: center;">Volume</th>
                        <th style="text-align: center;">Anggaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($list_program as $program):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?= $no++ ?></td>
                            <td><?= esc($program->unor ?? '-') ?></td>
                            <td style="text-align: left;"><?= esc($program->pekerjaan ?? '-') ?></td>
                            <td><?= esc($program->nama_kawasan ?? '-') ?></td>
                            <td style="text-align: right;"><?= esc($program->volume . ' ' . $program->nama_satuan ?? '-') ?></td>
                            <td style="text-align: right;">
                                Rp<?= number_format($program->anggaran ?? 0, 0, ',', '.') ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-secondary mt-2 text-center">
            Belum ada data program.
        </div>
    <?php endif; ?>
</div>