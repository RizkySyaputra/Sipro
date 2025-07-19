<div class="card">
    <div class="card-header pt-5">
        <div class="card-title">
            <?= $title ?>
        </div>
        <div class="card-toolbar">
            <a href="javascript:;" class="text-hover-primary me-8 btn_export" data-export="pdf" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Export as PDF">
                <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen055.svg-->
                <i class="fas fa-file-pdf fs-1"></i>
                <!--end::Svg Icon-->
            </a>
        </div>
    </div>
    <div class="card-body py-5 px-10">
        <div class="text-center mb-20" id="header">
            <h1>BERITA ACARA KESEPAKATAN PROGRAM KETERPADUAN RANCANGAN<br>
                <h1>MAJOR PROJECT <?= strtoupper($name_mp['kepanjangan']) ?></h1>
                <br>
                <h1>WILAYAH <?= strtoupper($wilayah['keterangan']) ?></h1>
                <br>
                <h3>HASIL PEMBAHASAN RAPAT KOORDINASI KETERPADUAN PENGEMBANGAN <br> INFRASTRUKTUR WILAYAH (RAKORBANGWIL) BIDANG PUPR <br> TAHUN ANGGARAN <?= $tahun ?></h3>
        </div>
        <div class="text-justify mb-15" id="body">
            <p>Dengan memperhatikan:</p>
            <ol>
                <li>Rancangan Akhir Rencana Pembangunan Jangka Panjang Nasional (RPJPN) 2045;</li>
                <li>Rancangan Teknokratik Rencana Pembangunan Jangka Menegah Nasional (RPJPN) 2025-2029;</li>
                <li>Evaluasi RPJMN 2020-2024 dan Proyek Strategis Nasional (PSN);</li>
                <li>Rencana Pengembangan Infrastruktur Wilayah (RPIW) 2025-2034.</li>
            </ol>
        </div>

        <div class="mb-15">
            <p>Dapat disepakati hasil pembahasan rancangan <i style="color:black">Major Project</i> <?= humanize(strtolower($name_mp['kepanjangan'])) ?> wilayah <?= humanize(strtolower($wilayah['keterangan'])) ?>:</p>
            <table class="table table-responsive border gy-3 gs-3 mb-8 nowrap align-middle">
                <thead class="fw-bold border border-dark align-middle text-center" style="background-color: #D6E7F6;">
                    <tr>
                        <th width="5%">No.</th>
                        <th width="15%">Rancangan <i style="color:black">Major Project</i></th>
                        <th width="50%">Catatan</th>
                    </tr>
                </thead>
                <tbody class="border border-dark">
                    <?php if (!empty($major_project)) : ?>
                        <?php $no = 1; ?>
                        <?php foreach ($major_project as $data) : ?>
                            <tr>
                                <td><?= $no ?>.</td>
                                <td><?= ($data->kode ? $data->kode . " - " : "") . $data->name ?></td>
                                <td style="white-space: pre-line"><?= $data->catatan ? $data->catatan : "-" ?></td>
                                <?php $no++; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" align="center">Tidak Ada Data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mb-15">
            <p>Dapat disepakati hasil pembahasan program/kegiatan TA 2025 dalam rancangan <i style="color:black">Major Project</i> <?= humanize(strtolower($name_mp['kepanjangan'])) ?> wilayah <?= humanize(strtolower($wilayah['keterangan'])) ?>:</p>
            <table class="table table-responsive border gy-3 gs-3 mb-8 nowrap align-middle">
                <thead class="fw-bold border border-dark align-middle text-center" style="background-color: #D6E7F6;">
                    <tr>
                        <th width="5%">No.</th>
                        <th width="10%">Program/Kegiatan</th>
                        <th width="10%">Provinsi</th>
                        <th width="10%">Kawasan</th>
                        <th width="10%">Unit Kerja/Instansi Terkait</th>
                        <th width="10%">Kesepakatan</th>
                        <th width="45%">Catatan</th>
                    </tr>
                </thead>
                <tbody class="border border-dark">
                    <?php if (!empty($program)) : ?>
                        <?php $no = 1; ?>
                        <?php foreach ($program as $data) : ?>
                            <tr>
                                <td><?= $no ?>.</td>
                                <td><?= $data->kebutuhan_program ?></td>
                                <td><?= $data->nama_provinsi ?></td>
                                <td><?= $data->nama_kawasan ?></td>
                                <td><?= $data->nama_unor ?></td>
                                <td><?= $data->kesimpulan_kesepakatan ?></td>
                                <td style="white-space: pre-line"><?= $data->catatan_kesepakatan ? $data->catatan_kesepakatan : "-" ?></td>
                                <?php $no++; ?>
                            </tr>
                            <?php if (!empty($pekerjaan)) : ?>
                                <?php foreach ($pekerjaan as $result) : ?>
                                    <?php if ($data->id == $result->id_program) : ?>
                                        <tr>
                                            <td><?= $no ?>.</td>
                                            <td><?= $data->nama_kawasan ?></td>
                                            <td>
                                                <ul>
                                                    <li><?= $result->kebutuhan_program ?> / <?= $result->nama_pekerjaan ?></li>
                                                </ul>
                                            </td>
                                            <td><?= $result->detil_pelaksana ?></td>
                                            <td><?= $result->kesimpulan_kesepakatan ?></td>
                                            <td><?= $result->catatan_kesepakatan ? $result->catatan_kesepakatan : "-" ?></td>
                                            <?php $no++; ?>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" align="center">Tidak Ada Data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mb-15">
            <p>Dapat disepakati usulan baru program/kegiatan TA 2025 dalam rancangan <i style="color:black">Major Project</i> <?= humanize(strtolower($name_mp['kepanjangan'])) ?> wilayah <?= humanize(strtolower($wilayah['keterangan'])) ?>:</p>
            <table class="table table-responsive border gy-3 gs-3 mb-8 nowrap align-middle">
                <thead class="fw-bold border border-dark align-middle text-center" style="background-color: #D6E7F6;">
                    <tr>
                        <th width="5%">No.</th>
                        <th width="10%">Program/Kegiatan</th>
                        <th width="10%">Provinsi</th>
                        <th width="10%">Kawasan</th>
                        <th width="10%">Unit Kerja / Instansi Terkait</th>
                        <th width="45%">Catatan</th>
                    </tr>
                </thead>
                <tbody class="border border-dark">
                    <?php if (!empty($usulan)) : ?>
                        <?php $no = 1; ?>
                        <?php foreach ($usulan as $data) : ?>
                            <tr>
                                <td><?= $no ?>.</td>
                                <td><?= $data->program ?></td>
                                <td><?= $data->nama_provinsi ?></td>
                                <td><?= $data->kawasan_prioritas ?></td>
                                <td><?= $data->nama_unor ?? "-" ?></td>
                                <td style="white-space: pre-line"><?= $data->catatan ? $data->catatan : "-" ?></td>
                                <?php $no++; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" align="center">Tidak Ada Data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mb-20">
            <p>Pemenuhan program/kegiatan dalam rancangan <i style="color:black">Major Project</i> PUPR pada Tahun Anggaran <?= $tahun ?> akan dibahas lebih lanjut dalam Konsultasi Regional dan forum pemograman dan penganggaran lainnya.</p>
        </div>

        <div class="d-flex flex-column align-items-center text-center" id="tanda_tangan">
            <div class="row">
                <div class="col">
                    <p>Cirebon, <?= format_datetime(date('Y-M-d')) ?> <? //= format_datetime($tanggal_ttd) 
                                                                        ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-responsive border gy-3 gs-3 mb-8 nowrap align-middle" id="table_rekomendasi_pekerjaan">
                        <thead class="fw-bold border border-dark" style="background-color: #D6E7F6;">
                            <tr>
                                <th>Nama dan Jabatan</th>
                                <th style="width: 200px;">Tanda Tangan</th>
                            </tr>
                        </thead>
                        <tbody class="border border-dark">
                            <?php foreach ($tanda_tangan as $data) : ?>
                                <tr>
                                    <td>
                                        <?= $data->nama ?> <br>
                                        <?= $data->jabatan ?> <br>
                                        <?= $data->instansi ?>
                                    </td>
                                    <td><img src="<?= base_url() ?>/<?= $data->tanda_tangan ?>" alt="" style="width: 75%;"></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>