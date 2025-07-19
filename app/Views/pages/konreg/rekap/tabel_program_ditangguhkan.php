<?php
$a = 1;
foreach ($program as $data) : ?>
    <tr>
        <td><?= $a++; ?></td>
        <td><?= $data->provinsi ?></td>
        <td><?= $data->unor ?></td>
        <td>
            <?php
            if (!empty($data->pekerjaan)) {
                $namaPekerjaan = $data->pekerjaan;
            } elseif (!empty($data->nama_pekerjaan)) {
                $namaPekerjaan = $data->nama_pekerjaan;
            } elseif (!empty($data->usulan)) {
                $namaPekerjaan = $data->usulan;
            } else {
                $namaPekerjaan = '-';
            }
            ?>
            <?= esc($namaPekerjaan) ?>
        </td>

        <td><?php if (!empty($data->volume)) {
                $volume = $data->volume;
            } elseif (!empty($data->volume_rakortek)) {
                $volume = $data->volume_rakortek;
            } ?>
            <?= esc($volume) . " " . $data->nama_satuan ?></td>
        <td><?php

            if (!empty($data->anggaran)) {
                $anggaran = $data->anggaran;
            } elseif (!empty($data->alokasi_rakortek)) {
                $anggaran = $data->alokasi_rakortek;
            }
            $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);

            // Mengatur agar desimal ditampilkan 0 jika tidak diperlukan
            $format->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, 0);
            $format->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);

            // Menampilkan hasil format tanpa desimal
            echo $format->formatCurrency($anggaran, 'IDR');
            ?>


        </td>
        <td align="center">
            <span class="badge badge-pill badge-danger">Ditangguhkan</span>
        </td>
        <td align="center">
            <?= strtoupper($data->sumber_data) ?>
        </td>
    </tr>
<?php endforeach; ?>