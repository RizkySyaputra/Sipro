<?php

foreach ($p_fkb as $p_fkb) : ?>
    <div class="container mt-5">
        <div class="card">
            <?php if ($desk) : ?>
                <form action="<?= base_url('/program/editFkb?desk=konreg') ?>" method="post" id="myForm" enctype="multipart/form-data">
                    <!-- <form action="#" method="post" id="myForm"> -->
                <?php else: ?>
                    <form action="<?= base_url('/program/editFkb') ?>" method="post" id="myForm" enctype="multipart/form-data">
                    <?php endif ?>
                    <div class="card-header bg-primary text-white">
                        <h4 style="text-align: center;"> Pembahasan Pekerjaan FKB </h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Nama Pekerjaan</div>
                            <div class="col-sm-9">
                                <input type="text" name="id_fkb" class="form-control" value="<?= $p_fkb->id_fkb; ?>" hidden>
                                <input type="text" name="nama_pekerjaan" class="form-control" value="<?= $p_fkb->pekerjaan; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Provinsi</div>
                            <div class="col-sm-9"><?= $p_fkb->provinsi; ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold"><strong>Kabupaten Kota</strong></div>
                            <div class="col-sm-9">
                                <select name="id_kabkot" class="form-control" id="select-kabkot">
                                    <?php if (isset($p_fkb->id_kabkot)): ?>
                                        <option value="<?= $p_fkb->id_kabkot ?>" selected><?= $p_fkb->kab_kot ?></option>
                                    <?php else : ?>
                                        <option value="" disabled selected>-- Pilih Kabkot --</option>
                                    <?php endif; ?>
                                    <?php foreach ($kabkot as $item) : ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['kab_kot'] ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Unit Organisasi</div>
                            <div class="col-sm-9"><?= $p_fkb->unor; ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Program</div>
                            <div class="col-sm-9"><?= $p_fkb->kd_prog . " - " . $p_fkb->nmprogram ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Kode Kegiatan </div>
                            <div class="col-sm-9">
                                <select name="kd_kgiat" class="form-control" id="select-kd_kegiatan" required>
                                    <option value="<?= $p_fkb->kd_kgiat ?>" selected> <?= $p_fkb->kd_kgiat . " - " . $p_fkb->nmgiat ?></option>
                                    <?php foreach ($kegiatan as $item) : ?>
                                        <option value="<?= $item['kdgiat'] ?>"><?= $item['kdgiat'] . " - " . $item['nmgiat'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">KRO</div>
                            <div class="col-sm-9">
                                <select name="kd_kro" class="form-control" id="select-kd_kro" required>
                                    <option value="<?= $p_fkb->kd_kro ?>" selected> <?= $p_fkb->kd_kro . " - " . $p_fkb->nmkro; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">RO</div>
                            <div class="col-sm-9">
                                <select name="kd_ro" class="form-control" id="select-kd_ro" required>
                                    <option value="<?= $p_fkb->kd_ro ?>" selected> <?= $p_fkb->kd_ro . " - " . $p_fkb->nmro; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Tahun diusulkan</div>
                            <div class="col-sm-9"><?= $p_fkb->tahun_diusulkan; ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Lokasi</div>
                            <div class="col-sm-9">
                                <input type="text" name="lokasi" class="form-control" value="<?= $p_fkb->lokasi; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Volume</div>
                            <div class="col-sm-3 d-flex align-items-center">
                                <input type="text" id="volume" name="volume" class="form-control me-2" value="<?= $p_fkb->volume; ?>" required>
                                <select name="id_satuan" class="form-control" id="select-satuan">
                                    <option selected value="<?= $p_fkb->id_satuan; ?>"><?= $p_fkb->nama_satuan; ?></option>

                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Anggaran (dalam ribu)</div>
                            <div class="col-sm-9">
                                <input type="text" id="biaya" name="anggaran" class="form-control" value="<?= $p_fkb->anggaran; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Waktu Pelaksanaan</div>
                            <div class="col-sm-9">
                                <?php $tahunList = [2026, 2027, 2028, 2029]; ?>
                                <select name="tahun_pengerjaan" class="form-control tahun-pelaksanaan-dropdown" id="select-tahun-pelaksanaan" required>
                                    <option selected value="<?= $p_fkb->tahun_pelaksanaan; ?>">
                                        <?= $p_fkb->tahun_pelaksanaan; ?>
                                    </option>
                                    <?php foreach ($tahunList as $tahun) : ?>
                                        <?php if ($tahun == $p_fkb->tahun_pelaksanaan) continue; ?>
                                        <option value="<?= $tahun; ?>"><?= $tahun; ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Sumber Data</div>
                            <div class="col-sm-9"><?= $p_fkb->sumber; ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Sumber Pendanaan</div>
                            <div class="col-sm-9">
                                <select name="id_pendanaan" class="form-control" required>
                                    <option value="1" <?= $p_fkb->sumber_pendanaan == 'APBN' ? 'selected' : ''; ?>>APBN</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Catatan</div>
                            <div class="col-sm-9"><?= $p_fkb->catatan; ?></div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Tematik</div>
                            <div class="col-sm-9">
                                <select name="id_tematik" class="form-control" id="select-tematik">
                                    <option value="<?= $p_fkb->id_tematik ?>" selected> <?= $p_fkb->id_tematik . ". " . $p_fkb->tematik ?></option>
                                    <?php foreach ($tematik as $tematiks) : ?>
                                        <?php if ($tematiks["id_tematik"] == $p_fkb->id_tematik) {
                                            continue;
                                        } ?>
                                        <option value="<?= $tematiks["id_tematik"]; ?>"><?= $tematiks["id_tematik"] . ". " . $tematiks["tematik"]; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <?php
                        $opsiKesiapan = [
                            'renc_induk' => 'Rencana Induk',
                            'fs' => 'FS',
                            'dokling' => 'Dokumen lingkungan',
                            'lahan' => 'Lahan',
                            'ded' => 'DED',
                            'pasca_kons' => 'Pasca Konstruksi',
                            'terima_bantuan' => 'Menerima Bantuan'
                        ];
                        foreach ($opsiKesiapan as $field => $label) : ?>


                            <div class="row mb-3">
                                <div class="col-sm-3 font-weight-bold"><strong><?= $label ?></strong></div>
                                <?php $fileField = 'dok_' . $field; ?>
                                <div class="col-sm-9">
                                    <select name="<?= $field ?>" class="form-control kesiapan-dropdown" data-target="<?= $field ?>" id="select-<?= $field ?>" required>
                                        <option value="<?= $p_fkb->$field; ?>" selected><?= $p_fkb->$field; ?></option>
                                        <?php if ($p_fkb->$field == "Siap"): ?>
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
                            <?php if (!empty($p_fkb->$fileField)) : ?>
                                <div class="row mb-3">
                                    <div class="col-sm-3 font-weight-bold">
                                        <strong> Dokumen <?= $label ?></strong>
                                    </div>
                                    <div class="col-sm-9">
                                        <button type="button" class="btn btn-sm btn-primary" onclick="previewPDF('<?= base_url('uploads/usulan_dokumen/' . $p_fkb->$fileField) ?>')">
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

                                    <input type="hidden" name="existing_file_<?= $field ?>" value="<?= $p_fkb->$fileField ?>">

                                </div>
                            </div>

                        <?php endforeach; ?>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Catatan PraDesk</div>
                            <div class="col-sm-9">
                                <?= $p_fkb->catatan_pradesk; ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Catatan Desk</div>
                            <div class="col-sm-9">
                                <textarea type="text" name="catatan_desk" class="form-control" required><?= $p_fkb->catatan_desk ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Kesepakatan</div>
                            <div class="col-sm-9">
                                <?php
                                $kesepakatanOptions = [
                                    1 => 'FKS',
                                    2 => 'Ditangguhkan',
                                    0 => 'Non FKS/Belum Terbahas'
                                ];
                                ?>
                                <select name="kesepakatan" class="form-control" required>
                                    <option value="<?= $p_fkb->FKS ?>" selected>
                                        <?= $kesepakatanOptions[$p_fkb->FKS] ?? 'Pilih Jenis Program'; ?>
                                    </option>
                                    <?php foreach ($kesepakatanOptions as $value => $label): ?>
                                        <?php if ($value == $p_fkb->FKS) continue; ?>
                                        <option value="<?= $value; ?>"><?= $label; ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                        </div>
                    </div>
        </div>
        <div class="col-sm-12 text-center">
            <button type="submit" class="btn filter">Simpan</button>
        </div>
    </div>
    </form>
    </div>
<?php break;
endforeach ?>
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
        // $('#select-tematik, #select-ri, #select-fs, #select-dokling, #select-lahan, #select-ded, #select-pasca_kontruksi, #select-menerima_bantuan').select2();
        $('#select-tahun-pelaksanaan,  #select-kd_kegiatan, #select-kd_kro, #select-kd_ro, #select-kabkot, #select-prop, #select-kp, #select-satuan, #select-kawasan, #select-provinsi, #select-unor, #select-ri, #select-fs, #select-dokling, #select-lahan, #select-ded, #select-pasca_kontruksi, #select-menerima_bantuan, #select-sumber').select2();
        $('#select-tematik, #select-renc_induk, #select-fs, #select-dokling, #select-lahan, #select-ded, #select-pasca_kons, #select-terima_bantuan').select2();
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
        const volume = document.getElementById('volume');
        const biaya = document.getElementById('biaya');
        const rpm = document.getElementById('rpm');
        const phln = document.getElementById('phln');
        const sbsn = document.getElementById('sbsn');
        // Fungsi untuk memvalidasi input
        volume.addEventListener('input', function(e) {
            // Hanya karakter yang diizinkan: angka (0-9) dan titik (.)
            const value = e.target.value;

            // Mengganti input dengan hanya angka dan titik
            e.target.value = value.replace(/[^0-9.]/g, '');
        });
        biaya.addEventListener('input', function(e) {
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

        // Memformat value saat input dimuat
        biaya.value = formatAngka(biaya.value);


        // Event listener untuk memformat input saat pengguna mengetik
        biaya.addEventListener('input', function(e) {
            // Memformat angka setelah pengguna mengetik
            e.target.value = formatAngka(e.target.value);
        })


        document.getElementById('myForm').addEventListener('submit', function(e) {
            // Menghapus titik (pemisah ribuan) sebelum mengirimkan nilai

            biaya.value = biaya.value.replace(/\./g, ''); // Hapus titik

            // Form akan dikirim dengan nilai yang sudah diubah
        });
        $('#submitBtn').click(function(e) {
            e.preventDefault(); // cegah submit default

            const form = $('#myForm')[0];
            // const formData = new FormData(form);

            // Validasi HTML5
            if (form.checkValidity() === false) {
                form.reportValidity();
                return;
            }

            // Hapus titik di input biaya sebelum submit
            biaya.value = biaya.value.replace(/\./g, ''); // Hapus titik

            const formData = new FormData(form);

            // Jika sudah yakin, lanjut submit
            // Kirim pakai AJAX
            // $.ajax({
            //     url: "<?= base_url('/program/editFkb') ?>",
            //     method: "POST",
            //     data: formData,
            //     processData: false,
            //     contentType: false,
            //     success: function(res) {
            //         console.log(formData);
            //         swal({
            //             title: "Terima Kasih!",
            //             text: "Data berhasil diproses!",
            //             icon: "success"
            //         }).then(() => {
            //             // Redirect kalau perlu
            //             window.location.href = "<?= base_url('/program-konreg/fkb?desk=konreg') ?>";
            //         });
            //     },
            //     error: function(err) {
            //         swal({
            //             title: "Gagal!",
            //             text: "Terjadi kesalahan saat memproses data.",
            //             icon: "error"
            //         });
            //     }
            // });
        });

        $('#select-kd_kegiatan').on('change', function() {
            var kgiat = $(this).val(); // Ambil nilai kp yang dipilih
            console.log(kgiat);
            $.ajax({
                url: '<?= base_url('/Konreg/get_kro') ?>',
                type: 'POST',
                data: {
                    kgiat: kgiat
                },
                success: function(response) {
                    $('#select-kd_kro').empty();
                    $('#select-kd_kro').append('<option value="">-- Pilih KRO --</option>');
                    $('#select-kd_ro').empty();
                    $('#select-kd_ro').append('<option value="">-- Pilih RO --</option>');

                    $.each(response, function(index, kro) {
                        $('#select-kd_kro').append('<option value="' + kro.kdkro + '">' + kro.kdkro + '. ' + kro.nmkro + '</option>');
                    });
                },
                error: function() {
                    alert('Error loading data');
                }
            });
        });

        $('#select-kd_kro').on('change', function() {
            var kro = $(this).val(); // Ambil nilai kp yang dipilih
            console.log(kro);
            $.ajax({
                url: '<?= base_url('/Konreg/get_ro') ?>',
                type: 'POST',
                data: {
                    kro: kro
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
    });
</script>