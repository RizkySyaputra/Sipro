<div class="p-2">

    <?php if (!empty($list_kawasan)): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm">
                <thead class="thead-light">
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Kawasan</th>
                        <th style="text-align: center;">Provinsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($list_kawasan as $kawasan):
                    ?>
                        <tr>
                            <td style="text-align: center;"><?= $no++ ?></td>
                            <td style="text-align: left;"><?= esc($kawasan->kawasan ?? '-') ?></td>
                            <td><?= esc($provinsi ?? '-') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-secondary mt-2">Belum ada data kawasan.</div>
    <?php endif; ?>
</div>