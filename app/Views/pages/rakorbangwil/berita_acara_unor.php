<style>
    .tabs-wrapper {
        overflow-x: auto;
        overflow-y: hidden;
        white-space: nowrap;
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
                                            <button id="btn-add-pejabat" class="btn btn-primary">
                                                <i class="fa fa-plus"></i> Tambah Pejabat
                                            </button>
                                        <?php endif ?>
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