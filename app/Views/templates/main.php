<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?= isset($title) ? $title : null ?></title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.ico') ?>" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <!-- CSS: Bootstrap (only CSS) + Material Icons + FontAwesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Material Dashboard CSS -->
    <link href="<?= base_url('assets/css/material-dashboard.min.css?v=2.1.0') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <style>
        /* LOADING */
        #loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 5px solid #ddd;
            border-top-color: #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ===== TREE MENU ===== */
        .sidebar-wrapper .nav {
            padding-left: 0;
            margin: 0;
            list-style: none;
        }

        .menu-level {
            padding-left: 0;
            margin: 0;
        }

        .menu-item {
            list-style: none;
            margin: 0;
        }

        .menu-row {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            cursor: pointer;
        }

        .menu-row .nav-link {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: inherit;
            width: 100%;
        }

        .menu-row .spacer {
            width: 36px;
            display: inline-block;
        }

        .toggle-btn {
            background: transparent;
            border: 0;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            padding: 0;
        }

        .toggle-icon {
            transition: transform .15s ease;
            font-size: 20px;
        }

        .submenu-wrapper {
            display: none;
            overflow: hidden;
        }

        .submenu-wrapper.open {
            display: block;
        }

        .toggle-btn[aria-expanded="true"] .toggle-icon {
            transform: rotate(90deg);
        }

        /* indentation */
        .menu-level-0>.menu-item>.menu-row {
            padding-left: 8px;
        }

        .menu-level-1 {
            padding-left: 12px;
        }

        .menu-level-2 {
            padding-left: 24px;
        }

        .menu-level-3 {
            padding-left: 36px;
        }

        /* menu-active link */
        .menu-active {
            background: linear-gradient(45deg, #3aa9ffff, #6fbefbff);
            color: #fff;
            border-radius: 4px;
        }

        .menu-row:hover {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 4px;
        }

        .menu-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* teks kiri, panah kanan */
            padding: 6px 10px;
        }

        .toggle-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            margin-left: 8px;
            font-size: 0.75rem;
            /* kecil */
            color: #555;
            transition: transform 0.2s ease;
        }

        .toggle-btn[aria-expanded="true"] i {
            transform: rotate(90deg);
            /* panah ke bawah saat open */
        }
    </style>

    <?= isset($_style) ? $_style : null ?>
</head>

<body>
    <!-- loading -->
    <div id="loading">
        <div class="spinner"></div>
    </div>

    <div class="wrapper">
        <div class="sidebar" data-color="rose" data-background-color="grey">
            <div class="logo">
                <a href="#" style="text-align: center;" class="simple-text logo-normal">SIPRO</a>
            </div>

            <div class="sidebar-wrapper">
                <div class="user text-center p-3">
                    <!-- Foto user -->
                    <div class="photo mb-2" style="margin-top: 10px;">
                        <img src="<?= base_url('assets/img/faces/profile-user.png') ?>"
                            alt="User"
                            class="img-fluid "
                            style="width: 100%; height: 40px; object-fit: cover;">
                    </div>

                    <!-- Nama user -->
                    <div class="user-info mb-2">
                        <span class="d-block font-weight-bold">
                            <?= user()->username ?>
                        </span>
                    </div>

                    <!-- Tombol Logout -->
                    <div>
                        <a class="btn btn-sm btn-danger" href="<?= base_url('logout') ?>">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>


                <!-- RENDER MENU TREE -->
                <nav class="nav">
                    <?= renderMenuTree($menuTree) ?>
                </nav>
            </div>
        </div>

        <div class="main-panel">
            <div class="content">
                <?= isset($contents) ? $contents : null ?>
                <?= isset($_script) ? $_script : null ?>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <nav class="float-left">
                        <ul>
                            <li><a href="https://www.bpiw.pu.go.id">BPIW</a></li>
                        </ul>
                    </nav>
                    <div class="copyright float-right">
                        &copy;<script>
                            document.write(new Date().getFullYear())
                        </script>,
                        made with <i class="material-icons">favorite</i> by
                        <a href="https://bpiw.pu.go.id" target="_blank">BPIW Tim</a>.
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // hide loading
        window.addEventListener("load", function() {
            document.getElementById("loading").style.display = "none";
        });

        (function($) {
            $(function() {
                // Klik tombol panah
                $('.sidebar-wrapper').on('click', '.toggle-btn', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSubmenu($(this));
                });

                // Klik teks (link) yang punya child
                $('.sidebar-wrapper').on('click', '.tree-link.has-children', function(e) {
                    e.preventDefault(); // cegah redirect
                    e.stopPropagation();
                    var $btn = $(this).closest('.menu-row').find('.toggle-btn');
                    toggleSubmenu($btn);
                });

                // Fungsi toggle submenu
                function toggleSubmenu($btn) {
                    var expanded = $btn.attr('aria-expanded') === 'true';
                    var $submenu = $btn.closest('.menu-row').next('.submenu-wrapper');

                    if ($submenu.length) {
                        if (expanded) {
                            $btn.attr('aria-expanded', 'false');
                            $submenu.slideUp(200, function() {
                                $submenu.removeClass('open');
                            });
                        } else {
                            $btn.attr('aria-expanded', 'true');
                            $submenu.slideDown(200, function() {
                                $submenu.addClass('open');
                            });
                        }
                    }
                }

                // Klik link biasa: menu-active + buka parent
                $('.sidebar-wrapper').on('click', '.tree-link:not(.has-children)', function() {
                    $('.tree-link').removeClass('menu-active');
                    $(this).addClass('menu-active');
                    openParents($(this));
                });

                function openParents($el) {
                    var $submenu = $el.closest('.submenu-wrapper');
                    if ($submenu.length) {
                        $submenu.slideDown(200).addClass('open');
                        $submenu.prev('.menu-row').find('.toggle-btn').attr('aria-expanded', 'true');
                        openParents(
                            $submenu.prev('.menu-row').closest('.menu-item').parents('.submenu-wrapper').first().prev().find('.tree-link')
                        );
                    }
                }

                // On load: buka menu sesuai URL
                (function() {
                    var currentPath = window.location.pathname.replace(/\/$/, '') || '/';

                    $('.tree-link').each(function() {
                        var href = $(this).attr('href');
                        if (!href) return;

                        var a = document.createElement('a');
                        a.href = href;
                        var linkPath = a.pathname.replace(/\/$/, '') || '/';

                        if (linkPath === currentPath) {
                            // hanya kasih menu-active kalau link BUKAN parent
                            if (!$(this).hasClass('has-children')) {
                                $('.tree-link').removeClass('menu-active open-parent'); // reset
                                $(this).addClass('menu-active'); // anak jadi menu-active
                            }

                            // buka semua parentnya
                            var $row = $(this).closest('.menu-row');
                            var $parentSub = $row.closest('.submenu-wrapper');
                            while ($parentSub.length) {
                                $parentSub.show().addClass('open'); // buka parent
                                var $parentRow = $parentSub.prev('.menu-row');
                                $parentRow.find('.toggle-btn').attr('aria-expanded', 'true');
                                $parentRow.find('.tree-link').addClass('open-parent'); // parent cukup open-parent
                                $parentSub = $parentSub.parent().closest('.submenu-wrapper');
                            }
                        }
                    });
                })();

            });
        })(jQuery);
    </script>


    <?= isset($_script) ? $_script : null ?>
    <!-- Section khusus script -->
    <?= $this->renderSection('_script') ?>
</body>

</html>