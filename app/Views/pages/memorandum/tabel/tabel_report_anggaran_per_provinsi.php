<?php
$a = 1;
$format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
$format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
foreach ($anggaran_per_provinsi as $ap) : ?>
    <tr>
        <td><?= $a++; ?></td>
        <td><?= $ap->provinsi ?></td>
        <td class="text-right"><?= $format->formatCurrency($ap->jumlah_rpm, 'IDR') ?></td>
        <td class="text-right"><?= $format->formatCurrency($ap->jumlah_phln, 'IDR') ?></td>
        <td class="text-right"><?= $format->formatCurrency($ap->jumlah_sbsn, 'IDR') ?></td>
        <td class="text-right"><?= $format->formatCurrency($ap->total_provinsi_apbn, 'IDR') ?></td>
        <td class="text-right"><?= $format->formatCurrency($ap->jumlah_lainnya, 'IDR') ?></td>
    </tr>
<?php endforeach; ?>