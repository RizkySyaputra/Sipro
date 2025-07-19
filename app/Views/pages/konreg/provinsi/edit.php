<style>
    /* Menjamin textarea tidak memiliki scrollbar */
    .form-control-tes {
        resize: none;
        overflow: hidden;
        min-height: 60px;
    }
</style>
<?php foreach ($usulan as $usulan) : ?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-white" style="background-color: #222cb1;">
                <h4 style="text-align: center;">Detail Usulan Provinsi</h4>
            </div>
            <div class="card-body">
                <?php if ($desk == "konreg") : ?>
                    <form action="<?= base_url('UsulanProvinsi/edit?desk=konreg') ?>" id="myForm" method="POST" enctype="multipart/form-data">
                    <?php else : ?>
                        <form action="<?= base_url('UsulanProvinsi/edit') ?>" id="myForm" method="POST" enctype="multipart/form-data">
                        <?php endif; ?>
                        <div class="row mb-3">
                            <input type="text" name="id_provinsi" value="<?= $usulan->id_provinsi; ?>" hidden>
                            <input type="text" name="id_usulan" class="form-control" value="<?= $usulan->id_usulan; ?>" hidden>
                            <input type="text" name="id_unor" value="<?= $usulan->id_unor; ?>" hidden>
                            <input type="text" name="nama_program" value="<?= $usulan->nama_pekerjaan; ?>" hidden>
                            <input type="text" name="id_kawasan" value="<?= $usulan->id_kawasan; ?>" hidden>
                            <input type="text" name="catatan_unor" value="<?= $usulan->catatan_unor; ?>" hidden>
                            <input type="text" name="lokasi" value="<?= $usulan->lokasi; ?>" hidden>
                            <input type="text" name="anggaran" value="<?= $usulan->anggaran; ?>" hidden>
                            <input type="text" name="id_pembiayaan" value="<?= $usulan->id_pendanaan; ?>" hidden>
                            <input type="text" name="kd_prog" value="<?= $usulan->kd_prog; ?>" hidden>
                            <div class="col-sm-3 font-weight-bold"><strong>PN (Prioritas Nasional)</strong></div>
                            <div class="col-sm-9">
                                <select name="id_pn" id="select-pn" class="form-control" hidden>
                                    <option value="<?= $usulan->id_pn ?>" selected><?= $usulan->id_pn . " " . $usulan->nama_pn;  ?></option>
                                </select>
                                <input type="text" id="selected-pn" name="id_pn" class="form-control" value="<?= $usulan->id_pn . " " .  $usulan->nama_pn; ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>PP (Program Prioritas)</strong></div>
                            <div class="col-sm-9">
                                <select name="id_pp" id="select-pp" class="form-control" hidden>
                                    <option value="<?= $usulan->id_pp ?>" selected><?= $usulan->id_pp . " " . $usulan->nama_pp;  ?></option>
                                </select>
                                <input type="text" id="selected-pp" name="id_pp" class="form-control" value="<?= $usulan->id_pp . " " . $usulan->nama_pp; ?>" disabled>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>KP (Kegiatan Prioritas)</strong></div>
                            <div class="col-sm-9">
                                <select name="id_kp" id="select-kp" class="form-control" required>
                                    <option value="<?= $usulan->id_kp; ?>" selected><?= $usulan->id_kp . " " . $usulan->nama_kp; ?></option>
                                    <?php foreach ($kp as $item) : ?>
                                        <option value="<?= $item['id_kp'] ?>"> <?= $item['id_kp'] . ". " . $item['nama_kp'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- new -->
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>ProP (Proyek Prioritas) </strong></div>
                            <div class="col-sm-9">
                                <select name="id_prop" id="select-prop" class="form-control" required>
                                    <option value="<?= $usulan->id_prop; ?>" disabled selected><?= $usulan->id_prop . " " . $usulan->nama_prop; ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- new  -->
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>Sektor</strong></div>
                            <div class="col-sm-9">
                                <select name="id_unor" class="form-control" id="select-unor">
                                    <?php if (isset($unor['id'])): ?>
                                        <option value="<?= $unor['id'] ?>"><?= $unor['unor'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $usulan->id_unor; ?>" selected><?= $usulan->unor; ?></option>
                                        <?php foreach ($unor as $u): ?>
                                            <option value="<?= $u->id ?>"><?= $u->unor ?></option>
                                        <?php endforeach; ?>
                                    <?php endif ?>
                                </select>
                            </div>
                        </div>
                        <!-- new -->
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>Kegiatan</strong></div>
                            <div class="col-sm-9">
                                <select name="kd_kgiat" class="form-control" id="select-kd_kegiatan" required>
                                    <option value="<?= $usulan->kd_kro; ?>" selected><?= $usulan->kd_kgiat . " " . $usulan->nmgiat; ?></option>
                                    <!-- <?php foreach ($kegiatan as $item) : ?>
                                    <option value="<?= $item['kdgiat'] ?>"><?= $item['nmgiat'] ?></option>
                                <?php endforeach; ?> -->
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>KRO (Kumpulan Rincian Output)</strong></div>
                            <div class="col-sm-9">
                                <select name="kd_kro" class="form-control" id="select-kd_kro" required>
                                    <option value="<?= $usulan->kd_kro; ?>" selected><?= $usulan->kd_kro . " " . $usulan->nmkro; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>RO (Rincian Output)</strong></div>
                            <div class="col-sm-9">
                                <select name="kd_ro" class="form-control" id="select-kd_ro" required>
                                    <option value="<?= $usulan->kd_ro; ?>" selected><?= $usulan->kd_ro  . " " . $usulan->nmro; ?></option>
                                </select>
                            </div>
                        </div>
                        <!-- new -->
                        <!-- <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> KRO</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="kd_kro" class="form-control" value="<?= $usulan->kd_kro; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> RO</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="kd_ro" class="form-control" value="<?= $usulan->kd_ro; ?>" required>
                        </div>
                    </div> -->
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>Provinsi</strong></div>
                            <div class="col-sm-9">
                                <select name="id_provinsi" class="form-control" id="select-provinsi" required>
                                    <?php if (isset($provinsi['id'])): ?>
                                        <option value="<?= $usulan->id_provinsi ?>" selected><?= $usulan->provinsi ?></option>
                                    <?php else : ?>
                                        <option value="<?= $usulan->id_provinsi; ?>" selected><?= $usulan->provinsi; ?></option>
                                        <?php foreach ($provinsi as $item) : ?>
                                            <option value="<?= $item['id'] ?>"><?= $item['provinsi'] ?></option>
                                    <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>Kabupaten Kota</strong></div>
                            <div class="col-sm-9">
                                <select name="id_kabkot" class="form-control" id="select-kabkot" required>
                                    <option value="<?= $usulan->id_kabkot ?>" selected><?= $usulan->kab_kot ?></option>

                                    <?php foreach ($kabkot as $item) : ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['kab_kot'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>Kawasan Prioritas</strong></div>
                            <div class="col-sm-9">
                                <select name="id_kawasan" class="form-control" id="select-kawasan" required>
                                    <option value="<?= $usulan->id_kawasan ?>" selected><?= $usulan->nama_kawasan; ?></option>
                                    <?php $no = 1;
                                    foreach ($kawasan as $item) : ?>
                                        <option value="<?= $item['kode_kawasan'] ?>"><?= $no . ". " . $item['nama_kawasan'] ?></option>
                                    <?php $no++;
                                    endforeach; ?>
                                    <option value="0"><?= $no . ". Non Kawasan" ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong> Nama Pekerjaan</strong></div>
                            <div class="col-sm-9">
                                <input type="text" name="nama_pekerjaan" class="form-control" value="<?= $usulan->nama_pekerjaan; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>Lokasi</strong></div>
                            <div class="col-sm-9">
                                <input type="text" name="lokasi" class="form-control" value="<?= $usulan->lokasi; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>Justifikasi</strong></div>
                            <div class="col-sm-9">
                                <textarea name="justifikasi" class="form-control" required><?= $usulan->justifikasi ?></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>Volume</strong></div>
                            <div class="col-sm-3 d-flex align-items-center">
                                <input type="text" id="volume" name="volume" class="form-control me-2" value="<?= $usulan->volume; ?>" required>
                            </div>
                            <div class="col-sm-3">
                                <select name="id_satuan" class="form-control" id="select-satuan" required>
                                    <option value="<?= $usulan->id_satuan; ?>" selected><?= $usulan->nama_satuan; ?></option>
                                    <?php foreach ($satuan as $item) : ?>
                                        <option value="<?= $item['id_satuan'] ?>"><?= $item['nama_satuan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>Anggaran (dalam ribu)</strong></div>
                            <div class="col-sm-9">
                                <input type="text" id="biaya" name="anggaran" class="form-control" value="<?= $usulan->anggaran; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>Sumber Pendanaan</strong> </div>
                            <div class="col-sm-9">
                                <select name="id_pendanaan" class="form-control" required>
                                    <option value="1" <?= $usulan->sumber_pendanaan == 'APBN' ? 'selected' : ''; ?>>APBN</option>
                                </select>
                            </div>
                        </div>
                        <?php
                        $opsiKesiapan = [
                            'ri' => 'Rencana Induk',
                            'fs' => 'FS',
                            'dokling' => 'Dokumen lingkungan',
                            'lahan' => 'Lahan',
                            'ded' => 'DED',
                            'pasca_kontruksi' => 'Pasca Konstruksi',
                            'menerima_bantuan' => 'Menerima Bantuan'
                        ];
                        foreach ($opsiKesiapan as $field => $label) : ?>


                            <div class="row mb-3">
                                <div class="col-sm-3 font-weight-bold"><strong><?= $label ?></strong></div>
                                <?php $fileField = $field . '_dokumen'; ?>
                                <div class="col-sm-9">
                                    <select name="<?= $field ?>" class="form-control kesiapan-dropdown" data-target="<?= $field ?>" id="select-<?= $field ?>" required>
                                        <option value="<?= $usulan->$field; ?>" selected><?= $usulan->$field; ?></option>
                                        <?php if ($usulan->$field == "Siap"): ?>
                                            <option value="Siap">Ubah Dokumen</option>
                                        <?php else : ?>
                                            <option value="Siap">Siap</option>
                                        <?php endif; ?>
                                        <option value="Mei 2025">Mei 2025</option>
                                        <option value="Juni 2025">Juni 2025</option>
                                        <option value="Juli 2025">Juli 2025</option>
                                        <option value="Agustus 2025">Agustus 2025</option>
                                        <option value="September 2025">September 2025</option>
                                        <option value="Oktober 2025">Oktober 2025</option>
                                        <option value="Belum Siap">Belum Siap</option>
                                        <option value="Tidak Perlu">Tidak Perlu</option>
                                    </select>
                                </div>
                            </div>
                            <?php if (!empty($usulan->$fileField)) : ?>
                                <div class="row mb-3">
                                    <div class="col-sm-3 font-weight-bold">
                                        <strong> Dokumen <?= $label ?></strong>
                                    </div>
                                    <div class="col-sm-9">
                                        <button type="button" class="btn btn-sm btn-primary" onclick="previewPDF('<?= base_url('uploads/usulan_dokumen/' . $usulan->$fileField) ?>')">
                                            Preview Dokumen
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Form Upload, disembunyikan dulu -->

                            <div class="row mb-3 upload-<?= $field ?>" style="display: none;">
                                <div class="col-sm-3 font-weight-bold">
                                    <strong>Upload Dokumen <?= $label ?></strong>
                                </div>
                                <div class="col-sm-9">
                                    <input type="file" name="file_<?= $field ?>" class="form-control-file" accept=".pdf">
                                    <small class="form-text text-muted">Hanya file PDF dengan ukuran maksimal 20MB.</small>

                                    <input type="hidden" name="existing_file_<?= $field ?>" value="<?= $usulan->$fileField ?>">

                                </div>
                            </div>

                        <?php endforeach; ?>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>Tahun Pelaksanaan Fisik</strong></div>
                            <div class="col-sm-9">
                                <select name="tahun_pengerjaan" class="form-control tahun-pelaksanaan-dropdown" id="select-tahun-pelaksanaan" required>
                                    <option value="<?= $usulan->tahun_pengerjaan; ?>" selected><?= $usulan->tahun_pengerjaan; ?></option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                </select>
                            </div>
                        </div>
                        <?php if ($desk == "konreg"): ?>
                            <div class="row mb-3">
                                <div class="col-sm-3 font-weight-bold">Catatan FUP</div>
                                <div class="col-sm-9">
                                    <textarea style="height: auto;" name="catatan_fup" class="form-control"><?= $usulan->catatan_fup; ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3 font-weight-bold">Kesepakatan</div>
                                <div class="col-sm-9">
                                    <?php
                                    $kesepakatanOptions = [
                                        0 => 'Belum dibahas',
                                        1 => 'FKW',
                                        2 => 'FKB',
                                        3 => 'Ditangguhkan'
                                    ];
                                    ?>
                                    <select name="kesepakatan" class="form-control" required>
                                        <option value="<?= $usulan->kesepakatan ?>" selected>
                                            <?= $kesepakatanOptions[$usulan->kesepakatan] ?? 'Pilih Jenis Program'; ?>
                                        </option>
                                        <?php foreach ($kesepakatanOptions as $value => $label): ?>
                                            <?php if ($value == $usulan->kesepakatan) continue; ?>
                                            <option value="<?= $value; ?>"><?= $label; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <!-- <select name="kesepakatan" class="form-control" required>
                                    <option value="<?= $usulan->kesepakatan; ?>" selected><?= $usulan->kesepakatan; ?>
                                    <option value="" disabled selected>Pilih Jenis Program</option>
                                    <option value="1">FKW</option>
                                    <option value="2">FKB</option>
                                    <option value="3">FKB Dengan Catatan</option>
                                    <option value="4">Ditangguhkan</option>
                                </select> -->
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row mb-3">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                        </form>
            </div>
        </div>
    </div>

<?php endforeach ?>
<!-- Modal Preview PDF -->
<div class="modal fade" id="pdfPreviewModal" tabindex="-1" role="dialog" aria-labelledby="pdfPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 80vh;">
                <iframe id="pdfViewer" src="" width="100%" height="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>


<script>
    function previewPDF(url) {
        document.getElementById('pdfViewer').src = url;
        $('#pdfPreviewModal').modal('show');
    }
    $(document).ready(function() {




        $('#select-tahun-pelaksanaan, #select-kd_kegiatan, #select-kd_kro, #select-kd_ro, #select-kabkot, #select-prop, #select-kp, #select-satuan, #select-kawasan, #select-provinsi, #select-unor, #select-ri, #select-fs, #select-dokling, #select-lahan, #select-ded, #select-pasca_kontruksi, #select-menerima_bantuan, #select-sumber').select2();

        //get kegiatan berdasarkan unor
        // $('#select-unor').on('change', function() {
        //     var id_unor = $(this).val(); // Ambil nilai provinsi yang dipilih
        //     $.ajax({
        //         url: '<?= base_url('/UsulanProvinsi/get_kegiatan') ?>',
        //         type: 'POST',
        //         data: {
        //             id_unor: id_unor
        //         },
        //         success: function(response) {
        //             $('#select-kd_kegiatan').empty();
        //             $('#select-kd_kro').empty();
        //             $('#select-kd_ro').empty();
        //             $('#select-kd_ro').empty();
        //             $('#select-kd_kegiatan').append('<option value="" selected disabled>-- Pilih Kegiatan --</option>');
        //             $('#select-kd_kro').append('<option value="" selected disabled>-- Pilih KRO --</option>');
        //             $('#select-kd_ro').append('<option value="" selected disabled>-- Pilih RO --</option>');

        //             var i = 1;
        //             $.each(response, function(index, kegiatan) {
        //                 $('#select-kd_kegiatan').append('<option value="' + kegiatan.kdgiat + '">' + kegiatan.kdgiat + '. ' + kegiatan.nmgiat + '</option>');
        //                 i++;
        //             });
        //         },
        //         error: function() {
        //             alert('Error loading data');
        //         }
        //     });
        // });



        //get kro berdasarkan kegiatan
        // $('#select-kd_kegiatan').on('change', function() {
        //     var kd_kgiat = $(this).val(); // Ambil nilai provinsi yang dipilih
        //     $.ajax({
        //         url: '<?= base_url('/UsulanProvinsi/get_kro') ?>',
        //         type: 'POST',
        //         data: {
        //             kd_kgiat: kd_kgiat
        //         },
        //         success: function(response) {
        //             $('#select-kd_kro').empty();
        //             $('#select-kd_kro').append('<option value="">-- Pilih KRO --</option>');

        //             var i = 1;
        //             $.each(response, function(index, kro) {
        //                 $('#select-kd_kro').append('<option value="' + kro.kdkro + '">' + kro.kdkro + '. ' + kro.nmkro + '</option>');
        //                 i++;
        //             });
        //         },
        //         error: function() {
        //             alert('Error loading data');
        //         }
        //     });
        // });

        //get ro berdasarkan kro
        // $('#select-kd_kro').on('change', function() {
        //     var kd_kro = $(this).val(); // Ambil nilai provinsi yang dipilih
        //     $.ajax({
        //         url: '<?= base_url('/UsulanProvinsi/get_ro') ?>',
        //         type: 'POST',
        //         data: {
        //             kd_kro: kd_kro
        //         },
        //         success: function(response) {
        //             $('#select-kd_ro').empty();
        //             $('#select-kd_ro').append('<option value="">-- Pilih RO --</option>');

        //             var i = 1;
        //             $.each(response, function(index, ro) {
        //                 $('#select-kd_ro').append('<option value="' + ro.kdro + '">' + ro.kdro + '. ' + ro.nmro + '</option>');
        //                 i++;
        //             });
        //         },
        //         error: function() {
        //             alert('Error loading data');
        //         }
        //     });
        // });


        //get satuan berdasarkan ro
        $('#select-kd_ro').on('change', function() {
            var kd_ro = $(this).val(); // Ambil nilai provinsi yang dipilih
            $.ajax({
                url: '<?= base_url('/UsulanProvinsi/get_satuan') ?>',
                type: 'POST',
                data: {
                    kd_ro: kd_ro
                },
                success: function(response) {
                    console.log(kd_ro);
                    $('#select-satuan').empty();

                    $.each(response, function(index, satuan) {
                        $('#select-satuan').append('<option value="' + satuan.id_satuan + '">' + satuan.nama_satuan + '</option>');
                    });
                },
                error: function() {
                    alert('Error loading data');
                }
            });
        });

        //get kawasan berdasarkan provinsi
        $('#select-provinsi').on('change', function() {
            var provinsiId = $(this).val(); // Ambil nilai provinsi yang dipilih
            $.ajax({
                url: '<?= base_url('/UsulanProvinsi/get_kawasan') ?>',
                type: 'POST',
                data: {
                    provinsi_id: provinsiId
                },
                success: function(response) {
                    $('#select-kawasan').empty();
                    $('#select-kawasan').append('<option value="">Semua Kawasan</option>');

                    var i = 1;
                    $.each(response, function(index, kawasan) {
                        $('#select-kawasan').append('<option value="' + kawasan.kode_kawasan + '">' + i + '. ' + kawasan.nama_kawasan + '</option>');
                        i++;
                    });
                },
                error: function() {
                    alert('Error loading data');
                }
            });
        });


        $('.kesiapan-dropdown').on('change', function() {
            const selected = $(this).val();
            const target = $(this).data('target');
            const uploadDiv = $('.upload-' + target);

            if (selected === 'Siap') {
                uploadDiv.show();
            } else {
                uploadDiv.hide();
                uploadDiv.find('input[type="file"]').val(''); // reset file input
            }
        });


        // Saat pilih KP dan pn pp terisi otomatis
        // User memilih KP
        $('#select-kp').on('change', function() {
            var id_kp = $(this).val();
            $.post('<?= base_url("UsulanProvinsi/get_kp") ?>', {
                id_kp: id_kp
            }, function(res_kp) {
                // Misal res_kp = { id_kp: 3, nama_kp: "KP 3", id_pp: 2 }
                $('#nama-kp').val(res_kp.nama_kp);
                var id_pp = res_kp.id_pp;

                // 2. Ambil data PP berdasarkan id_pp
                $.post('<?= base_url("UsulanProvinsi/get_pp") ?>', {
                    id_pp: id_pp
                }, function(res_pp) {
                    // Misal res_pp = { id_pp: 2, nama_pp: "PP 2", id_pn: 1 }
                    $('#nama-pp').val(res_pp.nama_pp);

                    var id_pn = res_pp.id_pn;
                    $('#select-pp').empty().append('<option value="' + res_pp.id_pp + '">' + res_pp.id_pp + '. ' + res_pp.nama_pp + '</option>');
                    $('#selected-pp').empty().val(res_pp.id_pp + '. ' + res_pp.nama_pp);


                    // 3. Ambil data PN berdasarkan id_pn
                    $.post('<?= base_url("UsulanProvinsi/get_pn") ?>', {
                        id_pn: id_pn
                    }, function(res_pn) {
                        $('#select-pn').empty().append('<option value="' + res_pn.id_pn + '">' + res_pn.id_pn + '. ' + res_pn.nama_pn + '</option>');
                        $('#selected-pn').empty().val(res_pn.id_pn + '. ' + res_pn.nama_pn);
                        // Misal res_pn = { id_pn: 1, nama_pn: "PN 1" }
                        $('#nama-pn').val(res_pn.nama_pn);
                    });
                });
            });
        });



        //get prop by kp id

        $('#select-kp').on('change', function() {
            var id_kp = $(this).val(); // Ambil nilai kp yang dipilih
            $.ajax({
                url: '<?= base_url('/UsulanProvinsi/get_prop') ?>',
                type: 'POST',
                data: {
                    id_kp: id_kp
                },
                success: function(response) {
                    $('#select-prop').empty();
                    $('#select-prop').append('<option value="">-- Pilih PROP --</option>');
                    $('#select-unor').empty();
                    $('#select-unor').append('<option value="">-- Pilih Sektor --</option>');
                    $('#select-kd_ro').empty();
                    $('#select-kd_ro').append('<option value="">-- Pilih RO --</option>');
                    $('#select-kd_kro').empty();
                    $('#select-kd_kro').append('<option value="">-- Pilih KRO --</option>');
                    $('#select-kd_kegiatan').empty();
                    $('#select-kd_kegiatan').append('<option value="">-- Pilih Kegiatan --</option>');

                    $.each(response, function(index, prop) {
                        $('#select-prop').append('<option value="' + prop.id_prop + '">' + prop.id_prop + '. ' + prop.nama_prop + '</option>');
                    });
                },
                error: function() {
                    alert('Error loading data');
                }
            });
        });
        var prop = null;
        //ambil program by prop
        $('#select-prop').on('change', function() {
            prop = $(this).val(); // Ambil nilai kp yang dipilih
            $.ajax({
                url: '<?= base_url('/UsulanProvinsi/get_program') ?>',
                type: 'POST',
                data: {
                    prop: prop
                },
                success: function(response) {
                    $('#select-unor').empty();
                    $('#select-unor').append('<option value="">-- Pilih Unor --</option>');
                    $('#select-kd_ro').empty();
                    $('#select-kd_ro').append('<option value="">-- Pilih RO --</option>');

                    $.each(response, function(index, program) {
                        $('#select-unor').append('<option value="' + program.id_unor + '">' + program.unor + '</option>');
                    });
                },
                error: function() {
                    alert('Error loading data');
                }
            });
        });

        // //ambil Kegiatan by prop
        $('#select-prop').on('change', function() {
            prop = $(this).val(); // Ambil nilai kp yang dipilih
            $.ajax({
                url: '<?= base_url('/UsulanProvinsi/get_kegiatan') ?>',
                type: 'POST',
                data: {
                    prop: prop
                },
                success: function(response) {
                    $('#select-kd_kegiatan').empty();
                    $('#select-kd_kegiatan').append('<option value="">-- Pilih Kegiatan --</option>');

                    $.each(response, function(index, kegiatan) {
                        $('#select-kd_kegiatan').append('<option value="' + kegiatan.kdgiat + '">' + kegiatan.kdgiat + '. ' + kegiatan.nmgiat + '</option>');
                    });
                },
                error: function() {
                    alert('Error loading data');
                }
            });
        });

        // //ambil Kro by prop
        $('#select-prop').on('change', function() {
            prop = $(this).val(); // Ambil nilai kp yang dipilih
            $.ajax({
                url: '<?= base_url('/UsulanProvinsi/get_kro') ?>',
                type: 'POST',
                data: {
                    prop: prop
                },
                success: function(response) {
                    $('#select-kd_kro').empty();
                    $('#select-kd_kro').append('<option value="">-- Pilih KRO --</option>');

                    $.each(response, function(index, kro) {
                        $('#select-kd_kro').append('<option value="' + kro.kdkro + '">' + kro.kdkro + '. ' + kro.nmkro + '</option>');
                    });
                },
                error: function() {
                    alert('Error loading data');
                }
            });
        });

        // //ambil ro by kro+prop
        $('#select-kd_kro').on('change', function() {
            var kro = $(this).val(); // Ambil nilai kp yang dipilih
            $.ajax({
                url: '<?= base_url('/UsulanProvinsi/get_ro') ?>',
                type: 'POST',
                data: {
                    kro: kro,
                    prop: prop
                },
                success: function(response) {
                    $('#select-kd_ro').empty();
                    $('#select-kd_ro').append('<option value="">-- Pilih RO --</option>');

                    $.each(response, function(index, ro) {
                        $('#select-kd_ro').append('<option value="' + ro.kdro + '">' + ro.kdro + '. ' + ro.nmro + '</option>');
                    });
                },
                error: function() {
                    alert('Error loading data');
                }
            });
        });

        function autoResize(textarea) {
            textarea.style.height = "auto"; // Reset tinggi sebelum menyesuaikan
            textarea.style.height = (textarea.scrollHeight) + "px"; // Menyesuaikan tinggi dengan konten
        }


        $('#list-satuan').select2();

        function autoResize(textarea) {
            textarea.style.height = 'auto'; // Reset height
            textarea.style.height = textarea.scrollHeight + 'px'; // Set height to scroll height
        }

        const input = document.getElementById('volume');
        const input2 = document.getElementById('biaya');

        // Fungsi untuk memvalidasi input
        input.addEventListener('input', function(e) {
            // Hanya karakter yang diizinkan: angka (0-9) dan titik (.)
            const value = e.target.value;

            // Mengganti input dengan hanya angka dan titik
            e.target.value = value.replace(/[^0-9.]/g, '');
        });
        input2.addEventListener('input', function(e) {
            // Hanya karakter yang diizinkan: angka (0-9) dan titik (.)
            const value = e.target.value;

            // Mengganti input dengan hanya angka dan titik
            e.target.value = value.replace(/[^0-9.]/g, '');
        });

        function formatAngka(value) {
            // Menghapus semua karakter non-digit
            value = value.replace(/\D/g, '');

            // Memformat angka dengan pemisah ribuan (titik)
            return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Mendapatkan elemen input
        const input3 = document.getElementById('biaya');

        // Memformat value saat input dimuat
        input3.value = formatAngka(input3.value);

        // Event listener untuk memformat input saat pengguna mengetik
        input3.addEventListener('input', function(e) {
            // Memformat angka setelah pengguna mengetik
            e.target.value = formatAngka(e.target.value);
        })

        document.getElementById('myForm').addEventListener('submit', function(e) {
            // Menghapus titik (pemisah ribuan) sebelum mengirimkan nilai
            const biayaInput = document.getElementById('biaya');
            biayaInput.value = biayaInput.value.replace(/\./g, ''); // Hapus titik

            // Form akan dikirim dengan nilai yang sudah diubah
        });


    });
</script>