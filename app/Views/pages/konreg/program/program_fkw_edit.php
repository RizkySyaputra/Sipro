<?php

foreach ($p_fkw as $p_fkw) : ?>
    <div class="container mt-5">
        <div class="card">
            <form action="" method="" id="myForm">
                <!-- <form action="#" method="post" id="myForm"> -->

                <div class="card-header bg-primary text-white">
                    <h4 style="text-align: center;"> Pembahasan Pekerjaan FKW </h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Nama Pekerjaan</div>
                        <div class="col-sm-9">
                            <input type="text" name="id_fkw" class="form-control" value="<?= $p_fkw->id_fkw; ?>" hidden>
                            <input type="text" name="nama_pekerjaan" class="form-control" value="<?= $p_fkw->pekerjaan; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Provinsi</div>
                        <div class="col-sm-9"><?= $p_fkw->provinsi; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Kabupaten Kota</strong></div>
                        <div class="col-sm-9">
                            <select name="id_kabkot" class="form-control" id="select-kabkot">
                                <?php if (isset($p_fkw->kode_kabkot)): ?>
                                    <option value="<?= $p_fkw->kode_kabkot ?>" selected><?= $p_fkw->kab_kot ?></option>
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
                        <div class="col-sm-9"><?= $p_fkw->unor; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Program</div>
                        <div class="col-sm-9"><?= $p_fkw->kd_prog . " - " . $p_fkw->nmprogram ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Kode Kegiatan </div>
                        <div class="col-sm-9">
                            <select name="kd_kgiat" class="form-control" id="select-kd_kegiatan" required>
                                <option value="<?= $p_fkw->kd_kgiat ?>" selected> <?= $p_fkw->kd_kgiat . " - " . $p_fkw->nmgiat ?></option>
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
                                <option value="<?= $p_fkw->kd_kro ?>" selected> <?= $p_fkw->kd_kro . " - " . $p_fkw->nmkro; ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">RO</div>
                        <div class="col-sm-9">
                            <select name="kd_ro" class="form-control" id="select-kd_ro" required>
                                <option value="<?= $p_fkw->kd_ro ?>" selected> <?= $p_fkw->kd_ro . " - " . $p_fkw->nmro; ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Tahun diusulkan</div>
                        <div class="col-sm-9"><?= $p_fkw->tahun_diusulkan; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Lokasi</div>
                        <div class="col-sm-9">
                            <input type="text" name="lokasi" class="form-control" value="<?= $p_fkw->lokasi; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Volume</div>
                        <div class="col-sm-3 d-flex align-items-center">
                            <input type="text" id="volume" name="volume" class="form-control me-2" value="<?= $p_fkw->volume; ?>" required>
                            <select name="id_satuan" class="form-control" id="select-satuan">
                                <option selected value="<?= $p_fkw->id_satuan; ?>"><?= $p_fkw->nama_satuan; ?></option>

                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">RPM (dalam ribu)</div>
                        <div class="col-sm-9">
                            <input type="text" id="rpm" name="rpm" class="form-control" value="<?= $p_fkw->rpm; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">PHLN (dalam ribu)</div>
                        <div class="col-sm-9">
                            <input type="text" id="phln" name="phln" class="form-control" value="<?= $p_fkw->phln; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">SBSN (dalam ribu)</div>
                        <div class="col-sm-9">
                            <input type="text" id="sbsn" name="sbsn" class="form-control" value="<?= $p_fkw->sbsn; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Anggaran (dalam ribu)</div>
                        <div class="col-sm-9">
                            <input type="text" id="biaya" name="anggaran" class="form-control" value="<?= $p_fkw->anggaran; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Waktu Pelaksanaan</div>
                        <div class="col-sm-9">
                            <?php $tahunList = [2026, 2027, 2028, 2029]; ?>
                            <select name="tahun_pengerjaan" class="form-control tahun-pelaksanaan-dropdown" id="select-tahun-pelaksanaan" required>
                                <option selected value="<?= $p_fkw->waktu_pelaksanaan; ?>">
                                    <?= $p_fkw->waktu_pelaksanaan; ?>
                                </option>
                                <?php foreach ($tahunList as $tahun) : ?>
                                    <?php if ($tahun == $p_fkw->waktu_pelaksanaan) continue; ?>
                                    <option value="<?= $tahun; ?>"><?= $tahun; ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Sumber Data</div>
                        <div class="col-sm-9"><?= $p_fkw->sumber; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Sumber Pendanaan</div>
                        <div class="col-sm-9">
                            <select name="id_pendanaan" class="form-control" required>
                                <option value="1" <?= $p_fkw->sumber_pendanaan == 'APBN' ? 'selected' : ''; ?>>APBN</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Catatan</div>
                        <div class="col-sm-9"><?= $p_fkw->catatan; ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Tematik</div>
                        <div class="col-sm-9">
                            <select name="id_tematik" class="form-control" id="select-tematik">
                                <option value="<?= $p_fkw->id_tematik ?>" selected> <?= $p_fkw->id_tematik . ". " . $p_fkw->tematik ?></option>
                                <?php foreach ($tematik as $tematiks) : ?>
                                    <?php if ($tematiks["id_tematik"] == $p_fkw->id_tematik) {
                                        continue;
                                    } ?>
                                    <option value="<?= $tematiks["id_tematik"]; ?>"><?= $tematiks["id_tematik"] . ". " . $tematiks["tematik"]; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Catatan PraDesk</div>
                        <div class="col-sm-9">
                            <?= $p_fkw->catatan_pradesk; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Catatan Desk</div>
                        <div class="col-sm-9">
                            <textarea type="text" name="catatan_desk" class="form-control" required><?= $p_fkw->catatan_desk ?></textarea>
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
                                <option value="<?= $p_fkw->FKS ?>" selected>
                                    <?= $kesepakatanOptions[$p_fkw->FKS] ?? 'Pilih Jenis Program'; ?>
                                </option>
                                <?php foreach ($kesepakatanOptions as $value => $label): ?>
                                    <?php if ($value == $p_fkw->FKS) continue; ?>
                                    <option value="<?= $value; ?>"><?= $label; ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>
                </div>
        </div>
        <div class="col-sm-12 text-center">
            <button type="submit" class="btn filter" id="submitBtn">Simpan</button>
        </div>
    </div>
    </form>
    </div>
