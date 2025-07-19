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
            width: 1100px;
            border-collapse: collapse;
            margin-top: 10px;
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
        <h3 style=" width: 80%;">POKOK–POKOK HASIL PEMBAHASAN PROGRAM DAN KEGIATAN INFRASTRUKTUR PU</h3>
        <h3>TAHUN ANGGARAN 2026</h3>
        <h3>DALAM KONSULTASI REGIONAL KEMENTERIAN PU TAHUN 2025</h3>
        <h3>PROVINSI : <?= $provinsi['provinsi']; ?></h3>
        <h3>DIREKTORAT JENDERAL : <?= $unor['unor']; ?></h3>
        <!-- Tambahkan konten lainnya di sini -->
    </div>

    <p>1.Pembahasan Program/Kegiatan Infrastruktur dalam Konsultasi Regional Kementerian PU Tahun 2025 dilakukan dengan memperhatikan:</p>
    <ol type="a">
        <li>Undang-Undang No. 59 Tahun 2024 tentang RPJPN 2025-2045;</li>
        <li>Peraturan Presiden No. 12 Tahun 2025 tentang RPJMN Tahun 2025-2029;</li>
        <li>Hasil Rapat Koordinasi Keterpaduan Pengembangan Infrastruktur Wilayah (Rakorbangwil) Tahun 2024;</li>
        <li>Hasil Rapat Koordinasi Teknis Perencanaan Pembangunan (Rakortekrenbang) Tahun 2025;</li>
        <li>Arahan Rencana Tata Ruang Wilayah (RTRW) Nasional, RTRW Pulau/Kepulauan, dan/atau RTRW Provinsi/Kabupaten/Kota;</li>
        <li>Dinamika/perubahan kebijakan nasional;</li>
    </ol>
    <p>2. Berdasarkan pembahasan, Kegiatan Wajib antara lain (Rincian F-KW terlampir):</p>
    <table>
        <colgroup>
            <col style="width: 5%;">
            <col style="width: 45%;">
            <col style="width: 15%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 15%;">
        </colgroup>
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Klasifikasi Rincian Output (KRO) /<br>Rincian Output (RO) / Pekerjaan</th>
                <th rowspan="2">Lokasi</th>
                <th colspan="2">Sasaran</th>
                <th rowspan="2">Rencana Alokasi (Rp. Ribu)</th>
            </tr>
            <tr>
                <th>Volume</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($fkw as $fkw) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $fkw->nmkro . ' / ' .  $fkw->nmro . ' / ' . $fkw->pekerjaan; ?></td>
                    <td><?= $fkw->lokasi; ?></td>
                    <td style="text-align: right;">

                        <?php
                        $volume = $fkw->volume;

                        // Cek apakah memiliki pecahan desimal
                        if (fmod($volume, 1) !== 0.0) {
                            echo number_format($volume, 2, '.', '');
                        } else {
                            echo $volume;
                        }
                        ?>

                    </td>
                    <td><?= $fkw->nama_satuan; ?></td>
                    <td style="text-align: right;">
                        <?php
                        $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                        $format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
                        echo $format->formatCurrency($fkw->anggaran, 'IDR');
                        ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <p>3. Berdasarkan pembahasan, Kegiatan Baru termasuk kegiatan yang diusulkan provinsi antara lain (Rincian F-KB terlampir):</p>
    <table>
        <colgroup>
            <col style="width: 5%;">
            <col style="width: 45%;">
            <col style="width: 15%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 15%;">
        </colgroup>
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Klasifikasi Rincian Output (KRO) /<br>Rincian Output (RO) / Pekerjaan</th>
                <th rowspan="2">Lokasi</th>
                <th colspan="2">Sasaran</th>
                <th rowspan="2">Rencana Alokasi (Rp. Ribu)</th>
            </tr>
            <tr>
                <th>Volume</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            <?php $j = 1;
            foreach ($fkb as $fkb) : ?>
                <tr>
                    <td><?= $j++; ?></td>
                    <td><?= $fkb->nmkro . ' / ' .  $fkb->nmro . ' / ' . $fkb->pekerjaan; ?></td>
                    <td><?= $fkb->lokasi; ?></td>
                    <td style="text-align: right;">
                        <?php
                        $volume = $fkb->volume;

                        // Cek apakah memiliki pecahan desimal
                        if (fmod($volume, 1) !== 0.0) {
                            echo number_format($volume, 2, '.', '');
                        } else {
                            echo $volume;
                        }
                        ?>
                    <td><?= $fkb->nama_satuan; ?></td>
                    <td style="text-align: right;">
                        <?php
                        $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                        $format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
                        echo $format->formatCurrency($fkb->anggaran, 'IDR');
                        ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <p style="text-indent: -0.9em;">4. Rekapitulasi pembahasan program/kegiatan yang disepakati sebagai berikut:</p>
    <table>
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Sumber Data</th>
                <th colspan="2">F-KW</th>
                <th colspan="2">F-KB</th>
                <th colspan="2">Jumlah</th>
            </tr>
            <tr>
                <th>Pekerjaan</th>
                <th>Anggaran(Rp. Ribu)</th>
                <th>Pekerjaan</th>
                <th>Anggaran (Rp. Ribu)</th>
                <th>Pekerjaan</th>
                <th>Anggaran (Rp. Ribu)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
            $format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

            // Total per bagian
            $total_fkw_program = 0;
            $total_fkw_anggaran = 0;
            $total_fkb_program = 0;
            $total_fkb_anggaran = 0;
            $total_program = 0;
            $total_anggaran = 0;

            $rows = [
                ['label' => 'Rakorbangwil', 'key' => 'rakorbangwil'],
                ['label' => 'Usulan Provinsi', 'key' => 'provinsi'],
                ['label' => 'Rakortekrenbang', 'key' => 'rakortek'],
                ['label' => 'Unit Organisasi', 'key' => 'unor']
            ];

            $no = 1;
            foreach ($rows as $row) :
                $key = $row['key'];
                $label = $row['label'];

                $fkw_program = $laporanfkw[0]->{"program_$key"} ?? 0;
                $fkb_program = $laporanfkb[0]->{"program_$key"} ?? 0;

                $fkw_anggaran = $laporanfkw[0]->{"anggaran_$key"} ?? 0;
                $fkb_anggaran = $laporanfkb[0]->{"anggaran_$key"} ?? 0;

                $program_total = $fkw_program + $fkb_program;
                $anggaran_total = $fkw_anggaran + $fkb_anggaran;

                if (
                    $fkw_program == 0 && $fkb_program == 0 &&
                    $fkw_anggaran == 0 && $fkb_anggaran == 0
                ) {
                    continue;
                }
                // Akumulasi
                $total_fkw_program += $fkw_program;
                $total_fkw_anggaran += $fkw_anggaran;
                $total_fkb_program += $fkb_program;
                $total_fkb_anggaran += $fkb_anggaran;
                $total_program += $program_total;
                $total_anggaran += $anggaran_total;
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $label ?></td>
                    <td style="text-align: right;"><?= $fkw_program ?: '' ?></td>
                    <td style="text-align: right;"><?= $fkw_anggaran ? $format->formatCurrency($fkw_anggaran, 'IDR') : '' ?></td>
                    <td style="text-align: right;"><?= $fkb_program ?: '' ?></td>
                    <td style="text-align: right;"><?= $fkb_anggaran ? $format->formatCurrency($fkb_anggaran, 'IDR') : '' ?></td>
                    <td style="text-align: right;"><?= $program_total ?: '' ?></td>
                    <td style="text-align: right;"><?= $anggaran_total ? $format->formatCurrency($anggaran_total, 'IDR') : '' ?></td>
                </tr>
            <?php endforeach; ?>

            <!-- ROW TOTAL -->
            <tr style="font-weight: bold; background-color: #f0f0f0;">
                <td colspan="2" style="text-align: center;"><strong>TOTAL</strong></td>
                <td style="text-align: right;"><strong><?= $total_fkw_program ?></strong></td>
                <td style="text-align: right;"><strong><?= $format->formatCurrency($total_fkw_anggaran, 'IDR') ?></strong></td>
                <td style="text-align: right;"><strong><?= $total_fkb_program ?></strong></td>
                <td style="text-align: right;"><strong><?= $format->formatCurrency($total_fkb_anggaran, 'IDR') ?></strong></td>
                <td style="text-align: right;"><strong><?= $total_program ?></strong></td>
                <td style="text-align: right;"><strong><?= $format->formatCurrency($total_anggaran, 'IDR') ?></strong></td>
            </tr>

        </tbody>

    </table>
    <p style="text-indent: -0.9em;">5.Pokok-pokok Hasil Pembahasan dalam Konsultasi Regional Kementerian PU Tahun 2025 menjadi bahan pembahasan pada forum-forum perencanaan dan pemrograman lainnya, antara lain Rapat Teknis di tingkat Unit Organisasi di Kementerian PU dan Musyawarah Perencanaan Pembangunan Nasional (Musrenbangnas) serta dalam penyusunan Rencana Kerja (Renja) Kementerian PU tahun 2026. Adapun kegiatan F-KW dan F-KB yang bersumber dari unit Unit Organisasi di Kementerian PU maupun yang bersumber dari Rakortekrenbang dan Rakorbangwil dapat dilakukan peninjauan dan penajaman kembali.</p>
    <p>6.Pemenuhan program/kegiatan hasil Konsultasi Regional Kementerian PU Tahun 2025 akan tergantung dari ketersediaan alokasi anggaran dan tingkat prioritasnya.</p>


    <!-- <p class="signature-table new-page">Program/kegiatan infrastruktur PU TA 2026 di Provinsi <?= $provinsi['provinsi']; ?> akan dibahas lebih lanjut dalam Konsultasi Regional (Konreg) Kementerian PU dengan memperhatikan ketersediaan alokasi anggaran dan tingkat prioritasnya.</p> -->
    <p class="date new-page">Jakarta, <?php $formattedDate = date('d F Y', strtotime($tanggal));

                                        echo $formattedDate; ?></p>
    <table style="width: 100%; border-collapse: collapse;">
        <?php
        $tdCount = 0; // Counter untuk <td>
        $trContent = ''; // Menampung isi baris

        foreach ($pejabat as $pejabat) {
            // Menambahkan kolom (td)
            $trContent .= '<td style="text-align: center; vertical-align: middle; padding: 20px; border: none; width: 33%;">';
            $trContent .= '<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 200px;">'; // Container flexbox untuk mengatur posisi dan ukuran
            if (substr($pejabat->tanda_tangan, 0, 1) == "-") {
                $trContent .= '<img src="assets/ttd/nonttd.png" alt="Tanda Tangan" style="width: 100px; height: 100px; object-fit: contain; margin-bottom: 10px;">';
            } elseif (substr($pejabat->tanda_tangan, 0, 1) != "-") {
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


    <div class="content new-page">
        <h3>LAMPIRAN</h3>
    </div>

    <p>1.(Rincian F-KB terlampir):</p>
    <table>
        <colgroup>
            <col style="width: 5%;">
            <col style="width: 10%;">
            <col style="width: 35%;">
            <col style="width: 15%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 15%;">
        </colgroup>
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Sumber</th>
                <th rowspan="2">Klasifikasi Rincian Output (KRO) /<br>Rincian Output (RO) / Pekerjaan</th>
                <th rowspan="2">Lokasi</th>
                <th colspan="2">Sasaran</th>
                <th rowspan="2">Rencana Alokasi (Rp. Ribu)</th>
                <th rowspan="2">Catatan Desk</th>
            </tr>
            <tr>
                <th>Volume</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            <?php $j = 1;
            foreach ($fkbLampiran as $fkb) : ?>
                <tr>
                    <td><?= $j++; ?></td>
                    <td><?= $fkb->sumber; ?></td>
                    <td><?= $fkb->nmkro . ' / ' .  $fkb->nmro . ' / ' . $fkb->pekerjaan; ?></td>
                    <td><?= $fkb->lokasi; ?></td>
                    <td style="text-align: right;">
                        <?php
                        $volume = $fkb->volume;

                        // Cek apakah memiliki pecahan desimal
                        if (fmod($volume, 1) !== 0.0) {
                            echo number_format($volume, 2, '.', '');
                        } else {
                            echo $volume;
                        }
                        ?>
                    <td><?= $fkb->nama_satuan; ?></td>
                    <td style="text-align: right;">
                        <?php
                        $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                        $format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
                        echo $format->formatCurrency($fkb->anggaran, 'IDR');
                        ?>
                    </td>
                    <td><?= nl2br($fkb->catatan_desk); ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <p>2. (Rincian F-KW terlampir):</p>
    <table>
        <colgroup>
            <col style="width: 5%;">
            <col style="width: 10%;">
            <col style="width: 35%;">
            <col style="width: 15%;">
            <col style="width: 10%;">
            <col style="width: 10%;">
            <col style="width: 15%;">
        </colgroup>
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Sumber</th>
                <th rowspan="2">Klasifikasi Rincian Output (KRO) /<br>Rincian Output (RO) / Pekerjaan</th>
                <th rowspan="2">Lokasi</th>
                <th colspan="2">Sasaran</th>
                <th rowspan="2">Rencana Alokasi (Rp. Ribu)</th>
                <th rowspan="2">Catatan Desk</th>
            </tr>
            <tr>
                <th>Volume</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($fkwLampiran as $fkw) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $fkw->sumber; ?></td>
                    <td><?= $fkw->nmkro . ' / ' .  $fkw->nmro . ' / ' . $fkw->pekerjaan; ?></td>
                    <td><?= $fkw->lokasi; ?></td>
                    <td style="text-align: right;">

                        <?php
                        $volume = $fkw->volume;

                        // Cek apakah memiliki pecahan desimal
                        if (fmod($volume, 1) !== 0.0) {
                            echo number_format($volume, 2, '.', '');
                        } else {
                            echo $volume;
                        }
                        ?>

                    </td>
                    <td><?= $fkw->nama_satuan; ?></td>
                    <td style="text-align: right;">
                        <?php
                        $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                        $format->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
                        echo $format->formatCurrency($fkw->anggaran, 'IDR');
                        ?>
                    </td>
                    <td><?= nl2br($fkw->catatan_desk); ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</body>

</html>