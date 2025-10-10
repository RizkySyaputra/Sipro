<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title">Nomenklatur Kegiatan</h4>

            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <div class="container mt-4">
                <div class="card shadow-sm">
                    <!-- <div class="card-header">
                        <h5 class="mb-0">Filter Data Memorandum</h5>
                    </div> -->
                    <div class="card-body">
                        <form id="filter-form">
                            <!-- <div class=""> -->
                            <!-- Dropdown Program -->
                            <div class="row mb-3">
                                <label for="program" class="col-sm-1"><strong>Program</strong></label>
                                <div class="col-sm-11">
                                    <select class="form-control" name="program" id="filter-program">
                                        <option value=""></option>
                                        <?php foreach ($program as $p): ?>
                                            <option value="<?= htmlspecialchars($p['id_program']) ?>"><?= htmlspecialchars($p['nm_program']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Dropdown Kegiatan -->
                            <div class="row mb-3">
                                <label for="kegiatan" class="col-sm-1"><strong>Kegiatan</strong></label>
                                <div class="col-sm-11">
                                    <select class="form-control" name="kegiatan" id="filter-kegiatan" disabled>
                                        <option value="">Pilih Kegiatan</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Dropdown Kode KRO -->
                            <div class="row mb-3">
                                <label for="kro" class="col-sm-1"><strong>KRO</strong></label>
                                <div class="col-sm-11">
                                    <select class="form-control" name="kro" id="filter-kro" disabled>
                                        <option value="">Pilih KRO</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Dropdown Kode RO -->
                            <div class="row mb-3">
                                <label for="ro" class="col-sm-1"><strong>RO</strong></label>
                                <div class="col-sm-11">
                                    <select class="form-control" name="ro" id="filter-ro" disabled>
                                        <option value="">Pilih RO</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Button Filter -->
                            <div class="row">
                                <div class="col-sm-1">

                                </div>
                                <div class="col-sm-11">
                                    <button type="submit" class="btn btn-primary" title="Cari Data">
                                        <i id="button-text" class="fa fa-search"></i>
                                        <span id="loading-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                    </button>
                                    <button type="button" id="reset-filters" class="btn btn-info" title="Reset Filter">
                                        <i class="fa fa-undo"></i>
                                    </button>
                                    <!-- Tombol Download Excel -->
                                    <button type="button" id="download-excel" class="btn btn-success" title="Download Excel">
                                        <img id="img-excel" src="https://cdn-icons-png.flaticon.com/512/732/732220.png" alt="Excel Icon" style="width: 20px; height: 20px; vertical-align: middle;">
                                        <span id="loading-spinner-excel" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                        <!-- <i class="fa fa-download"></i> -->
                                    </button>
                                </div>
                            </div>

                            <!-- </div> -->
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
        <div class="card-body">
            <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                        <tr>
                            <th>No </th>
                            <th>Program</th>
                            <th>Kegiatan</th>
                            <th>KRO</th>
                            <th>RO</th>
                            <th>Satuan</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                        <tr>
                            <th>No </th>
                            <th>Program</th>
                            <th>Kegiatan</th>
                            <th>KRO</th>
                            <th>RO</th>
                            <th>Satuan</th>
                            <th>Detail</th>
                        </tr>
                    </tfoot> -->
                    <tbody>

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
<!-- jQuery, Select2, dan Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->

<script>
    $(document).ready(function() {
        $('#download-excel').on('click', function() {
            $('#loading-spinner-excel').show();
            $('#img-excel').hide();
            // Ambil data filter
            var filterData = $('#filter-form').serialize(); // Serialize data dari form filter

            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url('master/exportToExcel') ?>', // Endpoint controller
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
                    link.download = 'Filtered_Nomenklatur_Program' + timestamp + '.xlsx'; // Nama file unduhan
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


        // Inisialisasi Select2 untuk semua dropdown
        // $('#filter-program, #filter-kegiatan, #filter-kro, #filter-ro').select2();
        $('#filter-program').select2({
            placeholder: "Pilih Program",
            allowClear: true
        });
        $('#filter-kegiatan').select2({
            placeholder: "Pilih Kegiatan",
            allowClear: true
        });
        $('#filter-kro').select2({
            placeholder: "Pilih KRO",
            allowClear: true
        });
        $('#filter-ro').select2({
            placeholder: "Pilih RO",
            allowClear: true
        });
        // Restore values from local storage
        $('#filter-program').val(localStorage.getItem('selectedProgram'));
        $('#filter-kegiatan').val(localStorage.getItem('selectedKegiatan'));
        $('#filter-kro').val(localStorage.getItem('selectedKro'));
        $('#filter-ro').val(localStorage.getItem('selectedRo'));

        // On form submit, save the selected values
        $('#filter-form').on('submit', function() {
            event.preventDefault();

            $('#loading-spinner').show();
            $('#button-text').hide();
            // Ambil data filter dari form
            var filterData = $(this).serialize();
            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url('/master/get_nomenklatur') ?>', // URL untuk memproses filter
                type: 'POST',
                data: filterData,
                success: function(response) {
                    console.log(response);
                    // Hapus inisialisasi DataTables yang lama
                    if ($.fn.DataTable.isDataTable('#datatables')) {
                        $('#datatables').DataTable().clear().destroy();
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




        // filtering section process sendi_08102025
        $('#reset-filters').on('click', function() {
            // Reset dropdowns to their default values
            $('#filter-program').val('').trigger('change');
            $('#filter-kegiatan').val('').trigger('change');
            $('#filter-kro').val('').trigger('change');
            $('#filter-ro').val('').trigger('change');

            // Optionally clear the table data
            //$('#datatables tbody').empty();

            // Optionally, you could also clear the local storage if needed
            localStorage.removeItem('selectedProgram=');
            localStorage.removeItem('selectedKegiatan');
            localStorage.removeItem('selectedKro');
            localStorage.removeItem('selectedRo');

            var table = $('#datatables').DataTable();
            table.clear().draw();
        });

        // get data filter kegiatan
        $('#filter-program').on('change', function() {
            let id_program = $(this).val();

            if (!id_program) {
                // Parent kosong → Reset semua anak
                $('#filter-kegiatan').html('<option value="">Pilih Kegiatan</option>').prop('disabled', true).trigger('change.select2');
                $('#filter-kro').html('<option value="">Pilih KRO</option>').prop('disabled', true).trigger('change.select2');
                $('#filter-ro').html('<option value="">Pilih RO</option>').prop('disabled', true).trigger('change.select2');
                return; // Hentikan proses kalau kosong
            }

            $.ajax({
                url: '<?= base_url("master/get_kegiatan") ?>',
                method: 'POST',
                data: {
                    id_program: id_program
                },
                // async: false,
                beforeSend: function() {
                    $('#filter-kegiatan').html('<option>Loading...</option>');
                    $('#filter-kegiatan').prop('disabled', true).trigger('change.select2');
                },
                success: function(response) {
                    // console.log(response);
                    // response dari server berupa HTML atau JSON untuk update #kegiatan-list
                    let options = '<option value="">Pilih Kegiatan</option>';
                    if (response.length > 0) {
                        response.forEach(function(item) {
                            options += `<option value="${item.id_kegiatan}">${item.nm_kegiatan}</option>`;
                        });
                    } else {
                        options += '<option value="">Tidak ada list kegiatan</option>'
                    }
                    $('#filter-kegiatan').html(options);
                },
                complete: function() {
                    $('#filter-kegiatan').prop('disabled', false).trigger('change.select2');
                }
            });
        });

        // get data filter KRO
        $('#filter-kegiatan').on('change', function() {
            let id_kegiatan = $(this).val();

            if (!id_kegiatan) {
                // Parent kosong → Reset semua anak
                $('#filter-kro').html('<option value="">Pilih KRO</option>').prop('disabled', true).trigger('change.select2');
                $('#filter-ro').html('<option value="">Pilih RO</option>').prop('disabled', true).trigger('change.select2');
                return; // Hentikan proses kalau kosong
            }

            $.ajax({
                url: '<?= base_url("master/get_kro") ?>',
                method: 'POST',
                data: {
                    id_kegiatan: id_kegiatan
                },
                // async: false,
                beforeSend: function() {
                    $('#filter-kro').html('<option>Loading...</option>');
                    $('#filter-kro').prop('disabled', true).trigger('change.select2');
                },
                success: function(response) {
                    // console.log(response);
                    // response dari server berupa HTML atau JSON untuk update #kegiatan-list
                    let options = '<option value="">Pilih KRO</option>';
                    if (response.length > 0) {
                        response.forEach(function(item) {
                            options += `<option value="${item.id_kro}">${item.nm_kro}</option>`;
                        });
                    } else {
                        options += '<option value="">Tidak ada list KRO</option>'
                    }
                    $('#filter-kro').html(options);
                },
                complete: function() {
                    $('#filter-kro').prop('disabled', false);
                    $('#filter-kro').trigger('change.select2');
                }
            });
        });

        // get data filter RO
        $('#filter-kro').on('change', function() {
            let id_kro = $(this).val();

            if (!id_kro) {
                // Parent kosong → Reset semua anak

                $('#filter-ro').html('<option value="">Pilih RO</option>').prop('disabled', true).trigger('change.select2');
                return; // Hentikan proses kalau kosong
            }

            $.ajax({
                url: '<?= base_url("master/get_ro") ?>',
                method: 'POST',
                data: {
                    id_kro: id_kro
                },
                // async: false,
                beforeSend: function() {
                    $('#filter-ro').html('<option>Loading...</option>');
                    $('#filter-ro').prop('disabled', true).trigger('change.select2');
                },
                success: function(response) {
                    console.log(response);
                    // response dari server berupa HTML atau JSON untuk update #kegiatan-list
                    let options = '<option value="">Pilih RO</option>';
                    if (response.length > 0) {
                        response.forEach(function(item) {
                            options += `<option value="${item.id_ro}">${item.nm_ro}</option>`;
                        });
                    } else {
                        options += '<option value="">Tidak ada list RO</option>'
                    }
                    $('#filter-ro').html(options);
                },
                complete: function() {
                    $('#filter-ro').prop('disabled', false);
                    $('#filter-ro').trigger('change.select2');
                }
            });
        });
    });
</script>