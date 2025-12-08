<?php
$a = 1;
foreach ($daftar_program_tahunan as $data) : ?>
    <tr>
        <td><?= $a++; ?></td>
        <td><?= $data->provinsi ?></td>
        <td><?= $data->tematik ?></td>
        <td><?= $data->kawasan ?></td>
        <td><?= $data->pekerjaan ?></td>
        <td><?= $data->unor ?></td>
        <td><?= $data->sumber ?></td>
        <td><?= $data->thn_pelaksanaan ?></td>
        <td style="text-align: center;">
            <?php
            // Jika catatan_konfrm_pemda kosong → tidak tampil apa-apa
            if ($data->catatan_konfrm_pemda === null || $data->catatan_konfrm_pemda === '-') {
                echo ''; // kolom dibiarkan kosong
            } else {
                // Jika melewati kondisi di atas berarti catatan_konfrm_pemda ADA
                // Sekarang cek catatan_pemda
                if ($data->catatan_pemda === null || $data->catatan_pemda === '-') {
                    echo '<span class="badge-grey">Belum Ada</span>';
                } else {
                    echo '<span class="badge-green">Ada</span>';
                }
            }
            ?>
        </td>

        <td style="width:20%">
            <?php if ($can_view == true) : ?>
                <button
                    class="btn btn-info btn-sm btn-view"
                    data-id="<?= $data->id_prog_tahunan ?>"
                    title="Lihat">
                    <i class="fas fa-eye"></i>
                </button>
            <?php endif ?>

            <?php if ($can_edit == true) : ?>
                <button
                    class="btn btn-warning btn-sm btn-edit"
                    data-id="<?= $data->id_prog_tahunan ?>"
                    title="Edit">
                    <i class="fas fa-edit"></i>
                </button>
            <?php endif ?>
            <?php if ($can_delete == true) : ?>
                <button type="button"
                    class="btn btn-danger btn-sm btn-delete"
                    data-id="<?= $data->id_prog_tahunan ?>"
                    title="Hapus">
                    <i class="fas fa-trash"></i>
                </button>
            <?php endif ?>

        </td>


    </tr>
<?php endforeach; ?>