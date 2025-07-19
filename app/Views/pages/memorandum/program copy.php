<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title">Program RPIW</h4>

            </div>
            <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->

            <div class="container mt-4">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Filter Data Program</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="memorandum/filter_data" id="filter-form">
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
                                        <option value="">Semua Provinsi</option>
                                        <?php foreach ($provinsi as $p): ?>
                                            <option value="<?= $p->id ?>"><?= $p->provinsi ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Dropdown Kawasan -->
                                <div class="col-md-2 mb-3">
                                    <label for="kawasan"><strong>Pilih Kawasan</strong></label>
                                    <select class="form-control" name="kawasan" id="filter-kawasan">
                                        <option value="">Semua kawasan</option>
                                        <?php foreach ($kawasan as $k): ?>
                                            <option value="<?= $k->kode_kawasan ?>"><?= $k->nama_kawasan ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label for="residu"><strong>Pilih Jenis Program</strong></label>
                                    <select class="form-control" name="residu" id="filter-residu">
                                        <option value="">Semua Program</option>
                                        <option value="residu">Residu</option>
                                        <option value="non">Non Residu</option>
                                    </select>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label for="tahun_anggaran"><strong>Pilih Tahun Anggaran</strong></label>
                                    <select class="form-control" name="tahun_anggaran" id="filter-tahun_anggaran">
                                        <option value="">Semua Tahun</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        Cari Data
                                    </button>
                                </div>
                                <!-- Button Filter -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>No </th>
                                <!-- <th>Kode </th> -->
                                <th>Provinsi</th>
                                <th>Unor</th>
                                <th>Nama Program </th>
                                <th>Kawasan</th>
                                <th>Volume</th>
                                <th>Anggaran </th>
                                <th>Tahun </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No </th>
                                <!-- <th>Kode </th> -->
                                <th>Provinsi</th>
                                <th>Unor</th>
                                <th>Nama Program </th>
                                <th>Kawasan</th>
                                <th>Volume</th>
                                <th>Anggaran </th>
                                <th>Tahun </th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (isset($p_rpiw)): ?>
                                <?php
                                $a = 1;
                                foreach ($p_rpiw as $p_rpiw) : ?>
                                    <tr>
                                        <td><?= $a++; ?></td>
                                        <!-- <td><?= $p_rpiw->id_program ?></td> -->
                                        <td><?= $p_rpiw->provinsi ?></td>
                                        <td><?= $p_rpiw->unor ?></td>
                                        <td><a href="/memo/<?= $p_rpiw->id_program ?>"><?= $p_rpiw->nama_program ?></a></td>
                                        <td>
                                            <?php if (isset($kawasans[$p_rpiw->id_program])): ?>
                                                <?php
                                                $rows = count($kawasans[$p_rpiw->id_program]);
                                                if ($rows > 1) {
                                                    $i = 1;
                                                    $ii = '.';
                                                } else {
                                                    $i = '';
                                                    $ii = '';
                                                }
                                                ?>
                                                <?php foreach ($kawasans[$p_rpiw->id_program] as $kawasan): ?>
                                                    <?= $i++ . $ii . $kawasan->nama_kawasan; ?><br>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                Non Kawasan
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $p_rpiw->volume . " " . $p_rpiw->nama_satuan ?></td>
                                        <td><?php $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                                            echo $format->formatCurrency($p_rpiw->biaya, 'IDR');  ?></td>
                                        <td><?= $tahun ?></td>
                                        <!-- <td class="text-center"><a href="/detail/<?= $p_rpiw->id_program ?>">Detail</td></a> -->
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif ?>
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


<script>
    $(document).ready(function() {
        //ambil kawasan
        $('#filter-provinsi').on('change', function() {
            var provinsiId = $(this).val(); // Ambil nilai provinsi yang dipilih
            console.log('Provinsi yang dipilih: ', provinsiId);

            $.ajax({
                url: '<?= base_url("memorandum/get_kawasan") ?>', // URL untuk memproses ambil data kawasan
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
        $('#filter-unor, #filter-provinsi, #filter-kawasan, #filter-residu, #filter-tahun_anggaran').select2();
        // Restore values from local storage
        $('#filter-unor').val(localStorage.getItem('selectedUnor'));
        $('#filter-provinsi').val(localStorage.getItem('selectedProvinsi'));
        $('#filter-kawasan').val(localStorage.getItem('selectedKawasan'));
        $('#filter-residu').val(localStorage.getItem('selectedResidu'));
        $('#filter-tahun_anggaran').val(localStorage.getItem('selectedTahun'));

        // On form submit, save the selected values
        $('#filter-form').on('submit', function() {
            // Ambil data filter dari form
            var filterData = $(this).serialize();

            // Kirim request AJAX
            $.ajax({
                url: '<?= base_url("memorandum/filter_data") ?>', // URL untuk memproses filter
                type: 'POST',
                data: filterData,
                success: function(response) {
                    // Update tabel dengan data yang diterima
                    $('#datatables tbody').html(response);
                },
                error: function() {
                    alert('Error loading data');
                }
            });
        });
    });
</script>