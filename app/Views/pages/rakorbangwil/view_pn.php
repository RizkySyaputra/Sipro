<style>
    .catatan-item {
        background-color: #f8f9fa;
        /* warna abu lembut */
        border-left: 4px solid #0d6efd;
        /* garis biru di kiri */
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 8px;
    }

    .catatan-nama {
        font-weight: 600;
        color: #0d6efd;
        margin-bottom: 4px;
    }

    .catatan-text {
        text-align: justify;
        color: #333;
        margin: 0;
        white-space: pre-line;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">

            <div class="card-body">
                <div class="container-fluid">

                    <!-- Header PN -->
                    <div class="pn-header mb-4">
                        <div class="pn-number"><?= esc($pn['id_pn'] ?? '-') ?></div>
                        <div class="pn-text">
                            <strong style="font-weight: 900; color: #00b37d; font-size: 1.2rem;">
                                Prioritas Nasional <?= esc($pn['id_pn'] ?? '-') ?>
                            </strong><br>

                            <?= esc($pn['nama_pn'] ?? 'Deskripsi belum tersedia') ?>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="pnTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#catatan" role="tab">Catatan Pembahasan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link non-active" data-toggle="tab" href="#usulan" role="tab">Usulan Program/Kegiatan</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-3 p-3 border rounded bg-white">

                        <!-- === CATATAN PEMBAHASAN === -->
                        <div class="tab-pane fade show active" id="catatan">
                            <div class="d-flex justify-content-between align-items-center">
                                <label><strong>Catatan Pembahasan</strong></label>
                                <button id="btnEditCatatan" class="btn btn-sm btn-warning">Ubah Catatan</button>
                            </div>
                            <div id="catatanDisplay">
                                <?php if (!empty($catatan_pn->catatan_pra_rakorbangwil)): ?>
                                    <?php
                                    $catatanList = json_decode($catatan_pn->catatan_pra_rakorbangwil, true);
                                    ?>
                                    <?php if (!empty($catatanList)): ?>
                                        <div class="mt-2">
                                            <?php foreach ($catatanList as $item): ?>
                                                <div class="catatan-item">
                                                    <div class="catatan-nama"><?= esc($item['nama']) ?>:</div>
                                                    <p class="catatan-text"><?= esc($item['catatan']) ?></p>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="text-muted mt-1">-</div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="text-muted mt-1">-</div>
                                <?php endif; ?>
                            </div>

                            <!-- Form edit catatan -->
                            <div id="catatanForm" class="d-none mt-3">
                                <div id="catatanWrapper"></div>
                                <button type="button" class="btn btn-sm btn-primary mt-2" id="tambahCatatan">Tambah Catatan</button>
                                <button type="button" class="btn btn-success mt-2" id="simpanCatatan">Simpan</button>
                                <button type="button" class="btn btn-secondary mt-2" id="batalCatatan">Batal</button>
                            </div>
                        </div>

                        <!-- === USULAN PROGRAM === -->
                        <div class="tab-pane fade" id="usulan">
                            <div class="d-flex justify-content-between align-items-center">
                                <label><strong>Usulan Program/Kegiatan</strong></label>
                                <button id="btnEditUsulan" class="btn btn-sm btn-warning">Ubah Usulan</button>
                            </div>
                            <div id="usulanDisplay">
                                <p><?= esc($catatan_pn->usulan_pekerjaan ?? '-') ?></p>
                            </div>

                            <!-- Form edit usulan -->
                            <div id="usulanForm" class="d-none mt-3">
                                <textarea id="inputUsulan" class="form-control" rows="4"><?= esc($catatan_pn->usulan_pekerjaan ?? '') ?></textarea>
                                <button class="btn btn-success mt-2" id="simpanUsulan">Simpan</button>
                                <button class="btn btn-secondary mt-2" id="batalUsulan">Batal</button>
                            </div>
                        </div>


                        <!-- Sub Tabs -->
                        <ul class="nav nav-tabs mt-4" id="pnSubTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kawasan" role="tab">Kawasan Prioritas PU</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link non-active" data-toggle="tab" href="#infra" role="tab">Dukungan Infrastruktur PU</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link non-active" data-toggle="tab" href="#kebutuhan" role="tab">Kebutuhan K/L</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-3 p-3 border rounded bg-white">
                            <div class="tab-pane fade show active" id="kawasan">
                                <div class="table-responsive">
                                    <table id="datatables" class="table table-bordered table-hover">
                                        <thead class="bg-light">
                                            <tr>
                                                <th style="text-align: center;">Provinsi</th>
                                                <th style="text-align: center;">Kawasan Afirmasi</th>
                                                <th style="text-align: center;">Kawasan Komoditas Unggulan</th>
                                                <th style="text-align: center;">Kawasan Konservasi/Rawan Bencana</th>
                                                <th style="text-align: center;">Kawasan Pertumbuhan</th>
                                                <th style="text-align: center;">Kawasan Swasembada Pangan, Air, dan Energi</th>
                                                <th style="text-align: center;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_kawasan_afirmasi = 0;
                                            $total_kawasan_komoditas_unggulan = 0;
                                            $total_kawasan_pertumbuhan = 0;
                                            $total_kawasan_konservasi_rawan_bencana = 0;
                                            $total_kawasan_swasembada_pangan_air_energi = 0;
                                            $total_total = 0;
                                            foreach ($kawasanData as $row):
                                                $total_total += $row['kawasan_afirmasi'] + $row['kawasan_komoditas_unggulan'] + $row['kawasan_konservasi_rawan_bencana'] + $row['kawasan_pertumbuhan'] + $row['kawasan_swasembada_pangan_air_energi'];
                                                $total_kawasan_afirmasi += $row['kawasan_afirmasi'];
                                                $total_kawasan_komoditas_unggulan += $row['kawasan_komoditas_unggulan'];
                                                $total_kawasan_pertumbuhan += $row['kawasan_pertumbuhan'];
                                                $total_kawasan_konservasi_rawan_bencana += $row['kawasan_konservasi_rawan_bencana'];
                                                $total_kawasan_swasembada_pangan_air_energi += $row['kawasan_swasembada_pangan_air_energi']; ?>
                                                <tr>
                                                    <td style="text-align: left;"><?= esc($row['provinsi']) ?></td>

                                                    <td style="text-align: center;">
                                                        <a href="#"
                                                            class="show-kawasan-detail text-primary font-weight-bold"
                                                            data-id_pn="<?= esc($pn['id_pn']) ?>"
                                                            data-id_tematik="1"
                                                            data-tematik="Kawasan Afirmasi"
                                                            data-id_provinsi="<?= esc($row['id_provinsi']) ?>"
                                                            data-provinsi="<?= esc($row['provinsi']) ?>">
                                                            <?= esc($row['kawasan_afirmasi']) ?>
                                                        </a>
                                                    </td>

                                                    <td style="text-align: center;">
                                                        <a href="#"
                                                            class="show-kawasan-detail text-primary font-weight-bold"
                                                            data-id_pn="<?= esc($pn['id_pn']) ?>"
                                                            data-id_tematik="2"
                                                            data-tematik="Kawasan Komoditas Unggulan"
                                                            data-id_provinsi="<?= esc($row['id_provinsi']) ?>"
                                                            data-provinsi="<?= esc($row['provinsi']) ?>">
                                                            <?= esc($row['kawasan_komoditas_unggulan']) ?>
                                                        </a>
                                                    </td>

                                                    <td style="text-align: center;">
                                                        <a href="#"
                                                            class="show-kawasan-detail text-primary font-weight-bold"
                                                            data-id_pn="<?= esc($pn['id_pn']) ?>"
                                                            data-id_tematik="3"
                                                            data-tematik="Kawasan Konservasi/Rawan Bencana"
                                                            data-id_provinsi="<?= esc($row['id_provinsi']) ?>"
                                                            data-provinsi="<?= esc($row['provinsi']) ?>">
                                                            <?= esc($row['kawasan_konservasi_rawan_bencana']) ?>
                                                        </a>
                                                    </td>

                                                    <td style="text-align: center;">
                                                        <a href="#"
                                                            class="show-kawasan-detail text-primary font-weight-bold"
                                                            data-id_pn="<?= esc($pn['id_pn']) ?>"
                                                            data-id_tematik="4"
                                                            data-tematik="Kawasan Pertumbuhan"
                                                            data-id_provinsi="<?= esc($row['id_provinsi']) ?>"
                                                            data-provinsi="<?= esc($row['provinsi']) ?>">
                                                            <?= esc($row['kawasan_pertumbuhan']) ?>
                                                        </a>
                                                    </td>

                                                    <td style="text-align: center;">
                                                        <a href="#"
                                                            class="show-kawasan-detail text-primary font-weight-bold"
                                                            data-id_pn="<?= esc($pn['id_pn']) ?>"
                                                            data-id_tematik="5"
                                                            data-tematik="Kawasan Swasembada Pangan, Air, dan Energi"
                                                            data-id_provinsi="<?= esc($row['id_provinsi']) ?>"
                                                            data-provinsi="<?= esc($row['provinsi']) ?>">
                                                            <?= esc($row['kawasan_swasembada_pangan_air_energi']) ?>
                                                        </a>
                                                    </td>

                                                    <td style="text-align: center;font-weight: bold;"><?= esc($row['kawasan_afirmasi'] + $row['kawasan_komoditas_unggulan'] + $row['kawasan_konservasi_rawan_bencana'] + $row['kawasan_pertumbuhan'] + $row['kawasan_swasembada_pangan_air_energi']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td style="text-align : center;font-weight: bold;"><strong>Total</strong></td>
                                                <td style="text-align : center;font-weight: bold;"> <?= $total_kawasan_afirmasi ?></td>
                                                <td style="text-align : center;font-weight: bold;"><?= $total_kawasan_komoditas_unggulan ?></td>
                                                <td style="text-align : center;font-weight: bold;"><?= $total_kawasan_pertumbuhan ?></td>
                                                <td style="text-align : center;font-weight: bold;"><?= $total_kawasan_konservasi_rawan_bencana  ?></td>
                                                <td style="text-align : center;font-weight: bold;"> <?= $total_kawasan_swasembada_pangan_air_energi  ?></td>
                                                <td style="text-align : center;font-weight: bold;"><?= $total_total  ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <!-- Modal Kawasan Detail -->
                                    <div class="modal fade" id="modalKawasanDetail" tabindex="-1" role="dialog" aria-labelledby="modalKawasanDetailLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="modalKawasanDetailLabel">Daftar Kawasan</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="kawasanDetailContent" class="p-3 text-center">
                                                        <div class="spinner-border text-primary" role="status"></div>
                                                        <p class="mt-2">Memuat data kawasan...</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade show" id="infra">
                                <div class="table-responsive">
                                    <table id="datatables2" class="table table-bordered table-hover">
                                        <thead class="bg-light">
                                            <tr>
                                                <th rowspan="2" style="text-align: center; vertical-align: middle;">Provinsi</th>
                                                <th colspan="2" style="text-align: center;">Kawasan Afirmasi</th>
                                                <th colspan="2" style="text-align: center;">Kawasan Komoditas Unggulan</th>
                                                <th colspan="2" style="text-align: center;">Kawasan Konservasi/Rawan Bencana</th>
                                                <th colspan="2" style="text-align: center;">Kawasan Pertumbuhan</th>
                                                <th colspan="2" style="text-align: center;">Kawasan Swasembada Pangan, Air, dan Energi</th>
                                                <th colspan="2" style="text-align: center;">Total</th>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center;">Pekerjaan</th>
                                                <th style="text-align: center;">Anggaran</th>
                                                <th style="text-align: center;">Pekerjaan</th>
                                                <th style="text-align: center;">Anggaran</th>
                                                <th style="text-align: center;">Pekerjaan</th>
                                                <th style="text-align: center;">Anggaran</th>
                                                <th style="text-align: center;">Pekerjaan</th>
                                                <th style="text-align: center;">Anggaran</th>
                                                <th style="text-align: center;">Pekerjaan</th>
                                                <th style="text-align: center;">Anggaran</th>
                                                <th style="text-align: center;">Pekerjaan</th>
                                                <th style="text-align: center;">Anggaran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_kawasan_afirmasi_pekerjaan = 0;
                                            $total_kawasan_afirmasi_anggaran = 0;
                                            $total_kawasan_komoditas_pekerjaan = 0;
                                            $total_kawasan_komoditas_anggaran = 0;
                                            $total_kawasan_konservasi_pekerjaan = 0;
                                            $total_kawasan_konservasi_anggaran = 0;
                                            $total_kawasan_pertumbuhan_pekerjaan = 0;
                                            $total_kawasan_pertumbuhan_anggaran = 0;
                                            $total_kawasan_swasembada_pekerjaan = 0;
                                            $total_kawasan_swasembada_anggaran = 0;
                                            $total_total_pekerjaan = 0;
                                            $total_total_anggaran = 0;
                                            foreach ($programData as $row):
                                                $total_kawasan_afirmasi_pekerjaan += $row['kawasan_afirmasi_pekerjaan'];
                                                $total_kawasan_afirmasi_anggaran += $row['kawasan_afirmasi_anggaran'];
                                                $total_kawasan_komoditas_pekerjaan += $row['kawasan_komoditas_pekerjaan'];
                                                $total_kawasan_komoditas_anggaran += $row['kawasan_komoditas_anggaran'];
                                                $total_kawasan_konservasi_pekerjaan += $row['kawasan_konservasi_pekerjaan'];
                                                $total_kawasan_konservasi_anggaran += $row['kawasan_konservasi_anggaran'];
                                                $total_kawasan_pertumbuhan_pekerjaan += $row['kawasan_pertumbuhan_pekerjaan'];
                                                $total_kawasan_pertumbuhan_anggaran += $row['kawasan_pertumbuhan_anggaran'];
                                                $total_kawasan_swasembada_pekerjaan += $row['kawasan_swasembada_pekerjaan'];
                                                $total_kawasan_swasembada_anggaran += $row['kawasan_swasembada_anggaran'];
                                                $total_total_pekerjaan += $row['kawasan_afirmasi_pekerjaan'] + $row['kawasan_komoditas_pekerjaan'] + $row['kawasan_pertumbuhan_pekerjaan'] + $row['kawasan_konservasi_pekerjaan'] + $row['kawasan_swasembada_pekerjaan'];
                                                $total_total_anggaran += $row['kawasan_afirmasi_anggaran'] + $row['kawasan_komoditas_anggaran'] + $row['kawasan_pertumbuhan_anggaran'] + $row['kawasan_konservasi_anggaran'] + $row['kawasan_swasembada_anggaran'];
                                            ?>
                                                <tr>
                                                    <td style="text-align: left; font-weight: 600;"><?= esc($row['provinsi']) ?></td>

                                                    <!-- Kawasan Afirmasi -->
                                                    <td style="text-align: center;">
                                                        <a href="#"
                                                            class="show-program-detail text-primary font-weight-bold"
                                                            data-id_pn="<?= esc($pn['id_pn']) ?>"
                                                            data-id_tematik="1"
                                                            data-tematik="Kawasan Afirmasi"
                                                            data-id_provinsi="<?= esc($row['id_provinsi']) ?>"
                                                            data-provinsi="<?= esc($row['provinsi']) ?>">
                                                            <?= esc($row['kawasan_afirmasi_pekerjaan'] ?? 0) ?>
                                                        </a>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        Rp<?= number_format($row['kawasan_afirmasi_anggaran'] ?? 0, 0, ',', '.') ?>
                                                    </td>

                                                    <!-- Kawasan Komoditas Unggulan -->
                                                    <td style="text-align: center;">
                                                        <a href="#"
                                                            class="show-program-detail text-primary font-weight-bold"
                                                            data-id_pn="<?= esc($pn['id_pn']) ?>"
                                                            data-id_tematik="2"
                                                            data-tematik="Kawasan Komoditas Unggulan"
                                                            data-id_provinsi="<?= esc($row['id_provinsi']) ?>"
                                                            data-provinsi="<?= esc($row['provinsi']) ?>">
                                                            <?= esc($row['kawasan_komoditas_pekerjaan'] ?? 0) ?>
                                                        </a>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        Rp<?= number_format($row['kawasan_komoditas_anggaran'] ?? 0, 0, ',', '.') ?>
                                                    </td>

                                                    <!-- Kawasan Konservasi/Rawan Bencana -->
                                                    <td style="text-align: center;">
                                                        <a href="#"
                                                            class="show-program-detail text-primary font-weight-bold"
                                                            data-id_pn="<?= esc($pn['id_pn']) ?>"
                                                            data-id_tematik="3"
                                                            data-tematik="Kawasan Konservasi/Rawan Bencana"
                                                            data-id_provinsi="<?= esc($row['id_provinsi']) ?>"
                                                            data-provinsi="<?= esc($row['provinsi']) ?>">
                                                            <?= esc($row['kawasan_konservasi_pekerjaan'] ?? 0) ?>
                                                        </a>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        Rp<?= number_format($row['kawasan_konservasi_anggaran'] ?? 0, 0, ',', '.') ?>
                                                    </td>
                                                    <!-- Kawasan Pertumbuhan -->
                                                    <td style="text-align: center;">
                                                        <a href="#"
                                                            class="show-program-detail text-primary font-weight-bold"
                                                            data-id_pn="<?= esc($pn['id_pn']) ?>"
                                                            data-id_tematik="4"
                                                            data-tematik="Kawasan Pertumbuhan"
                                                            data-id_provinsi="<?= esc($row['id_provinsi']) ?>"
                                                            data-provinsi="<?= esc($row['provinsi']) ?>">
                                                            <?= esc($row['kawasan_pertumbuhan_pekerjaan'] ?? 0) ?>
                                                        </a>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        Rp<?= number_format($row['kawasan_pertumbuhan_anggaran'] ?? 0, 0, ',', '.') ?>
                                                    </td>

                                                    <!-- Kawasan Swasembada -->
                                                    <td style="text-align: center;">
                                                        <a href="#"
                                                            class="show-program-detail text-primary font-weight-bold"
                                                            data-id_pn="<?= esc($pn['id_pn']) ?>"
                                                            data-id_tematik="5"
                                                            data-tematik="Kawasan Swasembada Pangan, Air, dan Energi"
                                                            data-id_provinsi="<?= esc($row['id_provinsi']) ?>"
                                                            data-provinsi="<?= esc($row['provinsi']) ?>">
                                                            <?= esc($row['kawasan_swasembada_pekerjaan'] ?? 0) ?>
                                                        </a>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        Rp<?= number_format($row['kawasan_swasembada_anggaran'] ?? 0, 0, ',', '.') ?>
                                                    </td>

                                                    <!-- Total -->
                                                    <td style="text-align: center;font-weight: bold;">
                                                        <?= esc($row['kawasan_afirmasi_pekerjaan'] + $row['kawasan_komoditas_pekerjaan'] + $row['kawasan_konservasi_pekerjaan'] + $row['kawasan_pertumbuhan_pekerjaan'] + $row['kawasan_swasembada_pekerjaan'] ?? 0) ?>
                                                    </td>
                                                    <td style="text-align: right;font-weight: bold;">
                                                        Rp<?= number_format($row['kawasan_afirmasi_anggaran'] + $row['kawasan_komoditas_anggaran'] + $row['kawasan_konservasi_anggaran'] + $row['kawasan_pertumbuhan_anggaran'] + $row['kawasan_swasembada_anggaran'] ?? 0, 0, ',', '.') ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <tfoot>
                                            <tr>
                                                <td style="text-align : center;font-weight: bold;"><strong>Total</strong></td>
                                                <td style="text-align : center;font-weight: bold;"> <?= $total_kawasan_afirmasi_pekerjaan ?></td>
                                                <td style="text-align : center;font-weight: bold;"> Rp<?= number_format($total_kawasan_afirmasi_anggaran ?? 0, 0, ',', '.')  ?></td>
                                                <td style="text-align : center;font-weight: bold;"><?= $total_kawasan_komoditas_pekerjaan ?></td>
                                                <td style="text-align : center;font-weight: bold;">Rp<?= number_format($total_kawasan_komoditas_anggaran  ?? 0, 0, ',', '.')  ?></td>
                                                <td style="text-align : center;font-weight: bold;"><?= $total_kawasan_konservasi_pekerjaan ?></td>
                                                <td style="text-align : center;font-weight: bold;">Rp<?= number_format($total_kawasan_konservasi_anggaran  ?? 0, 0, ',', '.')  ?></td>
                                                <td style="text-align : center;font-weight: bold;"><?= $total_kawasan_pertumbuhan_pekerjaan  ?></td>
                                                <td style="text-align : center;font-weight: bold;">Rp<?= number_format($total_kawasan_pertumbuhan_anggaran   ?? 0, 0, ',', '.')  ?></td>
                                                <td style="text-align : center;font-weight: bold;"> <?= $total_kawasan_swasembada_pekerjaan  ?></td>
                                                <td style="text-align : center;font-weight: bold;"> Rp<?= number_format($total_kawasan_swasembada_anggaran  ?? 0, 0, ',', '.')  ?></td>
                                                <td style="text-align : center;font-weight: bold;"> <?= $total_total_pekerjaan ?></td>
                                                <td style="text-align : center;font-weight: bold;">Rp<?= number_format($total_total_anggaran  ?? 0, 0, ',', '.')  ?></td>
                                            </tr>
                                        </tfoot>
                                        </tbody>


                                    </table>
                                    <!-- Modal Program Detail -->
                                    <div class="modal fade" id="modalprogramDetail" tabindex="-1" role="dialog" aria-labelledby="modalprogramDetailLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="modalprogramDetailLabel">Daftar Program</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="programDetailContent" class="p-3 text-center">
                                                        <div class="spinner-border text-primary" role="status"></div>
                                                        <p class="mt-2">Memuat data program...</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade show" id="kebutuhan">
                                <div class="form-group">
                                    <label><strong>Kebutuhan K/L</strong></label>
                                    <p><?= $catatan_pn->kebutuhan_dukungan_kl ?></p>
                                </div>
                            </div>
                        </div>

                    </div> <!-- container -->
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div> <!-- col -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script>
        window.currentCatatanData = <?= json_encode(json_decode($catatan_pn->catatan_pra_rakorbangwil ?? '[]')) ?>;
    </script>

    <script>
        $(document).ready(function() {
            // === UBAH & SIMPAN USULAN ===
            $('#btnEditUsulan').on('click', function() {
                $('#usulanDisplay').hide();
                $('#usulanForm').removeClass('d-none');
            });

            $('#batalUsulan').on('click', function() {
                $('#usulanForm').addClass('d-none');
                $('#usulanDisplay').show();
            });

            $('#simpanUsulan').on('click', function() {
                let newText = $('#inputUsulan').val();
                $.ajax({
                    url: "<?= base_url('rakorbangwil/update_usulan') ?>",
                    type: "POST",
                    data: {
                        id_pn: "<?= $pn['id_pn'] ?>",
                        usulan_pekerjaan: newText
                    },
                    success: function() {
                        $('#usulanDisplay').html('<p>' + newText + '</p>').show();
                        $('#usulanForm').addClass('d-none');
                        Swal.fire('Berhasil!', 'Usulan berhasil diperbarui.', 'success');
                    },
                    error: function() {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan.', 'error');
                    }
                });
            });


            // === UBAH & SIMPAN CATATAN ===
            $('#btnEditCatatan').on('click', function() {
                $('#catatanDisplay').hide();
                $('#catatanForm').removeClass('d-none');

                $('#catatanWrapper').html('');
                window.currentCatatanData.forEach(item => createCatatanItem(item.nama, item.catatan));
            });


            $('#batalCatatan').on('click', function() {
                $('#catatanForm').addClass('d-none');
                $('#catatanDisplay').show();
            });

            $('#simpanCatatan').on('click', function() {
                let catatanData = [];
                $('.catatan-item').each(function() {
                    let nama = $(this).find('.nama-pencatat').val();
                    let catatan = $(this).find('textarea').val();
                    if (nama || catatan) catatanData.push({
                        nama,
                        catatan
                    });
                });

                $.ajax({
                    url: "<?= base_url('rakorbangwil/update_catatan') ?>",
                    type: "POST",
                    data: {
                        id_pn: "<?= $pn['id_pn'] ?>",
                        catatan: JSON.stringify(catatanData)
                    },
                    success: function() {
                        // Simpan data baru ke variabel global
                        window.currentCatatanData = catatanData;

                        // Render ulang tampilan
                        let html = '';
                        catatanData.forEach(item => {
                            html += `
            <div class="catatan-item">
                <div class="catatan-nama">${item.nama || '-'}</div>
                <p class="catatan-text">${item.catatan || ''}</p>
            </div>
        `;
                        });
                        if (html === '') html = '<div class="text-muted mt-1">-</div>';

                        $('#catatanDisplay').html(html).show();
                        $('#catatanForm').addClass('d-none');

                        Swal.fire('Berhasil!', 'Catatan berhasil diperbarui.', 'success');
                    },
                    error: function() {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan catatan.', 'error');
                    }
                });
            });


            // === Fungsi dinamis tambah/hapus catatan ===
            function createCatatanItem(nama = '', catatan = '') {
                const wrapper = $('#catatanWrapper');
                const div = $('<div>').addClass('catatan-item mb-2');

                const select = $('<select>')
                    .addClass('form-select nama-pencatat')
                    .attr('name', 'catatan_nama[]');
                let options = '<option value="">-- Pilih Stakeholder --</option>';
                window.namaList.forEach(n => {
                    options += `<option value="${n}" ${n === nama ? 'selected' : ''}>${n}</option>`;
                });
                select.html(options);

                const textarea = $('<textarea>')
                    .addClass('form-control mt-1')
                    .attr('rows', 2)
                    .val(catatan);

                const removeBtn = $('<button>')
                    .addClass('btn btn-sm btn-danger mt-1 remove-catatan')
                    .text('Hapus')
                    .on('click', () => div.remove());

                div.append(select, textarea, removeBtn);
                wrapper.append(div);

                // Inisialisasi Select2
                $(select).select2({
                    placeholder: "-- Pilih Stakeholder --",
                    width: '100%',
                    allowClear: true
                });
            }

            $('#tambahCatatan').on('click', () => createCatatanItem());


            // Inisialisasi DataTables
            $('#datatables').DataTable({
                "order": [],
                "pageLength": 10,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
            $('#datatables2').DataTable({
                "order": [],
                "pageLength": 10,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });


            // === EVENT: Klik pada angka kawasan ===
            $(document).on('click', '.show-kawasan-detail', function(e) {
                e.preventDefault();

                // Ambil data dari atribut <a>
                let id_pn = $(this).data('id_pn');
                let id_tematik = $(this).data('id_tematik');
                let tematik = $(this).data('tematik');
                let provinsi = $(this).data('provinsi');
                let id_provinsi = $(this).data('id_provinsi');

                // Set judul modal
                $('#modalKawasanDetailLabel').text('Daftar ' + tematik);
                // Tampilkan modal
                $('#modalKawasanDetail').modal('show');

                // Isi dengan spinner loading
                $('#kawasanDetailContent').html(`
            <div class="text-center p-3">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-2">Memuat data kawasan...</p>
            </div>
        `);

                // Request AJAX ke controller
                $.ajax({
                    url: "<?= base_url('rakorbangwil/get_list_kawasan') ?>",
                    type: "POST",
                    data: {
                        id_pn: id_pn,
                        provinsi: provinsi,
                        id_tematik: id_tematik,
                        id_provinsi: id_provinsi
                    },
                    success: function(response) {
                        // Masukkan hasil view ke dalam modal
                        $('#kawasanDetailContent').html(response);
                    },
                    error: function(xhr) {
                        $('#kawasanDetailContent').html(`
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i> 
                        Gagal memuat data kawasan.<br>
                        ${xhr.responseText || 'Silakan coba lagi.'}
                    </div>
                `);
                    }
                });
            });

            // === EVENT: Klik pada angka program ===
            $(document).on('click', '.show-program-detail', function(e) {
                e.preventDefault();

                // Ambil data dari atribut <a>
                let id_pn = $(this).data('id_pn');
                let id_tematik = $(this).data('id_tematik');
                let tematik = $(this).data('tematik');
                let provinsi = $(this).data('provinsi');
                let id_provinsi = $(this).data('id_provinsi');

                // Set judul modal
                $('#modalprogramDetailLabel').text('Daftar Program ' + tematik);
                // Tampilkan modal
                $('#modalprogramDetail').modal('show');

                // Isi dengan spinner loading
                $('#programDetailContent').html(`
            <div class="text-center p-3">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-2">Memuat data program...</p>
            </div>
        `);

                // Request AJAX ke controller
                $.ajax({
                    url: "<?= base_url('rakorbangwil/get_list_program') ?>",
                    type: "POST",
                    data: {
                        id_pn: id_pn,
                        provinsi: provinsi,
                        id_tematik: id_tematik,
                        id_provinsi: id_provinsi
                    },
                    success: function(response) {
                        // Masukkan hasil view ke dalam modal
                        $('#programDetailContent').html(response);
                    },
                    error: function(xhr) {
                        $('#programDetailContent').html(`
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i> 
                        Gagal memuat data program.<br>
                        ${xhr.responseText || 'Silakan coba lagi.'}
                    </div>
                `);
                    }
                });
            });
        });
    </script>

    <script>
        window.namaList = <?= json_encode($namaList ?? []) ?>;
    </script>

    <style>
        .pn-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            border-left: 5px solid #00b37d;
        }

        .pn-number {
            background: #007bff;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            border-radius: 10px;
            padding: 15px 20px;
            min-width: 60px;
            text-align: center;
        }

        .pn-text {
            font-size: 0.95rem;
            color: #333;
            flex: 1;
        }

        .nav-tabs .nav-link.active {
            background-color: #00b37d !important;
            color: white !important;
        }

        .nav-tabs .nav-link.non-active {
            background-color: #d7d7d7ff !important;
            color: white !important;
        }



        .btn-save {
            background-color: #00bff0;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 14px;
        }

        .btn-save:hover {
            background-color: #009dcc;
        }

        .table th {
            background-color: #f1f3f5;
            color: #333;
        }
    </style>