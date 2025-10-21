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
        <td>
            <button class="btn btn-sm btn-success btn-view" data-id="<?= esc($nm->id_ro)  ?>" title="Lihat">
                <i class="fas fa-eye"></i>
            </button>
        </td>
    </tr>
<?php endforeach; ?>