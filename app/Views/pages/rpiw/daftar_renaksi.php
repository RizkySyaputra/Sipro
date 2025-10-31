<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title">Rencana Aksi</h4>

            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <div class="container mt-4">
                <div class="card shadow-md">
                    <!-- <div class="card-header">
                        <h5 class="mb-0">Filter Data Rencana Aksi</h5>
                    </div> -->
                    <div class="card-body">
                        <form id="filter-form" ?>
                            <!-- <div class="form-row align-items-center"> -->
                            <!-- Dropdown Provinsi -->
                            <div class="row mb-3">
                                <div class="col-md-1">
                                    <label for="provinsi"><strong>Provinsi</strong></label>
                                </div>
                                <div class="col-md-11">
                                    <select class="form-control" name="provinsi" id="filter-provinsi">
                                        <option value="">Semua Provinsi</option>
                                        <?php foreach ($provinsi as $p): ?>
                                            <option value="<?= $p->id ?>"><?= $p->provinsi ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-1">
                                    <label for="unor"><strong>Unor</strong></label>
                                </div>
                                <div class="col-md-11">
                                    <select class="form-control" name="unor" id="filter-unor">
                                        <option value="">Semua Unor</option>
                                        <?php foreach ($unor as $u): ?>
                                            <option value="<?= $u->id ?>"><?= $u->unor ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Dropdown Kawasan -->
                            <div class="row mb-3">
                                <div class="col-md-1">
                                    <label for="kawasan"><strong>Kawasan</strong></label>
                                </div>
                                <div class="col-md-11">
                                    <select class="form-control" name="kawasan" id="filter-kawasan">
                                        <option value="">Semua Kawasan</option>
                                        <?php foreach ($kawasan as $k): ?>
                                            <option value="<?= $k->nama_kawasan ?>"><?= $k->nama_kawasan ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Button Filter -->
                            <div class="row">
                                <!-- <div class="col-md-3 d-flex align-items-end gap-2"> -->
                                <!-- Cari (Search) -->
                                <div class="col-md-1">

                                </div>
                                <div class="col-md-11">
                                    <button type="submit" class="btn btn-primary" title="Cari">
                                        <i id="button-text" class="fa fa-search"></i>
                                        <span id="loading-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                    </button>

                                    <!-- Reset Filter -->
                                    <button type="button" id="reset-filters" class="btn btn-info" title="Reset Filter">
                                        <!-- <i class="fa fa-eraser"></i> -->
                                        <i class="fa fa-undo"></i>
                                    </button>

                                    <!-- Refresh -->
                                    <!-- <button type="submit" id="button-text" class="btn btn-success" title="Refresh Data">
                                        <i class="fas fa-sync-alt"></i>
                                    </button> -->
                                </div>
                                <!-- </div> -->
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>Provinsi</th>
                                        <th>Unor</th>
                                        <th>Nama Kegiatan </th>
                                        <th>Kawasan</th>
                                        <th>Mulai - Selesai</th>
                                        <th style="width:18%">Aksi</th>
                                    </tr>
                                </thead>
                                <!-- <tfoot>
                                    <tr>
                                        <th>No </th>
                                        <th>Provinsi</th>
                                        <th>Unor</th>
                                        <th>Nama Kegiatan </th>
                                        <th>Kawasan</th>
                                        <th>Mulai - Selesai</th>
                                        <th>Aksi </th>
                                    </tr>
                                </tfoot> -->
                                <tbody>

                                </tbody>
                            </table>
                            <!-- Modal View/Edit -->
                            <div class="modal fade" id="renaksiModal" tabindex="-1" role="dialog" aria-labelledby="renaksiModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="renaksiModalLabel">Loading...</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center p-3">
                                                <div class="spinner-border text-primary" role="status"></div>
                                                <p>Memuat data...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
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
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<!-- end row -->
<!-- jQuery, Select2, dan Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        $('#filter-unor, #filter-provinsi, #filter-kawasan,  #filter-sumber').select2();
        // Restore values from local storage
        $('#filter-unor').val(localStorage.getItem('selectedUnor'));
        $('#filter-provinsi').val(localStorage.getItem('selectedProvinsi'));
        $('#filter-kawasan').val(localStorage.getItem('selectedKawasan'));
        $('#filter-sumber').val(localStorage.getItem('selectedSumber'));

        // On form submit, save the selected values
        $('#filter-form').on('submit', function() {
            event.preventDefault();

            $('#loading-spinner').show();
            $('#button-text').hide();
            // Ambil data filter dari form
            var filterData = $(this).serialize();
            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url('/rpiw/get_daftar_renaksi') ?>', // URL untuk memproses filter
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
            $('#filter-unor').val('').trigger('change');
            $('#filter-provinsi').val('').trigger('change');
            $('#filter-kawasan').val('').trigger('change');
            $('#filter-sumber').val('').trigger('change');

            // Optionally clear the table data
            //$('#datatables tbody').empty();

            // Optionally, you could also clear the local storage if needed
            localStorage.removeItem('selectedUnor');
            localStorage.removeItem('selectedProvinsi');
            localStorage.removeItem('selectedKawasan');
            localStorage.removeItem('selectedSumber');

            var table = $('#datatables').DataTable();
            table.clear().draw();
        });
    });
