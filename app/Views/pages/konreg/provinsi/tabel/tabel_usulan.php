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
            <td><?php $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                echo $format->formatCurrency($usulan->anggaran, 'IDR'); ?></td>
            <td>
                <?php if (isset(user()->id_unor)): ?>
                    <a target="_blank" href="<?= base_url('detailusulan/' . $usulan->id_usulan) ?>" class="btn btn-info btn-sm" title="Reviu">
                        <i class="fas fa-edit"></i>
                    </a>
                <?php else : ?>
                    <a target="_blank" href="<?= base_url('detailusulan/' . $usulan->id_usulan) ?>" class="btn btn-info btn-sm" title="Detail">
                        <i class="fas fa-eye"></i>
                    </a>
                <?php endif ?>
                <?php if (
                    !isset(user()->id_unor) && (is_null(user()->id_provinsi) &&  (!in_groups('Staff')))
                ): ?>
                    <a target="_blank" href="<?= base_url($desk == "konreg" ? "editusulan/$usulan->id_usulan?desk=konreg" : "editusulan/$usulan->id_usulan") ?>" class="btn btn-warning btn-sm" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-danger btn-sm" title="Hapus"
                        data-toggle="modal" data-target="#confirmDeleteModal"
                        data-id="<?= $usulan->id_usulan ?>">
                        <i class="fas fa-trash"></i>
                    </button>
                <?php endif ?>
            </td>
            <td><?= ($usulan->catatan_unor != "") ? $usulan->catatan_unor : "Belum ditinjau"; ?></td>
            <?php ($desk == "konreg") ? "?desk=konreg" : ""; ?>
            <td align="center">
                <?php
                if ($usulan->kesepakatan == 0) {
                    echo '<span class="badge badge-pill badge-secondary">Belum Dibahas</span>';
                } elseif ($usulan->kesepakatan == 1) {
                    echo '<span class="badge badge-pill badge-primary">FKW</span>';
                } elseif ($usulan->kesepakatan == 2) {
                    echo '<span class="badge badge-pill badge-success">FKB</span>';
                } elseif ($usulan->kesepakatan == 3) {
                    echo '<span class="badge badge-pill badge-warning">Ditangguhkan</span>';
                }
                ?>
            </td>
        </tr>
    <?php endforeach; ?>