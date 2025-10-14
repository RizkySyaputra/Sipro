<?php
$a = 1;
foreach ($nomenklaturs as $nm) : ?>
    <tr>
        <td><?= $a++; ?></td>
        <td><?= $nm->nm_program ?></td>
        <td><?= $nm->nm_kegiatan ?></td>
        <td><?= $nm->nm_kro ?></td>
        <td><?= $nm->nm_ro ?></td>
        <td><?= $nm->nama_satuan ?></td>
        <td>
            <button class="btn-view btn btn-sm btn-success" data-id="<?= htmlspecialchars($nm->id_program) . ':' . htmlspecialchars($nm->id_kegiatan) . ':' . htmlspecialchars($nm->id_kro) . ':' . htmlspecialchars($nm->id_ro)  ?>">
                <i class="bi bi-eye" style="font-size: 15px;"></i>
            </button>
        </td>
    </tr>
<?php endforeach; ?>

<script>
    $('.btn-view').on('click', function() {
        $('#loading').show();

        var recordId = $(this).data('id');
        detailNomenklatur(recordId);
        // alert('tesss');
    });

    function detailNomenklatur(id) {
        // alert(id);
        let paramNomenklatur = id ? id.toString().split(':') : [];

        let id_program = paramNomenklatur[0] || '';
        let id_kegiatan = paramNomenklatur[1] || '';
        let id_kro = paramNomenklatur[2] || '';
        let id_ro = paramNomenklatur[3] || '';

        $.ajax({
            url: '<?= base_url('master/get_detail_nomenklatur'); ?>',
            types: 'GET',
            dataType: 'json',
            data: {
                program: id_program,
                kegiatan: id_kegiatan,
                kro: id_kro,
                ro: id_ro
            },
            success: function(response) {
                // console.log(response);

                let content = ` 

                    <div class="form-group row modal-border-bottom">
                        <label class="col-sm-4 col-form-label">Periode</label>
                        <div class="col-sm-8 col-form-label">
                            ${response.periode}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Kode Program</label>
                        <div class="col-sm-8 col-form-label">
                            ${response.id_program}
                        </div>
                    </div>
                    <div class="form-group row modal-border-bottom">
                        <label class="col-sm-4 col-form-label">Nama Program</label>
                        <div class="col-sm-8 col-form-label">
                            ${response.nm_program}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Kode Kegiatan</label>
                        <div class="col-sm-8 col-form-label">
                            ${response.id_kegiatan}
                        </div>
                    </div>
                    <div class="form-group row modal-border-bottom">
                        <label class="col-sm-4 col-form-label">Nama Kegiatan</label>
                        <div class="col-sm-8 col-form-label">
                            ${response.nm_kegiatan}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Kode KRO</label>
                        <div class="col-sm-8 col-form-label">
                            ${response.id_kro}
                        </div>
                    </div>
                    <div class="form-group row modal-border-bottom">
                        <label class="col-sm-4 col-form-label">Nama KRO</label>
                        <div class="col-sm-8 col-form-label">
                            ${response.nm_kro}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Kode RO</label>
                        <div class="col-sm-8 col-form-label">
                            ${response.id_ro}
                        </div>
                    </div>
                    <div class="form-group row modal-border-bottom">
                        <label class="col-sm-4 col-form-label">Nama RO</label>
                        <div class="col-sm-8 col-form-label">
                            ${response.nm_ro}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Satuan</label>
                        <div class="col-sm-8 col-form-label">
                            ${response.nama_satuan}
                        </div>
                    </div>
                `;
                $('#modalContent').html(content);
                $('#detailNomenklaturModal').modal('show'); // Menampilkan modal

                // Swal.fire({
                //     // title: 'Detail Nomenklatur',
                //     html: `
                //             <div style="text-align:left;">
                //                 <label style="font-size: 24px; color: #404040; font-weight: bold; margin-bottom: 20px;">Detail Nomenklatur Program</label>
                //             </div>
                //             <div style="text-align:left; margin-bottom:10px;">
                //                <span style="font-size: 16px; font-weight: bold">${response.id_ro}</span>
                //             </div>
                //             <div style="text-align:left; margin-bottom:30px;">
                //                <span style="font-size: 14px; font-weight: bold; color: #ccc">Periode ${response.periode}</span>
                //             </div>
                //              <div class="row mb-3">
                //                 <label for="id_program" class="col-sm-3" style="font-size: 14px; font-weight: bold; color: #404040; text-align: left;">Kode Program</label>
                //                 <div class="col-sm-1">:</div>
                //                 <div class="col-sm-8 text-left">
                //                     <span style="font-size: 15px;">${response.id_program}</span>
                //                 </div>
                //             </div>
                //              <div class="row mb-3">
                //                 <label for="program" class="col-sm-3" style="font-size: 14px; font-weight: bold; color: #404040; text-align: left;">Program</label>
                //                 <div class="col-sm-1">:</div>
                //                 <div class="col-sm-8 text-left">
                //                     <span style="font-size: 15px;">${response.nm_program}</span>
                //                 </div>
                //             </div>
                //             <hr style="border: 1px solid #ccc;">
                //              <div class="row mb-3">
                //                 <label for="id_kegiatan" class="col-sm-3" style="font-size: 14px; font-weight: bold; color: #404040; text-align: left;"><strong>Kode Kegiatan</strong></label>
                //                 <div class="col-sm-1">:</div>
                //                 <div class="col-sm-8 text-left">
                //                     <span style="font-size: 15px;">${response.id_kegiatan}</span>
                //                 </div>
                //             </div>
                //              <div class="row mb-3">
                //                 <label for="kegiatan" class="col-sm-3" style="font-size: 14px; font-weight: bold; color: #404040; text-align: left;"><strong>Kegiatan</strong></label>
                //                 <div class="col-sm-1">:</div>
                //                 <div class="col-sm-8 text-left">
                //                     <span style="font-size: 15px;">${response.nm_kegiatan}</span>
                //                 </div>
                //             </div>
                //             <hr style="border: 1px solid #ccc;">
                //              <div class="row mb-3">
                //                 <label for="id_kro" class="col-sm-3" style="font-size: 14px; font-weight: bold; color: #404040; text-align: left;"><strong>Kode KRO</strong></label>
                //                 <div class="col-sm-1">:</div>
                //                 <div class="col-sm-8 text-left">
                //                     <span style="font-size: 15px;">${response.id_kro}</span>
                //                 </div>
                //             </div>
                //              <div class="row mb-3">
                //                 <label for="kro" class="col-sm-3" style="font-size: 14px; font-weight: bold; color: #404040; text-align: left;"><strong>KRO</strong></label>
                //                 <div class="col-sm-1">:</div>
                //                 <div class="col-sm-8 text-left">
                //                     <span style="font-size: 15px;">${response.nm_kro}</span>
                //                 </div>
                //             </div>
                //             <hr style="border: 1px solid #ccc;">
                //             <div class="row mb-3">
                //                 <label for="id_ro" class="col-sm-3" style="font-size: 14px; font-weight: bold; color: #404040; text-align: left;"><strong>Kode RO</strong></label>
                //                 <div class="col-sm-1">:</div>
                //                 <div class="col-sm-8 text-left">
                //                     <span style="font-size: 15px;">${response.id_ro}</span>
                //                 </div>
                //             </div>
                //             <div class="row mb-3">
                //                 <label for="ro" class="col-sm-3" style="font-size: 14px; font-weight: bold; color: #404040; text-align: left;"><strong>RO</strong></label>
                //                 <div class="col-sm-1">:</div>
                //                 <div class="col-sm-8 text-left">
                //                     <span style="font-size: 15px;">${response.nm_ro}</span>
                //                 </div>
                //             </div>
                //             <hr style="border: 1px solid #ccc;">
                //             <div class="row mb-3">
                //                 <label for="satuan" class="col-sm-3" style="font-size: 14px; font-weight: bold; color: #404040; text-align: left;"><strong>Satuan</strong></label>
                //                 <div class="col-sm-1">:</div>
                //                 <div class="col-sm-8 text-left">
                //                     <span style="font-size: 15px;">${response.nama_satuan}</span>
                //                 </div>
                //             </div>
                //     `,
                //     width: '600px',
                //     showCloseButton: true,
                //     confirmButtonText: 'Kembali'
                // });
            },
            error: function() {
                Swal.fire('Error', 'Gagal mengambil data.', 'error');
            },
            complete: function() {
                $('#loading').hide();
            }


        });
    }
</script>