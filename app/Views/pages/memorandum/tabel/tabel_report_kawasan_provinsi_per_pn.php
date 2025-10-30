<?php
$pnList = [2, 3, 4, 5, 6, 8];
$jenis = ['Kawasan', 'Tematik Kawasan', 'Pekerjaan'];
$a = 1;
$table = '';
$table .= "<thead>
            <tr>
             <th rowspan='2'>No</th>
             <th rowspan='2'>Provinsi</th>"; // kolom tetap
foreach ($jenis as $j) {
    $table .= '<th colspan="' . count($pnList) . '">' . $j . '</th>';
}
$table .= "</tr>";

// Baris 2: PN
$table .= "<tr>";
foreach ($jenis as $j) {
    foreach ($pnList as $pn) {
        $table .= "<th>PN $pn</th>";
    }
}
$table .= "</tr></thead><tbody>";
foreach ($kawasan_per_provinsi_per_pn as $kn) {
    $table .= "<tr>
    <td>$a</td>
    <td>$kn->provinsi</td>";

    // Loop per jenis dan per PN
    foreach ($jenis as $j) {
        foreach ($pnList as $pn) {
            // buat nama properti sesuai query
            $jumlah_pn = 'pn' . $pn . '_' . strtolower(str_replace(' ', '_', $j));
            $nilai_jumlah_pn = $kn->$jumlah_pn ?? 0;
            // $subtotal_jumlah_pn += $nilai_jumlah_pn;
            $table .= "<td class='text-right'>$nilai_jumlah_pn</td>";
        }
    }

    $table .= "</tr>";
    $a++;
}

// $table .= "</tbody><tfoot><tr style='font-weight:bold;'>
//     <td colspan='2'>Total</td>
//     <td><strong>$total_kawasan</strong></td>
//     <td><strong>$total_tematik</strong></td>
//     <td><strong>$total_pekerjaan</strong></td>
// </tr></tfoot>";

echo $table;
