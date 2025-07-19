<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title font-weight-bold"><strong>Rekpa Program Konreg FKB/FKW</strong></h4>

            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <div class="container mt-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0 font-weight-bold"><strong>Filter</strong></h5>
                    </div>
                    <div class="card-body">
                        <form id="filter-form" ?>
                            <div class="form-row align-items-center">
                                <!-- Dropdown Unor -->
                                <div class="col-md-2 mb-3">
                                    <label for="unor"><strong>Pilih Program</strong></label>
                                    <select class="form-control" name="jenis_data" id="filter-unor">
                                        <option value="">ALL</option>
                                        <option value="fkw">FKW</option>
                                        <option value="fkb">FKB</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="sumber"><strong>Pilih Sumber</strong></label>
                                    <select class="form-control" name="sumber" id="filter-Sumber">
                                        <option value="">Semua Sumber</option>
                                        <option value="Rakorbangwil">Rakorbangwil</option>
                                        <option value="Rakortek">Rakortek</option>
                                        <option value="Usulan Provinsi">Usulan Provinsi</option>
                                        <option value="Unor">Unor</option>
                                    </select>
                                </div>


                                <!-- Dropdown Kawasan -->
                                <!-- Button Filter -->
                                <div class="col-md-3 ">
                                    <button type="button" id="reset-filters" class="btn btn-info" title="Reset Filter">
                                        <i class="fa fa-undo"></i>
                                    </button>
                                    <button type="submit" class="btn btn-primary" title="Cari Data">
                                        <i id="button-text" class="fa fa-search"></i>
                                        <span id="loading-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                    </button>
                                    <!-- Tombol Download Excel -->

                                    <!-- <button type="button" id="download-excel" class="btn btn-success" title="Download Excel">
                                        <img id="button-excel" src="https://cdn-icons-png.flaticon.com/512/732/732220.png" alt="Excel Icon" style="width: 20px; height: 20px; vertical-align: middle;">
                                        <span id="loading-spinner2" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                    </button> -->
                                </div>

                            </div>
                    </div>
                    <!-- <input type="text" name="sumber" value="NON RPIW" hidden> -->
                    </form>
                </div>
            </div>
        </div>
        <style>
            .btn:hover {
                transform: scale(1.05);
                /* Efek zoom saat hover */
            }

            .spinner-border {
                margin-left: 5px;
            }
        </style>
        <div class="card">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table id="datatables" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead class="thead-dark" style="text-align:center;">
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Provinsi</th>
                                <th colspan="2">SDA</th>
                                <th colspan="2">BM</th>
                                <th colspan="2">CK</th>
                                <th colspan="2">PS</th>
                                <th colspan="2">TOTAL</th>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <th>Anggaran(Rp. Ribu)</th>
                                <th>Pekerjaan</th>
                                <th>Anggaran(Rp. Ribu)</th>
                                <th>Pekerjaan</th>
                                <th>Anggaran(Rp. Ribu)</th>
                                <th>Pekerjaan</th>
                                <th>Anggaran(Rp. Ribu)</th>
                                <th>Pekerjaan</th>
                                <th>Anggaran(Rp. Ribu)</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
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
</div>
</div>
<!-- jQuery, Select2, dan Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->

<script>
    $(document).ready(function() {
        $('#download-excel').on('click', function() {
            // Ambil data filter
            var filterData = $('#filter-form').serialize(); // Serialize data dari form filter
            $('#loading-spinner2').show();
            $('#button-excel').hide();

            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url('/fkb/exportToExcel') ?>', // Endpoint controller
                type: 'POST',
                data: filterData,
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
                    link.download = 'Program_FKB' + timestamp + '.xlsx'; // Nama file unduhan
                    link.click();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Berhasil mengunduh file Excel.',
                        confirmButtonText: 'OK'
                    });
                    $('#loading-spinner2').hide();
                    $('#button-excel').show();
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal mengunduh file Excel. Silakan coba lagi.',
                        confirmButtonText: 'OK'
                    });
                    $('#loading-spinner2').hide();
                    $('#button-excel').show();
                }
            });
        });


        // Inisialisasi Select2 untuk semua dropdown
        $('#filter-unor, #filter-provinsi, #filter-sumber, #filter-pendanaan, #filter-pradesk, #filter-Kesepakatan, #filter-Sumber').select2();
        // Restore values from local storage
        $('#filter-unor').val(localStorage.getItem('selectedUnor'));
        $('#filter-provinsi').val(localStorage.getItem('selectedProvinsi'));
        $('#filter-Kesepakatan').val(localStorage.getItem('selectedKesepakatan'));
        $('#filter-pradesk').val(localStorage.getItem('selectedPradesk'));

        // On form submit, save the selected values
        $('#filter-form').on('submit', function() {
            event.preventDefault();

            $('#loading-spinner').show();
            $('#button-text').hide();
            // Ambil data filter dari form
            var filterData = $(this).serialize();
            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url('/Konreg/get/Repot1') ?>', // URL untuk memproses filter
                type: 'POST',
                data: filterData,
                success: function(response) {
                    // Hapus inisialisasi DataTables yang lama
                    if ($.fn.DataTable.isDataTable('#datatables')) {
                        $('#datatables').DataTable().destroy();
                    }
                    // Update tabel dengan data yang diterima
                    $('#datatables tbody').html(response);


                    //Inisialisasi DataTables kembali
                    $('#datatables').DataTable({
                        "pagingType": "full_numbers",
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        responsive: true,
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search records",
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
            $('#filter-unor').val('').trigger('change');
            $('#filter-provinsi').val('').trigger('change');
            $('#filter-sumber').val('').trigger('change');
            $('#filter-pradesk').val('').trigger('change');

            // Optionally clear the table data
            //$('#datatables tbody').empty();

            // Optionally, you could also clear the local storage if needed
            localStorage.removeItem('selectedUnor');
            localStorage.removeItem('selectedProvinsi');
            localStorage.removeItem('selectedKesepakatan');
            localStorage.removeItem('selectedPradesk');
        });
    });
</script>