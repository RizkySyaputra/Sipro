<?php
$format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
$format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

$unorList = ['SDA', 'BM', 'CK', 'PS'];
$jenis = ['Kawasan', 'Tematik', 'Pekerjaan', 'Anggaran'];
$a = 1;
$total_kawasan = 0;
$total_pekerjaan = 0;
$total_anggaran = 0;
$tahun = '-';

$table = '';
$table .= "<thead>
            <tr>
             <th rowspan='2' class='text-center'>No</th>
             <th rowspan='2' class='text-center'>Provinsi</th>"; // kolom tetap
foreach ($jenis as $j) {
    if ($j === 'Anggaran') {
        $j = 'Anggaran (Ribu)';
    }
    $table .= '<th colspan="' . count($unorList) + 1 . '" class="text-center">' . $j . '</th>';
}
$table .= "<th rowspan='2' class='text-center'>Tahun Anggaran</th></tr>";

// Baris 2: Unor
$table .= "<tr>";
foreach ($jenis as $j) {
    foreach ($unorList as $unor) {
        $table .= "<th class='text-center'>$unor</th>";
    }
    $table .= "<th class='text-center'>Total</th>";
}
$table .= "</tr></thead><tbody>";
foreach ($kawasan_per_provinsi_per_unor as $kr) {
    $total_kawasan += $kr->kawasan ?? 0;
    $total_pekerjaan += $kr->pekerjaan ?? 0;
    $total_anggaran += $kr->anggaran ?? 0;

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

    $tahun = $kr->tahun;
    if ($tahun === '2529') {
        $tahun = '2025 - 2029';
    }

    $table .= "<td>$tahun</td></tr>";
    $a++;
}

$table .= "</tbody><tfoot><tr style='font-weight:bold;'>
    <td colspan='2' class='text-center'>Total</td>
    <td colspan='" . count($unorList) + 1 . "' class='text-right'>$total_kawasan</td>
    <td colspan='" . count($unorList) + 1 . "' class='text-right'>-</td>
    <td colspan='" . count($unorList) + 1 . "' class='text-right'>$total_pekerjaan</td>
    <td colspan='" . count($unorList) + 1 . "' class='text-right'>" . $format->formatCurrency($total_anggaran, 'IDR') . "</td>
    <td>$tahun</td>
</tr></tfoot>";

echo $table;
