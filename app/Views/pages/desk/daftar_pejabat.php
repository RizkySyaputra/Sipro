<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <!-- <h4 class="card-title">Program Jangka Menengah</h4> -->
                <h4 class="card-title">Daftar Pejabat</h4>
            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <div class="container mt-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="material-datatables">
                            <div class="d-flex justify-content-end mb-3 gap-2">
                                <button class="btn btn-primary btn-add">
                                    <i class="fas fa-plus"></i> Tambah Pejabat
                                </button>

                                <button class="btn btn-secondary btn-refresh">
                                    <i class="fas fa-sync-alt"></i> Refresh
                                </button>
                            </div>

                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pejabat</th>
                                        <th>Jabatan</th>
                                        <th>Unit Kerja</th>
                                        <th>Unit Organisasi</th>
                                        <th>Instansi</th>
                                        <th style="width:20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($pejabat) && count($pejabat) > 0): ?>
                                        <?php $no = 1; ?>
                                        <?php foreach ($pejabat as $row): ?>
                                            <tr>
                                                <td style="text-align: center;"><?= $no++; ?></td>
                                                <td><?= esc($row['nama_pejabat']); ?></td>
                                                <td><?= esc($row['jabatan']); ?></td>
                                                <td><?= esc($row['unit_kerja']); ?></td>
                                                <td><?= esc($row['unit_organisasi']); ?></td>
                                                <td><?= esc($row['instansi']); ?></td>
                                                <td>
                                                    <?php if ($can_view == true) : ?>
                                                        <button
                                                            class="btn btn-info btn-sm btn-view"
                                                            data-id="<?= $row['id_pejabat'] ?>"
                                                            title="Lihat">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    <?php endif ?>

                                                    <?php if ($can_edit == true) : ?>
                                                        <button
                                                            class="btn btn-warning btn-sm btn-edit"
                                                            data-id="<?= $row['id_pejabat'] ?>"
                                                            title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    <?php endif ?>
                                                    <?php if ($can_delete == true) : ?>
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm btn-delete"
                                                            data-id="<?= $row['id_pejabat'] ?>"
                                                            title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    <?php endif ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="10" class="text-center">Data tidak ditemukan</td>
                                        </tr>
                                    <?php endif; ?>
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
        let id = $(this).data('id'); // ambil id_memo
        let row = $(this).closest('tr'); // baris tabel yang diklik

        if (!confirm('Yakin ingin menghapus data ini?')) {
            return;
        }

        $.ajax({
            url: '<?= base_url('pejabat/delete') ?>/' + id,
            type: 'POST',
            data: {
                _method: 'DELETE',
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
                    text: 'Data pejabat berhasil dihapus.',
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
            $('#memoModalLabel').text('Detail Data Pejabat');
            $('#memoModal .modal-body').html('<div class="text-center p-3"><div class="spinner-border"></div></div>');
            $('#memoModal').modal('show');

            $.get("<?= base_url('pejabat/view') ?>/" + id, function(data) {
                $('#memoModal .modal-body').html(data);
            });
        });

        // ====== EDIT ======
        $(document).on('click', '.btn-edit', function() {
            let id = $(this).data('id');
            $('#memoModalLabel').text('Edit Data Pejabat');
            $('#memoModal .modal-body').html('<div class="text-center p-3"><div class="spinner-border"></div></div>');
            $('#memoModal').modal('show');

            $.get("<?= base_url('pejabat/edit') ?>/" + id, function(data) {
                $('#memoModal .modal-body').html(data);
            });
        });

        // ====== UPDATE ======
        $(document).on('submit', '#editMemoForm', function(e) {
            e.preventDefault();

            let form = $(this);
            let id = form.find('input[name="id_pejabat"]').val();

            const $btn = form.find('button[type="submit"]');
            const originalText = $btn.html();

            $btn.prop('disabled', true).html(`
        <span class="spinner-border spinner-border-sm me-2"></span> Menyimpan...
    `);

            let formData = new FormData(this); // <-- penting

            $.ajax({
                url: "<?= base_url('pejabat/update') ?>/" + id,
                type: "POST",
                data: formData,
                processData: false, // <-- penting
                contentType: false, // <-- penting
                success: function(res) {
                    if (res.status) {
                        $('#memoModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data Pejabat berhasil diperbarui.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#button-text').submit();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: res.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal menghubungi server'
                    });
                },
                complete: function() {
                    $btn.prop('disabled', false).html(originalText);
                }
            });
        });


    });

    // ====== ADD ======
    $(document).on('click', '.btn-add', function() {
        $('#memoModalLabel').text('Tambah Pejabat Baru');
        $('#memoModal .modal-body').html('<div class="text-center p-3"><div class="spinner-border"></div></div>');
        $('#memoModal').modal('show');

        $.get("<?= base_url('pejabat/add') ?>", function(data) {
            $('#memoModal .modal-body').html(data);
        });
    });

    // ====== REFRESH ======
    $(document).on('click', '.btn-refresh', function() {
        location.reload();
    });
</script>

<?= $this->endSection() ?>