<?php
$a = 1;
foreach ($nomenklaturs as $nm) : ?>
    <tr>
        <td><?= $a++; ?></td>
        <td><?= $nm->nm_program ?></td>
        <td><?= $nm->nm_kegiatan ?></td>
        <td><?= $nm->nm_kro ?></td>
        <td><?= $nm->nm_ro ?></td>
        <td><?= $nm->nama_satuan ?></td>
    </tr>
<?php endforeach; ?>