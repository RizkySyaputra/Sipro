    <?php
    $a = 1;
    foreach ($p_rpiw as $p_rpiw) : ?>
        <tr>
            <td><?= $a++; ?></td>
            <!-- <td><?= $p_rpiw->id_program ?></td> -->
            <td><?= $p_rpiw->provinsi ?></td>
            <td><?= $p_rpiw->unor ?></td>
            <td><a target="_blank" href="<?= base_url('memo/' . $p_rpiw->id_program) ?>"><?= $p_rpiw->nama_program ?></a></td>
            <td>
                <?php if (isset($kawasans[$p_rpiw->id_program])): ?>
                    <?php
                    $rows = count($kawasans[$p_rpiw->id_program]);
                    if ($rows > 1) {
                        $i = 1;
                        $ii = '.';
                    } else {
                        $i = '';
                        $ii = '';
                    }
                    ?>
                    <?php foreach ($kawasans[$p_rpiw->id_program] as $kawasan): ?>
                        <?= $i++ . $ii . $kawasan->nama_kawasan; ?><br>
                    <?php endforeach; ?>
                <?php else: ?>
                    Non Kawasan
                <?php endif; ?>
            </td>
            <td><?= $p_rpiw->volume . " " . $p_rpiw->nama_satuan ?></td>
            <td><?php $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                echo $format->formatCurrency($p_rpiw->biaya, 'IDR');  ?></td>
            <td>
                <?php if ($tahun == "") : ?>
                    <?= ($tahun) ? $p_rpiw->tahun_selesai : $p_rpiw->tahun_mulai . '-' . $p_rpiw->tahun_selesai ?>
                <?php else : ?>
                    <?= $tahun ?>

                <?php endif ?>
            </td>
            <!-- <td class="text-center"><a href="/detail/<?= $p_rpiw->id_program ?>">Detail</td></a> -->
        </tr>
    <?php endforeach; ?>