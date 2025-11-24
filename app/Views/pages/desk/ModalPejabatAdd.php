<style>
    /* Warna abu-abu untuk field disabled */
    input:disabled,
    textarea:disabled,
    select:disabled {
        background-color: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
        border: 1px solid #d1d1d1 !important;
        /* tetap ada border halus */
    }

    /* Tambahkan border untuk semua input yang bisa diedit */
    input:not(:disabled),
    textarea:not(:disabled),
    select:not(:disabled) {
        border: 1px solid #000000ff !important;
        /* warna border biru */
        box-shadow: none !important;
        transition: border-color 0.2s ease-in-out;
    }

    /* Efek saat fokus (klik) */
    input:not(:disabled):focus,
    textarea:not(:disabled):focus,
    select:not(:disabled):focus {
        border-color: #000000ff !important;
        /* biru lebih gelap saat fokus */
        box-shadow: 0 0 3px rgba(0, 123, 255, 0.3);
        outline: none;
    }

    /* Agar field readonly tetap terlihat tapi tidak seperti editable */
    input[readonly],
    textarea[readonly] {
        background-color: #f8f9fa;
        border: 1px solid #ccc;
        color: #6c757d;
    }

    /* Style tambahan agar form tampak rapi */
    .form-control,
    .form-select {
        border-radius: 6px;
        padding: 6px 10px;
    }

    .catatan-item {
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
    }

    .catatan-text {
        text-align: justify;
        color: #333;
        margin: 0;
        white-space: pre-line;
    }
</style>
<form id="addPejabatForm" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="row g-3">
        <div class="col-md-6">
            <label><strong>NIP</strong></label>
            <input type="text" name="nip" class="form-control">

            <label><strong>Nama Pejabat</strong></label>
            <input type="text" name="nama_pejabat" class="form-control">

            <label><strong>Jabatan</strong></label>
            <input type="text" name="jabatan" class="form-control">

            <label><strong>Unit Kerja</strong></label>
            <input type="text" name="unit_kerja" class="form-control">

            <label><strong>Unit Organisasi</strong></label>
            <input type="text" name="unit_organisasi" class="form-control">
        </div>

        <div class="col-md-6">
            <label><strong>Instansi</strong></label>
            <input type="text" name="instansi" class="form-control">

            <label><strong>Email</strong></label>
            <input type="text" name="email" class="form-control">

            <label><strong>No Telepon</strong></label>
            <input type="text" name="no_telp" class="form-control">

            <label><strong>Tanda Tangan</strong></label>
            <input type="file" name="tanda_tangan" class="form-control" accept="image/*">
        </div>
    </div>

    <div class="text-end mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan
        </button>
    </div>
</form>

<script>
    $(document).on('submit', '#addPejabatForm', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "<?= base_url('pejabat/store') ?>",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.status) {
                    $('#memoModal').modal('hide');

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: res.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // reload table
                    $('#button-text').submit();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        html: res.message
                    });
                }
            }
        });
    });
</script>