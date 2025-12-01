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
                                            <option value="" disabled>Pilih Provinsi</option>
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
                                            <option value="" disabled>Pilih PN</option>
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
                    <ul class="nav nav-tabs" id="pnTabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#kawasan">Kawasan Prioritas</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#diakomodasi">Program Diakomodasi</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ditangguhkan">Program Ditangguhkan</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tidak_terbahas">Program Tidak Terbahas</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#bak">Pejabat Penandatangan & Generate BA</a></li>
                    </ul>
                    <div class="tab-content mt-3 p-3 border rounded bg-white">

                        <!-- ================= TAB PROGRAM ================= -->
                        <div class="tab-pane fade show active" id="kawasan" role="tabpanel">
                            <!-- DATATABLE -->
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="table-kawasan" class="table table-striped table-hover">
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
                                        <table id="table-diakomodasi" class="table table-striped table-hover">
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
                                        <table id="table-ditangguhkan" class="table table-striped table-hover">
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
                                        <table id="table-tidakterbahas" class="table table-striped table-hover">
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
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- END TAB Diakomodasi -->
                        <!-- ================= TAB Diakomodasi ================= -->
                        <div class="tab-pane fade show" id="bak" role="tabpanel">
                            <!-- DATATABLE -->
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="mb-3 text-right">
                                            <button id="btn-generate-bak" class="btn btn-success">
                                                <i class="fa fa-file-alt"></i> Generate Berita Acara
                                            </button>
                                        </div>

                                        <table id="table-tidakterbahas" class="table table-striped table-hover">
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
    <!-- Modal Pilih Tanggal BAK -->
    <div class="modal fade" id="modalTanggalBAK" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Pilih Tanggal Berita Acara</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <label><strong>Tanggal Berita Acara</strong></label>
                    <input type="date" id="tanggal-bak" class="form-control">
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button id="btn-submit-tanggal-bak" class="btn btn-primary">Generate</button>
                </div>

            </div>
        </div>
    </div>
    <form id="form-generate-bak" action="<?= base_url('rakorbangwil/create_berita_acara') ?>" method="POST" style="display:none;">
        <input type="hidden" name="provinsi_id" id="post-provinsi">
        <input type="hidden" name="pn_id" id="post-pn">
        <input type="hidden" name="tanggal" id="post-tanggal">
    </form>

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
            function emptyRow(colspan) {
                return `
        <tr>
            <td colspan="${colspan}" class="text-center text-muted">
                Tidak ada data
            </td>
        </tr>
    `;
            }

            // Inisialisasi Select2 untuk semua dropdown
            $('#filter-pn, #filter-provinsi').select2();

            // Restore value dari localStorage
            $('#filter-pn').val(localStorage.getItem('selectedPn')).trigger('change');
            $('#filter-provinsi').val(localStorage.getItem('selectedProvinsi')).trigger('change');


            // Submit filter (pakai ajax)
            $('#filter-form').on('submit', function(event) {
                event.preventDefault();
                let provinsi = $('#filter-provinsi').val();
                let pn = $('#filter-pn').val();

                // === VALIDASI WAJIB DIISI ===
                if (!provinsi || !pn) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Filter Belum Lengkap',
                        text: 'Silakan pilih Provinsi dan Prioritas Nasional terlebih dahulu.',
                        confirmButtonColor: '#3085d6'
                    });
                    return; // stop AJAX
                }
                $('#loading-spinner').show();
                $('#button-text').hide();

                $.ajax({
                    url: '<?= base_url('/rakorbangwil/get_data_berita_acara') ?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {

                        // ========== TABEL KAWASAN ==========
                        let htmlKawasan = "";

                        if (response.kawasan.length === 0) {
                            htmlKawasan = emptyRow(3);
                        } else {
                            response.kawasan.forEach((item, index) => {
                                htmlKawasan += `
            <tr>
                <td>${index + 1}</td>
                <td>${item.kawasan?? '-'}</td>
                <td>${item.tematik}</td>
            </tr>
        `;
                            });
                        }

                        $('#kawasan table tbody').html(htmlKawasan);


                        // ========== TABEL DIAKOMODASI ==========
                        let htmlDiakomodasi = "";

                        if (response.diakomodasi.length === 0) {
                            htmlDiakomodasi = emptyRow(7);
                        } else {
                            response.diakomodasi.forEach((item, index) => {
                                htmlDiakomodasi += `
            <tr>
                <td>${index + 1}</td>
                <td>${item.kawasan }</td>
                <td>${item.pekerjaan}</td>
                <td>${item.unor}</td>
                <td>Diakomodasi</td>
                <td>${item.sumber_pendanaan ?? '-'}</td>
                <td>${item.catatan_desk_rakorbangwil ?? '-'}</td>
            </tr>
        `;
                            });
                        }

                        $('#diakomodasi table tbody').html(htmlDiakomodasi);


                        // ========== TABEL DITANGGUHKAN ==========
                        let htmlTangguh = "";

                        if (response.ditangguhkan.length === 0) {
                            htmlTangguh = emptyRow(7);
                        } else {
                            response.ditangguhkan.forEach((item, index) => {
                                htmlTangguh += `
            <tr>
                <td>${index + 1}</td>
                <td>${item.kawasan}</td>
                <td>${item.pekerjaan}</td>
                <td>${item.unor}</td>
                <td>${item.desk_rakorbangwil}</td>
                <td>${item.sumber_pendanaan?? '-'}</td>
                <td>${item.catatan_desk_rakorbangwil ?? '-'}</td>
            </tr>
        `;
                            });
                        }

                        $('#ditangguhkan table tbody').html(htmlTangguh);


                        // ========== TABEL TIDAK TERBAHAS ==========
                        let htmlTidak = "";

                        if (response.tidakTerbahas.length === 0) {
                            htmlTidak = emptyRow(7);
                        } else {
                            response.tidakTerbahas.forEach((item, index) => {
                                htmlTidak += `
            <tr>
                <td>${index + 1}</td>
                <td>${item.kawasan}</td>
                <td>${item.pekerjaan}</td>
                <td>${item.unor}</td>
                <td>Tidak Terbahas</td>
                <td>${item.sumber_pendanaan ?? '-'}</td>
                <td>${item.catatan_desk_rakorbangwil ?? '-'}</td>
            </tr>
        `;
                            });
                        }

                        $('#tidak_terbahas table tbody').html(htmlTidak);


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
                $('#filter-pn, #filter-provinsi')
                    .val('')
                    .trigger('change');

                // Hapus localStorage
                localStorage.removeItem('selectedPn');
                localStorage.removeItem('selectedProvinsi');

                // Bersihkan tabel
                var table = $('#datatables').DataTable();
                table.clear().draw();
            });
        });
        $(document).ready(function() {

            // Klik tombol generate BAK
            $('#btn-generate-bak').on('click', function() {

                let provinsi = $('#filter-provinsi').val();
                let pn = $('#filter-pn').val();

                if (!provinsi || !pn) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Filter Belum Dipilih',
                        text: 'Silakan pilih Provinsi dan PN terlebih dahulu pada form filter.'
                    });
                    return;
                }

                $('#modalTanggalBAK').modal('show');
            });

            // Submit tanggal
            $('#btn-submit-tanggal-bak').on('click', function() {

                let tanggal = $('#tanggal-bak').val();
                let provinsi = $('#filter-provinsi').val();
                let pn = $('#filter-pn').val();

                if (!tanggal) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tanggal Belum Dipilih',
                        text: 'Harap pilih tanggal Berita Acara!'
                    });
                    return;
                }

                // Isi hidden form
                $('#post-provinsi').val(provinsi);
                $('#post-pn').val(pn);
                $('#post-tanggal').val(tanggal);

                // Submit form ke controller
                $('#form-generate-bak').submit();
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