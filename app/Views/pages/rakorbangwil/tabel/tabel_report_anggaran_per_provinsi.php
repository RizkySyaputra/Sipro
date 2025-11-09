<?php
$a = 1;
$format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
$format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
foreach ($anggaran_per_provinsi as $ap) : ?>
    <tr>
        <td><?= $a++; ?></td>
        <td><?= $ap->provinsi ?></td>
        <td class="text-right"><?= $format->formatCurrency($ap->rpm, 'IDR') ?></td>
        <td class="text-right"><?= $format->formatCurrency($ap->phln, 'IDR') ?></td>
        <td class="text-right"><?= $format->formatCurrency($ap->sbsn, 'IDR') ?></td>
        <td class="text-right" style="font-weight:500"><?= $format->formatCurrency($ap->total_apbn, 'IDR') ?></td>
        <td class="text-right"><?= $format->formatCurrency($ap->other, 'IDR') ?></td>
        <td class="text-right" style="font-weight:500"><?= $format->formatCurrency($ap->anggaran, 'IDR') ?></td>
    </tr>
<?php endforeach; ?>