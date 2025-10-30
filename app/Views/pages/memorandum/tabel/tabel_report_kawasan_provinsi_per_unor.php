<?php
$unorList = [6, 4, 5, 8];
$jenis = ['Kawasan', 'Tematik Kawasan', 'Pekerjaan'];
$a = 1;
foreach ($kawasan_per_provinsi_per_unor as $kr) {
    echo '<tr>';
    echo "<td>{$a}</td>";
    echo "<td>{$kr->provinsi}</td>";

    // Loop per jenis dan per Unor
    foreach ($jenis as $j) {
        foreach ($unorList as $unor) {
            // buat nama properti sesuai query
            $jumlah_unor = 'unor' . $unor . '_' . strtolower(str_replace(' ', '_', $j));
            echo "<td class='text-right'>{$kr->$jumlah_unor}</td>";
        }
    }

    echo '</tr>';
    $a++;
}
