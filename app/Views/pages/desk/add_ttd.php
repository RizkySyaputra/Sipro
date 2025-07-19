<div class="container mt-5">
    <div class="card">
        <div class="card-header text-white" style="background-color: #222cb1;">
            <h4 style="text-align: center;">Form Input Tanda Tangan</h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('tanda_tangan/tambah') ?>" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold"><strong>Pejabat</strong></div>
                    <div class="col-sm-9">
                        <select name="id_pejabat" class="form-control" required>
                            <!-- Dummy options, replace with dynamic data later -->
                            <option value="">Pilih Pejabat</option>
                            <?php foreach ($pejabat as $pejabat) : ?>
                                <option value="<?= $pejabat['id_pejabat'] ?>"><?= $pejabat['nama_pejabat']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold"><strong>Tanda Tangan</strong></div>
                    <div class="col-sm-9">
                        <input type="file" name="tanda_tangan" class="form-control" required accept="image/*">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary" onclick='swal({ title:"Terima Kasih!", text: "Tanda Tangan Berhasil disimpan !", type: "success", buttonsStyling: false, confirmButtonClass: "btn btn-success"})'>Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>