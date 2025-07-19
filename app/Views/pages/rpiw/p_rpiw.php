<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title">Data Program RPIW</h4>

            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <div class="container mt-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Filter Data Memorandum</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('Rpiw') ?>">
                            <div class="form-row align-items-center">
                                <!-- Dropdown Unor -->
                                <div class="col-md-3 mb-3">
                                    <label for="unor"><strong>Unor</strong></label>
                                    <select class="form-control select2" name="unor" id="unor">
                                        <option value="">Select Unor</option>
                                        <?php foreach ($unor as $u): ?>
                                            <option value="<?= $u->id ?>"><?= $u->unor ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Dropdown Provinsi -->
                                <div class="col-md-3 mb-3">
                                    <label for="provinsi"><strong>Provinsi</strong></label>
                                    <select class="form-control select2" name="provinsi" id="provinsi">
                                        <option value="">Select Provinsi</option>
                                        <?php foreach ($provinsi as $p): ?>
                                            <option value="<?= $p->id ?>"><?= $p->provinsi ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Dropdown Kawasan -->
                                <div class="col-md-3 mb-3">
                                    <label for="kawasan"><strong>Kawasan</strong></label>
                                    <select class="form-control select2" name="kawasan" id="kawasan">
                                        <option value="">Select Kawasan</option>
                                        <?php foreach ($kawasan as $k): ?>
                                            <option value="<?= $k->kode_kawasan ?>"><?= $k->nama_kawasan ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Button Filter -->
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-filter"></i> Apply Filters
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>No </th>
                                <!-- <th>Kode </th> -->
                                <th>Provinsi</th>
                                <th>Unor</th>
                                <th>Nama Program </th>
                                <th>Kawasan</th>
                                <th>Tahun Mulai</th>
                                <th>Tahun Selesai </th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No </th>
                                <!-- <th>Kode </th> -->
                                <th>Provinsi</th>
                                <th>Unor</th>
                                <th>Nama Program </th>
                                <th>Kawasan</th>
                                <th>Tahun Mulai</th>
                                <th>Tahun Selesai </th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $a = 1;
                            foreach ($p_rpiw as $p_rpiw) : ?>
                                <tr>
                                    <td><?= $a++; ?></td>
                                    <!-- <td><?= $p_rpiw->id_program ?></td> -->
                                    <td><?= $p_rpiw->provinsi ?></td>
                                    <td><?= $p_rpiw->unor ?></td>
                                    <td><?= $p_rpiw->nama_program ?></td>
                                    <td>
                                        <?php if (isset($kawasans[$p_rpiw->id_program])): ?>
                                            <?php
                                            $rows = count($kawasans[$p_rpiw->id_program]);
                                            if ($rows > 1) {
                                                $i = 1;
                                                $ii = '.';
                                            } else {
                                                $i = '';
                                                $ii = '';
                                            }
                                            ?>
                                            <?php foreach ($kawasans[$p_rpiw->id_program] as $kawasan): ?>
                                                <?= $i++ . $ii . $kawasan->nama_kawasan; ?><br>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            Non Kawasan
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $p_rpiw->tahun_mulai ?></td>
                                    <td><?= $p_rpiw->tahun_selesai ?></td>
                                    <td class="text-center"><a href="<?= base_url('detail/' . $p_rpiw->id_program) ?>">Detail</td></a>
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