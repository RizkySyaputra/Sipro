<?php

foreach ($p_fkb as $p_fkb) : ?>
    <div class="container mt-5">
        <div class="card">
            <form action="<?= base_url('/unor/fkb') ?>" method="get" id="myForm">
                <!-- <form action="#" method="post" id="myForm"> -->

                <div class="card-header bg-primary text-white">
                    <h4 style="text-align: center;"> Detail Pekerjaan FKB </h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Nama Pekerjaan</div>
                        <div class="col-sm-9">
                            <?= $p_fkb->pekerjaan; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Provinsi</div>
                        <div class="col-sm-9"><?= $p_fkb->provinsi; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Unit Organisasi</div>
                        <div class="col-sm-9"><?= $p_fkb->unor; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Program</div>
                        <div class="col-sm-9">
                            <?= $p_fkb->kd_prog . " " .  $p_fkb->nmprogram; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Kegiatan</div>
                        <div class="col-sm-9">
                            <?= $p_fkb->kd_kgiat . " " . $p_fkb->nmgiat; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">KRO</div>
                        <div class="col-sm-9">
                            <?= $p_fkb->kd_kro . " " . $p_fkb->nmkro; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">RO</div>
                        <div class="col-sm-9">
                            <?= $p_fkb->kd_ro .  " " . $p_fkb->nmro; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Tahun diusulkan</div>
                        <div class="col-sm-9">
                            <?= $p_fkb->tahun_diusulkan; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Lokasi</div>
                        <div class="col-sm-9"><?= $p_fkb->lokasi; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Volume</div>
                        <div class="col-sm-3 d-flex align-items-center">
                            <?= $p_fkb->volume . " " . $p_fkb->nama_satuan; ?>
                        </div>
                        <!-- </div> -->
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Anggaran (Rp Ribu)</div>
                        <div class="col-sm-9">
                            <?php $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                            echo $format->formatCurrency($p_fkb->anggaran, 'IDR'); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Sumber Pendanaan</div>
                        <div class="col-sm-9">
                            <?= $p_fkb->sumber_pendanaan; ?>
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
                            <div class="col-sm-3 font-weight-bold"><?= $label; ?></div>
                            <div class="col-sm-9">
                                <?= $p_fkb->$field; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Tematik</div>
                        <div class="col-sm-3 d-flex align-items-center">
                            <?= $p_fkb->tematik; ?>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn filter" id="submitBtn">Kembali</button>
                </div>
        </div>
        </form>
    </div>
<?php break;
endforeach ?>

<script>
    $(document).ready(function() {
        // $('#select-tematik, #select-ri, #select-fs, #select-dokling, #select-lahan, #select-ded, #select-pasca_kontruksi, #select-menerima_bantuan').select2();
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
        // Sebelum form disubmit, hapus pemisah ribuan
        document.getElementById('myForm').addEventListener('submit', function(e) {
            // Menghapus titik (pemisah ribuan) sebelum mengirimkan nilai
            const biayaInput = document.getElementById('biaya');
            biayaInput.value = biayaInput.value.replace(/\./g, ''); // Hapus titik

            // Form akan dikirim dengan nilai yang sudah diubah
        });
    });
</script>