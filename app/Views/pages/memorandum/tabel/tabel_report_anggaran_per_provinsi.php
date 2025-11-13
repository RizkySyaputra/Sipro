<?php
$format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
$format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

$unorList = ['BM', 'CK', 'SDA', 'PS'];
$a = 1;
$total_rpm = 0;
$total_phln = 0;
$total_sbsn = 0;
$total_apbn = 0;
$total_other = 0;
$total_anggaran = 0;
$tahun = '-';

$table = '';
$table = "<thead>
        <tr>
            <th rowspan='2' class='text-center'>No</th>
            <th rowspan='2' class='text-center'>Provinsi</th>
            <th colspan='4' class='text-center'>APBN (Ribu)</th>
            <th rowspan='2' class='text-center'>Pembiayaan Lainnya (Ribu)</th>
            <th rowspan='2' class='text-center'>Total Anggaran (Ribu)</th>
            <th rowspan='2' class='text-center'>Tahun Anggaran</th>
        </tr>
        <tr>
            <th class='text-center'>RPM</th>
            <th class='text-center'>PHLN</th>
            <th class='text-center'>SBSN</th>
            <th class='text-center'>Total</th>
        </tr></thead><tbody>";

foreach ($anggaran_per_provinsi as $ap) : ?>

    <?php
    $total_rpm += $ap->rpm ?? 0;
    $total_phln += $ap->phln ?? 0;
    $total_sbsn += $ap->sbsn ?? 0;
    $total_apbn += $ap->total_apbn ?? 0;
    $total_other += $ap->other ?? 0;
    $total_anggaran += $ap->anggaran ?? 0;

    $tahun = $ap->tahun;
    if ($tahun === '2529') {
        $tahun = '2025 - 2029';
    }

    $table .= "<tr>
        <td>$a</td>
        <td>$ap->provinsi</td>
        <td class='text-right'>" . $format->formatCurrency($ap->rpm, 'IDR') . "</td>
        <td class='text-right'>" . $format->formatCurrency($ap->phln, 'IDR') . "</td>
        <td class='text-right'>" . $format->formatCurrency($ap->sbsn, 'IDR') . "</td>
        <td class='text-right' style='font-weight:500'>" . $format->formatCurrency($ap->total_apbn, 'IDR') . "</td>
        <td class='text-right'>" . $format->formatCurrency($ap->other, 'IDR') . "</td>
        <td class='text-right' style='font-weight:500'>" . $format->formatCurrency($ap->anggaran, 'IDR') . "</td>
        <td style='font-weight:500'>$tahun</td>
    </tr>";
    $a++;
    ?>
<?php endforeach; ?>
<?php
$table .= "</tbody><tfoot>
    <tr style='font-weight:bold;'>
        <td colspan='2' class='text-center'>Total</td>
        <td class='text-right'>" . $format->formatCurrency($total_rpm, 'IDR') . "</td>
        <td class='text-right'>" . $format->formatCurrency($total_phln, 'IDR') . "</td>
        <td class='text-right'>" . $format->formatCurrency($total_sbsn, 'IDR') . "</td>
        <td class='text-right'>" . $format->formatCurrency($total_apbn, 'IDR') . "</td>
        <td class='text-right'>" . $format->formatCurrency($total_other, 'IDR') . "</td>
        <td class='text-right'>" . $format->formatCurrency($total_anggaran, 'IDR') . "</td>
        <td>$tahun</td>
    </tr>
</tfoot>";

echo $table;

?>