<?php
$a = 1;
foreach ($program as $data) : ?>
    <tr>
        <td><?= $a++; ?></td>
        <td><?= $data->provinsi ?></td>
        <td><?= $data->unor ?></td>
        <td style="width: 10%;"><?= $data->nama_kp ?></td>
        <td style="width: 10%;"><?= $data->nama_prop ?></td>
        <td><?= $data->usulan ?></td>
        <td><?= $data->volume_rakortek . " " . $data->nama_satuan ?></td>
        <td><?php
            $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);

            // Mengatur agar desimal ditampilkan 0 jika tidak diperlukan
            $format->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, 0);
            $format->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);

            // Menampilkan hasil format tanpa desimal
            echo $format->formatCurrency($data->alokasi_rakortek, 'IDR');
            ?>
        </td>
        <td><?php if ($data->approval_rakortek == 4) {
                echo "Tidak terbahas";
            } elseif ($data->approval_rakortek == 1) {
                echo "Direkomendasikan";
            } elseif ($data->approval_rakortek == 2) {
                echo "Tidak Direkomendasikan";
            } elseif ($data->approval_rakortek == 3) {
                echo "Direkomendasikan dengan catatan";
            } else {
                echo "Status tidak diketahui";
            } ?></td>
        <td>
            <span>
                <?php if (($desk == "konreg") &&  (!in_groups('Staff'))): ?>
                    <a target="_blank" href="<?= base_url('edit_rakortek/' . $data->id_usulan . '?desk=konreg') ?>" class=" btn btn-warning btn-sm" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                <?php endif ?>
                <a target="_blank" href="<?= base_url('detail_Rakortek/' . $data->id_usulan) ?>" class="btn btn-info btn-sm" title="Detail">
                    <i class="fas fa-eye"></i>
                </a>
            </span>
        </td>
        <td align="center">
            <?php
            if ($data->kesepakatan == 0) {
                echo '<span class="badge badge-pill badge-secondary">Belum Dibahas</span>';
            } elseif ($data->kesepakatan == 1) {
                echo '<span class="badge badge-pill badge-primary">FKW</span>';
            } elseif ($data->kesepakatan == 2) {
                echo '<span class="badge badge-pill badge-success">FKB</span>';
            } elseif ($data->kesepakatan == 3) {
                echo '<span class="badge badge-pill badge-warning">Ditangguhkan</span>';
            }
            ?>
        </td>
    </tr>
<?php endforeach; ?>