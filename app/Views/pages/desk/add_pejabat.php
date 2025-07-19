<div class="container mt-5">
    <div class="card">
        <div class="card-header text-white" style="background-color: #222cb1;">
            <h4 style="text-align: center;">Form Input Data Pejabat</h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('pejabat/tambah') ?>" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold"><strong>NIP</strong></div>
                    <div class="col-sm-9">
                        <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold"><strong>Nama Pejabat</strong></div>
                    <div class="col-sm-9">
                        <input type="text" name="nama_pejabat" class="form-control" placeholder="Masukkan Nama Pejabat">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold"><strong>Jabatan</strong></div>
                    <div class="col-sm-9">
                        <input type="text" name="jabatan" class="form-control" placeholder="Masukkan Jabatan">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold"><strong>Unit Kerja</strong></div>
                    <div class="col-sm-9">
                        <input type="text" name="unit_kerja" class="form-control" placeholder="Masukkan Unit Kerja">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold"><strong>Unit Organisasi</strong></div>
                    <div class="col-sm-9">
                        <input type="text" name="unit_organisasi" class="form-control" placeholder="Masukkan Unit Organisasi">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold"><strong>Instansi</strong></div>
                    <div class="col-sm-9">
                        <input type="text" name="instansi" class="form-control" placeholder="Masukkan Instansi">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold"><strong>Email</strong></div>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control" placeholder="Masukkan Email">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold"><strong>No. Telepon</strong></div>
                    <div class="col-sm-9">
                        <input type="text" name="no_telp" class="form-control" placeholder="Masukkan No. Telepon">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold"><strong>Tanda Tangan</strong></div>
                    <div class="col-sm-9">
                        <input type="file" name="tanda_tangan" class="" accept="image/*">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12 text-center">
                        <button type="submit" onclick='swal({ title:"Terima Kasih!", text: "Data Berhasil disimpan !", type: "success", buttonsStyling: false, confirmButtonClass: "btn btn-success"})' class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>