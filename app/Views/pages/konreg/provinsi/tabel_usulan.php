    <?php
    $no = 1;
    foreach ($usulan as $usulan) : ?>
        <tr id="row-<?= $usulan->id_usulan ?>">
            <td><?= $no++; ?></td>
            <td><?= $usulan->provinsi ?></td>
            <td><?= $usulan->nama_kp ?></td>
            <td><?= $usulan->nama_prop ?></td>
            <td><?= $usulan->nmkro ?></td>
            <td><?= $usulan->nmro ?></td>
            <td><?= $usulan->nama_pekerjaan ?></td>
            <td><?= $usulan->volume . " " . $usulan->nama_satuan ?></td>
            <td><?= $usulan->anggaran ?></td>
            <td>
                <a target="_blank" href="<?= base_url('detailusulan/' . $usulan->id_usulan) ?>" class="btn btn-info btn-sm" title="Detail">
                    <i class="fas fa-eye"></i>
                </a>
                <a target="_blank" href="<?= base_url('editusulan/' . $usulan->id_usulan) ?>" class="btn btn-warning btn-sm" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <button class="btn btn-danger btn-sm" title="Hapus"
                    data-toggle="modal" data-target="#confirmDeleteModal"
                    data-id="<?= $usulan->id_usulan ?>">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
            <td><?= ($usulan->catatan_unor != "") ? $usulan->catatan_unor : "Belum ditinjau"; ?></td>

        </tr>
    <?php endforeach; ?>