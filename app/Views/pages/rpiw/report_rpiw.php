<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <div class="card-title row">
                    <h4 class="col-6">Report Program RPIW</h4>
                    <h4 class="col-6" style="text-align: right;">Last Rekap : <?php foreach ($last_updated as $lp) echo $lp->updated_at ?> </h4>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <div class="card-body">
                <div class="toolbar row">

                    <div class="col-9">
                        <div class="dropdown">
                            <button class="filter" id="dropdownProvinsiBtn">Pilih Provinsi</button>
                            <div class="dropdown-content" id="dropdownProvinsiContent">
                                <label><input type="checkbox" class="filter-checkbox" id="selectAllProvinsi"> All</label>
                                <?php foreach ($provinsi as $p): ?>
                                    <label><input type="checkbox" class="filter-checkbox" value="<?= $p->provinsi ?>"> <?= $p->provinsi ?></label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="dropdown">
                            <button class="filter" id="dropdownUnorBtn">Pilih Unor</button>
                            <div class="dropdown-content" id="dropdownUnorContent">
                                <label><input type="checkbox" class="filter-checkbox" id="selectAllUnor"> All</label>
                                <?php foreach ($unor as $u): ?>
                                    <label><input type="checkbox" class="filter-checkbox" value="<?= $u->unor ?>"> <?= $u->unor ?></label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="dropdown">
                            <button class="filter" id="dropdownKawasanBtn">Pilih Kawasan</button>
                            <div class="dropdown-content" id="dropdownKawasanContent">
                                <label><input type="checkbox" class="filter-checkbox" id="selectAllKawasan"> All</label>
                                <?php foreach ($kawasan as $k): ?>
                                    <label><input type="checkbox" class="filter-checkbox" value="<?= $k->nama_kawasan ?>"> <?= $k->nama_kawasan ?></label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="dropdown">
                            <button class="filter" id="dropdownPendanaanBtn">Pilih Sumber Pendanaan</button>
                            <div class="dropdown-content" id="dropdownPendanaanContent">
                                <label><input type="checkbox" class="filter-checkbox" id="selectAllPendanaan"> All</label>
                                <?php foreach ($pendanaan as $pd): ?>
                                    <label><input type="checkbox" class="filter-checkbox" value="<?= $pd["sumber_pendanaan"] ?>"> <?= $pd["sumber_pendanaan"] ?></label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="filter" id="dropdownPendanaanBtn">Pilih Tanggal Rekap</button>
                            <div class="dropdown-content" id="dropdownUpdated_atContent">
                                <label><input type="checkbox" class="filter-checkbox" id="selectAllUpdated_at"> All</label>
                                <?php foreach ($list_date as $ls): ?>
                                    <label><input type="checkbox" class="filter-checkbox" value="<?= $ls->updated_at ?>"> <?= $ls->updated_at  ?></label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-3" style="text-align: right;">
                        <button class="btn filter" id="rekapDataBtn">Rekap Data</button>
                    </div>
                </div>

                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>No </th>
                                <th>Provinsi</th>
                                <th>Unor</th>
                                <th>Kawasan</th>
                                <th>Sumber Pendanaan</th>
                                <th>MP</th>
                                <th>Jumlah Program</th>
                                <th>Jumlah Anggaran</th>
                                <th>Tanggal Update</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No </th>
                                <th>Provinsi</th>
                                <th>Unor</th>
                                <th>Kawasan</th>
                                <th>Sumber Pendanaan</th>
                                <th>MP</th>
                                <th>Jumlah Program</th>
                                <th>Jumlah Anggaran</th>
                                <th>Tanggal Update</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($rekap_program as $rekap_program) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $rekap_program->provinsi ?></td>
                                    <td><?= $rekap_program->unor ?></td>
                                    <td><?php
                                        if ($rekap_program->nama_kawasan) {
                                            echo $rekap_program->nama_kawasan;
                                        } else {
                                            echo "Non Kawasan";
                                        }
                                        ?></td>
                                    <td><?= $rekap_program->sumber_pendanaan ?></td>
                                    <td><?= $rekap_program->tagging_mp ?></td>
                                    <td><?= $rekap_program->jumlah_program ?></td>

                                    <td><?php $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                                        echo $format->formatCurrency($rekap_program->anggaran, 'IDR');  ?></td>
                                    <td><?= $rekap_program->updated_at ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<!-- end row -->
</div>
</div>
<script>
    $('#rekapDataBtn').on('click', function() {
        // Konfirmasi sebelum melanjutkan
        if (confirm('Apakah Anda yakin ingin melanjutkan proses rekap data?')) {
            $.ajax({
                url: '<?= site_url('/rekap') ?>', // Ganti dengan URL yang sesuai
                method: 'POST',
                success: function(response) {
                    // Tampilkan response dari server
                    alert('Rekap data berhasil');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan: ' + error);
                }
            });
        } else {
            alert('Proses rekap data dibatalkan.');
        }
    });
</script>