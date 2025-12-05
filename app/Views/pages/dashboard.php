<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title">Dashboard</h4>
            </div>
            <div class="container mt-4" style="height: 100vh;">
                <!-- <div class="card p-2" style="height: 80vh;"> -->
                <div class="d-flex">
                    <div style="margin-top:30px;">
                        <img src="<?= base_url('assets/img/character_man.png') ?>" alt="Logo Man" width="100">
                        <hr style="border-top: 2px dashed #bfbfbf; margin-top:0px">
                    </div>
                    <div style="margin-top:60px; margin-left: 40px;">
                        <div class="card pt-2 pl-2 pr-2">
                            <p style="font-size: 18px;">
                                <strong>
                                    Hai <span style="color: #5200cc; font-size: inherit; text-transform: capitalize;"><?= user()->username ?></span>, Selamat Datang di Halaman Sistem Informasi Pemrograman (SIPro).
                                </strong>
                            </p>
                        </div>
                    </div>
                    <div style="margin-top:30px; margin-left: 40px;">
                        <img src="<?= base_url('assets/img/character_woman.png') ?>" alt="Logo Man" width="100">
                        <hr style="border-top: 2px dashed #bfbfbf; margin-top:0px">
                    </div>
                </div>
                <!-- </div> -->

                <!-- Modal -->
                <div class="modal fade" id="detailNomenklaturModal" tabindex="-1" role="dialog" aria-labelledby="detailNomenklaturModalTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="detailNomenklaturModalTitle">Nomenklatur Kegiatan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="form-row-block"></div>
                            <div class="modal-body" id="modalContent">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .btn:hover {
                    transform: scale(1.05);
                    /* Efek zoom saat hover */
                }

                .spinner-border {
                    margin-left: 5px;
                }
            </style>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>
<!-- jQuery, Select2, dan Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->