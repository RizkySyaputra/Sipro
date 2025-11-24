<?php
$format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
$format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

$pnList = [2, 3, 4, 5, 6, 8];
$jenis = ['Kawasan', 'Tematik', 'Pekerjaan', 'Anggaran'];
$a = 1;
$total_kawasan = 0;
$total_pekerjaan = 0;
$total_anggaran = 0;

$table = '';
$table .= "<thead>
            <tr>
             <th rowspan='2' class='text-center'>No</th>
             <th rowspan='2' class='text-center'>Provinsi</th>"; // kolom tetap
foreach ($jenis as $j) {
    if ($j === 'Anggaran') {
        $j = 'Anggaran (Ribu)';
    }
    $table .= '<th colspan="' . count($pnList) + 1 . '" class="text-center">' . $j . '</th>';
}
$table .= "</tr>";

// Baris 2: PN
$table .= "<tr>";
foreach ($jenis as $j) {
    foreach ($pnList as $pn) {
        $table .= "<th class='text-center'>PN $pn</th>";
    }
    $table .= "<th class='text-center'>Total</th>";
}
$table .= "</tr></thead><tbody>";
foreach ($kawasan_per_provinsi_per_pn as $kn) {

    $total_kawasan += $kn->kawasan ?? 0;
    $total_pekerjaan += $kn->pekerjaan ?? 0;
    $total_anggaran += $kn->total_anggaran ?? 0;

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

$table .= "</tbody><tfoot><tr style='font-weight:bold;'>
    <td colspan='2' class='text-center'>Total</td>
    <td colspan='" . count($pnList) + 1 . "' class='text-right'>$total_kawasan</td>
    <td colspan='" . count($pnList) + 1 . "' class='text-right'>-</td>
    <td colspan='" . count($pnList) + 1 . "' class='text-right'>$total_pekerjaan</td>
    <td colspan='" . count($pnList) + 1 . "' class='text-right'>" . $format->formatCurrency($total_anggaran, 'IDR') . "</td>
</tr></tfoot>";

echo $table;
