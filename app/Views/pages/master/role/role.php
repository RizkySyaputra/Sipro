<h2>Daftar Role</h2>
<ul>
    <?php foreach ($roles as $role): ?>
        <li><?= $role['name'] ?> -
            <a href="<?= site_url('role/permission/' . $role['id']) ?>">Lihat Akses</a>
            <a href="<?= site_url('role/edit_permission/' . $role['id']) ?>">Edit Permission</a>
        </li>
    <?php endforeach; ?>
</ul>