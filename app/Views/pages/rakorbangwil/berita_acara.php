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

    /* Efek saat baris di-drag */
    .drag-active {
        background: #d9ecff !important;
        transition: background 0.3s ease;
    }

    /* Animasi saat baris lain bergeser */
    .sortable-pejabat tr {
        transition: transform 200ms ease, background 200ms ease;
    }

    /* Hover untuk feedback */
    .sortable-pejabat tr:hover {
        background: #f5faff;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="<?= base_url('assets/js/jquery-ui.min.js') ?>"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script>
    console.log("Check jQuery:", typeof jQuery);
    console.log("Check jQuery UI:", typeof $.ui);
    console.log("Check Sortable:", typeof $.fn.sortable);
</script>

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
                        <div class="tab-pane fade show" id="bak" role="tabpanel">
                            <!-- DATATABLE -->
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">

                                        <div class="mb-3 text-right">
                                            <button id="btn-add-pejabat" class="btn btn-primary">
                                                <i class="fa fa-plus"></i> Tambah Pejabat
                                            </button>
                                            <button id="btn-generate-bak" class="btn btn-success">
                                                <i class="fa fa-file-alt"></i> Generate Berita Acara
                                            </button>
                                        </div>

                                        <table id="table-pejabat-bak" class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="width:40px;"></th>
                                                    <th>Nama Pejabat</th>
                                                    <th>Jabatan</th>
                                                    <th>Provinsi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="sortable-pejabat">
                                                <!-- akan diisi via AJAX -->
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
    <!-- Modal Tambah Pejabat -->
    <div class="modal fade" id="modalAddPejabat" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form id="form-tambah-pejabat" method="POST" action="<?= base_url('rakorbangwil/addPejabatBAK') ?>">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pejabat Penandatangan</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama Pejabat</label>
                            <select class="form-control" style="width: 100%;" name="pejabat_id" id="select-pejabat" required>
                                <option value="" disabled selected>Pilih Pejabat</option>
                                <?php foreach ($pejabat as $pj): ?>
                                    <option value="<?= $pj['id_pejabat'] ?>"><?= $pj['nama_pejabat'] ?> - <?= $pj['jabatan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <input type="hidden" name="provinsi_id" id="input-provinsi-id">
                        <input type="hidden" name="pn_id" id="input-pn-id">

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="btn-submit-pejabat">
                            <span class="text-label">Tambah Pejabat</span>
                            <span class="spinner-border spinner-border-sm d-none" id="spinner-pejabat"></span>
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>

    <form id="form-generate-bak" action="<?= base_url('rakorbangwil/create_berita_acara') ?>" method="POST" style="display:none;" target="_blank">
        <input type="hidden" name="provinsi_id" id="post-provinsi">
        <input type="hidden" name="pn_id" id="post-pn">
        <input type="hidden" name="tanggal" id="post-tanggal">
    </form>

    <script>
        window.currentCatatanData = <?= json_encode(json_decode($catatan_pn->catatan_pra_rakorbangwil ?? '[]')) ?>;
    </script>

    <script>
        $(document).ready(function() {
            function getStatusDesk(value) {
                switch (value) {
                    case '1':
                        return "Diakomodasi";
                    case '2':
                        return "Diakomodasi (Pra Desk Konreg)";
                    case '3':
                        return "Ditangguhkan";
                    case '4':
                        return "Ditangguhkan (Geser Tahun)";
                    case '5':
                        return "Ditangguhkan (Skema KPBU)";
                    case '6':
                        return "Ditangguhkan (Sumber Pendanaan Lainnya)";
                    default:
                        return "-";
                }
            }

            function formatCatatan(jsonString) {
                if (!jsonString) return '-';

                try {
                    const list = JSON.parse(jsonString); // decode JSON

                    return list.map(i => `${i.nama} : ${i.catatan}`).join('<br>');
                } catch (e) {
                    return jsonString; // jika JSON rusak, tampilkan apa adanya
                }
            }


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
            $('#filter-pn, #filter-provinsi ,#select-pejabat').select2();

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
                 <td>${getStatusDesk(item.desk_rakorbangwil)}</td>
                <td>${item.sumber_pendanaan ?? '-'}</td>
                <td style="width: 30%;">${formatCatatan(item.catatan_desk_rakorbangwil)}</td>
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
              <td>${getStatusDesk(item.desk_rakorbangwil)}</td>
                <td>${item.sumber_pendanaan?? '-'}</td>
              <td style="width: 30%;">${formatCatatan(item.catatan_desk_rakorbangwil)}</td>
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
              <td style="width: 30%;">${formatCatatan(item.catatan_desk_rakorbangwil)}</td>
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

            // Buka modal tambah pejabat
            $('#btn-add-pejabat').on('click', function() {

                let provinsi = $('#filter-provinsi').val();
                let pn = $('#filter-pn').val();

                if (!provinsi || !pn) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Filter Belum Dipilih',
                        text: 'Silakan pilih Provinsi dan PN terlebih dahulu.'
                    });
                    return;
                }

                // Simpan value ke hidden input
                $('#input-provinsi-id').val(provinsi);
                $('#input-pn-id').val(pn);

                $('#modalAddPejabat').modal('show');
            });

            $(document).ready(function() {

                // ========= FUNGSI LOAD DATA PEJABAT BAK =========
                function loadPejabatBAK() {
                    let provinsi = $('#filter-provinsi').val();
                    let pn = $('#filter-pn').val();

                    if (!provinsi || !pn) {
                        $('#table-pejabat-bak tbody').html(`
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Silakan pilih Provinsi dan PN terlebih dahulu.
                    </td>
                </tr>
            `);
                        return;
                    }

                    $.ajax({
                        url: '<?= base_url("/rakorbangwil/get_pejabat_bak") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            provinsi: provinsi,
                            pn: pn
                        },
                        success: function(response) {
                            let html = "";

                            if (!response || response.length === 0) {
                                html = `
            <tr>
                <td colspan="5" class="text-center text-muted">
                    Belum ada pejabat untuk kombinasi Provinsi & PN Terpilih.
                </td>
            </tr>`;
                            } else {
                                response.forEach((item, i) => {
                                    html += `
                <tr data-id="${item.id}">
                    <td class="drag-handle text-center" title="Geser urutan">
    <i class="fa fa-bars"></i>
        </td>
                    <td>${item.nama_pejabat}</td>
                    <td>${item.jabatan}</td>
                    <td>${item.provinsi}</td>
                    <td>
                        <button class="btn btn-danger btn-sm btn-delete-pejabat" data-id="${item.id}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
                                });
                            }

                            $('#table-pejabat-bak tbody').html(html);

                            // ===== AKTIFKAN SORTABLE ULANG SESUDAH TABEL DI UPDATE =====
                            enableSortable();
                        }

                    });
                }

                // ========= PANGGIL loadPejabatBAK SETELAH FILTER DI-SUBMIT =========
                $('#filter-form').on('submit', function() {
                    setTimeout(() => {
                        loadPejabatBAK();
                    }, 300);
                });

                // ========= BUKA MODAL TAMBAH PEJABAT =========
                $('#btn-add-pejabat').on('click', function() {
                    let provinsi = $('#filter-provinsi').val();
                    let pn = $('#filter-pn').val();

                    if (!provinsi || !pn) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Filter Belum Dipilih',
                            text: 'Silakan pilih Provinsi dan PN terlebih dahulu.'
                        });
                        return;
                    }

                    $('#input-provinsi-id').val(provinsi);
                    $('#input-pn-id').val(pn);

                    $('#modalAddPejabat').modal('show');
                });

                // ========= SUBMIT TAMBAH PEJABAT =========
                $('#form-tambah-pejabat').on('submit', function(e) {
                    e.preventDefault();

                    // ====== AKTIFKAN SPINNER ======
                    $("#btn-submit-pejabat").prop("disabled", true);
                    $("#btn-submit-pejabat .text-label").addClass("d-none");
                    $("#spinner-pejabat").removeClass("d-none");

                    $.ajax({
                        url: $(this).attr("action"),
                        type: "POST",
                        data: $(this).serialize(),
                        success: function(res) {

                            // reset tombol
                            $("#btn-submit-pejabat").prop("disabled", false);
                            $("#btn-submit-pejabat .text-label").removeClass("d-none");
                            $("#spinner-pejabat").addClass("d-none");

                            $('#modalAddPejabat').modal('hide');

                            Swal.fire('Berhasil', 'Pejabat berhasil ditambahkan', 'success');

                            // reload tabel
                            loadPejabatBAK();
                        },

                        error: function() {
                            // reset tombol
                            $("#btn-submit-pejabat").prop("disabled", false);
                            $("#btn-submit-pejabat .text-label").removeClass("d-none");
                            $("#spinner-pejabat").addClass("d-none");

                            Swal.fire('Error', 'Gagal menambah pejabat', 'error');
                        }
                    });
                });


                // ========= HAPUS PEJABAT =========
                $(document).on('click', '.btn-delete-pejabat', function() {
                    let id = $(this).data('id');

                    Swal.fire({
                        title: 'Hapus Pejabat?',
                        text: "Data akan dihapus dari daftar penandatangan.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '<?= base_url("/rakorbangwil/delete_pejabat_bak") ?>',
                                type: 'POST',
                                data: {
                                    id: id
                                },
                                success: function() {
                                    Swal.fire('Berhasil', 'Pejabat dihapus', 'success');
                                    loadPejabatBAK();
                                }
                            });
                        }
                    });
                });

                // Opsional: ketika tab BAK diklik, reload daftar pejabat
                $('a[href="#bak"]').on('shown.bs.tab', function() {
                    loadPejabatBAK();
                });
            });



        });
        // ===================================================
        // Fitur Drag & Drop Urutan Pejabat Penandatangan BAK
        // ===================================================
        function enableSortable() {

            const $el = $(".sortable-pejabat");

            // Hanya destroy jika sebelumnya sudah pernah sortable
            if ($el.data("ui-sortable")) {
                $el.sortable("destroy");
            }

            $el.sortable({
                handle: ".drag-handle",
                cursor: "move",
                axis: "y",
                opacity: 0.8,
                revert: 150,

                helper: function(e, tr) {
                    var originals = tr.children();
                    var helper = tr.clone();
                    helper.children().each(function(index) {
                        $(this).width(originals.eq(index).width());
                    });
                    helper.css({
                        "background": "#eef6ff",
                        "box-shadow": "0 4px 12px rgba(0,0,0,0.15)"
                    });
                    return helper;
                },

                start: function(e, ui) {
                    ui.item.addClass("drag-active");
                },

                stop: function(e, ui) {
                    ui.item.removeClass("drag-active");
                },

                update: function() {
                    let newOrder = [];

                    $(".sortable-pejabat tr").each(function(index) {
                        let id = $(this).data("id");
                        if (id) {
                            newOrder.push({
                                id: id,
                                prioritas: index + 1
                            });
                        }
                    });

                    $.ajax({
                        url: "<?= base_url('/rakorbangwil/update_prioritas_pejabat') ?>",
                        type: "POST",
                        data: {
                            order: newOrder
                        },
                        success: function() {
                            console.log("Prioritas updated");
                        }
                    });
                }
            });
        }
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

        .drag-handle {
            cursor: grab;
            font-size: 18px;
            color: #6c757d;
        }

        .drag-handle:active {
            cursor: grabbing;
        }

        .drag-handle i {
            pointer-events: none;
        }
    </style>