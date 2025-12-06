<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title">Laporan Program Tahunan Kawasan Per Provinsi</h4>

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
                                    <button type="button" id="download-excel" class="btn btn-success" title="Download Excel">
                                        <img id="img-excel" src="https://cdn-icons-png.flaticon.com/512/732/732220.png" alt="Excel Icon" style="width: 20px; height: 20px; vertical-align: middle;">
                                        <span id="loading-spinner-excel" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
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
                                    <tr>
                                        <th class="text-center" rowspan="2">No</th>
                                        <th class="text-center" rowspan="2">Provinsi</th>
                                        <th class="text-center" rowspan="2">Kawasan</th>
                                        <th class="text-center" colspan="6">Tematik Kawasan</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Pertumbuhan</th>
                                        <th class="text-center">Swasembada</th>
                                        <th class="text-center">Afirmasi</th>
                                        <th class="text-center">Konservasi/Rawan Bencana</th>
                                        <th class="text-center">Komoditas Unggulan</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>

                                </tfoot>
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
            // console.log(id_provinsi);
            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url("rakorbangwil/filter_laporan1") ?>', // URL untuk memproses filter
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
                        "pageLength": 10,
                        "pagingType": "full_numbers",
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
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

            // Optionally clear the table data
            //$('#datatables tbody').empty();

            // Optionally, you could also clear the local storage if needed
            localStorage.removeItem('selectedProvinsi');
            localStorage.removeItem('selectedUnor');
            localStorage.removeItem('selectedPN');

            var table = $('#datatables').DataTable();
            table.clear().draw();

            $('#datatables tfoot').remove();
        });

        $('#download-excel').on('click', function() {
            $('#loading-spinner-excel').show();
            $('#img-excel').hide();
            // Ambil data filter
            // let tahun_pelaksanaan = '<?= session()->get('tahun_pelaksana') ?>';
            // var filterData = $('#filter-form').serialize(); // Serialize data dari form filter
            let tahun_pelaksanaan = '<?= session()->get('tahun_pelaksana') ?>';
            let id_provinsi = $('#filter-provinsi').val();
            let id_unor = $('#filter-unor').val();
            let id_pn = $('#filter-pn').val();
            let prov = $('#filter-provinsi').val();

            var hasFilter = (prov && Array.isArray(prov) && prov.filter(v => v !== "").length > 0) ||

                ($('#filter-unor').val() !== "" &&
                    $('#filter-unor').val() !== "0" &&
                    $('#filter-unor').val() !== null) ||

                ($('#filter-pn').val() !== "" &&
                    $('#filter-pn').val() !== "0" &&
                    $('#filter-pn').val() !== null);

            // console.log('filter ' + filterData);
            // exit;

            console.log('filter id_provinsi ' + $('#filter-provinsi').val());
            console.log('filter hasFilter ' + hasFilter);

            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url('rakorbangwil/exportToExcelReportKawasan') ?>', // Endpoint controller
                type: 'POST',
                data: {
                    tahun_pelaksanaan: tahun_pelaksanaan,
                    id_provinsi: id_provinsi,
                    id_unor: id_unor,
                    id_pn: id_pn
                },
                xhrFields: {
                    responseType: 'blob' // Terima file sebagai blob
                },
                success: function(response) {
                    // Buat link unduh file
                    var blob = new Blob([response], {
                        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    });
                    var link = document.createElement('a');
                    var date = new Date();
                    var timestamp = date.getFullYear() +
                        (date.getMonth() + 1).toString().padStart(2, '0') +
                        date.getDate().toString().padStart(2, '0') + '_' +
                        date.getHours().toString().padStart(2, '0') +
                        date.getMinutes().toString().padStart(2, '0') +
                        date.getSeconds().toString().padStart(2, '0');
                    link.href = window.URL.createObjectURL(blob);

                    var filename = (hasFilter ?
                        'Filter_Laporan_Program_Tahunan_Kawasan_Per_Provinsi' :
                        'Laporan_Program_Tahunan_Kawasan_Per_Provinsi') + timestamp + '.xlsx';

                    link.download = filename; // Nama file unduhan
                    link.click();
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal mengunduh file Excel. Silakan coba lagi.',
                        confirmButtonText: 'OK'
                    });
                },
                complete: function() {
                    // Sembunyikan spinner dan kembalikan teks tombol
                    $('#loading-spinner-excel').hide();
                    $('#img-excel').show();
                }
            });
        });

        $(function() {
            $('#datatables').DataTable({
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