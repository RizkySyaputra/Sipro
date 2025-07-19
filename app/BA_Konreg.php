<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/img/apple-icon.png') ?>">
    <link rel="icon" type="image/png" href="https://sipro.pu.go.id/assets/img/favicon.ico?v=2">
    <title>Berita Acara Kesepakatan</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;

            font-size: 11px;
            margin: 0;
            padding: 0;
            z-index: 1;
        }

        .content {
            padding: 20px;
            position: relative;
            z-index: 10;
            /* Menjamin konten tetap di atas gambar */
        }

        h3,
        h4 {
            width: 50%;
            margin: 0 auto;
            /* Memastikan elemen tetap di tengah */
            text-align: center;
            /* Memastikan teks tetap di tengah */
        }

        h3 {
            font-size: 14px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }

        h4 {
            font-size: 11px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }

        p,
        ol {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid black;
            padding: 8px;
            font-size: 11px;
            vertical-align: middle;
        }

        th {
            text-align: center;
        }

        table thead th {
            background-color: #007bff;
            color: white;
        }

        table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        table tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        .signature-table {
            width: 100%;
            margin-top: 40px;
        }

        .signature-table td {
            text-align: center;
            padding: 10px;
        }

        .new-page {
            page-break-before: always;
        }

        .date {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="content">
        <h3>POKOK–POKOK HASIL PEMBAHASAN PROGRAM DAN KEGIATAN INFRASTRUKTUR PU</h3>
        <h3>TAHUN ANGGARAN 2026</h3>
        <h3>DALAM KONSULTASI REGIONAL KEMENTERIAN PU TAHUN 2025</h3>
        <h3>PROVINSI : <?= $provinsi['provinsi']; ?></h3>
        <h3>DIREKTORAT JENDERAL : <?= $unor['unor']; ?></h3>
        <!-- Tambahkan konten lainnya di sini -->
    </div>

    <p>1.Pembahasan Program/Kegiatan Infrastruktur dalam Konsultasi Regional Kementerian PU Tahun 2025 dilakukan dengan memperhatikan:</p>
    <ol>
        <li>Undang-Undang No. 59 Tahun 2024 tentang RPJPN 2025-2045;</li>
        <li>Peraturan Presiden No. 12 Tahun 2025 tentang RPJMN Tahun 2025-2029;</li>
        <li>Hasil Rapat Koordinasi Keterpaduan Pengembangan Infrastruktur Wilayah (Rakorbangwil) Tahun 2024;</li>
        <li>Hasil Rapat Koordinasi Teknis Perencanaan Pembangunan (Rakortekrenbang) Tahun 2025;</li>
        <li>Arahan Rencana Tata Ruang Wilayah (RTRW) Nasional, RTRW Pulau/Kepulauan, dan/atau RTRW Provinsi/Kabupaten/Kota;</li>
        <li>Dinamika/perubahan kebijakan nasional;</li>
    </ol>

    <p>2.Berdasarkan pembahasan, Kegiatan Wajib antara lain (Rincian F-KW terlampir):</p>
    <table>
        <thead>
            <tr>
                <th style="width: 20px;">No.</th>
                <th style="width: 220px;">Kegiatan/Klasifikasi Rincian Output (KRO)/ Rincian Output (RO)/Pekerjaan</th>
                <th style="width: 70px;">Lokasi</th>
                <th style="width: 70px;">Volume</th>
                <th style="width: 70px;">Satuan</th>
                <th style="width: 70px;">Rencana Alokasi (Rp. Ribu)</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1;

            foreach ($fkw as $fkw) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $fkw->pekerjaan; ?></td>
                    <td><?= $fkw->lokasi; ?></td>
                    <td><?= $fkw->volume; ?></td>
                    <td><?= $fkw->nama_satuan; ?></td>
                    <td><?php $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                        echo $format->formatCurrency($fkw->anggaran, 'IDR'); ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <p class="new-page">3.Berdasarkan pembahasan, Kegiatan Baru termasuk kegiatan yang diusulkan provinsi antara lain (Rincian F-KB terlampir):</p>
    <table>
        <thead>
            <tr>
                <th style="width: 20px;">No.</th>
                <th style="width: 220px;">Kegiatan/Klasifikasi Rincian Output (KRO)/ Rincian Output (RO)/Pekerjaan</th>
                <th style="width: 70px;">Lokasi</th>
                <th style="width: 70px;">Volume</th>
                <th style="width: 70px;">Satuan</th>
                <th style="width: 70px;">Rencana Alokasi (Rp. Ribu)</th>
            </tr>
        </thead>
        <tbody>
            <?php $j = 1;
            foreach ($fkb as $fkb) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $fkb->nama_program; ?></td>
                    <td><?= $fkb->lokasi; ?></td>
                    <td><?= $fkb->volume; ?></td>
                    <td><?= $fkb->satuan; ?></td>
                    <td><?= $fkb->anggaran; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <!-- <p class="new-page">3.Berdasarkan pembahasan, Kegiatan Baru termasuk kegiatan yang diusulkan provinsi antara lain (Rincian F-KB terlampir):</p>
    <table>
        <thead>
            <tr>
                <th style="width: 20px;">No.</th>
                <th style="width: 220px;">Kegiatan/Klasifikasi Rincian Output (KRO)/ Rincian Output (RO)/Pekerjaan</th>
                <th style="width: 70px;">Lokasi</th>
                <th style="width: 70px;">Volume</th>
                <th style="width: 70px;">Satuan</th>
                <th style="width: 70px;">Rencana Alokasi (Rp. Ribu)</th>
            </tr>
        </thead>
        <tbody>
            <?php $j = 1;
            foreach ($fkb as $fkb) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $fkb->nama_program; ?></td>
                    <td><?= $fkb->lokasi; ?></td>
                    <td><?= $fkb->volume; ?></td>
                    <td><?= $fkb->satuan; ?></td>
                    <td><?= $fkb->anggaran; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table> -->
    <p>4.Pokok-pokok Hasil Pembahasan dalam Konsultasi Regional Kementerian PU Tahun 2025 menjadi bahan pembahasan pada forum-forum perencanaan dan pemrograman lainnya, antara lain Rapat Teknis di tingkat Unit Organisasi di Kementerian PU dan Musyawarah Perencanaan Pembangunan Nasional (Musrenbangnas) serta dalam penyusunan Rencana Kerja (Renja) Kementerian PU tahun 2026. Adapun kegiatan F-KW dan FKB yang bersumber dari unit Unit Organisasi di Kementerian PU maupun yang bersumber dari Rakortekrenbang dan Rakorbangwil dapat dilakukan peninjauan dan penajaman kembali.</p>
    <p>5.Pemenuhan program/kegiatan hasil Konsultasi Regional Kementerian PU Tahun 2025 akan tergantung dari ketersediaan alokasi anggaran dan tingkat prioritasnya.</p>



</body>

</html>