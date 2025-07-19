<?php
$a = 1;
foreach ($p_fkb as $data) : ?>
    <tr>
        <td><?= $a++; ?></td>
        <td><?= $data->provinsi ?></td>
        <td><?= $data->unor ?></td>
        <td><?= $data->pekerjaan ?></td>
        <td><?= $data->nama_kawasan ?></td>
        <td><?= $data->volume . " " . $data->nama_satuan ?></td>
        <td><?php
            $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);

            // Mengatur agar desimal ditampilkan 0 jika tidak diperlukan
            $format->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, 0);
            $format->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);

            // Menampilkan hasil format tanpa desimal
            echo $format->formatCurrency($data->anggaran, 'IDR');
            ?>
        </td>
        <td>
            <span>
                <a target="_blank" href="<?= base_url('unor/detail_program_fkb/' . $data->id_fkb) ?>" class="btn btn-info btn-sm" title="Detail">
                    <i class="fas fa-eye"></i>
                </a>
                <!-- <a target="_blank" href="<?= base_url('unor/detail_program_fkb/' . $data->id_fkb) ?>" class="btn btn-warning btn-sm" title="Edit">
                    <i class="fas fa-edit"></i>
                </a> -->
            </span>
        </td>
    </tr>
<?php endforeach; ?>