<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title">Data Api Rakortek</h4>

            </div>
            <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->

            <div class="container mt-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Filter Data Rakortek</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" id="filter-form">
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

                                <!-- Dropdown Provinsi -->
                                <div class="col-md-2 mb-3">
                                    <label for="provinsi"><strong>Pilih Provinsi</strong></label>
                                    <select class="form-control" name="provinsi" id="filter-provinsi">
                                        <option value="">Semua Provinsi</option>
                                        <?php foreach ($provinsi as $p): ?>
                                            <option value="<?= $p->id ?>"><?= $p->provinsi ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Dropdown Kawasan -->
                                <div class="col-md-2 mb-3">
                                    <label for="pn"><strong>Pilih Program Nasional</strong></label>
                                    <select class="form-control" name="id_pn" id="filter-pn">
                                        <option value="">Semua PN</option>
                                        <?php foreach ($pn as $item): ?>
                                            <option value="<?= $item['id_pn'] ?>"><?= $item['nama_pn'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>


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
                                <th>PN</th>
                                <th>PP</th>
                                <th>KP</th>
                                <th>ProP</th>
                                <th>Nama pekerjaan </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No </th>
                                <!-- <th>Kode </th> -->
                                <th>Provinsi</th>
                                <th>PN</th>
                                <th>PP </th>
                                <th>KP</th>
                                <th>ProP</th>
                                <th>Nama pekKerjaan </th>
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


<script>
    $(document).ready(function() {

        // Inisialisasi Select2 untuk semua dropdown
        $('#filter-unor, #filter-provinsi, #filter-pn').select2();
        // Restore values from local storage
        $('#filter-unor').val(localStorage.getItem('selectedUnor'));
        $('#filter-provinsi').val(localStorage.getItem('selectedProvinsi'));
        $('#filter-pn').val(localStorage.getItem('selectedpn'));

        // On form submit, save the selected values
        $('#filter-form').on('submit', function() {
            event.preventDefault();

            $('#loading-spinner').show();
            $('#button-text').hide();
            // Ambil data filter dari form
            var filterData = $(this).serialize();
            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url("/tempRakortek/filter_data") ?>', // URL untuk memproses filter
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
            $('#filter-residu').val('').trigger('change');
            $('#filter-tahun_anggaran').val('').trigger('change');

            // Optionally clear the table data
            //$('#datatables tbody').empty();

            // Optionally, you could also clear the local storage if needed
            localStorage.removeItem('selectedUnor');
            localStorage.removeItem('selectedProvinsi');
            localStorage.removeItem('selectedKawasan');
            localStorage.removeItem('selectedResidu');
            localStorage.removeItem('selectedTahun');
        });
    });
</script>