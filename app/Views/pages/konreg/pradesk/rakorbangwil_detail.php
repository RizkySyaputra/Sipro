<?php

foreach ($p_memo as $p_memo) : ?>
    <div class="container mt-5">
        <div class="card">
            <form action="" method="" id="myForm">
                <!-- <form action="#" method="post" id="myForm"> -->
                <input type="text" name="id_provinsi" value="<?= $p_memo->id_provinsi; ?>" hidden>
                <input type="text" name="jenis_data" value="<?= $jenis_data ?>" hidden>
                <input type="text" name="id_mprogram" value=" <?= $p_memo->id_mprogram; ?>" hidden>
                <input type="text" name="id_unor" value="<?= $p_memo->id_unor; ?>" hidden>
                <input type="text" name="nama_program" value="<?= $p_memo->nama_program; ?>" hidden>
                <input type="text" name="id_kawasan" value="<?= $p_memo->kode_kawasan; ?>" hidden>
                <input type="text" name="lokasi" value="<?= $p_memo->lokasi; ?>" hidden>
                <input type="text" name="anggaran" value="<?= $p_memo->biaya; ?>" hidden>
                <input type="text" name="id_pembiayaan" value="<?= $p_memo->id_pendanaan; ?>" hidden>
                <input type="text" name="catatan_desk" value="<?= $p_memo->catatan_desk2; ?>" hidden>
                <input type="text" name="kd_prog" value="<?= $p_memo->kdprogram; ?>" hidden>
                <div class="card-header bg-primary text-white">
                    <h4 style="text-align: center;"> Detail Kegiatan </h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Nama Program</div>
                        <div class="col-sm-9">
                            <?= $p_memo->nama_program; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Provinsi</div>
                        <div class="col-sm-9"><?= $p_memo->provinsi; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Unit Organisasi</div>
                        <div class="col-sm-9"><?= $p_memo->unor; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Kawasan Prioritas</div>
                        <div class="col-sm-9">
                            <?php if (isset($kawasans)): ?>
                                <?php
                                $rows = count($kawasans);
                                if ($rows > 1) {
                                    $i = 1;
                                    $ii = '.';
                                } else {
                                    $i = '';
                                    $ii = '';
                                }
                                foreach ($kawasans as $kawasan) {
                                    echo $i++ . $ii . $kawasan->nama_kawasan . '<br>';
                                }
                                ?>
                            <?php else: ?>
                                Non Kawasan
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Lokasi</div>
                        <div class="col-sm-9"><?= $p_memo->lokasi; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Justifikasi</div>
                        <div class="col-sm-9"><?= $p_memo->justifikasi; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Kesiapan RC</div>
                        <div class="col-sm-9">
                            <?= $p_memo->kesiapan_rc; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Volume</div>
                        <div class="col-sm-9"><?= in_array($jenis_data, ['fkw', 'fkb']) ? $konreg->volume :  $p_memo->volume;
                                                echo " " . $p_memo->nama_satuan; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Anggaran (Rp Ribu)</div>
                        <div class="col-sm-9"><?php $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                                                echo $format->formatCurrency(in_array($jenis_data, ['fkw', 'fkb']) ? $konreg->anggaran : $p_memo->biaya, 'IDR'); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Sumber Pendanaan</div>
                        <div class="col-sm-9">
                            <?= $p_memo->sumber_pendanaan; ?>
                        </div>
                        <!-- <div class="col-sm-9"><?= $p_memo->sumber_pendanaan; ?></div> -->
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Kategori</div>
                        <div class="col-sm-9"><?= $p_memo->nama_mp; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Sumber Data</div>
                        <div class="col-sm-9"><?= $p_memo->source_data; ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Catatan BPIW</div>
                        <div class="col-sm-9">
                            <?= $p_memo->catatan_bpiw == '' ? 'Tidak Ada' : $p_memo->catatan_bpiw; ?>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Catatan Unor</div>
                        <div class="col-sm-9">
                            <?= $p_memo->catatan_unor == '' ? 'Tidak Ada' : $p_memo->catatan_unor; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Catatan Desk</div>
                        <div class="col-sm-9">
                            <?= $p_memo->catatan_desk2; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Kesepakatan</div>
                        <div class="col-sm-9">
                            <?= $p_memo->desk2 == '1' ? 'Diakomodasi' : 'Ditangguhkan'; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Program</div>
                        <div class="col-sm-9">
                            <?= $p_memo->nmprogram; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Kode Kegiatan</div>
                        <div class="col-sm-9">
                            <?= in_array($jenis_data, ['fkw', 'fkb']) ? $konreg->kd_kgiat . " " . $konreg->nmgiat : "" ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">KRO</div>
                        <div class="col-sm-9">
                            <?= in_array($jenis_data, ['fkw', 'fkb']) ? $konreg->kd_kro . " " . $konreg->nmkro : "" ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">RO</div>
                        <div class="col-sm-9">
                            <?= in_array($jenis_data, ['fkw', 'fkb']) ? $konreg->kd_ro . " " . $konreg->nmro : "" ?>
                        </div>
                    </div>
                    <?php if ($jenis_data != 'fkw') : ?>
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
                                <div class="col-sm-9">
                                    <?= ($jenis_data == 'fkb') ? $konreg->$field : "" ?>
                                </div>

                                <!-- <div class="col-sm-9">
                                <select name="<?= $field ?>" class="form-control kesiapan-dropdown" data-target="<?= $field ?>" id="select-<?= $field ?>" disabled required>
                                    <option value="<?= ($jenis_data == 'fkb') ? $konreg->$field : "" ?>" <?= ($jenis_data == 'fkb') ? "" : "disabled" ?> selected><?= ($jenis_data == 'fkb') ? $konreg->$field : "-- Pilih --" ?></option>
                                    <option value="Siap">Siap</option>
                                    <option value="Mei 2025">Mei 2025</option>
                                    <option value="Juni 2025">Juni 2025</option>
                                    <option value="Juli 2025">Juli 2025</option>
                                    <option value="Agustus 2025">Agustus 2025</option>
                                    <option value="September 2025">September 2025</option>
                                    <option value="Oktober 2025">Oktober 2025</option>
                                    <option value="Belum Siap">Belum Siap</option>
                                    <option value="Tidak Perlu">Tidak Perlu</option>
                                </select>
                            </div> -->
                            </div>
                            <!-- Form Upload, disembunyikan dulu -->
                            <div class="row mb-3 upload-<?= $field ?>" style="display: none;">
                                <div class="col-sm-3 font-weight-bold"><strong>Upload Dokumen <?= $label ?></strong></div>
                                <div class="col-sm-9">
                                    <input type="file" name="file_<?= $field ?>" class="form-control-file">
                                </div>
                            </div>
                        <?php endforeach; ?>

                    <?php endif; ?>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Tematik</div>
                        <div class="col-sm-9">
                            <?= in_array($jenis_data, ['fkw', 'fkb']) ? $konreg->tematik : "" ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Catatan PraDesk</div>
                        <div class="col-sm-9">
                            <?= in_array($jenis_data, ['fkw', 'fkb']) ? $konreg->catatan_pradesk : "" ?>
                        </div>
                    </div>

                    <?php if (!in_array($jenis_data, ['fkw', 'fkb'])): ?>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Jenis Program</div>
                            <div class="col-sm-9">
                                <select name="jenis_program" class="form-control" required>
                                    <option value="" disabled selected>Pilih Jenis Program</option>
                                    <option value="FKW">FKW</option>
                                    <option value="FKB">FKB</option>
                                    <option value="FKB1">FKB Dengan Catatan</option>
                                    <option value="ditangguhkan">Ditangguhkan</option>
                                </select>
                            </div>
                            <!-- <div class="col-sm-9"><?= $p_memo->sumber_pendanaan; ?></div> -->
                        </div>
                    <?php endif ?>
                </div>
                <div class="col-sm-12 text-center">
                    <a href="<?= base_url("/daftarRakorbangwil") ?>"> <button type="button" class="btn filter">Kembali </button></a>
                </div>
        </div>
        </form>
    </div>
