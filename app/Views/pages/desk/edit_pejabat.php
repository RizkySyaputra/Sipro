<div class="container mt-5">
    <div class="card">
        <div class="card-header text-white" style="background-color: #222cb1;">
            <h4 style="text-align: center;">Form Edit Data Pejabat</h4>
        </div>
        <?php foreach ($pejabat as $pejabat): ?>
            <div class="card-body">
                <form action="<?= base_url('pejabat/edit') ?>" method="POST" enctype="multipart/form-data">
                    <input type="text" name="id_pejabat" value="<?= $pejabat->id_pejabat ?>" hidden>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>NIP</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="nip" class="form-control" value="<?= $pejabat->nip ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Nama Pejabat</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="nama_pejabat" class="form-control" value="<?= $pejabat->nama_pejabat ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Jabatan</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="jabatan" class="form-control" value="<?= $pejabat->jabatan ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Unit Kerja</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="unit_kerja" class="form-control" value="<?= $pejabat->unit_kerja ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Unit Organisasi</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="unit_organisasi" class="form-control" value="<?= $pejabat->unit_organisasi ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Instansi</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="instansi" class="form-control" value="<?= $pejabat->instansi ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Email</strong></div>
                        <div class="col-sm-9">
                            <input type="email" name="email" class="form-control" value="<?= $pejabat->email ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>No. Telepon</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="no_telp" class="form-control" value="<?= $pejabat->no_telp ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 font-weight-bold"><strong>Tanda Tangan</strong></div>
                        <div class="col-sm-9">
                            <input type="text" name="ttd_lama" value="<?= $pejabat->tanda_tangan ?>" hidden>
                            <img src="<?= base_url('assets/ttd/' . $pejabat->tanda_tangan) ?>" alt="Tanda Tangan Pejabat" class="img-thumbnail" style="max-width: 200px;">

                            <input type="file" name="tanda_tangan" class="form-control" accept="image/*">
                        </div>
                    </div>
                <?php endforeach ?>
                <div class="row mb-3">
                    <div class="col-sm-12 text-center">
                        <button type="submit" onclick='swal({ title:"Terima Kasih!", text: "Data Berhasil disimpan !", type: "success", buttonsStyling: false, confirmButtonClass: "btn btn-success"})' class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                </form>
            </div>
    </div>
</div>