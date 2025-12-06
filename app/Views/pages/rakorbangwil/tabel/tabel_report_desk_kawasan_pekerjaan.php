<?php
$format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
$format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

// echo '<pre>';
// print_r($rekap);
// echo '</pre>';
// exit;
$a = 1;
$total_pekerjaan_belum_dibahas = 0;
$total_pekerjaan_sudah_dibahas = 0;
$total_pekerjaan = 0;
$table = '';
$table .= "<thead>
            <tr>
                <th class='text-center'>No</th>
                <th class='text-center'>Provinsi</th>
                <th class='text-center'>Tematik</th>
                <th class='text-center'>Kawasan / Lokus</th>
                <th class='text-center'>Pekerjaan Belum Dibahas</th>
                <th class='text-center'>Pekerjaan Sudah Dibahas</th>
                <th class='text-center'>Total Pekerjaan</th>
            </tr>
        </thead><tbody>";
foreach ($rekap as $rk) : ?>
    <?php
    $total_pekerjaan_belum_dibahas += $rk['pekerjaan_belum_dibahas'] ?? 0;
    $total_pekerjaan_sudah_dibahas += $rk['pekerjaan_sudah_dibahas'] ?? 0;
    $total_pekerjaan += $rk['jumlah_pekerjaan'] ?? 0;

    $table .= "<tr>
        <td>$a</td>
        <td>{$rk['provinsi']}</td>
        <td class='text-right'>{$rk['tematik']}</td>
        <td class='text-right'>{$rk['kawasan']}</td>
        <td class='text-right'>{$rk['pekerjaan_belum_dibahas']}</td>
        <td class='text-right'>{$rk['pekerjaan_sudah_dibahas']}</td>
        <td class='text-right'>{$rk['jumlah_pekerjaan']}</td>
    </tr>";
    $a++;
    ?>
<?php endforeach; ?>
<?php
$table .= "</tbody><tfoot><tr style='font-weight:bold;'>
    <td colspan='4' class='text-center'>Total</td>
    <td class='text-right'>$total_pekerjaan_belum_dibahas</td>
    <td class='text-right'>$total_pekerjaan_sudah_dibahas</td>
    <td class='text-right'>$total_pekerjaan</td>
</tr></tfoot>";

echo $table;

?>