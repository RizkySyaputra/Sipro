<style>
    /* Menjamin textarea tidak memiliki scrollbar */
    .form-control-tes {
        resize: none;
        overflow: hidden;
        min-height: 60px;
    }
</style>
<?php foreach ($usulan as $usulan) : ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-white" style="background-color: #222cb1;">
                <h4 style="text-align: center;">Detail Data Unor</h4>
            </div>
            <div class="card-body">
                <form action="/add_memorandum" method="POST">
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> Program Nasional</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="nama_pn" class="form-control" disabled value="<?= $usulan->nama_pn; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> Program Prioritas</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="nama_pp" class="form-control" disabled value="<?= $usulan->nama_pp; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> Kegiatan Prioritas</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="nama_kp" class="form-control" disabled value="<?= $usulan->nama_kp; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> Program Prioritas</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="nama_prop" class="form-control" disabled value="<?= $usulan->nama_prop; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> Nama Pekerjaan</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="nama_pekerjaan" class="form-control" disabled value="<?= $usulan->nama_pekerjaan; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Provinsi</strong></div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" disabled disabled value="<?= $usulan->provinsi; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">

                        <div class="col-sm-3 font-weight-bold"><strong>Unit Organisasi</strong></div>
                        <div class="col-sm-9">
                            <input type="hidden" name="id_unor" value="<?= $usulan->id_unor; ?>" />
                            <input type="text" disabled class="form-control" disabled id="id_unor" value="<?= $usulan->unor; ?>">
                            <!-- <span><?= $usulan->unor; ?></span> -->
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Kawasan Prioritas</strong></div>
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
                                    echo ' <input type="text" disabled class="form-control" id="id_unor" value="' . $i++ . $ii . $kawasan->nama_kawasan . '">';
                                    // echo $i++ . $ii . $kawasan->nama_kawasan . '<br>';
                                }
                                ?>

                            <?php else: ?>
                                Non Kawasan
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Lokasi</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="lokasi" class="form-control" disabled value="<?= $usulan->lokasi; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Justifikasi</strong></div>
                        <div class="col-sm-9">
                            <textarea name="justifikasi" class="form-control" disabled required><?= $usulan->justifikasi ?></textarea>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Kesiapan RC</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="rc" class="form-control" disabled value="<?= $usulan->rc; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Volume</strong></div>
                        <div class="col-sm-3 d-flex align-items-center">
                            <input type="text" id="volume" name="volume" class="form-control me-2" disabled value="<?= $usulan->volume; ?>" required>
                            <input type="text" id="volume" name="satuan" class="form-control me-2" disabled value="<?= $usulan->nama_satuan; ?>" required>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Anggaran (dalam ribu)</strong></div>
                        <div class="col-sm-9">
                            <input type="text" id="anggaran" name="anggaran" class="form-control" disabled value="<?= $usulan->anggaran; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Sumber Pendanaan</strong> </div>
                        <div class="col-sm-9">
                            <input type="text" id="anggaran" name="anggaran" class="form-control" disabled value="<?= $usulan->anggaran; ?>" required>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Sumber Pendanaan</strong></div>
                        <div class="col-sm-9">
                            <select name="id_pendanaan" class="form-control" required>
                                <option value="1" <?= $usulan->sumber_pendanaan == 'APBN' ? 'selected' : ''; ?>>APBN</option>
                                <option value="2" <?= $usulan->sumber_pendanaan == 'APBD' ? 'selected' : ''; ?>>APBD</option>
                                <option value="3" <?= $usulan->sumber_pendanaan == 'Swasta' ? 'selected' : ''; ?>>Swasta</option>
                            </select>
                        </div>
                    </div> -->

                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Major Project</strong> </div>
                        <div class="col-sm-9">
                            <select name="tagging_mp" id="list-mp" class="form-control" disabled>
                                <option selected value="<?= $usulan->id_mp; ?>"><?= $usulan->nama_mp; ?></option>

                            </select>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Kesiapn RI</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="ri" class="form-control" disabled value="<?= $usulan->ri; ?>" required>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Kesiapn FS</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="fs" class="form-control" disabled value="<?= $usulan->fs; ?>" required>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Kesiapn Dokling</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="dokling" class="form-control" disabled value="<?= $usulan->dokling; ?>" required>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Kesiapn DED</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="ded" class="form-control" disabled value="<?= $usulan->ded; ?>" required>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> Kesiapan Lahan</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="lahan" class="form-control" disabled value="<?= $usulan->lahan; ?>" required>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Kesiapn Pasca Konstruksi</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="pasca_kontruksi" class="form-control" disabled value="<?= $usulan->pasca_kontruksi; ?>" required>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> Kesiapan Menerima Bantuan</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="menerima_bantuan" class="form-control" disabled value="<?= $usulan->menerima_bantuan; ?>" required>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Tahun Anggaran</strong></div>
                        <div class="col-sm-9">
                            <input type="hidden" name="tahun_anggaran" value="2026" />
                            <input type="text" class="form-control" disabled value="2026">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 text-center">

                            <a href="/listUsulan" class="btn filter"> Kembali</a>
                            <!-- <button type="submit" class="btn filter" onclick='swal({ title:"Terima Kasih!", text: "Data Berhasil disimpan !", type: "success", buttonsStyling: false, confirmButtonClass: "btn btn-success"})'>Simpan</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php endforeach ?>


<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
<script src="https://unpkg.com/leaflet-measure/dist/leaflet-measure.js"></script>
<script>
    $(document).ready(function() {

        function autoResize(textarea) {
            textarea.style.height = "auto"; // Reset tinggi sebelum menyesuaikan
            textarea.style.height = (textarea.scrollHeight) + "px"; // Menyesuaikan tinggi dengan konten
        }



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


        // Fungsi untuk memvalidasi input
        input2.addEventListener('input', function(e) {
            // Hanya karakter yang diizinkan: angka (0-9)
            const value = e.target.value;

            // Mengganti input dengan hanya angka dan titik
            e.target.value = value.replace(/[^0-9]/g, '');
        });
    });
</script>