<?php
$a = 1;
foreach ($p_memo as $p_memo) : ?>
    <tr>
        <td><?= $a++; ?></td>
        <td><?= $p_memo->provinsi ?></td>
        <td><?= $p_memo->unor ?></td>
        <td><?= $p_memo->nama_program ?></td>
        <td>
            <?php if (isset($kawasans[$p_memo->id_rpiw])): ?>
                <?php
                $rows = count($kawasans[$p_memo->id_rpiw]);
                if ($rows > 1) {
                    $i = 1;
                    $ii = '.';
                } else {
                    $i = '';
                    $ii = '';
                }
                ?>
                <?php foreach ($kawasans[$p_memo->id_rpiw] as $kawasan): ?>
                    <?= $i++ . $ii . $kawasan->nama_kawasan; ?><br>
                <?php endforeach; ?>
            <?php else: ?>
                Non Kawasan
            <?php endif; ?>
        </td>
        <td><?= $p_memo->volume . " " . $p_memo->nama_satuan ?></td>
        <td><?php
            $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);

            // Mengatur agar desimal ditampilkan 0 jika tidak diperlukan
            $format->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, 0);
            $format->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);

            // Menampilkan hasil format tanpa desimal
            echo $format->formatCurrency($p_memo->biaya, 'IDR');
            ?>
        </td>
        <td align="center">
            <?php
            if ($p_memo->pradesk_konreg == 0) {
                echo '<span class="badge badge-pill badge-secondary">Belum Dibahas</span>';
            } elseif ($p_memo->pradesk_konreg == 1) {
                echo '<span class="badge badge-pill badge-primary">FKW</span>';
            } elseif ($p_memo->pradesk_konreg == 2) {
                echo '<span class="badge badge-pill badge-success">FKB</span>';
            } elseif ($p_memo->pradesk_konreg == 3) {
                echo '<span class="badge badge-pill badge-warning">FKB Dengan Catatan</span>';
            } elseif ($p_memo->pradesk_konreg == 4) {
                echo '<span class="badge badge-pill badge-danger">Ditangguhkan</span>';
            }
            ?>
        </td>
        <td>
            <span>
                <a target="_blank" href="<?= base_url('rakorbangwil/detail_program/' . $p_memo->id_mprogram) ?>" class="btn btn-info btn-sm" title="Detail">
                    <i class="fas fa-eye"></i>
                </a>
                <?php if (!isset(user()->id_unor)): ?>
                    <a target="_blank" href="<?= base_url('rakorbangwil/edit_program/' . $p_memo->id_mprogram) ?>" class="btn btn-warning btn-sm" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                <?php endif; ?>
            </span>
        </td>

    </tr>
<?php endforeach; ?>