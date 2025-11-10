<?php
$format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
$format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

$unorList = ['SDA', 'BM', 'CK', 'PS'];
$jenis = ['Kawasan', 'Tematik', 'Pekerjaan', 'Anggaran'];
$a = 1;
$table = '';
$table .= "<thead>
            <tr>
             <th rowspan='2'>No</th>
             <th rowspan='2'>Provinsi</th>"; // kolom tetap
foreach ($jenis as $j) {
    $table .= '<th colspan="' . count($unorList) + 1 . '">' . $j . '</th>';
}
$table .= "</tr>";

// Baris 2: Unor
$table .= "<tr>";
foreach ($jenis as $j) {
    foreach ($unorList as $unor) {
        $table .= "<th>$unor</th>";
    }
    $table .= "<th>Total</th>";
}
$table .= "</tr></thead><tbody>";
foreach ($kawasan_per_provinsi_per_unor as $kr) {
    $table .= "<tr>
    <td>$a</td>
    <td>$kr->provinsi</td>";

    // Loop per jenis dan per Unor
    foreach ($jenis as $j) {
        foreach ($unorList as $unor) {
            // buat nama properti sesuai query
            $kolom = strtolower($unor) . '_' . strtolower(str_replace(' ', '_', $j));
            if ($j === 'Anggaran') {
                $nilai_unor = $format->formatCurrency($kr->$kolom, 'IDR') ?? 0;
            } else {
                $nilai_unor = $kr->$kolom ?? 0;
            }
            // $subtotal_jumlah_pn += $nilai_jumlah_pn;
            $table .= "<td class='text-right'>$nilai_unor</td>";
        }
        if ($j === 'Kawasan') {
            $table .= "<td class='text-right' style='font-weight:500'>$kr->kawasan</td>";
        } else if ($j === 'Tematik') {
            $table .= "<td class='text-right' style='font-weight:500'>$kr->tematik</td>";
        } else if ($j === 'Pekerjaan') {
            $table .= "<td class='text-right' style='font-weight:500'>$kr->pekerjaan</td>";
        } else if ($j === 'Anggaran') {
            $table .= "<td class='text-right' style='font-weight:500'>" . $format->formatCurrency($kr->anggaran, 'IDR') . "</td>";
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
