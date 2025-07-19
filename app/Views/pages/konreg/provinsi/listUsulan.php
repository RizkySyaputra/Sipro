<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title font-weight-bold"><strong>Program Usulan Pemerintah Daerah (Provinsi)</strong></h4>

            </div>
            <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
            <div class="container mt-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0 font-weight-bold"><strong>Filter</strong></h5>
                    </div>
                    <div class="card-body">
                        <form method="post" id="filter-form">
                            <div class="form-row align-items-center">
                                <!-- Dropdown Unor -->
                                <div class="col-md-2 mb-3">
                                    <label for="unor"><strong>Pilih Unor</strong></label>
                                    <select class="form-control" name="unor" id="filter-unor">
                                        <?php if (isset($unor['id']) && $unor['id'] != "00"): ?>
                                            <option value="<?= $unor['id'] ?>"><?= $unor['unor'] ?></option>
                                        <?php else : ?>
                                            <option value="" selected>Semua Unor</option>
                                            <?php foreach ($unor as $u): ?>
                                                <option value="<?= $u->id ?>"><?= $u->unor ?></option>
                                            <?php endforeach; ?>
                                        <?php endif ?>
                                    </select>
                                </div>

                                <!-- Dropdown Provinsi -->
                                <div class="col-md-2 mb-3">
                                    <label for="provinsi"><strong>Pilih Provinsi</strong></label>
                                    <select name="provinsi" class="form-control" id="filter-provinsi">
                                        <?php if (isset($provinsi['id'])): ?>
                                            <option value="<?= $provinsi['id'] ?>"><?= $provinsi['provinsi'] ?></option>
                                        <?php else : ?>
                                            <option value="">Semua Provinsi</option>

                                            <?php foreach ($provinsi as $item) : ?>
                                                <option value="<?= $item['id'] ?>"><?= $item['provinsi'] ?></option>
                                        <?php endforeach;
                                        endif; ?>
                                    </select>
                                </div>

                                <?php if ($desk == "konreg"): ?>
                                    <div class="col-md-2 mb-3">
                                        <label for="pradesk"><strong>Kesepakatan</strong></label>
                                        <select class="form-control" name="kesepakatan" id="filter-pradesk">
                                            <option value="">Semua Sumber</option>
                                            <option value="0">Belum dibahas</option>
                                            <option value="1">FKW</option>
                                            <option value="2">FKB</option>
                                            <option value="3">Ditangguhkan</option>
                                        </select>
                                    </div>
                                <?php endif ?>
                                <!-- Dropdown Kawasan
                                <div class="col-md-2 mb-3">
                                    <label for="pn"><strong>Pilih Program Nasional</strong></label>
                                    <select class="form-control" name="id_pn" id="filter-pn">
                                        <option value="">Semua PN</option>
                                        <?php foreach ($pn as $item): ?>
                                            <option value="<?= $item['id_pn'] ?>"><?= $item['id_pn'] . ". " . $item['nama_pn'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div> -->


                                <div class="col-md-2 ">
                                    <button type="button" id="reset-filters" class="btn btn-info">
                                        <i class="fa fa-undo"></i>
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i id="button-text" class="fa fa-search"></i>
                                        <span id="loading-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
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
                    <table id="datatables" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead class="thead-dark" style="text-align:center;">
                            <tr>
                                <th>#</th>
                                <th>Provinsi</th>
                                <th>KP</th>
                                <th>ProP</th>
                                <th>Kro</th>
                                <th>Ro</th>
                                <th>Nama pekerjaan </th>
                                <th>Volume </th>
                                <th>Anggaran (Rp Ribu)</th>
                                <th>Aksi </th>
                                <th>Catatan Unor </th>
                                <th>Kesepakatan </th>
                            </tr>
                        </thead>

                        <tfoot class="thead-dark" style="text-align: center;">
                            <tr>
                                <th>#</th>
                                <th>Provinsi</th>
                                <th>KP</th>
                                <th>ProP</th>
                                <th>Kro</th>
                                <th>Ro</th>
                                <th>Nama pekerjaan </th>
                                <th>Volume </th>
                                <th>Anggaran (Rp Ribu)</th>
                                <th>Aksi </th>
                                <th>Catatan Unor </th>
                                <th>Kesepakatan </th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($usulan as $usulan) : ?>
                                <tr id="row-<?= $usulan->id_usulan ?>">
                                    <td><?= $no++; ?></td>
                                    <td><?= $usulan->provinsi ?></td>
                                    <td><?= $usulan->nama_kp ?></td>
                                    <td><?= $usulan->nama_prop ?></td>
                                    <td><?= $usulan->nmkro ?></td>
                                    <td><?= $usulan->nmro ?></td>
                                    <td><?= $usulan->nama_pekerjaan ?></td>
                                    <td><?= $usulan->volume . " " . $usulan->nama_satuan ?></td>
                                    <td><?php $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                                        echo $format->formatCurrency($usulan->anggaran, 'IDR'); ?></td>
                                    <td>
                                        <?php if (isset(user()->id_unor)): ?>
                                            <a target="_blank" href="<?= base_url('detailusulan/' . $usulan->id_usulan) ?>" class="btn btn-info btn-sm" title="Reviu">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        <?php else : ?>
                                            <a target="_blank" href="<?= base_url('detailusulan/' . $usulan->id_usulan) ?>" class="btn btn-info btn-sm" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        <?php endif ?>
                                        <?php if (
                                            !isset(user()->id_unor) && (is_null(user()->id_provinsi) &&  (!in_groups('Staff')))
                                        ): ?>
                                            <a target="_blank" href="<?= base_url($desk == "konreg" ? "editusulan/$usulan->id_usulan?desk=konreg" : "editusulan/$usulan->id_usulan") ?>" class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm" title="Hapus"
                                                data-toggle="modal" data-target="#confirmDeleteModal"
                                                data-id="<?= $usulan->id_usulan ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= ($usulan->catatan_unor != "") ? $usulan->catatan_unor : "Belum ditinjau"; ?></td>
                                    <td align="center">
                                        <?php
                                        if ($usulan->kesepakatan == 0) {
                                            echo '<span class="badge badge-pill badge-secondary">Belum Dibahas</span>';
                                        } elseif ($usulan->kesepakatan == 1) {
                                            echo '<span class="badge badge-pill badge-primary">FKW</span>';
                                        } elseif ($usulan->kesepakatan == 2) {
                                            echo '<span class="badge badge-pill badge-success">FKB</span>';
                                        } elseif ($usulan->kesepakatan == 3) {
                                            echo '<span class="badge badge-pill badge-warning">Ditangguhkan</span>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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
<!-- end row -->
</div>
</div>


<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" id="deleteForm">
            <!-- Tambahkan ini jika kamu pakai CSRF di CI4 -->
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#deleteForm').on('submit', function(e) {
            event.preventDefault(); // Mencegah reload form

            var form = $(this);
            var actionUrl = form.attr('action');

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    $('#confirmDeleteModal').modal('hide');

                    // Tampilkan alert sukses (opsional)
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil dihapus!',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // Reload data tabel (panggil ulang filter)
                    $('#filter-form').trigger('submit');
                },
                error: function(xhr, status, error) {
                    $('#confirmDeleteModal').modal('hide');
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menghapus data.',
                    });
                }
            });
        });

        $('#confirmDeleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang ditekan
            var id = button.data('id'); // Ambil ID dari data-id
            var form = $('#deleteForm');

            // Ganti action URL form berdasarkan ID
            form.attr('action', '<?= base_url('deleteusulan/') ?>' + id);
        });


        var defaultProvinsi = "<?= user()->id_provinsi; ?>";
        var defaultUnor = "<?= 0 . user()->id_unor; ?>";
        // Kalau default tersedia dan localStorage belum menyimpan apa-apa
        if (defaultProvinsi && !localStorage.getItem('selectedProvinsi')) {
            $('#filter-provinsi').val(defaultProvinsi);
            localStorage.setItem('selectedProvinsi', defaultProvinsi);

        }
        // if (defaultUnor && !localStorage.getItem('selectedUnor')) {
        //     $('#filter-unor').val(defaultUnor);
        //     localStorage.setItem('selectedUnor', defaultUnor);
        // }
        // Inisialisasi Select2 untuk semua dropdown
        $('#filter-unor, #filter-provinsi, #filter-pn, #filter-pradesk').select2();
        // Restore values from local storage
        $('#filter-unor').val(localStorage.getItem('selectedUnor'));
        $('#filter-provinsi').val(localStorage.getItem('selectedProvinsi'));
        $('#filter-pn').val(localStorage.getItem('selectedpn'));

        // On form submit, save the selected values
        $('#filter-form').on('submit', function() {
            event.preventDefault();

            $('#loading-spinner').show();
            $('#button-text').hide();
            // Ambil data filter dari form
            var filterData = $(this).serialize();
            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url($desk == "konreg" ? "/usulanProvinsi/filter_data?desk=konreg" : "/usulanProvinsi/filter_data") ?>', // URL untuk memproses filter
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
            // $('#filter-provinsi').val('').trigger('change');
            $('#filter-kawasan').val('').trigger('change');
            $('#filter-residu').val('').trigger('change');
            $('#filter-tahun_anggaran').val('').trigger('change');

            // Optionally clear the table data
            //$('#datatables tbody').empty();

            // Optionally, you could also clear the local storage if needed
            localStorage.removeItem('selectedUnor');
            // localStorage.removeItem('selectedProvinsi');
            localStorage.removeItem('selectedKawasan');
            localStorage.removeItem('selectedResidu');
            localStorage.removeItem('selectedTahun');
        });
    });
</script>