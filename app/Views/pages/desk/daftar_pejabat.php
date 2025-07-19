<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="card-body">
    <div class="d-flex justify-content-between mb-3">
        <h4>Daftar Pejabat</h4>
        <!-- <a href="<?= base_url('/pejabat/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-add"></i>Tambah Pejabat</a> -->
        <a href="<?= base_url('/pejabat/tambah') ?>" class="btn btn-primary btn-sm" title="Add">
            <i class="fas fa-plus"></i> Tambah Pejabat </a>
    </div>
    <div class="material-datatables">
        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pejabat</th>
                    <th>Jabatan</th>
                    <th>Unit Kerja</th>
                    <th>Unit Organisasi</th>
                    <th>Instansi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama Pejabat</th>
                    <th>Jabatan</th>
                    <th>Unit Kerja</th>
                    <th>Unit Organisasi</th>
                    <th>Instansi</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                <?php if (isset($pejabat) && count($pejabat) > 0): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($pejabat as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= esc($row['nama_pejabat']); ?></td>
                            <td><?= esc($row['jabatan']); ?></td>
                            <td><?= esc($row['unit_kerja']); ?></td>
                            <td><?= esc($row['unit_organisasi']); ?></td>
                            <td><?= esc($row['instansi']); ?></td>
                            <td>
                                <a href="<?= base_url('/pejabat/edit/' . esc($row['id_pejabat'])) ?>" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-info btn-sm" title="Belum Tersedia">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center">Data tidak ditemukan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Pejabat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Data detail pejabat akan dimuat di sini -->
                <div id="modalContent">
                    Memuat data...
                </div>
            </div>
        </div>
    </div>
</div>