<?php break;
endforeach ?>


<script>
    $(document).ready(function() {
        // $('#select-tematik, #select-ri, #select-fs, #select-dokling, #select-lahan, #select-ded, #select-pasca_kontruksi, #select-menerima_bantuan').select2();
        $('#select-tahun-pelaksanaan, #select-kd_kegiatan, #select-kd_kro, #select-kd_ro, #select-kabkot, #select-prop, #select-kp, #select-satuan, #select-kawasan, #select-provinsi, #select-unor, #select-ri, #select-fs, #select-dokling, #select-lahan, #select-ded, #select-pasca_kontruksi, #select-menerima_bantuan, #select-sumber').select2();
        $('#select-tematik, #select-ri, #select-fs, #select-dokling, #select-lahan, #select-ded, #select-pasca_kontruksi, #select-menerima_bantuan').select2();
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
        rpm.addEventListener('input', function(e) {
            // Hanya karakter yang diizinkan: angka (0-9) dan titik (.)
            const value = e.target.value;

            // Mengganti input dengan hanya angka dan titik
            e.target.value = value.replace(/[^0-9.]/g, '');
        });
        phln.addEventListener('input', function(e) {
            // Hanya karakter yang diizinkan: angka (0-9) dan titik (.)
            const value = e.target.value;

            // Mengganti input dengan hanya angka dan titik
            e.target.value = value.replace(/[^0-9.]/g, '');
        });
        sbsn.addEventListener('input', function(e) {
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
        sbsn.value = formatAngka(sbsn.value);
        phln.value = formatAngka(phln.value);
        rpm.value = formatAngka(rpm.value);

        // Event listener untuk memformat input saat pengguna mengetik
        biaya.addEventListener('input', function(e) {
            // Memformat angka setelah pengguna mengetik
            e.target.value = formatAngka(e.target.value);
        })
        sbsn.addEventListener('input', function(e) {
            // Memformat angka setelah pengguna mengetik
            e.target.value = formatAngka(e.target.value);
        })
        phln.addEventListener('input', function(e) {
            // Memformat angka setelah pengguna mengetik
            e.target.value = formatAngka(e.target.value);
        })
        rpm.addEventListener('input', function(e) {
            // Memformat angka setelah pengguna mengetik
            e.target.value = formatAngka(e.target.value);
        })

        document.getElementById('myForm').addEventListener('submit', function(e) {
            // Menghapus titik (pemisah ribuan) sebelum mengirimkan nilai

            biaya.value = biaya.value.replace(/\./g, ''); // Hapus titik
            sbsn.value = sbsn.value.replace(/\./g, ''); // Hapus titik
            phln.value = phln.value.replace(/\./g, ''); // Hapus titik
            rpm.value = rpm.value.replace(/\./g, ''); // Hapus titik
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
            sbsn.value = sbsn.value.replace(/\./g, ''); // Hapus titik
            phln.value = phln.value.replace(/\./g, ''); // Hapus titik
            rpm.value = rpm.value.replace(/\./g, '');

            const formData = new FormData(form);

            // Jika sudah yakin, lanjut submit
            // Kirim pakai AJAX
            $.ajax({
                url: "<?= base_url('/program/editFkw') ?>",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    console.log(formData);
                    swal({
                        title: "Terima Kasih!",
                        text: "Data berhasil diproses!",
                        icon: "success"
                    }).then(() => {
                        // Redirect kalau perlu
                        window.location.href = "<?= base_url('/program-konreg/fkw?desk=konreg') ?>";
                    });
                },
                error: function(err) {
                    swal({
                        title: "Gagal!",
                        text: "Terjadi kesalahan saat memproses data.",
                        icon: "error"
                    });
                }
            });
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