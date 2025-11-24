<?php
$format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
$format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

$a = 1;
$total_pkrjn_rpm = 0;
$total_pkrjn_phln = 0;
$total_pkrjn_sbsn = 0;
$total_pkrjn_apbn = 0;
$total_pkrjn_other = 0;
$total_pekerjaan = 0;

$total_rpm = 0;
$total_phln = 0;
$total_sbsn = 0;
$total_apbn = 0;
$total_other = 0;
$total_anggaran = 0;

$table = '';
$table = "<thead>
        <tr>
            <th rowspan='2' class='text-center'>No</th>
            <th rowspan='2' class='text-center'>Provinsi</th>
            <th colspan='4' class='text-center'>Pekerjaan APBN</th>';
            <th rowspan='2' class='text-center'>Pekerjaan Lainnya</th>';
            <th rowspan='2' class='text-center'>Total Pekerjaan</th>';
            <th colspan='4' class='text-center'>Anggaran APBN (Ribu)</th>
            <th rowspan='2' class='text-center'>Pembiayaan Lainnya (Ribu)</th>
            <th rowspan='2' class='text-center'>Total Anggaran (Ribu)</th>
        </tr>
        <tr>
            <th class='text-center'>RPM</th>
            <th class='text-center'>PHLN</th>
            <th class='text-center'>SBSN</th>
            <th class='text-center'>Total</th>

            <th class='text-center'>RPM</th>
            <th class='text-center'>PHLN</th>
            <th class='text-center'>SBSN</th>
            <th class='text-center'>Total</th>
        </tr></thead><tbody>";

foreach ($anggaran_per_provinsi as $ap) : ?>

    <?php
    $total_pkrjn_rpm += $ap->total_pkrjn_rpm;
    $total_pkrjn_phln += $ap->total_pkrjn_phln ?? 0;
    $total_pkrjn_sbsn += $ap->total_pkrjn_sbsn ?? 0;
    $total_pkrjn_apbn += $ap->total_pkrjn_apbn ?? 0;
    $total_pkrjn_other += $ap->total_pkrjn_other ?? 0;
    $total_pekerjaan += $ap->total_pekerjaan ?? 0;

    $total_rpm += $ap->total_rpm ?? 0;
    $total_phln += $ap->total_phln ?? 0;
    $total_sbsn += $ap->total_sbsn ?? 0;
    $total_apbn += $ap->total_apbn ?? 0;
    $total_other += $ap->total_other ?? 0;
    $total_anggaran += $ap->total_anggaran ?? 0;

    $table .= "<tr>
        <td>$a</td>
        <td>$ap->provinsi</td>
        <td class='text-right'>$ap->total_pkrjn_rpm</td>
        <td class='text-right'>$ap->total_pkrjn_phln</td>
        <td class='text-right'>$ap->total_pkrjn_sbsn</td>
        <td class='text-right' style='font-weight:500'>$ap->total_pkrjn_apbn</td>
        <td class='text-right'>$ap->total_pkrjn_other</td>
        <td class='text-right' style='font-weight:500'>$ap->total_pekerjaan</td>
        <td class='text-right'>" . $format->formatCurrency($ap->total_rpm, 'IDR') . "</td>
        <td class='text-right'>" . $format->formatCurrency($ap->total_phln, 'IDR') . "</td>
        <td class='text-right'>" . $format->formatCurrency($ap->total_sbsn, 'IDR') . "</td>
        <td class='text-right' style='font-weight:500'>" . $format->formatCurrency($ap->total_apbn, 'IDR') . "</td>
        <td class='text-right'>" . $format->formatCurrency($ap->total_other, 'IDR') . "</td>
        <td class='text-right' style='font-weight:500'>" . $format->formatCurrency($ap->total_anggaran, 'IDR') . "</td>
    </tr>";
    $a++;
    ?>
<?php endforeach; ?>
<?php
$table .= "</tbody><tfoot>
    <tr style='font-weight:bold;'>
        <td class='text-center total'></td>
        <td class='text-center'>Total</td>
        <td class='text-right'>$total_pkrjn_rpm</td>
        <td class='text-right'>$total_pkrjn_phln</td>
        <td class='text-right'>$total_pkrjn_sbsn</td>
        <td class='text-right'>$total_pkrjn_apbn</td>
        <td class='text-right'>$total_pkrjn_other</td>
        <td class='text-right'>$total_pekerjaan</td>
        <td class='text-right'>" . $format->formatCurrency($total_rpm, 'IDR') . "</td>
        <td class='text-right'>" . $format->formatCurrency($total_phln, 'IDR') . "</td>
        <td class='text-right'>" . $format->formatCurrency($total_sbsn, 'IDR') . "</td>
        <td class='text-right'>" . $format->formatCurrency($total_apbn, 'IDR') . "</td>
        <td class='text-right'>" . $format->formatCurrency($total_other, 'IDR') . "</td>
        <td class='text-right'>" . $format->formatCurrency($total_anggaran, 'IDR') . "</td>
    </tr>
</tfoot>";

echo $table;

?>