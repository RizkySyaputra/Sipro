<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">source</i>
                </div>
                <h4 class="card-title">Data User</h4>
            </div>
            <div class="card-body">
                <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>No </th>
                                <th>Username</th>
                                <th>Role Akses</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No </th>
                                <th>Username</th>
                                <th>Role Akses</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($user as $user) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $user->username; ?></td>
                                    <td><?= $user->name; ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm" onclick="openUpdateRoleModal('<?= $user->user_id; ?>', '<?= $user->name; ?>')">Update</button>
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete('<?= $user->user_id;; ?>')">Delete</button>
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
<!-- end row -->
<!-- Modal Confirm Delete -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus pengguna ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Role Akses -->
<div class="modal fade" id="updateRoleModal" tabindex="-1" role="dialog" aria-labelledby="updateRoleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateRoleLabel">Update Role Akses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateRoleForm">
                    <label for="roleSelect">Pilih Role Akses</label>
                    <div class="form-group">
                        <select class="form-control" id="roleSelect" name="role">
                            <?php
                            foreach ($role as $role) : ?>
                                <option value="<?= $role['id']; ?>"><?= $role['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmUpdateRoleButton">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Notifikasi -->
<div class="modal fade" id="notifModal" tabindex="-1" aria-labelledby="notifModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notifModalLabel">Notifikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="notifMessage">
                <!-- Pesan akan diisi dengan JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="location.reload()">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openUpdateRoleModal(userId, currentRole) {
        console.log("User ID:", userId); // Debugging
        // Set the current role to the select dropdown
        $('#roleSelect').val(currentRole);

        // Show the modal
        $('#updateRoleModal').modal('show');

        // On save button click
        $('#confirmUpdateRoleButton').off('click').on('click', function() {
            const newRoleId = $('#roleSelect').val(); // Get the new role
            updateRole(userId, newRoleId); // Call the function to update the role
        });
    }

    function updateRole(userId, newRoleId) {
        $.ajax({
            url: '<?= base_url('/update-user')?>', // URL untuk update role
            type: 'POST',
            data: {
                id: userId,
                role_id: newRoleId,
            },
            success: function(response) {
                if (response.success) {
                    // Tutup modal update role
                    $('#updateRoleModal').modal('hide');

                    // Tampilkan modal notifikasi
                    $('#notifMessage').html('Role akses berhasil diperbarui!');
                    $('#notifModal').modal('show');
                } else {
                    $('#notifMessage').html('Terjadi kesalahan saat mengupdate role akses.');
                    $('#notifModal').modal('show');
                }
            },
            error: function() {
                $('#notifMessage').html('Terjadi kesalahan. Gagal mengupdate role akses.');
                $('#notifModal').modal('show');
            }
        });
    }

    function confirmDelete(id) {
        $('#confirmDeleteModal').modal('show');
        document.getElementById('confirmDeleteButton').onclick = function() {
            $.ajax({
                url: '<?= base_url('/delete-user/')?>' + id,
                type: 'GET',
                success: function(response) {
                    location.reload(); // Refresh halaman setelah sukses
                },
                error: function() {
                    alert('Gagal menghapus user.');
                }
            });
        };
    }
</script>