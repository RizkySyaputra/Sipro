<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title"><?= $title; ?></h4>
            </div>
            <div class="card-body">
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>No </th>
                                <th>Kode </th>
                                <th>Provinsi</th>
                                <th>Nama Kawasan</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No </th>
                                <th>Kode </th>
                                <th>Provinsi</th>
                                <th>Nama Kawasan</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($p_kawasan as $p_kawasan) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $p_kawasan->kode_kawasan; ?></td>
                                    <td><?= $p_kawasan->provinsi; ?></td>
                                    <td><?= $p_kawasan->nama_kawasan; ?></td>
                                    <td class="text-center"><a href="<?= base_url('detail_kawasan/'.$p_kawasan->kode_kawasan) ?>">Detail</td></a>
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