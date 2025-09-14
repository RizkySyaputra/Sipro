<?php
function renderMenuVisibility($menus, $parent_id = 0, &$group = 0, $groupColors = [], $parentColor = null)
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
            if ($menu['level'] == 1) {
                $rowColor = $groupColors[$group % count($groupColors)];
                $group++;
            } else {
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
                    <label class="switch">
                        <input type="checkbox" name="is_active[]" value="<?= $menu['id_menu'] ?>"
                            <?= $menu['is_active'] ? 'checked' : '' ?>>
                        <span class="slider"></span>
                    </label>
                </td>
            </tr>
<?php
            renderMenuVisibility($menus, $menu['id_menu'], $group, $groupColors, $rowColor);
        }
    }
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-warning card-header-icon d-flex align-items-center">
                <div class="card-icon">
                    <i class="material-icons">tune</i>
                </div>
                <h4 class="card-title mb-0 ml-2">Pengaturan Menu</h4>
            </div>
            <div class="card-body">
                <form method="post" action="<?= site_url('menu/updateVisibilitas') ?>">
                    <div class="material-datatables">
                        <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
                            <thead class="text-primary">
                                <tr>
                                    <th>Menu</th>
                                    <th class="text-center">Show</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $group = 1;
                                renderMenuVisibility($menus, 0, $group);
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="material-icons">save</i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
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
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
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
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: #4caf50;
    }

    input:checked+.slider:before {
        transform: translateX(22px);
    }
</style>