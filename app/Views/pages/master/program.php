<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">table rows</i>
                </div>
                <h4 class="card-title">Data Program</h4>
            </div>
            <div class="card-body">
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kode </th>
                                <th>Nama</th>
                                <th>Tahun</th>
                                <th class="disabled-sorting text-center">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Kode </th>
                                <th>Nama</th>
                                <th>Tahun</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            foreach ($programs as $program) : ?>
                                <tr>
                                    <td><?= $program['kdprogram']; ?></td>
                                    <td><?= $program['nmprogram']; ?></td>
                                    <td><?= $program['tahun']; ?></td>
                                    <td class="text-center"><a href="<?= $program['kdprogram']; ?>">Update | Delete</td></a>
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