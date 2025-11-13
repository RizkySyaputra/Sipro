<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title">Laporan Program Tahunan Kawasan Per Provinsi Per PN</h4>

            </div>
            <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css">

            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>

            <div class="container mt-4">
                <div class="card shadow-md">
                    <div class="card-body">
                        <form method="post" id="filter-form">
                            <!-- <div class="form-row align-items-center"> -->

                            <!-- Dropdown Provinsi -->

                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="provinsi"><strong>Provinsi</strong></label>
                                </div>
                                <div class="col-md-10">
                                    <!-- <select class="form-control" name="tahun_anggaran" id="filter-tahun_anggaran">
                                        <option value="">Semua Tahun</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                    </select> -->

                                    <select name="provinsi" class="form-control" id="filter-provinsi">
                                        <option value="">Pilih Provinsi</option>
                                        <?php foreach ($provinsi as $p): ?>
                                            <option value="<?= $p->id ?>" <?= old('id_provinsi') == $p->id ? 'selected' : '' ?>><?= $p->provinsi ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">

                                </div>
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-primary">
                                        <i id="button-text" class="fa fa-search"></i>
                                        <span id="loading-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                    </button>
                                    <button type="button" id="reset-filters" class="btn btn-info">
                                        <i class="fa fa-undo"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- </div> -->
                        </form>
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <?php
                                    $pnList = [2, 3, 4, 5, 6, 8];
                                    $jenis = ['Kawasan', 'Tematik', 'Pekerjaan', 'Anggaran (Ribu)'];
                                    // Baris 1: Jenis, colspan = jumlah PN
                                    echo '<tr>';
                                    echo '<th rowspan="2" class="text-center">No</th>';
                                    echo '<th rowspan="2" class="text-center">Provinsi</th>'; // kolom tetap
                                    foreach ($jenis as $j) {
                                        echo '<th colspan="' . count($pnList) + 1 . '" class="text-center">' . $j . '</th>';
                                    }
                                    echo '</tr>';

                                    // Baris 2: PN
                                    echo '<tr>';
                                    foreach ($jenis as $j) {
                                        foreach ($pnList as $pn) {
                                            echo "<th class='text-center'>PN {$pn}</th>";
                                        }
                                        echo "<th class='text-center'>Total</th>";
                                    }
                                    echo '</tr>';

                                    ?>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<!-- end row -->

<script>
    $(document).ready(function() {

        $('#filter-provinsi').select2({
            placeholder: "Pilih Provinsi",
            allowClear: true
        });

        $('#filter-provinsi').val(localStorage.getItem('selectedProvinsi'));

        // On form submit, save the selected values
        $('#filter-form').on('submit', function() {
            event.preventDefault();

            $('#loading-spinner').show();
            $('#button-text').hide();
            // Ambil data filter dari form
            // var filterData = $(this).serialize();
            let tahun_pelaksanaan = '<?= session()->get('tahun_pelaksana') ?>';
            let id_provinsi = $('#filter-provinsi').val();
            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url("rakorbangwil/filter_laporan2") ?>', // URL untuk memproses filter
                type: 'POST',
                data: {
                    tahun_pelaksanaan: tahun_pelaksanaan,
                    id_provinsi: id_provinsi
                },
                success: function(response) {
                    console.log(response);
                    // Hapus inisialisasi DataTables yang lama
                    if ($.fn.DataTable.isDataTable('#datatables')) {
                        $('#datatables').DataTable().destroy();
                    }
                    // Update tabel dengan data yang diterima
                    $('#datatables').html(response);


                    //Inisialisasi DataTables kembali
                    $('#datatables').DataTable({
                        "scrollX": true,
                        "scrollCollapse": true,
                        "pageLength": 10,
                        "pagingType": "full_numbers",
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        "responsive": true,
                        "fixedColumns": {
                            "leftColumns": 1, // "freeze" kolom 1 dan 2
                        },
                        language: {
                            search: "Search:",
                            // search: "_INPUT_",
                            // searchPlaceholder: "Search records",
                            zeroRecords: "Data tidak ditemukan"
                        }
                    });
                },
                error: function() {
                    alert('Error loading data');
                },
                complete: function() {
                    // Sembunyikan spinner dan kembalikan teks tombol
                    $('#loading-spinner').hide();
                    $('#button-text').show();
                }
            });
        });

        $('#reset-filters').on('click', function() {
            // Reset dropdowns to their default values
            $('#filter-provinsi').val('').trigger('change');

            // Optionally clear the table data
            //$('#datatables tbody').empty();

            // Optionally, you could also clear the local storage if needed
            localStorage.removeItem('selectedProvinsi');

            var table = $('#datatables').DataTable();
            table.clear().draw();
        });


        $(function() {
            $('#datatables').DataTable({
                "scrollX": true,
                "scrollCollapse": true,
                "pageLength": 10,
                "ordering": true,
                "lengthChange": true,
                "fixedColumns": {
                    "leftColumns": 1, // "freeze" kolom 1 dan 2
                },
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search records",
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
        });
    });
</script>