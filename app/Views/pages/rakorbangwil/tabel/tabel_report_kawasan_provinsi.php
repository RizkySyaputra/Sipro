<?php
$format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
$format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

$a = 1;
$total_kawasan = 0;
$total_tematik = 0;
$total_pekerjaan = 0;
$table = '';
$table .= "<thead>
            <tr>
                <th>No</th>
                <th>Provinsi</th>
                <th>Kawasan</th>
                <th>Tematik Kawasan</th>
                <th>Pekerjaan</th>
                <th>Anggaran</th>
            </tr>
        </thead><tbody>";
foreach ($kawasan_per_provinsi as $kp) : ?>
    <?php
    // $total_kawasan += $kp->kawasan;
    // $total_tematik += $kp->tematik;
    // $total_pekerjaan += $kp->pekerjaan;

    $table .= "<tr>
        <td>$a</td>
        <td>$kp->provinsi</td>
        <td class='text-right'>$kp->kawasan</td>
        <td class='text-right'>$kp->tematik</td>
        <td class='text-right'>$kp->pekerjaan</td>
        <td class='text-right'>" . $format->formatCurrency($kp->anggaran, 'IDR') . "</td>
    </tr>";
    $a++;
    ?>
<?php endforeach; ?>
<?php
// $table .= "</tbody><tfoot><tr style='font-weight:bold;'>
//     <td colspan='2'>Total</td>
//     <td><strong>$total_kawasan</strong></td>
//     <td><strong>$total_tematik</strong></td>
//     <td><strong>$total_pekerjaan</strong></td>
// </tr></tfoot>";

echo $table;

?>