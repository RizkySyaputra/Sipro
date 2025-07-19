<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title">Program Tahunan</h4>

            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
            <div class="card-body">
                <div class="toolbar">
                    <div class="">
                        <form method="post" action="<?= base_url('memorandum') ?>">
                            <div class="form-row align-items-center mb-3">
                                <div class="col-2">
                                    <select class="form-control" name="unor">
                                        <option value="">Select Unor</option>
                                        <?php foreach ($unor as $u): ?>
                                            <option value="<?= $u->id ?>"><?= $u->unor ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select class="form-control" name="provinsi">
                                        <option value="">Select Provinsi</option>
                                        <?php foreach ($provinsi as $p): ?>
                                            <option value="<?= $p->id ?>"><?= $p->provinsi ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select class="form-control" name="kawasan">
                                        <option value="">Select Kawasan</option>
                                        <?php foreach ($kawasan as $k): ?>
                                            <option value="<?= $k->kode_kawasan ?>"><?= $k->nama_kawasan ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                                </div>
                            </div>
                        </form> <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>No </th>
                                <!-- <th>Kode </th> -->
                                <th>Provinsi</th>
                                <th>Unor</th>
                                <th>Nama Kegiatan </th>
                                <th>Kawasan</th>
                                <th>Volume</th>
                                <th>Anggaran </th>
                                <!-- <th>Aksi </th> -->
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No </th>
                                <!-- <th>Kode </th> -->
                                <th>Provinsi</th>
                                <th>Unor</th>
                                <th>Nama Kegiatan </th>
                                <th>Kawasan</th>
                                <th>Volume</th>
                                <th>Anggaran </th>
                                <!-- <th>Aksi </th> -->
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $a = 1;
                            foreach ($p_memo as $p_memo) : ?>
                                <tr>
                                    <td><?= $a++; ?></td>
                                    <td><?= $p_memo->provinsi ?></td>
                                    <td><?= $p_memo->unor ?></td>
                                    <td><a href="/detail_program/<?= $p_memo->id_mprogram ?>"><?= $p_memo->nama_program ?></a></td>
                                    <td>
                                        <?php if (isset($kawasans[$p_memo->id_rpiw])): ?>
                                            <?php
                                            $rows = count($kawasans[$p_memo->id_rpiw]);
                                            if ($rows > 1) {
                                                $i = 1;
                                                $ii = '.';
                                            } else {
                                                $i = '';
                                                $ii = '';
                                            }
                                            ?>
                                            <?php foreach ($kawasans[$p_memo->id_rpiw] as $kawasan): ?>
                                                <?= $i++ . $ii . $kawasan->nama_kawasan; ?><br>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            Non Kawasan
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $p_memo->volume . " " . $p_memo->nama_satuan ?></td>
                                    <td><?php $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                                        echo $format->formatCurrency($p_memo->biaya, 'IDR');  ?></td>
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