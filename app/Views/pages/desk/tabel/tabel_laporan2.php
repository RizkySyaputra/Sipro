<?php
$jumlah_p_3 = 0;
$jumlah_a_3 = 0;
$jumlah_p_1 = 0;
$jumlah_a_1 = 0;
$jumlah_p_0 = 0;
$jumlah_a_0 = 0;
$jumlah_p = 0;
$jumlah_a = 0;
?>
<?php $no = 1; ?>
<?php foreach ($laporan2 as $laporan2) : ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $laporan2->provinsi; ?></td> <!-- Nama provinsi dari indeks array -->
        <td style="text-align: center;"><?= ($laporan2->program_blm_dibahas ?? 0); ?></td>
        <td style="text-align: center;"><?= number_format($laporan2->anggaran_blm_dibahas  ?? 0, 0, ',', '.'); ?></td>
        <td style="text-align: center;"><?= ($laporan2->program_dilanjutkan ?? 0); ?></td>
        <td style="text-align: center;"><?= number_format($laporan2->anggaran_dilanjutkan  ?? 0, 0, ',', '.'); ?></td>
        <td style="text-align: center;"><?= ($laporan2->program_ditangguhkan ?? 0); ?></td>
        <td style="text-align: center;"><?= number_format($laporan2->program_ditangguhkan ?? 0, 0, ',', '.'); ?></td>
        <td style="text-align: center;"><?= ($laporan2->program ?? 0); ?></td>
        <td style="text-align: center;"><?= number_format($laporan2->anggaran ?? 0, 0, ',', '.'); ?></td>
    </tr>
    <?php
    $jumlah_p_3  += $laporan2->program_blm_dibahas;
    $jumlah_a_3  += $laporan2->anggaran_blm_dibahas;
    $jumlah_p_1  += $laporan2->program_dilanjutkan;
    $jumlah_a_1  += $laporan2->anggaran_dilanjutkan;
    $jumlah_p_0  += $laporan2->program_ditangguhkan;
    $jumlah_a_0  += $laporan2->anggaran_ditangguhkan;
    $jumlah_p  += $laporan2->program;
    $jumlah_a  += $laporan2->anggaran;
    ?>

<?php endforeach; ?>
<tr>
    <td><?= $no; ?></td>
    <td style="text-align: center;">Jumlah</td>
    <td style="text-align: center;"><?= ($jumlah_p_3) ?? 0; ?></td>
    <td style="text-align: center;"><?= number_format($jumlah_a_3  ?? 0, 0, ',', '.'); ?></td>
    <td style="text-align: center;"><?= ($jumlah_p_1 ?? 0) ?></td>
    <td style="text-align: center;"><?= number_format($jumlah_a_1 ?? 0, 0, ',', '.'); ?></td>
    <td style="text-align: center;"><?= ($jumlah_p_0 ?? 0); ?></td>
    <td style="text-align: center;"><?= number_format($jumlah_a_0 ?? 0, 0, ',', '.'); ?></td>
    <td style="text-align: center;"><?= ($jumlah_p ?? 0); ?></td>
    <td style="text-align: center;"><?= number_format($jumlah_a ?? 0, 0, ',', '.'); ?>
</tr>