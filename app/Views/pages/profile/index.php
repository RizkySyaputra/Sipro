<style>
    /* Warna abu-abu untuk field disabled */
    input:disabled,
    textarea:disabled,
    select:disabled {
        background-color: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
        border: 1px solid #d1d1d1 !important;
        /* tetap ada border halus */
    }

    /* Tambahkan border untuk semua input yang bisa diedit */
    input:not(:disabled),
    textarea:not(:disabled),
    select:not(:disabled) {
        border: 1px solid #000000ff !important;
        /* warna border biru */
        box-shadow: none !important;
        transition: border-color 0.2s ease-in-out;
    }

    /* Efek saat fokus (klik) */
    input:not(:disabled):focus,
    textarea:not(:disabled):focus,
    select:not(:disabled):focus {
        border-color: #000000ff !important;
        /* biru lebih gelap saat fokus */
        box-shadow: 0 0 3px rgba(0, 123, 255, 0.3);
        outline: none;
    }

    /* Agar field readonly tetap terlihat tapi tidak seperti editable */
    input[readonly],
    textarea[readonly] {
        background-color: #f8f9fa;
        border: 1px solid #ccc;
        color: #6c757d;
    }

    /* Style tambahan agar form tampak rapi */
    .form-control,
    .form-select {
        border-radius: 6px;
        padding: 6px 10px;
    }

    .catatan-item {
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
    }

    .catatan-text {
        text-align: justify;
        color: #333;
        margin: 0;
        white-space: pre-line;
    }

    /* Hilangkan ruang kosong (search box) di Select2 multiple yang tertutup */
    .select2-container--default .select2-search--inline .select2-search__field {
        width: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
        border: none !important;
    }

    /* Supaya tidak muncul input kosong di bawah pilihan */
    .select2-container--default .select2-selection--multiple {
        min-height: 10px;
        /* sesuaikan tinggi agar pas */
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }

    /* Sedikit perbaikan visual agar tampilan rapi */
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        margin-top: 4px;
        margin-bottom: 4px;
    }
</style>

<?php
// echo '<pre>';
// print_r($user['id']);

// echo user()->password_hash;
// echo '</pre>';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <!-- <h4 class="card-title">Program Jangka Menengah</h4> -->
                <h4 class="card-title">Data Profil Pengguna</h4>
            </div>
            <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
            <div class="container d-flex mt-4">
                <div class="card shadow-md">
                    <!-- <div class="card-header">
                        <h5 class="mb-0">Filter Data Memorandum</h5>
                    </div> -->
                    <div class="card-body">
                        <form method="post" action="<?= site_url('profile/update') ?>">
                            <div class="row mb-5 justify-content-center">
                                <img src="<?= base_url('assets/img/faces/profile-user.png') ?>" alt="Logo Man" width="100">
                            </div>
                            <div class="row justify-content-center mb-3">
                                <div class="col-md-2">
                                    <label for="kegiatan"><strong>Nama</strong></label>
                                </div>
                                <div class="col-md-1">
                                    <label><strong>:</strong></label>
                                </div>
                                <div class="col-md-2">
                                    <label for=""><strong><?= $user['user'] ?></strong></label>
                                </div>
                            </div>
                            <div class="row justify-content-center mb-3">
                                <div class="col-md-2">
                                    <label for="Email"><strong>Username</strong></label>
                                </div>
                                <div class="col-md-1">
                                    <label><strong>:</strong></label>
                                </div>
                                <div class="col-md-2">
                                    <label for=""><strong><?= $user['username'] ?></strong></label>
                                </div>
                            </div>
                            <div class="row justify-content-center mb-5">
                                <div class="col-md-2">
                                    <label for="Email"><strong>Email</strong></label>
                                </div>
                                <div class="col-md-1">
                                    <label><strong>:</strong></label>
                                </div>
                                <div class="col-md-2">
                                    <label for=""><strong><?= $user['email'] ?></strong></label>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="material-icons">edit</i> Ubah Profil
                                </button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="detailNomenklaturModal" tabindex="-1" role="dialog" aria-labelledby="detailNomenklaturModalTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="detailNomenklaturModalTitle">Nomenklatur Kegiatan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="form-row-block"></div>
                    <div class="modal-body" id="modalContent">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
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
<!-- end row -->
<!-- jQuery, Select2, dan Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->section('_script') ?>
<script>
    $(document).ready(function() {
        // ====== VIEW ======
        $(document).on('click', '.btn-view', function() {
            let id = $(this).data('id');
            $('#memoModalLabel').text('Detail Memorandum');
            $('#memoModal .modal-body').html('<div class="text-center p-3"><div class="spinner-border"></div></div>');
            $('#memoModal').modal('show');

            $.get("<?= base_url('memorandum/view') ?>/" + id, function(data) {
                $('#memoModal .modal-body').html(data);
            });
        });

        // ====== EDIT ======
        $(document).on('click', '.btn-edit', function() {
            let id = $(this).data('id');
            $('#memoModalLabel').text('Edit Memorandum');
            $('#memoModal .modal-body').html('<div class="text-center p-3"><div class="spinner-border"></div></div>');
            $('#memoModal').modal('show');

            $.get("<?= base_url('memorandum/edit') ?>/" + id, function(data) {
                $('#memoModal .modal-body').html(data);
            });
        });

        // ====== UPDATE ======
        $(document).on('submit', '#editMemoForm', function(e) {
            e.preventDefault();

            let form = $(this);
            let id = form.find('input[name="id_memorandum"]').val();

            // 🔹 Ambil tombol submit di dalam form
            const $btn = form.find('button[type="submit"]');
            const originalText = $btn.html(); // simpan teks asli tombol

            // 🔹 Ubah tombol jadi loading spinner & disable
            $btn.prop('disabled', true).html(`
        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
        Menyimpan...
    `);

            $.ajax({
                url: "<?= base_url('memorandum/update') ?>/" + id,
                type: "POST",
                data: form.serialize(),
                success: function(res) {
                    if (res.status) {
                        $('#memoModal').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data memorandum berhasil diperbarui.',
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

    // $.get("<?= base_url('memorandum/view') ?>/" + id, function(data) {
    //     console.log("Response:", data); // cek respon
    //     $('#memoModal .modal-body').html(data);
    // }).fail(function(xhr) {
    //     alert("Error " + xhr.status + ": " + xhr.responseText);
    // });
</script>

<?= $this->endSection() ?>