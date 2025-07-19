<?php

foreach ($program as $program) : ?>
    <div class="container mt-5">
        <div class="card">
            <form action="<?= base_url('/Rakortek') ?>" method="get" id="myForm">
                <!-- <form action="#" method="post" id="myForm"> -->

                <div class="card-header bg-primary text-white">
                    <h4 style="text-align: center;"> Detail Program Rakortek </h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">PN (Prioritas Nasional)</div>
                        <div class="col-sm-9">
                            <?= $program->id_pn . " - " . $program->nama_pn; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">PP (Program Prioritas)</div>
                        <div class="col-sm-9">
                            <?= $program->id_pp . " - " .  $program->nama_pp; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">KP (Kegiatan Prioritas)
                        </div>
                        <div class="col-sm-9">
                            <?= $program->id_kp . " - " . $program->nama_kp; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">ProP (Proyek Prioritas)
                        </div>
                        <div class="col-sm-9">
                            <?= $program->id_prop . " - " . $program->nama_prop; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Nama Pekerjaan</div>
                        <div class="col-sm-9">
                            <?= $program->usulan; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Provinsi</div>
                        <div class="col-sm-9"><?= $program->provinsi; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Unit Organisasi</div>
                        <div class="col-sm-9"><?= $program->unor; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Program</div>
                        <div class="col-sm-9"> - </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Kegiatan</div>
                        <div class="col-sm-9"> - </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">KRO</div>
                        <div class="col-sm-9"> - </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">RO</div>
                        <div class="col-sm-9"> - </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Tahun diusulkan</div>
                        <div class="col-sm-9"> - </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Lokasi</div>
                        <div class="col-sm-9"> - </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Volume</div>
                        <div class="col-sm-3 d-flex align-items-center">
                            <?= $program->volume_rakortek . " " . $program->nama_satuan; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Biaya (dalam ribu)</div>
                        <div class="col-sm-9">
                            <?php $format = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
                            echo $format->formatCurrency($program->alokasi_usulan, 'IDR'); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Tematik</div>
                        <div class="col-sm-3 d-flex align-items-center">
                            <?= $program->tematik; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Kesepakatan</div>
                        <div class="col-sm-9"> <?php if ($program->approval_rakortek == 4) {
                                                    echo "Tidak terbahas";
                                                } elseif ($program->approval_rakortek == 1) {
                                                    echo "Direkomendasikan";
                                                } elseif ($program->approval_rakortek == 2) {
                                                    echo "Tidak Direkomendasikan";
                                                } elseif ($program->approval_rakortek == 3) {
                                                    echo "Direkomendasikan dengan catatan";
                                                } else {
                                                    echo "Status tidak diketahui";
                                                } ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Catatan</div>
                        <div class="col-sm-9"> <?= $program->note_rakortek; ?> </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold">Catatan Pembahasan Rakortek</div>
                        <div class="col-sm-9"> <?= nl2br($program->catatan_pembahasan); ?> </div>
                    </div>
                </div>

                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn filter" id="submitBtn">Kembali</button>
                </div>
            </form>
        </div>
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