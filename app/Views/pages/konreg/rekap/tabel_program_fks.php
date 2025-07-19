<?php
$a = 1;
foreach ($program as $data) : ?>
    <tr>
        <td><?= $a++; ?></td>
        <td><?= $data->provinsi ?></td>
        <td><?= $data->unor ?></td>
        <td><?= $data->pekerjaan ?></td>
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
        <td align="center">
            <span class="badge badge-pill badge-primary">FKS</span>
        </td>
        <td align="center">
            <?= strtoupper($data->sumber_data) ?>
        </td>

    </tr>
<?php endforeach; ?>