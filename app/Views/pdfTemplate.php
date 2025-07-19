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
        <h3>BERITA ACARA KESEPAKATAN PROGRAM KETERPADUAN PROVINSI <?= $provinsi['provinsi']; ?></h3><br>
        <h4>HASIL PEMBAHASAN RAPAT KOORDINASI KETERPADUAN PENGEMBANGAN INFRASTRUKTUR WILAYAH (RAKORBANGWIL) BIDANG PU TAHUN 2024</h4>
        <h4>UNTUK PEMROGRAMAN INFRASTRUKTUR TAHUN ANGGARAN 2026</h4>
        <!-- Tambahkan konten lainnya di sini -->
    </div>

    <p>Dengan memperhatikan:</p>
    <ol>
        <li>Rencana Pembangunan Jangka Panjang Nasional (RPJPN) 2025-2045;</li>
        <li>Asta Cita 2025-2029;</li>
        <li>Rancangan Awal Rencana Pembangunan Jangka Menengah Nasional (RPJMN) 2025-2029;</li>
        <li>Teknokratik Rencana Strategis (Renstra) Kementerian Pekerjaan Umum 2025-2029;</li>
        <li>Rencana Pengembangan Infrastruktur Wilayah (RPIW) 38 Provinsi;</li>
        <li>Dinamika/perubahan kebijakan nasional;</li>
    </ol>

    <p>Dapat disepakati kawasan prioritas di Provinsi <?= $provinsi['provinsi']; ?> sebagai berikut:</p>
    <table>
        <thead>
            <tr>
                <th style="width: 20px;">No.</th>
                <th style="width: 220px;">Kawasan</th>
                <th style="width: 70px;">Kesepakatan</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1;
            $catatan = nl2br($catatanKawasan); // Mengubah newline menjadi <br>

            $row = count($kawasan);
            foreach ($kawasan as $kawasan) : ?>
                <?php if ($kawasan->nama_kawasan == 'Non Kawasan') {
                    continue;
                } ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $kawasan->nama_kawasan; ?></td>
                    <td>Diakomodasi</td>
                    <?php if ($i == 2) : ?>
                        <td rowspan="<?= $row ?>"><?= $catatan; ?></td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <p class="new-page">Dapat disepakati program/kegiatan infrastruktur PU TA 2026 di Provinsi <?= $provinsi['provinsi']; ?> sebagai berikut:</p>
    <table>
        <thead>
            <tr>
                <th style="width: 20px;">No.</th>
                <th style="width: 130px;">Kawasan</th>
                <th style="width: 200px;">Program/Kegiatan</th>
                <th style="width: 100x;">Unit Organisasi</th>
                <th style="width: 80px;">Kesepakatan</th>
                <th style="width: 80px;">Sumber Pendanaan</th>

                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $j = 1;
            foreach ($programs as $program) : ?>
                <?php if ($program->desk2 == 0) {
                    continue;
                } ?>
                <tr>
                    <td><?= $j++; ?></td>
                    <td><?php if (isset($kawasans[$program->id_rpiw])): ?>
                            <?php
                            $rows = count($kawasans[$program->id_rpiw]);
                            if ($rows > 1) {
                                $i = 1;
                                $ii = '.';
                            } else {
                                $i = '';
                                $ii = '';
                            }
                            ?>
                            <?php foreach ($kawasans[$program->id_rpiw] as $kawasan): ?>
                                <?= $i++ . $ii . $kawasan->nama_kawasan; ?><br>
                            <?php endforeach; ?>
                        <?php else: ?>
                            Non Kawasan
                        <?php endif; ?></td>
                    <td><?= $program->nama_program; ?></td>
                    <td><?= $program->id_pendanaan == 2 || $program->id_pendanaan == 4 ? "-" : $program->unor; ?></td>
                    <td><?= is_null($program->desk2) ? 'Belum dibahas' : ($program->desk2 == 1 ? 'Diakomodasi' : 'Ditangguhkan'); ?></td>
                    <td><?= $program->sumber_pendanaan; ?></td>
                    <td><?= nl2br($program->catatan_desk2); ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <p class="signature-table new-page">Program/kegiatan infrastruktur PU TA 2026 di Provinsi <?= $provinsi['provinsi']; ?> akan dibahas lebih lanjut dalam Konsultasi Regional (Konreg) Kementerian PU dengan memperhatikan ketersediaan alokasi anggaran dan tingkat prioritasnya.</p>
    <p class="date">Tangerang Selatan, <?php $formattedDate = date('d F Y', strtotime($tanggal));

                                        echo $formattedDate; ?></p>
    <table style="width: 100%; border-collapse: collapse;">
        <?php
        $tdCount = 0; // Counter untuk <td>
        $trContent = ''; // Menampung isi baris

        foreach ($pejabat as $pejabat) {
            // Menambahkan kolom (td)
            $trContent .= '<td style="text-align: center; vertical-align: middle; padding: 20px; border: none; width: 33%;">';
            $trContent .= '<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 200px;">'; // Container flexbox untuk mengatur posisi dan ukuran
            if ($pejabat->tanda_tangan) {
                $trContent .= '<img src="' . 'assets/ttd/' . $pejabat->tanda_tangan . '" alt="Tanda Tangan" style="width: 100px; height: 100px; object-fit: contain; margin-bottom: 10px;">';
            } else {
                $trContent .= '<img src="assets/ttd/nonttd.png" alt="Tanda Tangan" style="width: 100px; height: 100px; object-fit: contain; margin-bottom: 10px;">';
            }
            $trContent .= '<p style="margin: 0; font-size: 14px; font-weight: bold;">' . $pejabat->nama_pejabat . '</p>';
            $trContent .= '<p style="margin: 0; font-size: 12px; font-style: italic;">' . $pejabat->jabatan . '</p>';
            $trContent .= '</div></td>';

            $tdCount++;

            // Setelah 3 <td>, tambahkan <tr>
            if ($tdCount === 3) {
                echo '<tr>' . $trContent . '</tr>';
                $trContent = ''; // Reset trContent untuk baris berikutnya
                $tdCount = 0; // Reset tdCount
            }
        }

        // Jika masih ada <td> yang tersisa, tambahkan baris terakhir
        if ($tdCount > 0) {
            echo '<tr>' . $trContent . '</tr>';
        }
        ?>
    </table>


</body>

</html>