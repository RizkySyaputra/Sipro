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
                            <a class="nav-link active" data-toggle="tab" href="#kebutuhan" role="tab">Kebutuhan K/L</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#catatan" role="tab">Catatan Pembahasan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#usulan" role="tab">Usulan Program/Kegiatan</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-3 p-3 border rounded bg-white">
                        <div class="tab-pane fade show active" id="kebutuhan">
                            <div class="form-group">
                                <label><strong>Kebutuhan K/L</strong></label>
                                <p><?= $catatan_pn->kebutuhan_dukungan_kl ?></p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="catatan">
                            <label><strong>Catatan Pembahasan</strong></label>
                            <!-- <p><?= esc($catatan_pn->catatan_pra_rakorbangwil ?? '') ?></p> -->
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

                        <div class="tab-pane fade" id="usulan">
                            <label><strong>Usulan Program/Kegiatan</strong></label>
                            <p><?= $catatan_pn->usulan_pekerjaan ?></p>
                        </div>
                    </div>

                    <!-- Sub Tabs -->
                    <ul class="nav nav-tabs mt-4" id="pnSubTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kawasan" role="tab">Kawasan Prioritas PU</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#infra" role="tab">Dukungan Infrastruktur PU</a>
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
                                        <?php foreach ($kawasanData as $row): ?>
                                            <tr>
                                                <td style="text-align: right;"><?= esc($row['provinsi']) ?></td>
                                                <td style="text-align: right;"><?= esc($row['kawasan_afirmasi']) ?></td>
                                                <td style="text-align: right;"><?= esc($row['kawasan_komoditas_unggulan']) ?></td>
                                                <td style="text-align: right;"><?= esc($row['kawasan_konservasi_rawan_bencana']) ?></td>
                                                <td style="text-align: right;"><?= esc($row['kawasan_pertumbuhan']) ?></td>
                                                <td style="text-align: right;"><?= esc($row['kawasan_swasembada_pangan_air_energi']) ?></td>
                                                <td style="text-align: right;"><?= esc($row['total']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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

<!-- ✅ Tambahkan DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#datatables').DataTable({
            "order": [],
            "pageLength": 10,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
            }
        });
    });
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