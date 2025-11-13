<?php
$format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
$format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

$a = 1;
$total_kawasan = 0;
$total_pekerjaan = 0;
$total_anggaran = 0;
$tahun = '-';

$table = '';

$table .= "<thead>
            <tr>
                <th class='text-center'>No</th>
                <th class='text-center'>Provinsi</th>
                <th class='text-center'>Kawasan</th>
                <th class='text-center'>Tematik Kawasan</th>
                <th class='text-center'>Pekerjaan</th>
                <th class='text-center'>Anggaran (Ribu)</th>
                <th class='text-center'>Tahun Anggaran</th>
            </tr>
        </thead><tbody>";
foreach ($kawasan_per_provinsi as $kp) : ?>
    <?php
    $total_kawasan += $kp->kawasan;
    $total_pekerjaan += $kp->pekerjaan;
    $total_anggaran += $kp->anggaran;

    $tahun = $kp->tahun;
    if ($tahun === '2529') {
        $tahun = '2025 - 2029';
    }

    $table .= "<tr>
        <td>$a</td>
        <td>$kp->provinsi</td>
        <td class='text-right'>$kp->kawasan</td>
        <td class='text-right'>$kp->tematik</td>
        <td class='text-right'>$kp->pekerjaan</td>
        <td class='text-right'>" . $format->formatCurrency($kp->anggaran, 'IDR') . "</td>
        <td>$tahun</td>
    </tr>";
    $a++;
    ?>
<?php endforeach; ?>
<?php
$table .= "</tbody><tfoot><tr style='font-weight:bold;'>
    <td colspan='2' class='text-center'>Total</td>
    <td class='text-right'>$total_kawasan</td>
    <td class='text-right'>-</td>
    <td class='text-right'>$total_pekerjaan</td>
    <td class='text-right'>" . $format->formatCurrency($total_anggaran, 'IDR') . "</td>
    <td>$tahun</td>
</tr></tfoot>";

echo $table;

?>