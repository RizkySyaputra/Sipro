<div class="container mt-5">
    <div class="card">
        <div class="card-header text-white" style="background-color: #222cb1;">
            <h4 style="text-align: center;">Daftar Tanda Tangan Pejabat</h4>
        </div>
        <div class="card-body">
            <!-- Tabel Daftar Tanda Tangan -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pejabat</th>
                        <th>Jabatan</th>
                        <th>Unit Kerja</th>
                        <th>Unit Organisasi</th>
                        <th>Instansi</th>
                        <th>Tanda Tangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Misalnya $daftar_tanda_tangan adalah array data yang berisi data pejabat dan tanda tangan
                    foreach ($p_ttd as $index => $tanda_tangan) :
                    ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= $tanda_tangan->nama_pejabat; ?></td>
                            <td><?= $tanda_tangan->jabatan; ?></td>
                            <td><?= $tanda_tangan->unit_kerja; ?></td>
                            <td><?= $tanda_tangan->unit_organisasi; ?></td>
                            <td><?= $tanda_tangan->instansi; ?></td>
                            <td>
                                <?php if (!empty($tanda_tangan->tanda_tangan)) : ?>
                                    <!-- Menampilkan gambar tanda tangan -->
                                    <img src="<?= base_url('assets/tdd/' . $tanda_tangan->tanda_tangan); ?>" alt="Tanda Tangan" width="100" height="auto">
                                <?php else : ?>
                                    <span>Tidak ada tanda tangan</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>