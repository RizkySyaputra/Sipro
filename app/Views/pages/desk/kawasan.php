<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title">Pembahasan Kawasan</h4>

            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <div class="container mt-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Filter Provinsi</h5>
                    </div>
                    <div class="card-body">
                        <form id="filter-form">
                            <div class="form-row align-items-center">


                                <!-- Dropdown Provinsi -->
                                <div class="col-md-3 mb-3">
                                    <label for="provinsi"><strong>Pilih Provinsi</strong></label>
                                    <select class="form-control" name="provinsi" id="filter-provinsi">
                                        <option value="" selected disabled>Pilih Provinsi</option>
                                        <?php foreach ($provinsi as $p): ?>
                                            <option value="<?= $p->id ?>"><?= $p->provinsi ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

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
                                <th>Kawasan</th>
                                <th>Provinsi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No </th>
                                <th>Kawasan</th>
                                <th>Provinsi</th>
                            </tr>
                        </tfoot>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Form Catatan -->
            <!-- Form Catatan, tersembunyi awalnya -->
            <form action="<?= base_url('desk/simpan_catatan') ?>" method="post">
                <div class="card-body mt-4" id="catatan-form" style="display: none;">
                    <div class="form-group">
                        <input name="provinsi_id" id="id_provinsi" hidden> </input>
                        <label for="catatan"><strong>Catatan Kawasan untuk Provinsi yang Dipilih:</strong></label>
                        <textarea name="catatan" class="form-control" id="catatan" rows="4" placeholder="Masukkan catatan disini..." required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" onclick='swal({ title:"Terima Kasih!", text: "Catatan Berhasil disimpan !", type: "success", buttonsStyling: false, confirmButtonClass: "btn btn-success"})' id="simpan-catatan" class="btn btn-primary">
                            <i class="fa fa-save"></i> Simpan Catatan
                        </button>
                    </div>
                </div>
            </form>


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
        // Inisialisasi Select2 untuk semua dropdown
        $('#filter-provinsi').select2();
        // Restore values from local storage
        $('#filter-provinsi').val(localStorage.getItem('selectedProvinsi'));

        // On form submit, save the selected values
        $('#filter-form').on('submit', function() {
            event.preventDefault();
            var provinsiId = $('#filter-provinsi').val();
            $('#loading-spinner').show();
            $('#button-text').hide();
            // Kirim request AJAX untuk ambil catatan
            $.ajax({
                url: '<?= base_url("/desk/get_catatan") ?>', // Ganti dengan URL yang sesuai
                type: 'POST',
                data: {
                    provinsi_id: provinsiId // Kirimkan data provinsi_id jika diperlukan
                },
                success: function(response) {
                    // Update value textarea dengan data catatan
                    $('#catatan').val(response.catatan); // Misalnya 'response.catatan' adalah catatan yang dikembalikan

                    // Menyembunyikan spinner setelah data diterima

                },
                error: function() {
                    alert('Error loading catatan');

                }
            });
            // ambil kawasan
            $.ajax({
                url: '<?= base_url('/desk/get_kawasan') ?>', // URL untuk memproses filter
                type: 'POST',
                data: {
                    provinsi_id: provinsiId
                },
                success: function(response) {
                    // Hapus inisialisasi DataTables yang lama
                    if ($.fn.DataTable.isDataTable('#datatables')) {
                        $('#datatables').DataTable().destroy();
                    }
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
                    $('#catatan-form').show();
                }
            });

        });


        $('#reset-filters').on('click', function() {
            // Reset dropdowns to their default values
            $('#filter-provinsi').val('').trigger('change');

            // Optionally, you could also clear the local storage if needed
            localStorage.removeItem('selectedProvinsi');
        });
        $('#filter-provinsi').on('change', function() {
            const selectedValue = $(this).val(); // Ambil value dari dropdown
            $('#id_provinsi').val(selectedValue); // Set value ke input hidden
        });

    });
</script>