<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Berita Acara Kesepakatan Rakorbangwil</title>

    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 11px;
            margin: 30px;
            line-height: 1.4;
        }

        h2,
        h3 {
            text-align: center;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }

        h2 {
            font-size: 16px;
        }

        h3 {
            font-size: 13px;
            margin-top: 6px;
        }

        h4 {
            font-size: 12px;
            margin-top: 20px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        p {
            text-align: justify;
            margin: 6px 0;
        }

        ol {
            margin-left: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
        }

        table th {
            text-align: center;
            font-weight: bold;
        }

        .no-border td {
            border: none;
        }

        .center {
            text-align: center;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    <!-- ===================================================== -->
    <!-- HALAMAN 1 : JUDUL & PENDAHULUAN -->
    <!-- ===================================================== -->

    <h2>
        BERITA ACARA KESEPAKATAN<br>
        RAPAT KOORDINASI KETERPADUAN PENGEMBANGAN INFRASTRUKTUR WILAYAH<br>
        (RAKORBANGWIL) TAHUN 2025
    </h2>

    <h3>
        Pemrograman Infrastruktur Pekerjaan Umum<br>
        Tahun Anggaran 2027
    </h3>

    <br>

    <p>
        Pada tanggal <b>11–17 Desember 2025</b>, telah dilaksanakan Pembahasan
        Keterpaduan Program Infrastruktur Pekerjaan Umum TA 2027 berdasarkan
        Prioritas Nasional RPJMN 2025–2029 dalam Forum Desk Rakorbangwil Tahun 2025,
        dengan rincian sebagai berikut:
    </p>

    <ol>
        <li>
            Desk Rakorbangwil Tahun 2025 dihadiri oleh perwakilan dari:
            <ol type="a">
                <li>38 Bappeda/Bapelitbangda/Bapperinda Provinsi;</li>
                <li>
                    17 Kementerian/Lembaga, antara lain Kementerian Koordinator Bidang
                    Infrastruktur dan Pembangunan Kewilayahan, Kementerian PPN/Bappenas,
                    Kementerian PU, dan kementerian/lembaga terkait lainnya;
                </li>
                <li>
                    Unit Organisasi di lingkungan Kementerian PU:
                    Direktorat Jenderal Sumber Daya Air, Direktorat Jenderal Bina Marga,
                    Direktorat Jenderal Cipta Karya, Direktorat Jenderal Prasarana Strategis,
                    Sekretariat Jenderal, dan Badan Pengembangan Infrastruktur Wilayah.
                </li>
            </ol>
        </li>
        <li>
            Dalam Desk Rakorbangwil Tahun 2025 dibahas dan disepakati indikasi
            kawasan/lokus prioritas beserta kebutuhan program/kegiatan infrastruktur
            PU yang akan dilaksanakan pada TA 2027.
        </li>
    </ol>

    <div class="page-break"></div>

    <!-- ===================================================== -->
    <!-- A. KAWASAN / LOKUS PRIORITAS -->
    <!-- ===================================================== -->

    <h4>
        A. Kawasan/Lokus Prioritas yang Akan Didukung Infrastruktur PU TA 2027<br>
        Provinsi <?= esc($provinsi['provinsi']) ?>
    </h4>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="55%">Kawasan/Lokus Prioritas</th>
                <th width="40%">Prioritas Nasional</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($kawasan)): $no = 1;
                foreach ($kawasan as $k): ?>
                    <tr>
                        <td class="center"><?= $no++ ?></td>
                        <td><?= esc($k->nama_kawasan_rpjmn) ?></td>
                        <td><?= esc($k->tematik ?? '-') ?></td>
                    </tr>
                <?php endforeach;
            else: ?>
                <tr>
                    <td colspan="3" class="center">Tidak Ada Data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="page-break"></div>

    <!-- ===================================================== -->
    <!-- B – G : REKAP PROGRAM PER PRIORITAS NASIONAL -->
    <!-- ===================================================== -->

    <?php
    $sections = [
        'B' => 'Prioritas Nasional 2',
        'C' => 'Prioritas Nasional 3',
        'D' => 'Prioritas Nasional 4',
        'E' => 'Prioritas Nasional 5',
        'F' => 'Prioritas Nasional 6',
        'G' => 'Prioritas Nasional 8',
    ];
    ?>

    <?php foreach ($sections as $kode => $judul): ?>
        <h4><?= $kode ?>. Rekapitulasi Program/Kegiatan Pembangunan Infrastruktur PU TA 2027<br><?= $judul ?></h4>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Provinsi</th>
                    <th>Ditjen SDA</th>
                    <th>Ditjen BM</th>
                    <th>Ditjen CK</th>
                    <th>Ditjen PS</th>
                    <th>Total Kegiatan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="center">1</td>
                    <td><?= esc($provinsi['provinsi']) ?></td>
                    <td class="center">-</td>
                    <td class="center">-</td>
                    <td class="center">-</td>
                    <td class="center">-</td>
                    <td class="center">-</td>
                </tr>
            </tbody>
        </table>

        <div class="page-break"></div>
    <?php endforeach; ?>

    <!-- ===================================================== -->
    <!-- HALAMAN TANDA TANGAN -->
    <!-- ===================================================== -->

    <p class="center">
        Jakarta, Desember 2025<br>
        <b>Kementerian Pekerjaan Umum</b>
    </p>

    <br><br>

    <table class="no-border">
        <?php foreach ($pejabat_bak as $p): ?>
            <tr>
                <td class="center" style="padding-top:25px;">
                    <b><?= esc($p->nama_pejabat) ?></b><br>
                    <?= esc($p->jabatan) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>