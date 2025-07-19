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
                <h4 class="card-title font-weight-bold"><strong>Rakortekrenbang</strong></h4>

            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <div class="container mt-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0 font-weight-bold"><strong>Filter</strong></h5>
                    </div>
                    <div class="card-body">
                        <form id="filter-form" ?>
                            <div class="form-row align-items-center">
                                <!-- Dropdown Unor -->
                                <div class="col-md-2 mb-3">
                                    <label for="unor"><strong>Pilih Unor</strong></label>
                                    <select class="form-control" name="unor" id="filter-unor">
                                        <option value="">Semua Unor</option>
                                        <?php foreach ($unor as $u): ?>
                                            <option value="<?= $u->id ?>"><?= $u->unor ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Dropdown Provinsi -->
                                <div class="col-md-2 mb-3">
                                    <label for="provinsi"><strong>Pilih Provinsi</strong></label>
                                    <select class="form-control" name="provinsi" id="filter-provinsi">
                                        <?php if (isset($provinsi['id'])): ?>
                                            <option value="<?= $provinsi['id'] ?>"><?= $provinsi['provinsi'] ?></option>
                                        <?php else : ?>
                                            <option value="">Semua Provinsi</option>
                                            <?php
                                            foreach ($provinsi as $p): ?>
                                                <option value="<?= $p['id'] ?>"><?= $p['provinsi'] ?></option>
                                        <?php endforeach;
                                        endif; ?>
                                    </select>
                                </div>

                                <!-- Dropdown Kesepakatan -->
                                <div class="col-md-2 mb-3">
                                    <label for="kesepakatan"><strong>Kesepakatan</strong></label>
                                    <select class="form-control" name="kesepakatan" id="filter-kesepakatan">
                                        <option value="">Semua Kesepakatan</option>
                                        <option value="4">Tidak terbahas</option>
                                        <option value="3">Direkomendasikan dengan catatan</option>
                                    </select>
                                </div>
                                <?php if ($desk == "konreg"): ?>
                                    <div class="col-md-2 mb-3">
                                        <label for="pradesk"><strong>Pembahasan</strong></label>
                                        <select class="form-control" name="kesepakatan_desk" id="filter-pembahasan">
                                            <option value="">Semua Sumber</option>
                                            <option value="0">Belum dibahas</option>
                                            <option value="1">FKW</option>
                                            <option value="2">FKB</option>
                                            <option value="3">Ditangguhkan</option>
                                        </select>
                                    </div>
                                <?php endif ?>

                                <!-- Dropdown Kawasan -->
                                <!-- Button Filter -->
                                <div class="col-md-3 ">
                                    <button type="button" id="reset-filters" class="btn btn-info" title="Reset Filter">
                                        <i class="fa fa-undo"></i>
                                    </button>
                                    <button type="submit" class="btn btn-primary" title="Cari Data">
                                        <i id="button-text" class="fa fa-search"></i>
                                        <span id="loading-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                    </button>
                                    <!-- Tombol Download Excel -->
                                    <button type="button" id="download-excel" class="btn btn-success" title="Download Excel">
                                        <img id="button-excel" src="https://cdn-icons-png.flaticon.com/512/732/732220.png" alt="Excel Icon" style="width: 20px; height: 20px; vertical-align: middle;">
                                        <span id="loading-spinner2" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                    </button>
                                </div>

                            </div>
                    </div>
                    <!-- <input type="text" name="sumber" value="NON RPIW" hidden> -->
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
                            <th>Unor</th>
                            <th style="width: 10%;">KP</th>
                            <th style="width: 10%;">ProP</th>
                            <th>Usulan/Pekerjaan</th>
                            <th>Volume</th>
                            <th>Anggaran (Rp Ribu)</th>
                            <th>Kesepakatan Rakortek </th>
                            <th>Aksi </th>
                            <th>Hasil Pembahasan </th>

                        </tr>
                    </thead>
                    <tfoot class="thead-dark" style="text-align: center;">
                        <tr>
                            <th>#</th>
                            <th>Provinsi</th>
                            <th>Unor</th>
                            <th style="width: 10%;">KP</th>
                            <th style="width: 10%;">ProP</th>
                            <th>Usulan/Pekerjaan</th>
                            <th>Volume</th>
                            <th>Anggaran (Rp Ribu)</th>
                            <th>Kesepakatan Rakortek </th>
                            <th>Aksi </th>
                            <th>Hasil Pembahasan </th>
                        </tr>
                    </tfoot>
                    <tbody>

                        <?php $a = 1;
                        foreach ($program as $data) : ?>
                            <tr>
                                <td><?= $a++; ?></td>
                                <td><?= $data->provinsi ?></td>
                                <td><?= $data->unor ?></td>
                                <td style="width: 10%;"><?= $data->nama_kp ?></td>
                                <td style="width: 10%;"><?= $data->nama_prop ?></td>
                                <td><?= $data->usulan ?></td>
                                <td><?= $data->volume_rakortek . " " . $data->nama_satuan ?></td>
                                <td><?php
                                    $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);

                                    // Mengatur agar desimal ditampilkan 0 jika tidak diperlukan
                                    $format->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, 0);
                                    $format->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);

                                    // Menampilkan hasil format tanpa desimal
                                    echo $format->formatCurrency($data->alokasi_rakortek, 'IDR');
                                    ?>
                                </td>
                                <td><?php if ($data->approval_rakortek == 4) {
                                        echo "Tidak terbahas";
                                    } elseif ($data->approval_rakortek == 3) {
                                        echo "Direkomendasikan dengan catatan";
                                    } else {
                                        echo "Status tidak diketahui";
                                    } ?></td>
                                <td>
                                    <span>
                                        <?php if ($desk == "konreg"): ?>
                                            <a target="_blank" href="<?= base_url('edit_rakortek/' . $data->id_usulan . '?desk=konreg') ?>" class=" btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        <?php endif ?>
                                        <a target="_blank" href="<?= base_url('detail_Rakortek/' . $data->id_usulan) ?>" class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </span>
                                </td>
                                <td align="center">
                                    <?php
                                    if ($data->kesepakatan == 0) {
                                        echo '<span class="badge badge-pill badge-secondary">Belum Dibahas</span>';
                                    } elseif ($data->kesepakatan == 1) {
                                        echo '<span class="badge badge-pill badge-primary">FKW</span>';
                                    } elseif ($data->kesepakatan == 2) {
                                        echo '<span class="badge badge-pill badge-success">FKB</span>';
                                    } elseif ($data->kesepakatan == 3) {
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
<!-- jQuery, Select2, dan Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->

<script>
    $(document).ready(function() {
        $('#download-excel').on('click', function() {
            // Ambil data filter
            var filterData = $('#filter-form').serialize(); // Serialize data dari form filter
            $('#loading-spinner2').show();
            $('#button-excel').hide();

            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url('/rakortek/exportToExcel') ?>', // Endpoint controller
                type: 'POST',
                data: filterData,
                xhrFields: {
                    responseType: 'blob' // Terima file sebagai blob
                },
                success: function(response) {
                    // Buat link unduh file
                    var blob = new Blob([response], {
                        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    });
                    var link = document.createElement('a');
                    var date = new Date();
                    var timestamp = date.getFullYear() +
                        (date.getMonth() + 1).toString().padStart(2, '0') +
                        date.getDate().toString().padStart(2, '0') + '_' +
                        date.getHours().toString().padStart(2, '0') +
                        date.getMinutes().toString().padStart(2, '0') +
                        date.getSeconds().toString().padStart(2, '0');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = 'Program_Rakortek' + timestamp + '.xlsx'; // Nama file unduhan
                    link.click();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Berhasil mengunduh file Excel.',
                        confirmButtonText: 'OK'
                    });
                    $('#loading-spinner2').hide();
                    $('#button-excel').show();
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal mengunduh file Excel. Silakan coba lagi.',
                        confirmButtonText: 'OK'
                    });
                    $('#loading-spinner2').hide();
                    $('#button-excel').show();
                }
            });
        });



        var defaultProvinsi = "<?= user()->id_provinsi; ?>";
        var defaultUnor = "<?= 0 . user()->id_unor; ?>";
        // Kalau default tersedia dan localStorage belum menyimpan apa-apa
        if (defaultProvinsi && !localStorage.getItem('selectedProvinsi')) {
            $('#filter-provinsi').val(defaultProvinsi);
            localStorage.setItem('selectedProvinsi', defaultProvinsi);

        }
        // Inisialisasi Select2 untuk semua dropdown
        $('#filter-unor, #filter-provinsi, #filter-kesepakatan, #filter-pembahasan').select2();
        // Restore values from local storage
        $('#filter-unor').val(localStorage.getItem('selectedUnor'));
        $('#filter-provinsi').val(localStorage.getItem('selectedProvinsi'));
        $('#filter-kesepakatan').val(localStorage.getItem('selectedkesepakatan'));

        // On form submit, save the selected values
        $('#filter-form').on('submit', function() {
            event.preventDefault();

            $('#loading-spinner').show();
            $('#button-text').hide();
            // Ambil data filter dari form
            var filterData = $(this).serialize();
            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url($desk == "konreg" ? "/Rakortek/filter_data?desk=konreg" : "/Rakortek/filter_data") ?>', // URL untuk memproses filter
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
            $('#filter-sumber').val('').trigger('change');
            $('#filter-pradesk').val('').trigger('change');

            // Optionally clear the table data
            //$('#datatables tbody').empty();

            // Optionally, you could also clear the local storage if needed
            localStorage.removeItem('selectedUnor');
            // localStorage.removeItem('selectedProvinsi');
            localStorage.removeItem('selectedSumber');
            localStorage.removeItem('selectedPradesk');
        });
    });
</script>