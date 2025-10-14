<?php

function buildMenuTree(array $menus, $parentId = 0)
{
    $branch = [];
    foreach ($menus as $menu) {
        if ((int)$menu['parent_id'] === (int)$parentId) {
            $children = buildMenuTree($menus, $menu['id_menu']);
            if ($children) {
                $menu['children'] = $children;
            }
            $branch[] = $menu;
        }
    }
    return $branch;
}

function renderMenuTree(array $tree)
{
    $html = '';
    foreach ($tree as $menu) {
        $hasChild   = isset($menu['children']);
        $collapseId = 'menu_' . $menu['id_menu'];

        if ($hasChild) {
            $html .= '
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">
                        <i class="material-icons">source</i>
                        <p>' . esc($menu['nama_menu']) . '<b class="caret"></b></p>
                    </a>
                    <div class="collapse" id="' . $collapseId . '">
                        <ul class="nav submenu">';
            $html .= renderMenuTree($menu['children']);
            $html .= '</ul>
                    </div>
                </li>';
        } else {
            $html .= '
                <li class="nav-item">
                    <a class="nav-link"  href="' . base_url($menu['link'] ?? '#') . '">
                        <i class="material-icons">arrow_right</i>
                        <span class="sidebar-normal">' . esc($menu['nama_menu']) . '</span>
                    </a>
                </li>';
        }
    }
    return $html;
}
