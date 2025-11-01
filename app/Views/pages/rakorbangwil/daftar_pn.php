<style>
    .badge-success {
        background-color: #00b37d !important;
        color: #fff;
        font-size: 0.85rem;
        padding: 6px 10px;
        border-radius: 12px;
        margin: 2px 4px;
        display: inline-block;
    }

    .table td {
        vertical-align: top;
    }

    .badge:hover {
        opacity: 0.9;
        transform: scale(1.05);
        transition: all 0.2s ease-in-out;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <!-- <h4 class="card-title">Program Jangka Menengah</h4> -->
                <h4 class="card-title">Data Pra Rakorbangwil</h4>
            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <div class="container mt-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>Prioritas Nasional </th>
                                        <th>Kementerian / Lembaga Terkait</th>
                                        <th>Tahun</th>
                                        <th>Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $a = 1;
                                    foreach ($dataPn as $pn): ?>
                                        <tr>
                                            <td><?= $a++; ?></td>
                                            <td>
                                                <strong><?= esc($pn['nama_pn']) ?></strong>
                                            </td>
                                            <td>
                                                <?php if (!empty($klByPn[$pn['id_pn']])): ?>
                                                    <?php foreach ($klByPn[$pn['id_pn']] as $kl): ?>
                                                        <span class="badge badge-success me-1"><?= esc($kl) ?></span>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <em class="text-muted">Belum ada data KL</em>
                                                <?php endif; ?>
                                            </td>
                                            <td>2026</td>
                                            <td>
                                                <?php if ($can_view): ?>
                                                    <button class="btn btn-info btn-sm btn-view" data-id="<?= $pn['id_pn'] ?>" title="Lihat">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                <?php endif; ?>

                                                <!-- <?php if ($can_edit): ?>
                                                    <button class="btn btn-warning btn-sm btn-edit" data-id="<?= $pn['id_pn'] ?>" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                <?php endif; ?> -->

                                                <!-- <?php if ($can_delete): ?>
                                                    <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<?= $pn['id_pn'] ?>" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                <?php endif; ?> -->
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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
                url: '<?= base_url('/rakorbangwil/get_daftar_program_tahunan') ?>', // URL untuk memproses filter
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
        let id = $(this).data('id'); // ambil id_memo
        let row = $(this).closest('tr'); // baris tabel yang diklik

        if (!confirm('Yakin ingin menghapus data ini?')) {
            return;
        }

        $.ajax({
            url: '<?= base_url('rakorbangwil/delete') ?>/' + id,
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
                    text: 'Data Prioritas Nasional berhasil dihapus.',
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
            // 🔹 Buka halaman detail di tab baru
            window.open("<?= base_url('rakorbangwil/view_pn') ?>/" + id, '_blank');
        });
    });



    // ====== EDIT ======
    $(document).on('click', '.btn-edit', function() {
        let id = $(this).data('id');
        $('#memoModalLabel').text('Edit Prioritas Nasional');
        $('#memoModal .modal-body').html('<div class="text-center p-3"><div class="spinner-border"></div></div>');
        $('#memoModal').modal('show');

        $.get("<?= base_url('rakorbangwil/edit_pn') ?>/" + id, function(data) {
            $('#memoModal .modal-body').html(data);
        });
    });

    // ====== UPDATE ======
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
            url: "<?= base_url('rakorbangwil/update') ?>/" + id,
            type: "POST",
            data: form.serialize(),
            success: function(res) {
                if (res.status) {
                    $('#memoModal').modal('hide');

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data Prioritas Nasional berhasil diperbarui.',
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
</script>

<?= $this->endSection() ?>