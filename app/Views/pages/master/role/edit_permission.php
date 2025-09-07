<h2>Atur Akses Role</h2>
<form method="post" action="<?= site_url('role/updatePermission/' . $role_id) ?>">
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Menu</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menus as $menu): ?>
                <tr>
                    <td>
                        <?= $menu['parent_id'] ? '&nbsp;&nbsp;&nbsp;↳ ' : '' ?>
                        <?= esc($menu['nama_menu']) ?>
                        <input type="hidden" name="menu_ids[]" value="<?= $menu['id_menu'] ?>">
                    </td>
                    <td><input type="checkbox" name="view[]" value="<?= $menu['id_menu'] ?>" <?= isset($permMap[$menu['id_menu']]) && $permMap[$menu['id_menu']]['can_view'] ? 'checked' : '' ?>></td>
                    <td><input type="checkbox" name="edit[]" value="<?= $menu['id_menu'] ?>" <?= isset($permMap[$menu['id_menu']]) && $permMap[$menu['id_menu']]['can_edit'] ? 'checked' : '' ?>></td>
                    <td><input type="checkbox" name="delete[]" value="<?= $menu['id_menu'] ?>" <?= isset($permMap[$menu['id_menu']]) && $permMap[$menu['id_menu']]['can_delete'] ? 'checked' : '' ?>></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <button type="submit">Simpan Akses</button>
</form>