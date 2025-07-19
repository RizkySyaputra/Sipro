<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dokumen BAK</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        BERITA ACARA KESEPAKATAN PROGRAM KETERPADUAN PROVINSI <?= $provinsi->nama; ?>
    </div>
    <p>Hasil pembahasan RAKORBANGWIL <?= date('Y'); ?></p>
    <h3>Kawasan Prioritas</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kawasan</th>
                <th>Tematik Kawasan</th>
                <th>Kesepakatan</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kawasan as $index => $item): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= $item->nama_kawasan; ?></td>
                    <td><?= $item->tematik; ?></td>
                    <td><?= $item->kesepakatan; ?></td>
                    <td><?= $item->catatan; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h3>Program Infrastruktur</h3>
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
            <?php foreach ($programs as $index => $program): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= $program->kawasan; ?></td>
                    <td><?= $program->kegiatan; ?></td>
                    <td><?= $program->unit_organisasi; ?></td>
                    <td><?= $program->kesepakatan; ?></td>
                    <td><?= $program->catatan; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>