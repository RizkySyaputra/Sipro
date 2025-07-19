<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title">Data Kawasan</h4>
            </div>
            <div class="card-body">
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id </th>
                                <th>Provinisi</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id </th>
                                <th>Provinisi</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            foreach ($provinsi as $provinsi) : ?>
                                <tr>
                                    <td><?= $provinsi['id']; ?></td>
                                    <td><?= $provinsi['provinsi']; ?></td>
                                    <td><?= $provinsi['latitude']; ?></td>
                                    <td><?= $provinsi['longitude']; ?></td>
                                    <td class="text-center"><a href="<?= $provinsi['id']; ?>">Update | Delete</td></a>
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