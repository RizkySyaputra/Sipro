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
                <form action="<?= base_url('UsulanProvinsi/add_catatan') ?>" method="POST">
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> PN</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="nama_pn" class="form-control" disabled value="<?= $usulan->id_pn . " " . $usulan->nama_pn; ?>" required>
                            <input type="text" name="id" class="form-control" value="<?= $usulan->id_usulan; ?>" hidden>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> PP</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="nama_pp" class="form-control" disabled value="<?= $usulan->id_pp . " " . $usulan->nama_pp; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> KP</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="nama_kp" class="form-control" disabled value="<?= $usulan->id_kp . " " . $usulan->nama_kp; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> PROP</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="nama_prop" class="form-control" disabled value="<?= $usulan->id_prop . " " . $usulan->nama_prop; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">

                        <div class="col-sm-3 font-weight-bold"><strong>Sektor</strong></div>
                        <div class="col-sm-9">
                            <input type="hidden" name="id_unor" value="<?= $usulan->id_unor; ?>" />
                            <input type="text" disabled class="form-control" disabled id="id_unor" value="<?= $usulan->unor; ?>">
                            <!-- <span><?= $usulan->unor; ?></span> -->
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> Kegiatan</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="nama_prop" class="form-control" disabled value="<?= $usulan->nmgiat; ?>" required>
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> KRO</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="nama_prop" class="form-control" disabled value="<?= $usulan->nmkro; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> RO</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="nama_prop" class="form-control" disabled value="<?= $usulan->nmro; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Provinsi</strong></div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" disabled disabled value="<?= $usulan->provinsi; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Kabupaten / Kota</strong></div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" disabled disabled value="<?= $usulan->kab_kot; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Kawasan Prioritas</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="lokasi" class="form-control" disabled value="<?= $usulan->nama_kawasan; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> Nama Pekerjaan</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="nama_pekerjaan" class="form-control" disabled value="<?= $usulan->nama_pekerjaan; ?>" required>
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
                            <input type="text" id="anggaran" name="anggaran" hidden class="form-control" disabled value="<?= $usulan->anggaran; ?>" required>
                            <input type="text" id="" name="" class="form-control" disabled value=" <?php $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                                                                                                    echo $format->formatCurrency($usulan->anggaran, 'IDR'); ?>">

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Sumber Pendanaan</strong> </div>
                        <div class="col-sm-9">
                            <input type="text" id="anggaran" name="anggaran" hidden class="form-control" disabled value="<?= $usulan->id_pendanaan; ?>" required>
                            <input type="text" id="" name="" class="form-control" disabled value="<?= $usulan->sumber_pendanaan; ?>" required>
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
                        <div class="col-sm-3 font-weight-bold"><strong>Kesiapan RI</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="ri" class="form-control" disabled value="<?= $usulan->ri; ?>" required>
                        </div>
                    </div>
                    <?php if (!empty($usulan->ri_dokumen)) : ?>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">
                                <strong> Dokumen Kesiapan RI</strong>
                            </div>
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-sm btn-primary" onclick="previewPDF('<?= base_url('uploads/usulan_dokumen/' . $usulan->ri_dokumen) ?>')">
                                    Preview Dokumen
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Kesiapan FS</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="fs" class="form-control" disabled value="<?= $usulan->fs; ?>" required>
                        </div>
                    </div>
                    <?php if (!empty($usulan->fs_dokumen)) : ?>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">
                                <strong> Dokumen Kesiapan FS</strong>
                            </div>
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-sm btn-primary" onclick="previewPDF('<?= base_url('uploads/usulan_dokumen/' . $usulan->fs_dokumen) ?>')">
                                    Preview Dokumen
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Kesiapn Dokling</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="dokling" class="form-control" disabled value="<?= $usulan->dokling; ?>" required>
                        </div>
                    </div>
                    <?php if (!empty($usulan->dokling_dokumen)) : ?>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">
                                <strong> Dokumen Kesiapn Dokling</strong>
                            </div>
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-sm btn-primary" onclick="previewPDF('<?= base_url('uploads/usulan_dokumen/' . $usulan->dokling_dokumen) ?>')">
                                    Preview Dokumen
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Kesiapn DED</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="ded" class="form-control" disabled value="<?= $usulan->ded; ?>" required>
                        </div>
                    </div>
                    <?php if (!empty($usulan->ded_dokumen)) : ?>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">
                                <strong> Dokumen Kesiapn DED</strong>
                            </div>
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-sm btn-primary" onclick="previewPDF('<?= base_url('uploads/usulan_dokumen/' . $usulan->ded_dokumen) ?>')">
                                    Preview Dokumen
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> Kesiapan Lahan</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="lahan" class="form-control" disabled value="<?= $usulan->lahan; ?>" required>

                        </div>
                    </div>
                    <?php if (!empty($usulan->lahan_dokumen)) : ?>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">
                                <strong> Dokumen Kesiapn Lahan</strong>
                            </div>
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-sm btn-primary" onclick="previewPDF('<?= base_url('uploads/usulan_dokumen/' . $usulan->lahan_dokumen) ?>')">
                                    Preview Dokumen
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Kesiapn Pasca Konstruksi</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="pasca_kontruksi" class="form-control" disabled value="<?= $usulan->pasca_kontruksi; ?>" required>
                        </div>
                    </div>
                    <?php if (!empty($usulan->pasca_kontruksi_dokumen)) : ?>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">
                                <strong> Dokumen Kesiapn Pasca Konstruksi</strong>
                            </div>
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-sm btn-primary" onclick="previewPDF('<?= base_url('uploads/usulan_dokumen/' . $usulan->pasca_kontruksi_dokumen) ?>')">
                                    Preview Dokumen
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong> Kesiapan Menerima Bantuan</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="menerima_bantuan" class="form-control" disabled value="<?= $usulan->menerima_bantuan; ?>" required>
                        </div>
                    </div>
                    <?php if (!empty($usulan->menerima_bantuan_dokumen)) : ?>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">
                                <strong> Dokumen Kesiapn Menerima Bantuan</strong>
                            </div>
                            <div class="col-sm-9">
                                <button type="button" class="btn btn-sm btn-primary" onclick="previewPDF('<?= base_url('uploads/usulan_dokumen/' . $usulan->menerima_bantuan_dokumen) ?>')">
                                    Preview Dokumen
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Tahun Anggaran</strong></div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" disabled value="<?= $usulan->tahun_pengerjaan; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Catatan Unor</strong></div>
                        <div class="col-sm-9">
                            <textarea name="catatan_unor" class="form-control" <?= (user()->id_unor) ? "" : "Disabled"; ?> required><?= $usulan->catatan_unor ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 text-right">
                            <a href="<?= base_url('/listUsulan') ?>" class="btn filter"> Kembali</a>
                            <?php if (!empty(user()->id_unor)) : ?>
                                <button type="submit" class="btn filter" onclick='swal({ title:"Terima Kasih!", text: "Data Berhasil disimpan !", type: "success", buttonsStyling: false, confirmButtonClass: "btn btn-success"})'>Simpan Catatan</button>
                            <?php endif; ?>
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

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
<script src="https://unpkg.com/leaflet-measure/dist/leaflet-measure.js"></script>
<script>
    function previewPDF(url) {
        document.getElementById('pdfViewer').src = url;
        $('#pdfPreviewModal').modal('show');
    }
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