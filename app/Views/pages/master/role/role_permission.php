<h2>Permission Role</h2>
<table border="1">
    <tr>
        <th>Menu</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php foreach ($permissions as $perm): ?>
        <tr>
            <td><?= $perm['nama_menu'] ?></td>
            <td><?= $perm['can_view'] ? '✔' : '-' ?></td>
            <td><?= $perm['can_edit'] ? '✔' : '-' ?></td>
            <td><?= $perm['can_delete'] ? '✔' : '-' ?></td>
        </tr>
    <?php endforeach; ?>
</table>