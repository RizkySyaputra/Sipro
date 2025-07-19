<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title">Program Tahunan</h4>

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
                        <form id="filter-form"?>
                            <div class="form-row align-items-center">
                                <!-- Dropdown Unor -->
                                <div class="col-md-3 mb-3">
                                    <label for="unor"><strong>Pilih Unor</strong></label>
                                    <select class="form-control" name="unor" id="filter-unor">
                                        <option value="">Semua Unor</option>
                                        <?php foreach ($unor as $u): ?>
                                            <option value="<?= $u->id ?>"><?= $u->unor ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Dropdown Provinsi -->
                                <div class="col-md-3 mb-3">
                                    <label for="provinsi"><strong>Pilih Provinsi</strong></label>
                                    <select class="form-control" name="provinsi" id="filter-provinsi">
                                        <option value="">Semua Provinsi</option>
                                        <?php foreach ($provinsi as $p): ?>
                                            <option value="<?= $p->id ?>"><?= $p->provinsi ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Dropdown Kawasan -->
                                <!-- <div class="col-md-3 mb-3">
                                    <label for="kawasan"><strong>Kawasan</strong></label>
                                    <select class="form-control" name="kawasan" id="filter-kawasan">
                                        <option value="">Semua Kawasan</option>
                                        <?php foreach ($kawasan as $k): ?>
                                            <option value="<?= $k->kode_kawasan ?>"><?= $k->nama_kawasan ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div> -->

                                <!-- Button Filter -->
                                <div class="col-md-2 ">
                                    <button type="button" id="reset-filters" class="btn btn-info">
                                        <i class="fa fa-undo"></i>
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i id="button-text" class="fa fa-search"></i>
                                        <span id="loading-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                    </button>
                                </div>
                            </div>
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
                                <!-- <th>Kode </th> -->
                                <th>Provinsi</th>
                                <th>Unor</th>
                                <th>Nama Kegiatan </th>
                                <th>Kawasan</th>
                                <th>Volume</th>
                                <th>Anggaran </th>
                                <th>Kesepakatan </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No </th>
                                <!-- <th>Kode </th> -->
                                <th>Provinsi</th>
                                <th>Unor</th>
                                <th>Nama Kegiatan </th>
                                <th>Kawasan</th>
                                <th>Volume</th>
                                <th>Anggaran </th>
                                <th>Kesepakatan </th>
                            </tr>
                        </tfoot>
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
        //ambil kawasan untuk filter
        $('#filter-provinsi').on('change', function() {
            var provinsiId = $(this).val(); // Ambil nilai provinsi yang dipilih
            $.ajax({
                url: '<?= base_url('/memorandum/get_kawasan') ?>', // URL untuk memproses ambil data kawasan
                type: 'POST',
                data: {
                    provinsi_id: provinsiId
                }, // Kirimkan ID provinsi sebagai data
                success: function(response) {
                    // Kosongkan dropdown kawasan
                    $('#filter-kawasan').empty();
                    // Tambahkan opsi default
                    $('#filter-kawasan').append('<option value="">Semua Kawasan</option>');
                    // Update data option select kawasan dengan data yang diterima
                    $.each(response, function(index, kawasan) {
                        $('#filter-kawasan').append('<option value="' + kawasan.kode_kawasan + '">' + kawasan.nama_kawasan + '</option>');
                    });
                },
                error: function() {
                    alert('Error loading data');
                }
            });
        });


        // Inisialisasi Select2 untuk semua dropdown
        $('#filter-unor, #filter-provinsi, #filter-kawasan').select2();
        // Restore values from local storage
        $('#filter-unor').val(localStorage.getItem('selectedUnor'));
        $('#filter-provinsi').val(localStorage.getItem('selectedProvinsi'));
        $('#filter-kawasan').val(localStorage.getItem('selectedKawasan'));

        // On form submit, save the selected values
        $('#filter-form').on('submit', function() {
            event.preventDefault();

            $('#loading-spinner').show();
            $('#button-text').hide();
            // Ambil data filter dari form
            var filterData = $(this).serialize();
            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url('/memorandum/get_program') ?>', // URL untuk memproses filter
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
            $('#filter-kawasan').val('').trigger('change');

            // Optionally clear the table data
            //$('#datatables tbody').empty();

            // Optionally, you could also clear the local storage if needed
            localStorage.removeItem('selectedUnor');
            localStorage.removeItem('selectedProvinsi');
            localStorage.removeItem('selectedKawasan');
        });
    });
</script>