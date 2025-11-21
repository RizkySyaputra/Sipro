<?php
$format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
$format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

$a = 1;
$total_kawasan = 0;
$total_tematik = 0;
$total_tematik_all = 0;
// $total_pekerjaan = 0;
// $total_anggaran = 0;
$table = '';
$table .= "<thead>
            <tr>
                <th class='text-center' rowspan='2'>No</th>
                <th class='text-center' rowspan='2'>Provinsi</th>
                <th class='text-center' rowspan='2'>Kawasan</th>
                <th class='text-center' colspan='6'>Tematik Kawasan</th>
            </tr>
            <tr>
                <th class='text-center'>Pertumbuhan</th>
                <th class='text-center'>Swasembada</th>
                <th class='text-center'>Afirmasi</th>
                <th class='text-center'>Konservasi/Rawan Bencana</th>
                <th class='text-center'>Komoditas Unggulan</th>
                <th class='text-center'>Total</th>
            </tr>
        </thead><tbody>";
foreach ($kawasan_per_provinsi as $kp) : ?>
    <?php
    $total_kawasan += $kp->jml_kawasan ?? 0;
    // $total_pekerjaan += $kp->jml_pertumbuhan ?? 0;
    // $total_anggaran += $kp->anggaran ?? 0;
    $total_tematik = $kp->jml_pertumbuhan + $kp->jml_swasembada + $kp->jml_afirmasi + $kp->jml_unggulan;

    $total_tematik_all += $total_tematik;

    $table .= "<tr>
        <td>$a</td>
        <td>$kp->provinsi</td>
        <td class='text-right'>$kp->jml_kawasan</td>
        <td class='text-right'>$kp->jml_pertumbuhan</td>
        <td class='text-right'>$kp->jml_swasembada</td>
        <td class='text-right'>$kp->jml_afirmasi</td>
        <td class='text-right'>$kp->jml_konservasi</td>
        <td class='text-right'>$kp->jml_unggulan</td>
        <td class='text-right'>$total_tematik</td>
    </tr>";
    $a++;
    ?>
<?php endforeach; ?>
<?php
$table .= "</tbody><tfoot><tr style='font-weight:bold;'>
    <td colspan='2' class='text-center'>Total</td>
    <td class='text-right'>$total_kawasan</td>
    <td colspan='6' class='text-right'>$total_tematik_all</td>
</tr></tfoot>";

echo $table;

?>