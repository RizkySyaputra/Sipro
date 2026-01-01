<style>
    .tabs-wrapper {
        overflow-x: auto;
        overflow-y: hidden;
        white-space: nowrap;
    }

    .btn-loading {
        pointer-events: none;
        opacity: 0.85;
    }

    .tabs-wrapper::-webkit-scrollbar {
        height: 6px;
    }

    .tabs-wrapper::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }

    .tabs-wrapper::-webkit-scrollbar-track {
        background: transparent;
    }

    .nav-tabs {
        flex-wrap: nowrap !important;
    }

    .nav-tabs .nav-item {
        flex: 0 0 auto;
    }

    .nav-tabs .nav-link {
        white-space: nowrap;
        padding: 10px 16px;
        font-size: 0.9rem;
    }

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
                                Berita Acara Kesepakatan Unor
                            </strong><br>
                        </div>
                    </div>
                    <div class="tab-content mt-3 p-3 border rounded bg-white">

                        <!-- END TAB Diakomodasi -->
                        <!-- DATATABLE -->
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="table-responsive">

                                    <div class="mb-3 text-right">
                                        <?php if ($can_edit == true) : ?>
                                            <button id="btn-add-kl" class="btn btn-primary">
                                                <i class="fa fa-plus"></i> Tambah K / L
                                            </button>
                                        <?php endif ?>

                                        <button id="btn-generate-bak" class="btn btn-success">
                                            <i class="fa fa-file-alt"></i> Generate Berita Acara
                                        </button>
                                    </div>

                                    <table id="table-pejabat-bak" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th width="40"></th>
                                                <th>Kementerian / Lembaga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="sortable-kl">
                                            <?php
                                            foreach ($kl as $data): ?>
                                                <tr data-id="<?= $data->id ?>">
                                                    <td class="drag-handle">
                                                        <i class="fa fa-bars"></i>
                                                    </td>
                                                    <td><?= $data->nama_kl ?></td>
                                                    <td style="width:20%">
                                                        <?php if ($can_view): ?>
                                                            <button class="btn btn-info btn-sm btn-view-pejabat"
                                                                data-id-kl="<?= $data->id_kl ?>"
                                                                data-nama-kl="<?= $data->nama_kl ?>">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        <?php endif ?>

                                                        <?php if ($can_edit): ?>
                                                            <button class="btn btn-warning btn-sm btn-edit-pejabat"
                                                                data-id-kl="<?= $data->id_kl ?>"
                                                                data-nama-kl="<?= $data->nama_kl ?>">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        <?php endif ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>

                                    </table>

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

    <div class="modal fade" id="modalViewPejabat" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        Daftar Pejabat – <span id="viewNamaKL"></span>
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th width="40">No</th>
                                <th>Nama Pejabat</th>
                                <th>Jabatan</th>
                            </tr>
                        </thead>
                        <tbody id="viewPejabatBody">
                            <tr>
                                <td colspan="3" class="text-center text-muted">Memuat data...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditPejabat" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        Kelola Pejabat – <span id="editNamaKL"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <!-- FORM TAMBAH -->
                    <form id="formTambahPejabat" class="mb-3">
                        <input type="hidden" name="id_kl" id="edit_id_kl">

                        <div class="form-row">
                            <div class="col-md-9">
                                <select style="width: 100%;" name="id_pejabat" class="form-control" id="select-pejabat" required>
                                    <option value="">Pilih Pejabat</option>
                                    <?php foreach ($pejabat as $p): ?>
                                        <option value="<?= $p['id_pejabat'] ?>">
                                            <?= $p['nama_pejabat'] ?> – <?= $p['jabatan'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary" id="btnSubmitPejabat">
                                    <span class="btn-text">Tambah</span>
                                    <span class="spinner-border spinner-border-sm d-none"
                                        id="spinnerPejabat"></span>
                                </button>

                            </div>
                        </div>
                    </form>

                    <!-- LIST PEJABAT -->
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="40"></th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th width="60">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="editPejabatBody" class="sortable-pejabat">
                            <tr>
                                <td colspan="4" class="text-center text-muted">Memuat data...</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modalAddKL" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form id="formTambahKL">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kementerian / Lembaga</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kementerian / Lembaga</label>
                            <select style="width: 100%;" class="form-control" name="id_kl" id="select-kl" required>
                                <option value="">-- Pilih K / L --</option>
                                <?php foreach ($KL as $row): ?>
                                    <option value="<?= $row['id_kl'] ?>">
                                        <?= $row['nama_kl'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary" id="btnSubmitKL">
                            <span class="btn-text">Tambah</span>
                            <span class="spinner-border spinner-border-sm d-none"
                                id="spinnerKL" role="status" aria-hidden="true"></span>
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>

    <form id="form-generate-bak" action="<?= base_url('rakorbangwil/create_berita_acara_unor') ?>" method="POST" style="display:none;" target="_blank">
        <input type="hidden" name="tanggal" id="post-tanggal">
    </form>

    <script>
        window.currentCatatanData = <?= json_encode(json_decode($catatan_pn->catatan_pra_rakorbangwil ?? '[]')) ?>;
    </script>
    <script>
        const canDelete = <?= $can_delete ? 'true' : 'false' ?>;
    </script>

    <script>
        $(document).ready(function() {
            enableSortableKL();
        });

        function enableSortableKL() {

            const $el = $("#sortable-kl");

            if ($el.data("ui-sortable")) {
                $el.sortable("destroy");
            }

            $el.sortable({
                handle: ".drag-handle",
                axis: "y",
                opacity: 0.85,
                revert: 150,

                update: function() {

                    let order = [];

                    $('#sortable-kl tr').each(function(index) {
                        const id = $(this).data('id');

                        if (id) {
                            order.push({
                                id: id,
                                prioritas: index + 1
                            });
                        }
                    });

                    $.ajax({
                        url: "<?= base_url('rakorbangwil/update_prioritas_kl') ?>",
                        type: "POST",
                        dataType: "json",
                        data: {
                            order
                        },
                        success: function(res) {
                            console.log('Prioritas K/L updated');
                        }
                    });
                }
            });
        }


        //tambah kl
        $(document).ready(function() {
            $('#btn-add-kl').on('click', function() {
                $('#modalAddKL').modal('show');
            });
        });

        $('#formTambahKL').on('submit', function(e) {
            e.preventDefault();

            const $btn = $('#btnSubmitKL');
            const $spinner = $('#spinnerKL');
            const $text = $btn.find('.btn-text');

            // ON LOADING
            $btn.addClass('btn-loading').prop('disabled', true);
            $spinner.removeClass('d-none');
            $text.text('Menyimpan...');

            $.ajax({
                url: "<?= base_url('rakorbangwil/add_kl_bak') ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json"
            }).done(function(res) {

                if (res.status === 'success') {
                    Swal.fire('Berhasil', res.message, 'success');
                    $('#modalAddKL').modal('hide');
                    location.reload();
                } else {
                    Swal.fire('Gagal', res.message, 'warning');
                }

            }).fail(function() {
                Swal.fire('Error', 'Terjadi kesalahan server', 'error');
            }).always(function() {

                // OFF LOADING
                $btn.removeClass('btn-loading').prop('disabled', false);
                $spinner.addClass('d-none');
                $text.text('Tambah');
            });
        });


        //view Pejabat

        $(document).on('click', '.btn-view-pejabat', function() {
            let id_kl = $(this).data('id-kl');
            let nama = $(this).data('nama-kl');

            $('#viewNamaKL').text(nama);
            $('#viewPejabatBody').html('<tr><td colspan="3" class="text-center">Loading...</td></tr>');
            $('#modalViewPejabat').modal('show');

            $.post("<?= base_url('rakorbangwil/get_pejabat_by_kl') ?>", {
                id_kl
            }, function(res) {
                let html = '';
                res.forEach((row, i) => {
                    html += `
                <tr>
                    <td>${i+1}</td>
                    <td>${row.nama_pejabat}</td>
                    <td>${row.jabatan}</td>
                </tr>`;
                });
                $('#viewPejabatBody').html(html);
            }, 'json');
        });
        $(document).on('click', '.btn-edit-pejabat', function() {
            let id_kl = $(this).data('id-kl');
            let nama = $(this).data('nama-kl');

            $('#edit_id_kl').val(id_kl);
            $('#editNamaKL').text(nama);
            loadEditPejabat(id_kl);

            $('#modalEditPejabat').modal('show');
        });
        //Edit Pejabat
        function loadEditPejabat(id_kl) {
            $('#editPejabatBody').html(`
        <tr>
            <td colspan="4" class="text-center">
                <div class="spinner-border text-primary"></div>
                <div class="mt-2 text-muted">Memuat data...</div>
            </td>
        </tr>
    `);

            $.post("<?= base_url('rakorbangwil/get_pejabat_by_kl') ?>", {
                id_kl
            }, function(res) {
                let html = '';
                res.forEach(row => {
                    html += `
            <tr data-id="${row.id}">
                <td class="drag-handle"><i class="fa fa-bars"></i></td>
                <td>${row.nama_pejabat}</td>
                <td>${row.jabatan}</td>
                <td class="text-center">
                    <button class="btn btn-danger btn-sm btn-hapus-pejabat" data-id="${row.id}">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>`;
                });

                $('#editPejabatBody').html(html);
                enableSortable();
            }, 'json');
        }
        //Hapus Pejabat
        $(document).on('click', '.btn-hapus-pejabat', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Hapus pejabat?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus'
            }).then(res => {
                if (res.isConfirmed) {
                    $.post("<?= base_url('rakorbangwil/delete_pejabat_bak_unor') ?>", {
                        id
                    }, function() {
                        loadEditPejabat($('#edit_id_kl').val());
                    });
                }
            });
        });
        $('#formTambahPejabat').on('submit', function(e) {
            e.preventDefault();

            const $btn = $('#btnSubmitPejabat');
            const $spinner = $('#spinnerPejabat');
            const $text = $btn.find('.btn-text');

            // ON LOADING
            $btn.addClass('btn-loading').prop('disabled', true);
            $spinner.removeClass('d-none');
            $text.text('Menyimpan...');

            $.ajax({
                url: "<?= base_url('rakorbangwil/add_pejabat_bak') ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json"
            }).done(function(res) {

                if (res.status === 'success') {
                    Swal.fire('Berhasil', res.message, 'success');
                    loadEditPejabat($('#edit_id_kl').val());
                    $('#formTambahPejabat')[0].reset();
                } else {
                    Swal.fire('Gagal', res.message, 'warning');
                }

            }).fail(function() {
                Swal.fire('Error', 'Terjadi kesalahan server', 'error');
            }).always(function() {

                // OFF LOADING
                $btn.removeClass('btn-loading').prop('disabled', false);
                $spinner.addClass('d-none');
                $text.text('Tambah');
            });
        });

        $(document).ready(function() {
            $('#select-pejabat, #select-kl').select2();
            // Klik tombol generate BAK
            $('#btn-generate-bak').on('click', function() {

                $('#modalTanggalBAK').modal('show');
            });

            // Submit tanggal
            $('#btn-submit-tanggal-bak').on('click', function() {
                let tanggal = $('#tanggal-bak').val();
                // Isi hidden form
                $('#post-tanggal').val(tanggal);

                // Submit form ke controller
                $('#form-generate-bak').submit();
            });

            // Buka modal tambah pejabat
            $('#btn-add-pejabat').on('click', function() {

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

        // ===================================================
        // Fitur Drag & Drop Urutan Pejabat Penandatangan BAK
        // ===================================================
        function enableSortable() {

            const $el = $("#editPejabatBody");

            if ($el.data("ui-sortable")) {
                $el.sortable("destroy");
            }

            $el.sortable({
                handle: ".drag-handle",
                axis: "y",
                opacity: 0.8,

                update: function() {
                    let newOrder = [];

                    $('#editPejabatBody tr').each(function(index) {
                        const id = $(this).data('id');

                        if (id) {
                            newOrder.push({
                                id: id,
                                prioritas: index + 1
                            });
                        }
                    });

                    $.ajax({
                        url: "<?= base_url('/rakorbangwil/update_prioritas_pejabat_unor') ?>",
                        type: "POST",
                        data: {
                            order: newOrder
                        },
                        dataType: "json",
                        success: function(res) {
                            console.log(res);
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