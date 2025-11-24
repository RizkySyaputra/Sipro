<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title">Laporan Program Tahunan Jenis Anggaran Per Provinsi</h4>

            </div>
            <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                                    <select name="provinsi" class="form-control" id="filter-provinsi" multiple="multiple">
                                        <!-- <option value="">Semua Provinsi</option> -->
                                        <?php foreach ($provinsi as $p): ?>
                                            <option value="<?= $p->id ?>" <?= old('id_provinsi') == $p->id ? 'selected' : '' ?>><?= $p->provinsi ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="unor"><strong>Unor</strong></label>
                                </div>
                                <div class="col-md-10">
                                    <select class="form-control" name="unor" id="filter-unor">
                                        <option value="">Semua Unor</option>
                                        <?php foreach ($unor as $u): ?>
                                            <option value="<?= $u->id ?>"><?= $u->unor ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <label for="pn"><strong>Prioritas Nasional</strong></label>
                                </div>
                                <div class="col-md-10">
                                    <select class="form-control" name="pn" id="filter-pn">
                                        <option value="">Semua PN dan Non PN</option>
                                        <option value="0">Non PN</option>
                                        <option value="28">PN 2-8</option>
                                        <option value="2">PN 2</option>
                                        <option value="3">PN 3</option>
                                        <option value="4">PN 4</option>
                                        <option value="5">PN 5</option>
                                        <option value="6">PN 6</option>
                                        <option value="8">PN 8</option>
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

                                    echo '<tr>';
                                    echo '<th rowspan="2" class="text-center">No</th>';
                                    echo '<th rowspan="2" class="text-center">Provinsi</th>'; // kolom tetap
                                    echo '<th colspan="4" class="text-center">Pekerjaan APBN</th>';
                                    echo '<th rowspan="2" class="text-center">Pekerjaan Lainnya</th>';
                                    echo '<th rowspan="2" class="text-center">Total Pekerjaan</th>';
                                    echo '<th colspan="4" class="text-center">Anggaran APBN (Ribu)</th>';
                                    echo '<th rowspan="2" class="text-center">Pembiayaan Lainnya (Ribu)</th>';
                                    echo '<th rowspan="2" class="text-center">Total Anggaran (Ribu)</th>';
                                    echo '</tr>';

                                    echo '<tr>';
                                    echo "<th class='text-center'>RPM</th>";
                                    echo "<th class='text-center'>PHLN</th>";
                                    echo "<th class='text-center'>SBSN</th>";
                                    echo "<th class='text-center'>Total</th>";

                                    echo "<th class='text-center'>RPM</th>";
                                    echo "<th class='text-center'>PHLN</th>";
                                    echo "<th class='text-center'>SBSN</th>";
                                    echo "<th class='text-center'>Total</th>";
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
            placeholder: "Semua Provinsi",
            allowClear: true
        });

        $('#filter-unor, #filter-pn').select2();

        // $('#filter-unor').select2({
        //     placeholder: "Semua Unor",
        //     allowClear: true
        // });

        // $('#filter-pn').select2({
        //     placeholder: "Semua PN dan Non PN",
        //     allowClear: true
        // });

        $('#filter-provinsi').val(localStorage.getItem('selectedProvinsi'));
        $('#filter-unor').val(localStorage.getItem('selectedUnor'));
        $('#filter-pn').val(localStorage.getItem('selectedPN'));

        // On form submit, save the selected values
        $('#filter-form').on('submit', function() {
            event.preventDefault();

            $('#loading-spinner').show();
            $('#button-text').hide();
            // Ambil data filter dari form
            // var filterData = $(this).serialize();
            let tahun_pelaksanaan = '<?= session()->get('tahun_pelaksana') ?>';
            let id_provinsi = $('#filter-provinsi').val();
            let id_unor = $('#filter-unor').val();
            let id_pn = $('#filter-pn').val();
            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url("rakorbangwil/filter_laporan4") ?>', // URL untuk memproses filter
                type: 'POST',
                data: {
                    tahun_pelaksanaan: tahun_pelaksanaan,
                    id_provinsi: id_provinsi,
                    id_unor: id_unor,
                    id_pn: id_pn
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
                        "pageLength": 10,
                        "pagingType": "full_numbers",
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        "fixedColumns": {
                            "leftColumns": 2 // Membekukan 2 kolom dari kiri
                        },
                        responsive: true,
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
            $('#filter-unor').val('').trigger('change');
            $('#filter-pn').val('').trigger('change');

            // Optionally, you could also clear the local storage if needed
            localStorage.removeItem('selectedProvinsi');
            localStorage.removeItem('selectedUnor');
            localStorage.removeItem('selectedPN');

            var table = $('#datatables').DataTable();
            table.clear().draw();
        });

        $(function() {
            $('#datatables').DataTable({
                "scrollX": true,
                // "scrollCollapse": true,
                "pageLength": 10,
                "ordering": true,
                "lengthChange": true,
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search records",
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
        });
    });
</script>