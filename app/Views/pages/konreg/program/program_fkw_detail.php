<?php

foreach ($p_fkw as $p_fkw) : ?>
    <div class="container mt-5">
        <div class="card">
            <form action="<?= base_url('/program-konreg/fkw') ?>" method="get" id="myForm">
                <!-- <form action="#" method="post" id="myForm"> -->

                <div class="card-header bg-primary text-white">
                    <h4 style="text-align: center;"> Detail Pekerjaan FKW </h4>
                </div>
                <div class="card-body">
					<div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Tahun diusulkan</div>
                        <div class="col-sm-9">
                            <?= $p_fkw->tahun_diusulkan; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Provinsi</div>
                        <div class="col-sm-9"><?= $p_fkw->provinsi; ?></div>
                    </div>
					<div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Kabupaten Kota</div>
                        <div class="col-sm-9">
							<?= $p_fkw->kab_kot; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Unit Organisasi</div>
                        <div class="col-sm-9"><?= $p_fkw->unor; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Program</div>
                        <div class="col-sm-9">
                            <?= $p_fkw->kd_prog . " " . $p_fkw->nmprogram; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Kegiatan</div>
                        <div class="col-sm-9">
                            <?= $p_fkw->kd_kgiat . " " . $p_fkw->nmgiat; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">KRO</div>
                        <div class="col-sm-9">
                            <?= $p_fkw->kd_kro . " " . $p_fkw->nmkro; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">RO</div>
                        <div class="col-sm-9">
                            <?= $p_fkw->kd_ro . " " . $p_fkw->nmro; ?>
                        </div>
                    </div>
					<div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Nama Pekerjaan</div>
                        <div class="col-sm-9">
                            <?= $p_fkw->pekerjaan; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Lokasi</div>
                        <div class="col-sm-9"><?= $p_fkw->lokasi; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Volume</div>
                        <div class="col-sm-3 d-flex align-items-center">
                            <?= $p_fkw->volume . " " . $p_fkw->nama_satuan; ?>
                        </div>
                        <!-- </div> -->
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">RPM (Rp Ribu)</div>
                        <div class="col-sm-9">
                            <?php $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                            echo $format->formatCurrency($p_fkw->rpm, 'IDR'); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">PHLN (Rp Ribu)</div>
                        <div class="col-sm-9">
                            <?php $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                            echo $format->formatCurrency($p_fkw->phln, 'IDR'); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">SBSN (Rp Ribu)</div>
                        <div class="col-sm-9">
                            <?php $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                            echo $format->formatCurrency($p_fkw->sbsn, 'IDR'); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Anggaran (Rp Ribu)</div>
                        <div class="col-sm-9">
                            <?php $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                            echo $format->formatCurrency($p_fkw->anggaran, 'IDR'); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Tahun Pelaksanaan</div>
                        <div class="col-sm-9">
                            <?= $p_fkw->waktu_pelaksanaan; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Sumber Data</div>
                        <div class="col-sm-9">
                            <?= $p_fkw->sumber; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Sumber Pendanaan</div>
                        <div class="col-sm-9">
                            <?= $p_fkw->sumber_pendanaan; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Catatan</div>
                        <div class="col-sm-9">
                            <?= $p_fkw->catatan; ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Tematik</div>
                        <div class="col-sm-3 d-flex align-items-center">
                            <?= $p_fkw->tematik; ?>
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
                            <?= $p_fkw->catatan_desk; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Kesepakatan</div>
                        <div class="col-sm-9">
                            <?php
                            if ($p_fkw->FKS == 0) {
                                echo '<span class="badge badge-pill badge-secondary">Non FKS/Belum Terbahas</span>';
                            } elseif ($p_fkw->FKS == 1) {
                                echo '<span class="badge badge-pill badge-primary">FKS</span>';
                            } elseif ($p_fkw->FKS == 2) {
                                echo '<span class="badge badge-pill badge-warning">Ditangguhkan</span>';
                            }
                            ?>
                        </div>
                    </div>
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