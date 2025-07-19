    <?php
    $no = 1;
    foreach ($usulan as $usulan) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $usulan->provinsi ?></td>
            <td><?= $usulan->nama_pn ?></td>
            <td><?= $usulan->nama_pp ?></td>
            <td><?= $usulan->nama_kp ?></td>
            <td><?= $usulan->nama_prop ?></td>
            <td><a target="_blank" href="<?= base_url('detail_dataRakortek/' . $usulan->id) ?>"><?= $usulan->nama_pekerjaan ?></a></td>
        </tr>
    <?php endforeach; ?>