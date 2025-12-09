<style>
    .badge-green {
        background: #00d084;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 4px;
    }

    .badge-oranye {
        background: #f49c31ff;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 4px;
    }

    .badge-blue {
        background: #007bff;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 4px;
    }

    .badge-grey {
        background: #606060ff;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 4px;
    }

    /* --- FILTER AREA --- */
    .filter-group .form-group {
        margin-bottom: 15px;
    }

    .filter-label {
        font-weight: 600;
        color: #444;
        margin-bottom: 4px;
    }

    /* Make the tab look modern */
    .nav-tabs .nav-link.active {
        background-color: #00b37d !important;
        color: #fff !important;
        border: none;
        font-weight: 600;
    }

    .nav-tabs .nav-link {
        background: #d7d7d7 !important;
        color: #fff !important;
        font-weight: 500;
        border: none;
    }

    .nav-tabs .nav-link:hover {
        background: #bbb !important;
        color: #fff !important;
    }

    /* Program Header */
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

    /* Catatan style */
    .catatan-item {
        background-color: #f8f9fa;
        border-left: 4px solid #0d6efd;
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

                    <!-- HEADER PN -->
                    <div class="pn-header mb-4">
                        <div class="pn-number"><?= esc($pn['id_pn'] ?? '-') ?></div>
                        <div class="pn-text">
                            <strong style="font-weight: 900; color: #00b37d; font-size: 1.2rem;">
                                Prioritas Nasional <?= esc($pn['id_pn'] ?? '-') ?>
                            </strong><br>
                            <?= esc($pn['nama_pn'] ?? 'Deskripsi belum tersedia') ?>
                        </div>
                    </div>

                    <!-- TABS -->
                    <ul class="nav nav-tabs" id="pnTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link " data-toggle="tab" href="#kawasan" role="tab">Kawasan Prioritas <?= session('tahun_pelaksana'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#program" role="tab">Program/Pekerjaan <?= session('tahun_pelaksana'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#usulan" role="tab">Usulan Program</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#catatan" role="tab">Catatan Pra Rakorbangwil</a>
                        </li>
                    </ul>

                    <!-- TAB CONTENT -->
                    <div class="tab-content mt-3 p-3 border rounded bg-white">
                        <!-- TAB KAWASAN -->
                        <div class="tab-pane fade" id="kawasan">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div>
                                        <table id="datatables_kawasan" class="table table-striped table-hover" width="100%">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center;">No</th>
                                                    <th style="text-align: center;">Provinsi</th>
                                                    <th style="text-align: center;">Kawasan</th>
                                                    <th style="text-align: center;">Jumlah Pekerjaan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $a = 1;
                                                foreach ($rekap_program_kawasan as $data) : ?>
                                                    <tr>
                                                        <td><?= $a++; ?></td>
                                                        <td><?= $data['provinsi'] ?></td>
                                                        <td style="width: 40%;"><?= $data['kawasan'] ?></td>
                                                        <td style="text-align: center;"><?= $data['jumlah_pekerjaan'] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- CATATAN -->
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h6><strong>Catatan Kawasan Prioritas</strong></h6>

                                    <form id="formCatatanKawasan">
                                        <textarea name="catatan_kawasan" class="form-control" rows="4"
                                            placeholder="Tambahkan catatan keseluruhan terkait kawasan..."><?= esc($catatan_kws->catatan_kws_desk_rakorbangwil ?? '') ?></textarea>
                                        <input type="text" name="id_pn" value="<?= esc($pn['id_pn'] ?? '-') ?>" hidden>
                                        <button type="submit" id="btnSaveCatatan" class="btn btn-success mt-3">
                                            <span id="textSave">Simpan Catatan</span>
                                            <span id="spinnerSave" class="spinner-border spinner-border-sm ml-2" style="display:none;"></span>
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- ================= TAB PROGRAM ================= -->
                        <div class="tab-pane fade show active" id="program" role="tabpanel">

                            <div class="card shadow-sm mb-3">
                                <div class="card-body">

                                    <form id="filter-form">

                                        <div class="row filter-group">
                                            <input type="text" value="<?= $pn['id_pn']  ?>" name="id_pn" hidden>

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
                                            <!-- CATATAN RAKORBANGWIL -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="filter-label">Catatan Pra Rakorbangwil</label>
                                                    <select class="form-control" name="catatan_rakorbangwil" id="filter-catatan_rakorbangwil">
                                                        <option value="">Semua Catatan</option>
                                                        <option value="ya">Ya</option>
                                                        <option value="tidak">Tidak</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- UNOR -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="filter-label">Unor</label>
                                                    <select class="form-control" name="unor" id="filter-unor">
                                                        <option value="">Semua Unor</option>
                                                        <?php foreach ($unor as $u): ?>
                                                            <option value="<?= $u->id ?>"><?= $u->unor ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- KONFIRMASI PEMDA -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="filter-label">Catatan Konfirmasi Pemda</label>
                                                    <select class="form-control" name="konfirmasi_pemda" id="filter-konfirmasi_pemda">
                                                        <option value="">Semua Konfirmasi</option>
                                                        <option value="ya">Ya</option>
                                                        <option value="tidak">Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Pendanaan -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="filter-label">Sumber Pendanaan</label>
                                                    <select class="form-control" name="pendanaan[]" id="filter-pendanaan" multiple="multiple">
                                                        <option value="" selected disabled>Semua Sumber Pendanaan</option>
                                                        <?php foreach ($pendanaan as $item): ?>
                                                            <option value="<?= esc($item['id_pendanaan']) ?>">
                                                                <?= esc($item['sumber_pendanaan']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- CATATAN PEMDA -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="filter-label">Catatan Pemda</label>
                                                    <select class="form-control" name="catatan_pemda" id="filter-catatan_pemda">
                                                        <option value="">Semua Catatan</option>
                                                        <option value="ya">Ya</option>
                                                        <option value="tidak">Tidak</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <!-- TIPE -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="filter-label">Tipe Pekerjaan</label>
                                                    <select class="form-control" name="tipe" id="filter-tipe">
                                                        <option value="">Semua Tipe</option>
                                                        <option value="FISIK">Fisik</option>
                                                        <option value="NON FISIK">Non Fisik</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <!-- SUMBER -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="filter-label">Sumber</label>
                                                    <select class="form-control" name="sumber" id="filter-sumber">
                                                        <option value="">Semua Sumber</option>
                                                        <option value="rpiw">RPIW</option>
                                                        <option value="non_rpiw">NON RPIW</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- KESEPAKATAN -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="filter-label">Kesepakatan</label>
                                                    <select class="form-control" name="kesepakatan" id="filter-kesepakatan">
                                                        <option value="">Semua Kesepakatan</option>
                                                        <?php foreach ($kesepakatan as $item): ?>
                                                            <option value="<?= esc($item['id_kesepakatan']) ?>">
                                                                <?= esc($item['kesepakatan']) ?>
                                                            </option>
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
                            </div>

                            <!-- DATATABLE -->
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatables" class="table table-striped table-hover" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Provinsi</th>
                                                    <th>Unor</th>
                                                    <th>Pekerjaan</th>
                                                    <th>Kawasan</th>
                                                    <th>Tematik Kawasan</th>
                                                    <th>Status Catatan</th>
                                                    <th>Kesepakatan</th>
                                                    <th style="text-align: center;">Aksi</th>
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


                        <!-- ================= TAB USULAN ================= -->
                        <div class="tab-pane fade" id="usulan" role="tabpanel">
                            <strong>Usulan Program/Kegiatan</strong>
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatables_usulan" class="table table-striped table-hover" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>K/L Pnegusul</th>
                                                    <th>Provinsi</th>
                                                    <th>Pekerjaan</th>
                                                    <th>Unor</th>
                                                    <th>Justifikasi</th>
                                                    <th>Reviu BPIW</th>
                                                    <th>Status Pekerjaan</th>
                                                    <th>Kebutuhan Dukungan Pemda</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $a = 1;
                                                foreach ($daftar_program_tahunan_usulan as $data) : ?>
                                                    <tr>
                                                        <td><?= $a++; ?></td>
                                                        <td><?= $data->kl_pengusul ?></td>
                                                        <td><?= $data->provinsi ?></td>
                                                        <td><?= $data->pekerjaan ?></td>
                                                        <td><?= $data->unor ?></td>
                                                        <td><?= nl2br($data->justifikasi) ?></td>
                                                        <td><?= nl2br($data->reviu_bpiw) ?></td>
                                                        <td><?= $data->status_pekerjaan ?></td>
                                                        <td><?= nl2br($data->kebutuhan_dukungan_pemda)  ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ================= TAB CATATAN ================= -->
                        <div class="tab-pane fade" id="catatan" role="tabpanel">

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <label><strong>Catatan Pra Rakorbangwil</strong></label>
                            </div>

                            <div id="catatanDisplay">
                                <?php if (!empty($catatan_pn->catatan_pra_rakorbangwil)): ?>
                                    <?php $list = json_decode($catatan_pn->catatan_pra_rakorbangwil, true); ?>
                                    <?php foreach ($list as $item): ?>
                                        <div class="catatan-item">
                                            <div class="catatan-nama"><?= esc($item['nama']) ?>:</div>
                                            <p class="catatan-text"><?= esc($item['catatan']) ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-muted">Tidak ada catatan.</div>
                                <?php endif; ?>
                            </div>

                        </div>
                        <!-- END TAB CATATAN -->

                    </div><!-- END TAB CONTENT -->

                </div> <!-- END container -->

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    window.currentCatatanData = <?= json_encode(json_decode($catatan_pn->catatan_pra_rakorbangwil ?? '[]')) ?>;
</script>

<script>
    $(document).ready(function() {

        // Inisialisasi Select2 untuk semua dropdown
        $('#filter-unor, #filter-provinsi, #filter-tipe, #filter-catatan_rakorbangwil, #filter-catatan_pemda, #filter-konfirmasi_pemda, #filter-kesepakatan, #filter-sumber, #filter-pendanaan').select2();

        // Restore value dari localStorage
        $('#filter-unor').val(localStorage.getItem('selectedUnor')).trigger('change');
        $('#filter-provinsi').val(localStorage.getItem('selectedProvinsi')).trigger('change');
        $('#filter-tipe').val(localStorage.getItem('selectedTipe')).trigger('change');
        $('#filter-catatan_rakorbangwil').val(localStorage.getItem('selectedRakorbangwil')).trigger('change');
        $('#filter-catatan_pemda').val(localStorage.getItem('selectedCatatanPemda')).trigger('change');
        $('#filter-konfirmasi_pemda').val(localStorage.getItem('selectedKonfirmasiPemda')).trigger('change');
        $('#filter-kesepakatan').val(localStorage.getItem('selectedKesepakatan')).trigger('change');
        $('#filter-sumber').val(localStorage.getItem('selectedSumber')).trigger('change');
        $('#filter-pendanaan').val(localStorage.getItem('selectedPendanaan')).trigger('change');


        // Submit filter (pakai ajax)
        $('#filter-form').on('submit', function(event) {
            event.preventDefault();

            // Simpan setiap filter ke localStorage
            localStorage.setItem('selectedUnor', $('#filter-unor').val());
            localStorage.setItem('selectedProvinsi', $('#filter-provinsi').val());
            localStorage.setItem('selectedTipe', $('#filter-tipe').val());
            localStorage.setItem('selectedRakorbangwil', $('#filter-catatan_rakorbangwil').val());
            localStorage.setItem('selectedCatatanPemda', $('#filter-catatan_pemda').val());
            localStorage.setItem('selectedKonfirmasiPemda', $('#filter-konfirmasi_pemda').val());
            localStorage.setItem('selectedKesepakatan', $('#filter-kesepakatan').val());
            localStorage.setItem('selectedSumber', $('#filter-sumber').val());
            localStorage.setItem('selectedPendanaan', $('#filter-pendanaan').val());

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
        $('#datatables_kawasan').DataTable({
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

        // Reset filter
        $('#reset-filters').on('click', function() {

            // Reset semua dropdown
            $('#filter-unor, #filter-provinsi, #filter-tipe, #filter-catatan_rakorbangwil, #filter-catatan_pemda, #filter-konfirmasi_pemda, #filter-kesepakatan, #filter-sumber, #filter-pendanaan')
                .val('')
                .trigger('change');

            // Hapus localStorage
            localStorage.removeItem('selectedUnor');
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
    $('#formCatatanKawasan').on('submit', function(e) {
        e.preventDefault();

        let btn = $('#btnSaveCatatan');

        // MUNCULKAN LOADING
        $('#textSave').hide();
        $('#spinnerSave').show();
        btn.prop('disabled', true);

        $.ajax({
            url: "<?= base_url('rakorbangwil/save_catatan_kawasan') ?>",
            type: "POST",
            data: $(this).serialize(),
            success: function(res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Tersimpan!',
                    text: 'Catatan kawasan berhasil diperbarui.',
                    timer: 1800,
                    showConfirmButton: false
                });
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menyimpan catatan.'
                });
            },
            complete: function() {
                // KEMBALIKAN TOMBOL
                $('#textSave').show();
                $('#spinnerSave').hide();
                btn.prop('disabled', false);
            }
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