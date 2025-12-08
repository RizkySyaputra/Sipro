<?php
$a = 1;
foreach ($daftar_program_tahunan as $data) : ?>
    <tr>
        <td><?= $a++; ?></td>
        <td><?= $data->provinsi ?></td>
        <td><?= $data->unor ?></td>
        <td><?= $data->pekerjaan ?></td>
        <td><?= $data->kawasan ?></td>
        <td><?= $data->tematik ?></td>
        <td style="width:20%">
            <?php if (($data->catatan_pra_rakorbangwil != null) && ($data->catatan_pra_rakorbangwil != "-")): ?>
                <span class="badge-green">Pra Rakorbangwil</span><br>
            <?php endif; ?>

            <?php if (($data->catatan_pemda != null) &&  ($data->catatan_pemda != "-")): ?>
                <span class="badge-oranye">Pemda</span><br>
            <?php endif; ?>

            <?php if (($data->catatan_konfrm_pemda != null) && ($data->catatan_konfrm_pemda != "-")): ?>
                <span class="badge-blue">Konfirmasi Pemda</span>
            <?php endif; ?>

            <?php if (empty($data->catatan_pra_rakorbangwil) && empty($data->catatan_pemda) && empty($data->catatan_konfrm_pemda)): ?>
                <span class="text-muted">-</span>
            <?php endif; ?>
        </td>

        <td>
            <?php
            if ($data->desk_rakorbangwil === "1") {
                echo '<span class="badge-green" style="text-align:center;">Diakomodasi</span>';
            } elseif ($data->desk_rakorbangwil === "2") {
                echo '<span class="badge-green" style="text-align:center;" >Diakomodasi (Pra Desk Konreg)</span>';
            } elseif ($data->desk_rakorbangwil === "3") {
                echo '<span class="badge-oranye" style="text-align:center;">Ditangguhkan</span>';
            } elseif ($data->desk_rakorbangwil === "4") {
                echo '<span class="badge-oranye" style="text-align:center;">Ditangguhkan (Geser Tahun)</span>';
            } elseif ($data->desk_rakorbangwil === "5") {
                echo '<span class="badge-oranye" style="text-align:center;">Ditangguhkan (Skema KPBU)</span>';
            } elseif ($data->desk_rakorbangwil === "6") {
                echo '<span class="badge-oranye" style="text-align:center;">Ditangguhkan (Sumber Pendanaan Lainnya)</span>';
            } elseif ($data->desk_rakorbangwil === "0") {
                echo '<span class="badge-grey" style="text-align:center;">Belum Dibahas</span>';
            } else {
                echo '<span class="text-muted">-</span>';
            }
            ?>
        </td>

        <td style="width:20%; text-align:center">
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
            <!-- <?php if ($can_delete == true) : ?>
                <button type="button"
                    class="btn btn-danger btn-sm btn-delete"
                    data-id="<?= $data->id_prog_tahunan ?>"
                    title="Hapus">
                    <i class="fas fa-trash"></i>
                </button>
            <?php endif ?> -->

        </td>


    </tr>
<?php endforeach; ?>