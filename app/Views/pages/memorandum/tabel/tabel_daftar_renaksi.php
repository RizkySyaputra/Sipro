<?php
$a = 1;
foreach ($daftar_renaksi as $data) : ?>
    <tr>
        <td><?= $a++; ?></td>
        <td><?= $data->provinsi ?></td>
        <td><?= $data->unor ?></td>
        <td><?= $data->pekerjaan ?></td>
        <td><?= $data->kawasan ?></td>
        <td><?= $data->tahun_mulai . ' - ' . $data->tahun_selesai  ?></td>
        <td>
            <?php if ($data->mp == 0) : ?>
                <span class="badge bg-info">
                    Belum Terinput
                </span>
            <?php elseif ($data->mp > 0) : ?>
                <span class="badge bg-success">
                    Sudah Terinput
                </span>
            <?php endif; ?>
        </td>
        <td>
            <?php if ($can_view == true) : ?>
                <button
                    class="btn btn-info btn-sm btn-view"
                    data-id="<?= $data->id_renaksi ?>"
                    title="Lihat">
                    <i class="fas fa-eye"></i>
                </button>
            <?php endif ?>

            <?php if ($can_edit == true) : ?>
                <button
                    class="btn btn-warning btn-sm btn-edit"
                    data-id="<?= $data->id_renaksi ?>"
                    title="Input">
                    <i class="fas fa-plus"></i>
                </button>
            <?php endif ?>
        </td>


    </tr>
<?php endforeach; ?>