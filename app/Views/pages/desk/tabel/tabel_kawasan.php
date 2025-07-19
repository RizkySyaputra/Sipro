<?php

use PhpParser\Node\Stmt\Continue_;

$a = 1;
foreach ($kawasan_p as $kawasan_p) : ?>
    <?php if ($kawasan_p->nama_kawasan == 'Non Kawasan') {
        continue;
    } ?>
    <tr>

        <td><?= $a++; ?></td>
        <td><?= $kawasan_p->nama_kawasan ?></td>
        <td><?= $kawasan_p->provinsi ?></td>
    </tr>
<?php endforeach; ?>