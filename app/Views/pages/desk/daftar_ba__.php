<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon bg-primary">
                    <i class="material-icons">drawing</i>
                </div>


                <h4 class="card-title">Pejabatan Penanda Tangan</h4>

            </div>
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

                                <div class="col-md-4">
                                    <button type="button" id="reset-filters" class="btn btn-info">
                                        <i class="fa fa-undo"></i>
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i id="button-text" class="fa fa-search"></i>
                                        <span id="loading-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                    </button>

                                    <button class="btn btn-success" id="download" style="display: none;">
                                        <span style="color: white;">Download BA</span>
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
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Provinsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No </th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Provinsi</th>
                                <th>Aksi</th>
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
<div class="card mt-4" id="form-tambah" style="display: none;">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Tambah Pejabat Penandatangan</h5>
        </div>
        <div class="card-body">
            <form id="addJabatanForm" method="POST" action="<?= base_url('desk/add_pejabat') ?>">
                <div class="form-row align-items-center">
                    <!-- Dropdown Pejabat -->
                    <div class="col-md-12 mb-3">
                        <label for="pejabatSelect"><strong>Pilih Pejabat</strong></label>
                        <select class="form-control" style="width: 300px;" id="pejabatSelect" name="pejabat_id" required>
                            <option value="" selected disabled>Pilih Pejabat</option>
                            <?php foreach ($pejabat as $pejabat) : ?>
                                <option value="<?= $pejabat['id_pejabat'] ?>"><?= $pejabat['nama_pejabat']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <!-- Hidden Input for Provinsi -->
                    <input type="hidden" id="hiddenProvinsiIdForJabatan" name="provinsi_id" value="">

                    <!-- Submit Button -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary mt-4">
                            <i class="fa fa-plus"></i> Tambah Pejabat
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- end row -->
</div>
</div>
<div class="modal fade" id="dateModal" tabindex="-1" role="dialog" aria-labelledby="dateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateModalLabel">Masukkan Tanggal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="modal-download-date">Tanggal:</label>
                <input type="date" id="modal-download-date" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" id="confirm-modal-download" class="btn btn-primary">Konfirmasi</button>
            </div>
        </div>
    </div>
</div>
<!-- jQuery, Select2, dan Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('addJabatanForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah pengiriman form standar

        const form = this;
        const formData = new FormData(form);

        // Kirim data form menggunakan fetch
        fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => response.json()) // Pastikan server mengembalikan JSON
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: "Terima Kasih!",
                        text: "Pejabat berhasil ditambahkan!",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        // Reset form setelah sukses
                        form.reset();
                    });
                } else {
                    Swal.fire({
                        title: "Gagal!",
                        text: data.message || "Terjadi kesalahan saat menambahkan pejabat.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: "Error!",
                    text: "Terjadi kesalahan pada server.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
                console.error(error);
            });
    });
</script>

<script>
    $(document).ready(function() {
        // Inisialisasi Select2 untuk semua dropdown
        $('#filter-provinsi, #pejabatSelect').select2();

        // Restore values from local storage
        $('#filter-provinsi').val(localStorage.getItem('selectedProvinsi'));

        // On form submit, save the selected values
        $('#filter-form').on('submit', function(event) {
            event.preventDefault();

            var provinsiId = $('#filter-provinsi').val();
            var newUrl = '<?= base_url('addBak2/') ?>' + provinsiId;
            $('#downloadLink').attr('href', newUrl);
            $('#hiddenProvinsiIdForJabatan').val(provinsiId);

            $('#loading-spinner').show();
            $('#button-text').hide();

            $.ajax({
                url: '<?= base_url('/desk/get_pejabat') ?>', // URL untuk memproses filter
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

                    // Inisialisasi DataTables kembali
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
                    $('#form-tambah').show();
                    $('#download').show();
                }
            });
        });

        // Reset filter
        $('#reset-filters').on('click', function() {
            // Reset dropdowns to their default values
            $('#filter-provinsi').val('').trigger('change');
            $('#addJabatanButton').hide();
            $('#form-tambah').hide();
            $('#download').hide();
            // Optionally, you could also clear the local storage if needed
            localStorage.removeItem('selectedProvinsi');
        });

        // Update hidden input on dropdown change
        $('#filter-provinsi').on('change', function() {
            const selectedValue = $(this).val(); // Ambil value dari dropdown
            $('#id_provinsi').val(selectedValue); // Set value ke input hidden
        });

        // Tambahan fitur modal
        $('#download').on('click', function() {
            // Tampilkan modal untuk input tanggal
            $('#dateModal').modal('show');
        });

        // Konfirmasi tanggal dari modal
        $('#confirm-modal-download').on('click', function() {
            var selectedDate = $('#modal-download-date').val();

            if (!selectedDate) {
                alert('Harap masukkan tanggal sebelum melanjutkan!');
                return;
            }

            var provinsiId = $('#filter-provinsi').val();
            var postData = {
                provinsi_id: provinsiId,
                tanggal: selectedDate
            };

            // Kirim data ke server menggunakan AJAX
            $.ajax({
                url: '<?= base_url('addBak2/') ?>', // Endpoint controller
                type: 'POST',
                data: postData,
                success: function(response) {
                    $('#dateModal').modal('hide'); // Tutup modal
                    window.location.href = response.download_url; // Redirect ke URL file
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan: ' + error);
                }
            });
        });
    });
</script>