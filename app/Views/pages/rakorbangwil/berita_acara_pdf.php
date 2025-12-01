<style>
    .catatan-item {
        background-color: #f8f9fa;
        /* warna abu lembut */
        border-left: 4px solid #0d6efd;
        /* garis biru di kiri */
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 8px;
    }

    .catatan-nama {
        font-weight: 600;
        color: #0d6efd;
        margin-bottom: 4px;
    }

    .catatan-text {
        text-align: justify;
        color: #333;
        margin: 0;
        white-space: pre-line;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">

            <div class="card-body">
                <div class="container-fluid">

                    <!-- Header PN -->
                    <div class="pn-header mb-4">
                        <div class="pn-text">
                            <strong style="font-weight: 900; color: #00b37d; font-size: 1.2rem;">
                                Berita Acara Kesepakatan
                            </strong><br>
                        </div>
                    </div>
                    <div class="card-body">

                        <form id="filter-form">

                            <div class="row filter-group">

                                <!-- PROVINSI -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="filter-label">Provinsi</label>
                                        <select class="form-control" name="provinsi" id="filter-provinsi">
                                            <option value="">Semua Provinsi</option>
                                            <?php foreach ($provinsi as $p): ?>
                                                <option value="<?= $p->id ?>"><?= $p->provinsi ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- SUMBER -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="filter-label">Prioritas Nasional</label>
                                        <select class="form-control" name="pn" id="filter-pn">
                                            <option value="">Pilih PN</option>
                                            <?php foreach ($pn as $p): ?>
                                                <option value="<?= $p['id_pn'] ?>"><?= 'PN' . $p['id_pn'] . ' - ' . $p['nama_pn'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <!-- BUTTON ROW -->
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary mr-2">
                                    <i id="button-text" class="fa fa-search"></i>
                                    <span id="loading-spinner" class="spinner-border spinner-border-sm" style="display:none;"></span>
                                </button>

                                <button type="button" id="reset-filters" class="btn btn-info">
                                    <i class="fa fa-undo"></i>
                                </button>
                            </div>

                        </form>

                    </div>
                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="pnTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kawasan" role="tab">Kawasan Prioritas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#diakomodasi" role="tab">Program/Kegiatan Diakomodasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#ditangguhkan" role="tab">Program/Kegiatan Ditangguhkan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tidak_terbahas" role="tab">Program/Kegiatan Tidak Terbahas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#bak" role="tab">Pejabat Penandatangan dan BAK</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3 p-3 border rounded bg-white">

                        <!-- ================= TAB PROGRAM ================= -->
                        <div class="tab-pane fade show active" id="kawasan" role="tabpanel">
                            <!-- DATATABLE -->
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatables" class="table table-striped table-hover" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kawasan</th>
                                                    <th>Tematik Kawasan</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <!-- Modal View/Edit -->
                                        <div class="modal fade" id="memoModal" tabindex="-1" role="dialog" aria-labelledby="memoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="memoModalLabel">Loading...</h5>
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
                        <!-- END TAB PROGRAM -->
                        <!-- ================= TAB Diakomodasi ================= -->
                        <div class="tab-pane fade show" id="diakomodasi" role="tabpanel">
                            <!-- DATATABLE -->
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatables" class="table table-striped table-hover" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kawasan</th>
                                                    <th>Pekerjaan</th>
                                                    <th>Unor</th>
                                                    <th>Kesepakatan</th>
                                                    <th>Sumber Pendanaan</th>
                                                    <th>Catatan Rakorbangwil</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <!-- Modal View/Edit -->
                                        <div class="modal fade" id="memoModal" tabindex="-1" role="dialog" aria-labelledby="memoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="memoModalLabel">Loading...</h5>
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
                        <!-- END TAB Diakomodasi -->
                        <!-- ================= TAB Diakomodasi ================= -->
                        <div class="tab-pane fade show" id="ditangguhkan" role="tabpanel">
                            <!-- DATATABLE -->
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatables" class="table table-striped table-hover" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kawasan</th>
                                                    <th>Pekerjaan</th>
                                                    <th>Unor</th>
                                                    <th>Kesepakatan</th>
                                                    <th>Sumber Pendanaan</th>
                                                    <th>Catatan Rakorbangwil</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <!-- Modal View/Edit -->
                                        <div class="modal fade" id="memoModal" tabindex="-1" role="dialog" aria-labelledby="memoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="memoModalLabel">Loading...</h5>
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
                        <!-- END TAB Diakomodasi -->
                        <!-- ================= TAB Diakomodasi ================= -->
                        <div class="tab-pane fade show" id="tidak_terbahas" role="tabpanel">
                            <!-- DATATABLE -->
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatables" class="table table-striped table-hover" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kawasan</th>
                                                    <th>Pekerjaan</th>
                                                    <th>Unor</th>
                                                    <th>Kesepakatan</th>
                                                    <th>Sumber Pendanaan</th>
                                                    <th>Catatan Rakorbangwil</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <!-- Modal View/Edit -->
                                        <div class="modal fade" id="memoModal" tabindex="-1" role="dialog" aria-labelledby="memoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="memoModalLabel">Loading...</h5>
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
                        <!-- END TAB Diakomodasi -->

                    </div><!-- END TAB CONTENT -->
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div> <!-- col -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script>
        window.currentCatatanData = <?= json_encode(json_decode($catatan_pn->catatan_pra_rakorbangwil ?? '[]')) ?>;
    </script>

    <script>
        $(document).ready(function() {

            // Inisialisasi Select2 untuk semua dropdown
            $('#filter-pn, #filter-provinsi').select2();

            // Restore value dari localStorage
            $('#filter-pn').val(localStorage.getItem('selectedPn')).trigger('change');
            $('#filter-provinsi').val(localStorage.getItem('selectedProvinsi')).trigger('change');
            $('#filter-tipe').val(localStorage.getItem('selectedTipe')).trigger('change');
            $('#filter-catatan_rakorbangwil').val(localStorage.getItem('selectedRakorbangwil')).trigger('change');
            $('#filter-catatan_pemda').val(localStorage.getItem('selectedCatatanPemda')).trigger('change');
            $('#filter-konfirmasi_pemda').val(localStorage.getItem('selectedKonfirmasiPemda')).trigger('change');
            $('#filter-kesepakatan').val(localStorage.getItem('selectedKesepakatan')).trigger('change');
            $('#filter-sumber').val(localStorage.getItem('selectedSumber')).trigger('change');


            // Submit filter (pakai ajax)
            $('#filter-form').on('submit', function(event) {
                event.preventDefault();

                // Simpan setiap filter ke localStorage
                localStorage.setItem('selectedPn', $('#filter-pn').val());
                localStorage.setItem('selectedProvinsi', $('#filter-provinsi').val());
                localStorage.setItem('selectedTipe', $('#filter-tipe').val());
                localStorage.setItem('selectedRakorbangwil', $('#filter-catatan_rakorbangwil').val());
                localStorage.setItem('selectedCatatanPemda', $('#filter-catatan_pemda').val());
                localStorage.setItem('selectedKonfirmasiPemda', $('#filter-konfirmasi_pemda').val());
                localStorage.setItem('selectedKesepakatan', $('#filter-kesepakatan').val());
                localStorage.setItem('selectedSumber', $('#filter-sumber').val());

                $('#loading-spinner').show();
                $('#button-text').hide();

                var filterData = $(this).serialize();

                $.ajax({
                    url: '<?= base_url('/rakorbangwil/get_desk_daftar_program_tahunan') ?>',
                    type: 'POST',
                    data: filterData,
                    success: function(response) {

                        // Destroy DataTable lama
                        if ($.fn.DataTable.isDataTable('#datatables')) {
                            $('#datatables').DataTable().destroy();
                        }

                        // Update tabel baru
                        $('#datatables tbody').html(response);

                        // Reinit DataTable
                        $('#datatables').DataTable({
                            pagingType: "full_numbers",
                            lengthMenu: [
                                [10, 25, 50, -1],
                                [10, 25, 50, "All"]
                            ],
                            responsive: true,
                            language: {
                                search: "_INPUT_",
                                searchPlaceholder: "Search...",
                                zeroRecords: "Data tidak ditemukan"
                            }
                        });
                    },
                    error: function() {
                        alert('Error loading data');
                    },
                    complete: function() {
                        $('#loading-spinner').hide();
                        $('#button-text').show();
                    }
                });
            });

            // Reset filter
            $('#reset-filters').on('click', function() {

                // Reset semua dropdown
                $('#filter-pn, #filter-provinsi, #filter-tipe, #filter-catatan_rakorbangwil, #filter-catatan_pemda, #filter-konfirmasi_pemda, #filter-kesepakatan, #filter-sumber')
                    .val('')
                    .trigger('change');

                // Hapus localStorage
                localStorage.removeItem('selectedPn');
                localStorage.removeItem('selectedProvinsi');
                localStorage.removeItem('selectedTipe');
                localStorage.removeItem('selectedRakorbangwil');
                localStorage.removeItem('selectedCatatanPemda');
                localStorage.removeItem('selectedKonfirmasiPemda');
                localStorage.removeItem('selectedKesepakatan');
                localStorage.removeItem('selectedSumber');

                // Bersihkan tabel
                var table = $('#datatables').DataTable();
                table.clear().draw();
            });

            $(document).on('click', '.btn-view', function() {
                let id = $(this).data('id');
                $('#memoModalLabel').text('Detail Program Tahunan');
                $('#memoModal .modal-body').html('<div class="text-center p-3"><div class="spinner-border"></div></div>');
                $('#memoModal').modal('show');

                $.get("<?= base_url('rakorbangwil/view') ?>/" + id, function(data) {
                    $('#memoModal .modal-body').html(data);
                });
            });

            // ====== EDIT ======
            $(document).on('click', '.btn-edit', function() {
                let id = $(this).data('id');
                $('#memoModalLabel').text('Edit Program Tahunan');
                $('#memoModal .modal-body').html('<div class="text-center p-3"><div class="spinner-border"></div></div>');
                $('#memoModal').modal('show');

                $.get("<?= base_url('rakorbangwil/edit_desk') ?>/" + id, function(data) {
                    $('#memoModal .modal-body').html(data);
                });
            });

            $(document).on('submit', '#editMemoForm', function(e) {
                e.preventDefault();

                let form = $(this);
                let id = form.find('input[name="id_prog_tahunan"]').val();

                // 🔹 Ambil tombol submit di dalam form
                const $btn = form.find('button[type="submit"]');
                const originalText = $btn.html(); // simpan teks asli tombol

                // 🔹 Ubah tombol jadi loading spinner & disable
                $btn.prop('disabled', true).html(`
        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
        Menyimpan...
    `);

                $.ajax({
                    url: "<?= base_url('rakorbangwil/update_desk') ?>/" + id,
                    type: "POST",
                    data: form.serialize(),
                    success: function(res) {
                        if (res.status) {
                            $('#memoModal').modal('hide');

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data Program Tahunan berhasil diperbarui.',
                                showConfirmButton: false,
                                timer: 2000
                            });

                            // reload tabel dengan submit filter
                            $('#button-text').submit();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: res.message || 'Terjadi kesalahan saat memperbarui data.',
                                showConfirmButton: true
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal menghubungi server.',
                            showConfirmButton: true
                        });
                    },
                    complete: function() {
                        // 🔹 Kembalikan tombol seperti semula
                        $btn.prop('disabled', false).html(originalText);
                    }
                });
            });
        });
    </script>

    <script>
        window.namaList = <?= json_encode($namaList ?? []) ?>;
    </script>

    <style>
        .pn-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            border-left: 5px solid #00b37d;
        }

        .pn-number {
            background: #007bff;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            border-radius: 10px;
            padding: 15px 20px;
            min-width: 60px;
            text-align: center;
        }

        .pn-text {
            font-size: 0.95rem;
            color: #333;
            flex: 1;
        }

        /* TAB ACTIVE = Hijau */
        .nav-tabs .nav-link.active {
            background-color: #00b37d !important;
            /* hijau */
            color: white !important;
            font-weight: 600;
            border: none !important;
        }

        /* TAB NON ACTIVE = Abu */
        .nav-tabs .nav-link {
            background-color: #d7d7d7 !important;
            /* abu */
            color: white !important;
            font-weight: 500;
            border: none !important;
        }

        /* Hover effect optional */
        .nav-tabs .nav-link:hover {
            background-color: #bbbbbb !important;
            color: white !important;
        }




        .btn-save {
            background-color: #00bff0;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 14px;
        }

        .btn-save:hover {
            background-color: #009dcc;
        }

        .table th {
            background-color: #f1f3f5;
            color: #333;
        }
    </style>