<?php break;
endforeach ?>

<script>
    $(document).ready(function() {
        // $('#select-tematik, #select-ri, #select-fs, #select-dokling, #select-lahan, #select-ded, #select-pasca_kontruksi, #select-menerima_bantuan').select2();
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
            const biayaInput = document.getElementById('biaya');
            biayaInput.value = biayaInput.value.replace(/\./g, '');

            const formData = new FormData(form);

            // Jika sudah yakin, lanjut submit
        });


        function validasiInput(e) {
            let value = e.target.value;

            // Hanya angka dan titik yang diizinkan
            value = value.replace(/[^0-9.]/g, '');

            // Menghindari lebih dari satu titik
            if ((value.match(/\./g) || []).length > 1) {
                value = value.replace(/\./g, '');
            };

            // Update nilai input
            e.target.value = value;
        }

        // Menambahkan event listener untuk input
        volume.addEventListener('input', validasiInput);

        function formatAngka(value) {
            // Menghapus semua karakter non-digit
            value = value.replace(/\D/g, '');

            // Memformat angka dengan pemisah ribuan (titik)
            return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Mendapatkan elemen input
        const input = document.getElementById('biaya');

        // Memformat value saat input dimuat
        input.value = formatAngka(input.value);

        // Event listener untuk memformat input saat pengguna mengetik
        input.addEventListener('input', function(e) {
            // Memformat angka setelah pengguna mengetik
            e.target.value = formatAngka(e.target.value);
        })

    });
</script>