</script>
<?= $this->section('_script') ?>
<script>
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

    $(document).on('click', '.btn-delete', function() {
        let id = $(this).data('id'); // ambil id_renaksi
        let row = $(this).closest('tr'); // baris tabel yang diklik

        if (!confirm('Yakin ingin menghapus data ini?')) {
            return;
        }

        $.ajax({
            url: '<?= base_url('rpiw/delete') ?>/' + id,
            type: 'DELETE',
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>' // kirim CSRF
            },
            success: function(response) {
                // Hapus baris dari DataTables tanpa reload
                let table = $('#datatables').DataTable();
                table.row(row).remove().draw(false);

                // Tampilkan popup notifikasi
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data renaksi berhasil dihapus.',
                    showConfirmButton: false,
                    timer: 2000
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menghapus data.',
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // ====== VIEW ======
        $(document).on('click', '.btn-view', function() {
            let id = $(this).data('id');
            $('#renaksiModalLabel').text('Detail Renaksi');
            $('#renaksiModal .modal-body').html('<div class="text-center p-3"><div class="spinner-border"></div></div>');
            $('#renaksiModal').modal('show');

            $.get("<?= base_url('rpiw/view') ?>/" + id, function(data) {
                $('#renaksiModal .modal-body').html(data);
            });
        });

        // ====== EDIT ======
        $(document).on('click', '.btn-edit', function() {
            let id = $(this).data('id');
            $('#renaksiModalLabel').text('Edit Renaksi');
            $('#renaksiModal .modal-body').html('<div class="text-center p-3"><div class="spinner-border"></div></div>');
            $('#renaksiModal').modal('show');

            $.get("<?= base_url('rpiw/edit') ?>/" + id, function(data) {
                $('#renaksiModal .modal-body').html(data);
            });
        });

        // ====== UPDATE ======
        $(document).on('submit', '#editRenaksiForm', function(e) {
            e.preventDefault();
            let form = $(this);
            let id = form.find('input[name="id_renaksi"]').val();

            $.ajax({
                url: "<?= base_url('rpiw/update') ?>/" + id,
                type: "POST",
                data: form.serialize(),
                success: function(res) {
                    if (res.success) {
                        $('#renaksiModal').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data renaksi berhasil diperbarui.',
                            showConfirmButton: false,
                            timer: 2000
                        });

                        // reload tabel dengan submit filter
                        $('#button-text').submit();
                    }
                },
                error: function() {
                    alert("Gagal update data");
                }
            });
        });
    });

    // $.get("<?= base_url('rpiw/view') ?>/" + id, function(data) {
    //     console.log("Response:", data); // cek respon
    //     $('#renaksiModal .modal-body').html(data);
    // }).fail(function(xhr) {
    //     alert("Error " + xhr.status + ": " + xhr.responseText);
    // });
</script>

<?= $this->endSection() ?>