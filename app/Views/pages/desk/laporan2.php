<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title">Program /Kegiatan Tahunan</h4>

            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <div class="container mt-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Filter Data Memorandum</h5>
                    </div>
                    <div class="card-body">
                        <form id="filter-form" ?>
                            <div class="form-row align-items-center">
                                <!-- Dropdown Unor -->
                                <div class="col-md-2 mb-3">
                                    <label for="unor"><strong>Pilih Unor</strong></label>
                                    <select class="form-control" name="unor" id="filter-unor">
                                        <option value="">Semua Unor</option>
                                        <?php foreach ($unor as $u): ?>
                                            <option value="<?= $u->id ?>"><?= $u->unor ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>


                                <div class="col-md-2 mb-3">
                                    <label for="sumber"><strong>Pilih Sumber Data</strong></label>
                                    <select class="form-control" name="sumber" id="filter-sumber">
                                        <option value="">Semua Sumber</option>
                                        <option value="RPIW">RPIW</option>
                                        <option value="NON RPIW">NON RPIW</option>
                                    </select>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label for="pendanaan"><strong>Pilih Sumber Pendanaan</strong></label>
                                    <select class="form-control" name="pendanaan_id" id="filter-pendanaan">
                                        <option value="">Semua Sumber</option>
                                        <?php foreach ($pendanaan as $pa): ?>
                                            <option value="<?= $pa["id_pendanaan"] ?>"><?= $pa["sumber_pendanaan"] ?></option>
                                        <?php endforeach; ?>
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

                                    <button type="button" id="download-excel" class="btn btn-success" title="Download Excel">
                                        <img src="https://cdn-icons-png.flaticon.com/512/732/732220.png" alt="Excel Icon" style="width: 20px; height: 20px; vertical-align: middle;">
                                    </button>
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
        <div class="card-body">
            <div class="material-datatables">
                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <!-- <th>Kode </th> -->
                            <th rowspan="2">Provinsi</th>
                            <th colspan="2" style="text-align: center;">Belum dibahas</th>
                            <th colspan="2" style="text-align: center;">diakomodasi</th>
                            <th colspan="2" style="text-align: center;">ditangguhkan</th>
                            <th rowspan="2">Total Program</th>
                            <th rowspan="2">Total Anggaran</th>
                        </tr>
                        <tr>
                            <th>Program</th>
                            <th>Anggaran (Ribu)</th>
                            <th>Program</th>
                            <th>Anggaran (Ribu)</th>
                            <th>Program</th>
                            <th>Anggaran (Ribu)</th>
                        </tr>
                    </thead>


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
            // Ambil data filter
            var filterData = $('#filter-form').serialize(); // Serialize data dari form filter

            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url('/desk/excel2') ?>', // Endpoint controller
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
                    link.download = 'Filtered_Program_Tahunan' + timestamp + '.xlsx'; // Nama file unduhan
                    link.click();
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal mengunduh file Excel. Silakan coba lagi.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });


        // Inisialisasi Select2 untuk semua dropdown
        $('#filter-unor, #filter-sumber, #filter-pendanaan').select2();
        // Restore values from local storage
        $('#filter-unor').val(localStorage.getItem('selectedUnor'));
        $('#filter-sumber').val(localStorage.getItem('selectedSumber'));
        $('#filter-pendanaan').val(localStorage.getItem('selectedPendanaan'));

        // On form submit, save the selected values
        $('#filter-form').on('submit', function() {
            event.preventDefault();

            $('#loading-spinner').show();
            $('#button-text').hide();
            // Ambil data filter dari form
            var filterData = $(this).serialize();

            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url('/desk/laporan2') ?>', // URL untuk memproses filter
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
            $('#filter-sumber').val('').trigger('change');
            $('#filter-pendanaan').val('').trigger('change');

            // Optionally clear the table data
            //$('#datatables tbody').empty();

            // Optionally, you could also clear the local storage if needed
            localStorage.removeItem('selectedUnor');
            localStorage.removeItem('selectedSumber');
            localStorage.removeItem('selectedPendanaan');
        });
    });
</script>