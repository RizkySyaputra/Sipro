<?php
$jumlah_p_sda = 0;
$jumlah_a_sda = 0;
$jumlah_p_bm = 0;
$jumlah_a_bm = 0;
$jumlah_p_ck = 0;
$jumlah_a_ck = 0;
$jumlah_p = 0;
$jumlah_a = 0;
?>
<?php $no = 1; ?>
<?php foreach ($laporan1 as $laporan1) : ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $laporan1->provinsi; ?></td> <!-- Nama provinsi dari indeks array -->
        <td style="text-align: center;"><?= ($laporan1->program_sda ?? 0); ?></td>
        <td style="text-align: center;"><?= number_format($laporan1->anggaran_sda  ?? 0, 0, ',', '.'); ?></td>
        <td style="text-align: center;"><?= ($laporan1->program_bm ?? 0); ?></td>
        <td style="text-align: center;"><?= number_format($laporan1->anggaran_bm  ?? 0, 0, ',', '.'); ?></td>
        <td style="text-align: center;"><?= ($laporan1->program_ck ?? 0); ?></td>
        <td style="text-align: center;"><?= number_format($laporan1->anggaran_ck ?? 0, 0, ',', '.'); ?></td>
        <td style="text-align: center;"><?= ($laporan1->program ?? 0); ?></td>
        <td style="text-align: center;"><?= number_format($laporan1->anggaran ?? 0, 0, ',', '.'); ?></td>
    </tr>
    <?php
    $jumlah_p_sda  += $laporan1->program_sda;
    $jumlah_a_sda  += $laporan1->anggaran_sda;
    $jumlah_p_bm  += $laporan1->program_bm;
    $jumlah_a_bm  += $laporan1->anggaran_bm;
    $jumlah_p_ck  += $laporan1->program_ck;
    $jumlah_a_ck  += $laporan1->anggaran_ck;
    $jumlah_p  += $laporan1->program;
    $jumlah_a  += $laporan1->anggaran;
    ?>

<?php endforeach; ?>
<tr>
    <td><?= $no; ?></td>
    <td style="text-align: center;">Jumlah</td>
    <td style="text-align: center;"><?= ($jumlah_p_sda) ?? 0; ?></td>
    <td style="text-align: center;"><?= number_format($jumlah_a_sda  ?? 0, 0, ',', '.'); ?></td>
    <td style="text-align: center;"><?= ($jumlah_p_bm ?? 0) ?></td>
    <td style="text-align: center;"><?= number_format($jumlah_a_bm ?? 0, 0, ',', '.'); ?></td>
    <td style="text-align: center;"><?= ($jumlah_p_ck ?? 0); ?></td>
    <td style="text-align: center;"><?= number_format($jumlah_a_ck ?? 0, 0, ',', '.'); ?></td>
    <td style="text-align: center;"><?= ($jumlah_p ?? 0); ?></td>
    <td style="text-align: center;"><?= number_format($jumlah_a ?? 0, 0, ',', '.'); ?>
</tr>