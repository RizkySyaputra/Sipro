<?php
$a = 1;
foreach ($p_memo as $p_memo) : ?>
    <tr>
        <td><?= $a++; ?></td>
        <td><?= $p_memo->provinsi ?></td>
        <td><?= $p_memo->unor ?></td>
        <td><a target="_blank" href="<?= base_url('detail_program/' . $p_memo->id_mprogram) ?>"><?= $p_memo->nama_program ?></a></td>
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

        <td al>
            <!-- <?= $p_memo->desk ?> -->
            <?php
            if ($p_memo->desk == null) {
                echo '<span class="badge badge-pill badge-warning">Belum Dibahas</span>';
            } elseif ($p_memo->desk == 1) {
                echo '<span class="badge badge-pill badge-success">Diakomodasi</span>';
            } elseif ($p_memo->desk == 0) {
                echo '<span class="badge badge-pill badge-danger">Ditangguhkan</span>';
            }
            ?>

        </td>
    </tr>
<?php endforeach; ?>