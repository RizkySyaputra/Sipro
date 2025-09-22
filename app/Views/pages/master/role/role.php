<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">groups</i>
                </div>
                <h4 class="card-title">Daftar Role</h4>
            </div>
            <div class="card-body">
                <div class="toolbar">
                    <!-- Tombol tambahan bisa ditaruh di sini -->
                </div>
                <div class="material-datatables">
                    <table id="roleTable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Role</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Role</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($roles as $role): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $role['name']; ?></td>
                                    <td class="text-center">
                                        <a href="<?= site_url('role/permission/' . $role['id']) ?>" class="btn btn-info btn-sm">Lihat Akses</a>
                                        <!-- <a href="<?= site_url('role/edit_permission/' . $role['id']) ?>" class="btn btn-warning btn-sm">Edit Permission</a> -->
                                        <?php if ($can_delete == true) : ?> <button class="btn btn-danger btn-sm" onclick="confirmDeleteRole('<?= $role['id']; ?>')">Delete</button><?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end content-->
        </div>
        <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
</div>

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="confirmDeleteRoleModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteRoleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteRoleLabel">Konfirmasi Hapus Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus role ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteRoleButton">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDeleteRole(id) {
        $('#confirmDeleteRoleModal').modal('show');
        document.getElementById('confirmDeleteRoleButton').onclick = function() {
            $.ajax({
                url: '<?= base_url('/delete-role/') ?>' + id,
                type: 'GET',
                success: function(response) {
                    location.reload();
                },
                error: function() {
                    alert('Gagal menghapus role.');
                }
            });
        };
    }
</script>