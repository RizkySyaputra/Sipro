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
                <button id="export-btn">Ekspor ke Excel</button>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kode </th>
                                <th>Nama</th>
                                <th>Tahun</th>
                                <th class="text-center">Actions</th>
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
                            foreach ($kegiatan as $kegiatan) : ?>
                                <tr>
                                    <td><?= $kegiatan['kdgiat']; ?></td>
                                    <td><?= $kegiatan['nmgiat']; ?></td>
                                    <td><?= $kegiatan['tahun']; ?></td>
                                    <td class="text-center"><a href="<?= $kegiatan['kdgiat']; ?>">Update | Delete</td></a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#datatables').DataTable();

        // Ekspor ke Excel saat tombol diklik
        $('#export-btn').on('click', function() {
            // Buat workbook dan tambahkan sheet dari DataTable
            var wb = XLSX.utils.table_to_book($('#datatables')[0], {
                sheet: "Data Kegiatan"
            });

            // Format tanggal saat ini
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
            var fileName = 'data_kegiatan_' + yyyy + '-' + mm + '-' + dd + '.xlsx';

            // Ekspor file Excel
            XLSX.writeFile(wb, fileName);
        });
    });
</script>