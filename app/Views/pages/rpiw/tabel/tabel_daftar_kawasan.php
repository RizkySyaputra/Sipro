<?php
$a = 1;
foreach ($daftar_kawasan as $data) : ?>
    <tr>
        <td><?= $a++; ?></td>
        <td><?= $data->provinsi ?></td>
        <td><?= $data->nama_kawasan ?></td>
        <td><?= $data->tematik ?></td>
        <td>
            <?php if ($can_view == true) : ?>
                <button
                    class="btn btn-info btn-sm btn-view"
                    data-id="<?= $data->kode_kawasan ?>"
                    title="Lihat">
                    <i class="fas fa-eye"></i>
                </button>
            <?php endif ?>
        </td>
    </tr>
<?php endforeach; ?>