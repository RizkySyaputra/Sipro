<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara Kesepakatan</title>

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
        PROGRAM KETERPADUAN PEMBANGUNAN INFRASTRUKTUR PU TA 2025<br>
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
    <h5>A. Disepakati Kawasan Prioritas di Provinsi <?= $provinsi['provinsi'] ?></h5>

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
                        <td><?= $row->kawasan ?></td>
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


    <!-- ======== B. DIKOMODASI ======== -->
    <h5>B. Disepakati Program/Kegiatan Infrastruktur PU TA 2027 yang Diakomodasi di Provinsi <?= $provinsi['provinsi'] ?></h5>

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
                        <td><?= $row->kawasan ?></td>
                        <td><?= $row->pekerjaan ?></td>
                        <td><?= $row->unor ?></td>
                        <td>Diakomodasi</td>
                        <td><?= $row->catatan_desk_rakorbangwil ?: '-' ?></td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" align="center">Tidak Ada Data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>


    <!-- ======== C. DITANGGUHKAN ======== -->
    <h5>C. Disepakati Program/Kegiatan Infrastruktur PU TA 2027 yang Ditangguhkan di Provinsi <?= $provinsi['provinsi'] ?></h5>

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
                        <td><?= $row->kawasan ?></td>
                        <td><?= $row->pekerjaan ?></td>
                        <td><?= $row->unor ?></td>
                        <td><?php if ($row->desk_rakorbangwil == '2') {
                                echo "Direncanakan ke tahun berikutnya";
                            } elseif ($row->desk_rakorbangwil == '3') {
                                echo "Telah dilaksanakan";
                            } ?></td>
                        <td><?= $row->catatan_desk_rakorbangwil ?: '-' ?></td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" align="center">Tidak Ada Data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>


    <!-- ======== D. TIDAK TERBAHAS ======== -->
    <h5>D. Program/Kegiatan Infrastruktur PU TA 2027 yang Tidak Terbahas di Provinsi Aceh akan dilanjutkan pada Konsultasi Regional (Konreg) TA 2026 sebagai berikut:</h5>

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
                        <td><?= $row->kawasan ?></td>
                        <td><?= $row->pekerjaan ?></td>
                        <td><?= $row->unor ?></td>
                        <td>Tidak Terbahas</td>
                        <td><?= $row->catatan_desk_rakorbangwil ?: '-' ?></td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" align="center">Tidak Ada Data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>


    <!-- ======== PARAGRAF PENUTUP ======== -->
    <p style="margin-top:25px;">
        Program/kegiatan infrastruktur PU TA 2027 di Provinsi <?= $provinsi['provinsi'] ?>
        akan dibahas lebih lanjut dalam Konsultasi Regional dan forum pemrograman lainnya
        dengan memperhatikan readiness criteria, ketersediaan alokasi anggaran, dan tingkat prioritasnya.
    </p>

    <p class="date">Jakarta, Desember 2025</p>


    <!-- ======== TANDA TANGAN ======== -->
    <table style="margin-top:30px;">
        <thead>
            <tr>
                <th>Nama dan Jabatan</th>
                <th width="200px">Tanda Tangan</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

</body>

</html>