<?php

function renderEditPermissions($menus, $permMap, $parent_id = 0, &$group = 0, $groupColors = [], $parentColor = null)
{
    if (empty($groupColors)) {
        $groupColors = [
            '#f2f8ff', // biru muda
            '#f9fff2', // hijau muda
            '#fff8f2', // oranye muda
            '#f2fff9', // aqua muda
            '#f2f2ff', // ungu muda
        ];
    }

    foreach ($menus as $menu) {
        if ($menu['parent_id'] == $parent_id) {
            if ($menu['level'] === 1) {
                // root -> ambil warna baru
                $rowColor = $groupColors[$group % count($groupColors)];
                $group++;
            } else {
                // anak -> pakai warna parent yg dikirim
                $rowColor = $parentColor ?? $groupColors[0];
            }
?>
            <tr style="background-color: <?= $rowColor ?>;">
                <td>
                    <?= str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $menu['level']) ?>
                    <?= str_repeat('↳', $menu['level'] - 1) ?> <?= esc($menu['nama_menu']) ?>
                    <input type="hidden" name="menu_ids[]" value="<?= $menu['id_menu'] ?>">
                </td>
                <td class="text-center">
                    <label class="switch view">
                        <input type="checkbox" name="view[]" value="<?= $menu['id_menu']  ?>" disabled
                            <?= isset($permMap[$menu['id_menu']]) && $permMap[$menu['id_menu']]['can_view'] ? 'checked' : '' ?>>
                        <span class="slider"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="switch edit">
                        <input type="checkbox" name="edit[]" value="<?= $menu['id_menu'] ?>" disabled
                            <?= isset($permMap[$menu['id_menu']]) && $permMap[$menu['id_menu']]['can_edit'] ? 'checked' : '' ?>>
                        <span class="slider"></span>
                    </label>
                </td>
                <td class="text-center">
                    <label class="switch delete">
                        <input type="checkbox" name="delete[]" value="<?= $menu['id_menu'] ?>" disabled
                            <?= isset($permMap[$menu['id_menu']]) && $permMap[$menu['id_menu']]['can_delete'] ? 'checked' : '' ?>>
                        <span class="slider"></span>
                    </label>
                </td>
            </tr>
<?php
            // render anak, kirim rowColor sebagai parentColor
            renderEditPermissions($menus, $permMap, $menu['id_menu'], $group, $groupColors, $rowColor);
        }
    }
}

?>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="card-icon">
                        <i class="material-icons">lock</i>
                    </div>
                    <h4 class="card-title mb-0 ml-2">Permission Role <?= $role['name']; ?></h4>
                </div>
                <?php if ($can_edit == true) : ?>
                    <a href="<?= site_url('role/edit_permission/' . $id_role) ?>" class="btn btn-warning btn-sm">
                        <i class="material-icons">edit</i> Edit Akses
                    </a>
                <?php endif ?>
            </div>
            <div class="card-body">
                <div class="material-datatables">
                    <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th class="text-center">View</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $group = 0;
                            renderEditPermissions($menus, $permMap, 0, $group);
                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Toggle switch style */
    .switch {
        position: relative;
        display: inline-block;
        width: 46px;
        height: 24px;
    }

    .switch input {
        display: none;
    }

    .slider {
        position: absolute;
        cursor: not-allowed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: currentColor;
    }

    input:checked+.slider:before {
        transform: translateX(22px);
    }

    /* Warna per tipe permission */
    .switch.view {
        color: #2196f3;
    }

    /* Biru */
    .switch.edit {
        color: #ff9800;
    }

    /* Oranye */
    .switch.delete {
        color: #f44336;
    }

    /* Merah */
</style>