<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara Kesepakatan</title>
    <style>
        .section-block {
            page-break-inside: avoid !important;
        }

        .ttd-container {
            width: 100%;
            margin-top: 40px;
        }

        .ttd-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 50px;
        }

        .ttd-box {
            width: 32%;
            text-align: center;
            font-size: 11px;
        }

        .ttd-name {
            margin-top: 3px;
            font-weight: bold;
        }

        .ttd-position {
            font-size: 10px;
            margin-bottom: 40px;
        }

        .ttd-line {
            margin-top: 40px;
            border-top: 1px dotted #000;
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>

    <style>
        body {
            font-size: 11px;
            margin: 25px;
            padding: 0;
            z-index: 1;
            line-height: 1.4;
        }

        h2,
        h3,
        h4,
        h5 {
            text-align: center;
            margin: 0 auto 10px auto;
            font-weight: bold;
            text-transform: uppercase;
        }

        h2 {
            font-size: 16px;
        }

        h3 {
            font-size: 14px;
        }

        h4 {
            font-size: 12px;
        }

        h5 {
            font-size: 12px;
            text-align: left;
            margin-top: 25px;
            margin-bottom: 8px;
        }

        p,
        ol {
            margin-bottom: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 11px;
        }

        table th,
        table td {
            border: 1px solid black;
            padding: 6px;
            vertical-align: top;
        }

        table thead th {
            background-color: #D6E7F6;
            font-weight: bold;
            text-align: center;
        }

        .date {
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>

<body>

    <!-- ======== HEADER DOKUMEN ======== -->
    <h2>BERITA ACARA KESEPAKATAN<br>
        PROGRAM KETERPADUAN PEMBANGUNAN INFRASTRUKTUR PU TA 2027<br>
        MENDUKUNG PRIORITAS NASIONAL (PN) RPJMN 2025–2029<br>
        DI PROVINSI <?= strtoupper($provinsi['provinsi']) ?>
    </h2>

    <h3>HASIL PEMBAHASAN RAPAT KOORDINASI KETERPADUAN PENGEMBANGAN <br>
        INFRASTRUKTUR WILAYAH (RAKORBANGWIL)
        TAHUN 2025
    </h3>


    <!-- ======== PARAGRAF PEMBUKA ======== -->
    <div style="margin-top:25px;">
        <p>Dengan memperhatikan:</p>
        <ol>
            <li>Rencana Pembangunan Jangka Panjang Nasional (RPJPN) 2045;</li>
            <li>Rencana Pembangunan Jangka Menengah (RPJMN) 2025–2029;</li>
            <li>Rancangan Rencana Strategis Kementerian Pekerjaan Umum 2025–2029;</li>
            <li>Rencana Pembangunan Infrastruktur Wilayah (RPIW) 2025–2034 di 38 Provinsi; dan</li>
            <li>Masukan dalam Pra Rakorbangwil Tahun 2025 tanggal 12–18 November 2025.</li>
        </ol>
    </div>


    <!-- ======== A. KAWASAN PRIORITAS ======== -->
    <div class="section-block">
        <h5>A. Disepakati Kawasan Prioritas di Provinsi <?= $provinsi['provinsi'] ?> </h5>

        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="45%">Kawasan</th>
                    <th width="50%">Tematik</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($kawasan)): ?>
                    <?php $no = 1;
                    foreach ($kawasan as $row): ?>
                        <tr>
                            <td align="center"><?= $no++ ?></td>
                            <td><?= $row->nama_kawasan_rpjmn ?></td>
                            <td><?= $row->tematik ?: '-' ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" align="center">Tidak Ada Data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
    <!-- ======== B. DIKOMODASI ======== -->
    <div class="section-block">
        <h5>B. Disepakati program/kegiatan infrastruktur PU TA 2027 yang diakomodasi di Provinsi <?= $provinsi['provinsi'] ?> sebagai berikut :</h5>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kawasan</th>
                    <th>Program/Kegiatan</th>
                    <th>Unit Organisasi</th>
                    <th>Kesepakatan</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($diakomodasi)): ?>
                    <?php $no = 1;
                    foreach ($diakomodasi as $row): ?>
                        <tr>
                            <td align="center"><?= $no++ ?></td>
                            <td><?= $row->kawasan_panjang ?></td>
                            <td><?= $row->pekerjaan ?></td>
                            <td><?= $row->unor ?></td>
                            <td><?php if ($row->desk_rakorbangwil == '1') {
                                    echo "Diakomodasi untuk Dilanjutkan pada Desk Konreg";
                                }  ?></td>
                            <td style="width: 30%;">
                                <?php
                                if (!empty($row->catatan_desk_rakorbangwil)) {

                                    // Decode JSON
                                    $catatanList = json_decode($row->catatan_desk_rakorbangwil, true);

                                    // Cek apakah valid array
                                    if (is_array($catatanList)) {
                                        foreach ($catatanList as $item) {
                                            echo esc($item['nama']) . " : <br> " . nl2br(esc($item['catatan'])) . "<br>";
                                        }
                                    } else {
                                        echo "-";
                                    }
                                } else {
                                    echo "-";
                                }
                                ?>
                            </td>

                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" align="center">Tidak Ada Data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="section-block">
        <!-- ======== C. DITANGGUHKAN ======== -->
        <h5>C. Disepakati program/kegiatan infrastruktur PU TA 2027 yang ditangguhkan di Provinsi <?= $provinsi['provinsi'] ?> sebagai berikut :</h5>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kawasan</th>
                    <th>Program/Kegiatan</th>
                    <th>Unit Organisasi</th>
                    <th>Kesepakatan</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ditangguhkan)): ?>
                    <?php $no = 1;
                    foreach ($ditangguhkan as $row): ?>
                        <tr>
                            <td align="center"><?= $no++ ?></td>
                            <td><?= $row->kawasan_panjang ?></td>
                            <td><?= $row->pekerjaan ?></td>
                            <td><?= $row->unor ?></td>
                            <td><?php if ($row->desk_rakorbangwil == '3') {
                                    echo "Ditangguhkan karena kegiatan fisik telah dilaksanakan";
                                } elseif ($row->desk_rakorbangwil == '4') {
                                    echo "Ditangguhkan karena Kegiatan fisik digeser ke tahun selanjutnya";
                                } elseif ($row->desk_rakorbangwil == '5') {
                                    echo "Ditangguhkan karena menggunakan skema KPBU, menjadi input Forum Pemrograman di luar APBN";
                                }  ?></td>
                            <td style="width: 30%;">
                                <?php
                                if (!empty($row->catatan_desk_rakorbangwil)) {

                                    // Decode JSON
                                    $catatanList = json_decode($row->catatan_desk_rakorbangwil, true);

                                    // Cek apakah valid array
                                    if (is_array($catatanList)) {
                                        foreach ($catatanList as $item) {
                                            echo esc($item['nama']) . " : <br> " . nl2br(esc($item['catatan'])) . "<br>";
                                        }
                                    } else {
                                        echo "-";
                                    }
                                } else {
                                    echo "-";
                                }
                                ?>
                            </td>

                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" align="center">Tidak Ada Data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="section-block">
        <!-- ======== D. TIDAK TERBAHAS ======== -->
        <h5>D. Disepakati program/kegiatan infrastruktur PU TA 2027 yang tidak terbahas di Provinsi <?= $provinsi['provinsi'] ?> akan dilanjutkan pada Pra Desk Konsultasi Regional (Konreg) TA 2026 atau menjadi Input pada Forum Pemrograman di Luar APBN sebagai berikut:</h5>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kawasan</th>
                    <th>Program/Kegiatan</th>
                    <th>Unit Organisasi</th>
                    <th>Kesepakatan</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tidakTerbahas)): ?>
                    <?php $no = 1;
                    foreach ($tidakTerbahas as $row): ?>
                        <tr>
                            <td align="center"><?= $no++ ?></td>
                            <td><?= $row->kawasan_panjang ?></td>
                            <td><?= $row->pekerjaan ?></td>
                            <td><?= $row->unor ?></td>
                            <td><?php if ($row->desk_rakorbangwil == '2') {
                                    echo "Diakomodasi untuk Dibahas pada Pra Konreg";
                                } elseif ($row->desk_rakorbangwil == '6') {
                                    echo "Ditangguhkan karena menggunakan Sumber Pendanaan Lainnya, menjadii input Forum Pemrograman di luar APBN";
                                } elseif ($row->desk_rakorbangwil == '7') {
                                    echo "Ditangguhkan karena menggunakan skema KPBU, menjadi input Forum Pemrograman di luar APBN";
                                } else {
                                    echo "Tidak Terbahas";
                                }  ?></td>
                            <td style="width: 30%;">
                                <?php
                                if (!empty($row->catatan_desk_rakorbangwil)) {

                                    // Decode JSON
                                    $catatanList = json_decode($row->catatan_desk_rakorbangwil, true);

                                    // Cek apakah valid array
                                    if (is_array($catatanList)) {
                                        foreach ($catatanList as $item) {
                                            echo esc($item['nama']) . " : <br> " . nl2br(esc($item['catatan'])) . "<br>";
                                        }
                                    } else {
                                        echo "-";
                                    }
                                } else {
                                    echo "-";
                                }
                                ?>
                            </td>

                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" align="center">Tidak Ada Data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- ======== PARAGRAF PENUTUP ======== -->
    <p style="margin-top:25px;">
        Program/kegiatan infrastruktur PU TA 2027 di Provinsi <?= $provinsi['provinsi'] ?>
        akan dibahas lebih lanjut dalam Konsultasi Regional (Konreg) Kementerian PU dan forum pemrograman dan penganggaran tingkat nasional dengan memperhatikan kesiapan readiness criteria, ketersedian alokasi anggaran, dan tingkat prioritasnya.
    </p>

    <p style="text-align:center; margin-bottom:40px;">
        Jakarta, <?= date('d F Y', strtotime($tanggal_bak)) ?>
    </p>
    <table style="width: 100%; border-collapse: collapse; text-align: center;">
        <?php
        $count = 0;
        foreach ($pejabat_bak as $p):
            if ($count % 3 === 0) echo "<tr>";
        ?>
            <td style="text-align:center; padding:20px; border:none; width:33%;">
                <div style="display:flex; flex-direction:column; align-items:center; height:200px;">

                    <?php
                    // Path image absolute (FPATH)
                    $ttd_file = FCPATH . 'assets/ttd/' . $p->tanda_tangan;
                    ?>

                    <?php if (!empty($p->tanda_tangan) && file_exists($ttd_file)): ?>
                        <img src="<?= $ttd_file ?>" style="width:100px; height:100px; object-fit:contain; margin-bottom:10px;">
                    <?php else: ?>
                        <img src="assets/ttd/nonttd.png" style="width:100px; height:100px; opacity:0.3;">
                    <?php endif; ?>

                    <p style="margin:0; font-size:14px; font-weight:bold;">
                        <?= htmlspecialchars($p->nama_pejabat) ?>
                    </p>
                    <p style="margin:0; font-size:12px; font-style:italic;">
                        <?= htmlspecialchars($p->jabatan) ?>
                    </p>
                </div>
            </td>
        <?php
            $count++;
            if ($count % 3 === 0) echo "</tr>";
        endforeach;

        if ($count % 3 !== 0) echo "</tr>";
        ?>
    </table>



</body>

</html>