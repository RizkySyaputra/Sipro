<?php
$format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
$format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

$pnList = [2, 3, 4, 5, 6, 8];
$jenis = ['Kawasan', 'Tematik', 'Pekerjaan', 'Anggaran'];
$a = 1;
$table = '';
$table .= "<thead>
            <tr>
             <th rowspan='2'>No</th>
             <th rowspan='2'>Provinsi</th>"; // kolom tetap
foreach ($jenis as $j) {
    $table .= '<th colspan="' . count($pnList) + 1 . '">' . $j . '</th>';
}
$table .= "</tr>";

// Baris 2: PN
$table .= "<tr>";
foreach ($jenis as $j) {
    foreach ($pnList as $pn) {
        $table .= "<th>PN $pn</th>";
    }
    $table .= "<th>Total</th>";
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
            $kolom = 'pn' . $pn . '_' . strtolower(str_replace(' ', '_', $j));
            if ($j === 'Anggaran') {
                $nilai_pn = $format->formatCurrency($kn->$kolom, 'IDR') ?? 0;
            } else {
                $nilai_pn = $kn->$kolom ?? 0;
            }
            // $subtotal_jumlah_pn += $nilai_jumlah_pn;
            $table .= "<td class='text-right'>$nilai_pn</td>";
        }
        if ($j === 'Kawasan') {
            $table .= "<td class='text-right' style='font-weight:500'>$kn->kawasan</td>";
        } else if ($j === 'Tematik') {
            $table .= "<td class='text-right' style='font-weight:500'>$kn->tematik</td>";
        } else if ($j === 'Pekerjaan') {
            $table .= "<td class='text-right' style='font-weight:500'>$kn->pekerjaan</td>";
        } else if ($j === 'Anggaran') {
            $table .= "<td class='text-right' style='font-weight:500'>" . $format->formatCurrency($kn->total_anggaran, 'IDR') . "</td>";
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
