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

/**
 * renderMenuTree
 * - Men-generate nested <ul> / <li> tree.
 * - Untuk item yang punya child, kita buat tombol toggle (span/button) dan submenu <ul class="submenu"> yang disembunyikan lewat CSS.
 * - $level untuk styling/indentation bila perlu.
 */
function renderMenuTree($menus, $level = 0, $parentClass = '')
{
    $html = '<ul class="menu-level menu-level-' . $level . ' ' . $parentClass . '">';

    foreach ($menus as $menu) {
        $hasChildren = !empty($menu['children']);
        $menuId = 'menu-' . $menu['id_menu'];
        $extraClass = ($level === 0) ? 'parent-' . $menu['id_menu'] : '';

        $html .= '<li class="menu-item ' . $extraClass . '">';
        $html .= '<div class="menu-row">';

        // Link menu utama
        if ($hasChildren) {
            // kalau ada anak → kasih atribut data-toggle="submenu"
            $html .= '<a href="#' . $menuId . '" class="nav-link tree-link has-children" data-toggle="submenu">'
                . '<span>' . esc($menu['nama_menu']) . '</span></a>';
        } else {
            // kalau tidak ada anak → normal link
            $html .= '<a href="' . base_url($menu['link'] ?? '#') . '" class="nav-link tree-link">'
                . '<span>' . esc($menu['nama_menu']) . '</span></a>';
        }


        // Panah di kanan (hanya kalau ada child)
        if ($hasChildren) {
            $html .= '<button class="toggle-btn" aria-expanded="false" aria-controls="' . $menuId . '">
                        <i class="fas fa-chevron-right"></i>
                      </button>';
        }

        $html .= '</div>';

        if ($hasChildren) {
            $html .= '<div class="submenu-wrapper" id="' . $menuId . '">';
            $html .= renderMenuTree($menu['children'], $level + 1, 'parent-' . $menu['id_menu']);
            $html .= '</div>';
        }

        $html .= '</li>';
    }

    $html .= '</ul>';

    return $html;
}
