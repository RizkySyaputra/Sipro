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
    <!-- <link href="<?= base_url('assets/css/material-dashboard.min.css?v=2.1.0') ?>" rel="stylesheet" /> -->

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/img/apple-icon.png') ?>">
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.ico') ?>">
    <title>
        <?= isset($title) ? $title : null ?>
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <!-- <link href="<?= base_url('assets/demo/demo.css') ?>" rel="stylesheet" /> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> -->

    <!-- CSS Material Design -->
    <link href="<?= base_url('assets/css/material-dashboard.min.css?v=2.1.0') ?>" rel="stylesheet" />
    <!-- DataTables -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" /> -->

    <!-- CSS for Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">


    <style>
        /* CSS untuk animasi loading */
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

        /* Menu utama */
        .menu-main>a {
            background: linear-gradient(45deg, #333333, #555555);
            /* Gradasi abu-abu gelap */
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 5px;
            text-decoration: none;
            display: flex;
            align-items: center;
        }


        /* Hover efek */
        .menu-main>a:hover,
        .submenu>.nav-item>a:hover,
        .sub-submenu>.nav-item>a:hover {
            background: linear-gradient(45deg, #222222, #444444);
            /* Abu-abu lebih gelap saat hover */
            opacity: 0.9;
        }

        .menu-level .menu-item {
            font-weight: 600;
        }


        /* Tambahan styling */
        .nav-item {
            margin-bottom: 10px;
        }

        .content {
            background-color: #e6e6e6;
            margin-top: -20px !important;
        }

        #peta {
            height: 400px;
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
            background-color: #ffffff;
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

        .footer {
            background-color: #e6e6e6;
        }

        /* Gaya khusus dropdown tahun */
        .tahun-container {
            border-radius: 12px;
            padding: 10px 12px;
            text-align: center;
            width: 100%;
            margin-top: 10px;
            transition: all 0.2s ease-in-out;
        }


        .tahun-container label {
            font-size: 13px;
            font-weight: 600;
            color: #495057;
            display: block;
            margin-bottom: 4px;
        }

        .tahun-container select {
            font-size: 14px;
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 5px 8px;
            width: 100%;
            transition: all 0.2s ease;
            cursor: pointer;
            text-align: center;
        }

        .tahun-container select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }

        .tahun-container option {
            text-align: center;
        }

        /* Spinner Overlay */
        #loading-overlay {
            display: none;
            position: fixed;
            z-index: 9999;
            background: rgba(255, 255, 255, 0.85);
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            text-align: center;
            padding-top: 200px;
        }

        .spinner {
            border: 6px solid #f3f3f3;
            border-top: 6px solid #007bff;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 0.8s linear infinite;
            margin: 0 auto 10px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #loading-overlay p {
            color: #333;
            font-weight: 500;
            margin-top: 10px;
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
        <div class="sidebar" data-color="rose" data-background-color="white">
            <div class="logo d-flex justify-content-center">
                <img src="<?= base_url('assets/img/logo-sipro-horizontal.png') ?>" alt="Logo Sipro" width="140">
                <!-- <a href="#" style="text-align: center;" class="simple-text logo-normal">SIPRO</a> -->
            </div>
            <!-- Dropdown Pilih Tahun -->

            <div class="sidebar-wrapper">
                <div class="user dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none" id="userDropdown" data-toggle="dropdown" aria-expanded="false">
                        <!-- Foto user -->
                        <div class="photo me-2">
                            <img src="<?= base_url('assets/img/faces/profile-user.png') ?>"
                                alt="User">
                        </div>

                        <!-- Nama user -->
                        <div class="user-info">
                            <span class="d-block font-weight-bold" style="text-transform: capitalize;">
                                <?= user()->username ?>
                            </span>
                        </div>
                    </a>

                    <div class="dropdown-menu ml-4" aria-labelledby="userDropdown">
                        <a class="dropdown-item text-white bg-secondary mb-1" href="<?= base_url('profile') ?>">
                            <i class="fas fa-user-alt mr-2"></i> Profil
                        </a>
                        <a class="dropdown-item text-white bg-secondary" href="<?= base_url('logout') ?>">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </div>
                <!-- Dropdown Pilih Tahun -->
                <div class="tahun-container">
                    <form id="form-tahun">
                        <label for="tahun-pelaksana">Tahun Pelaksanaan</label>
                        <select id="tahun-pelaksana" name="tahun_pelaksana" style="width: 110px;">
                            <option value="">Pilih Tahun</option>
                            <?php
                            $tahunAktif = session('tahun_pelaksana');
                            for ($i = 2025; $i <= 2029; $i++):
                            ?>
                                <option value="<?= $i ?>" <?= ($tahunAktif == $i) ? 'selected' : '' ?>>
                                    <?= $i ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </form>
                </div>

                <div id="loading-overlay">
                    <div class="spinner"></div>
                    <p>Memproses tahun pelaksanaan...</p>
                </div>
                <!-- Tombol Logout -->
                <!-- <div>
                    <a class="btn btn-sm btn-danger" href="<?= base_url('logout') ?>">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>

                    <div class="collapse" id="user">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('logout') ?>">
                                    <i class="material-icons">exit_to_app</i>
                                    <span class="sidebar-normal">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div> -->


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
                    <!-- <nav class="float-left">
                        <ul>
                            <li><a href="https://www.bpiw.pu.go.id">BPIW</a></li>
                        </ul>
                    </nav> -->
                    <div class="copyright float-right">
                        &copy;<script>
                            document.write(new Date().getFullYear())
                        </script>,
                        made with <i class="material-icons">favorite</i> by
                        <a href="https://bpiw.pu.go.id" target="_blank">BPIW</a>.
                    </div>
                </div>
            </footer>
        </div>
    </div>


    <!-- SCRIPTS -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
    <script>
        $(document).ready(function() {
            // $('.submenu-wrapper').hide().removeClass('open');
            // $('.tree-link').removeClass('menu-active open-parent');
            // $('.toggle-btn').attr('aria-expanded', 'false');
            // Pilih semua elemen yang memiliki class mengandung 'parent-'
            $('.menu-item[class*="parent-"]').each(function() {
                var $parent = $(this);

                // Contoh: sembunyikan submenu
                $parent.find('.submenu-wrapper').hide().removeClass('open');

                // Set tombol toggle tertutup
                $parent.find('.toggle-btn').attr('aria-expanded', 'false');

                // Hapus tanda parent terbuka
                $parent.find('.tree-link').removeClass('open-parent');
            });

        });

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

                    // On load: tutup semua submenu dulu
                    // $('.submenu-wrapper').hide().removeClass('open');
                    // $('.tree-link').removeClass('menu-active open-parent');
                    // $('.toggle-btn').attr('aria-expanded', 'false');

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

                            // $('.submenu-wrapper').hide().removeClass('open');
                            // $('.tree-link').removeClass('menu-active open-parent');
                            // $('.toggle-btn').attr('aria-expanded', 'false');

                            // buka semua parentnya
                            var $row = $(this).closest('.menu-row');
                            var $parentSub = $row.closest('.submenu-wrapper');

                            if ($row.find('.nav-link').hasClass('menu-active')) {
                                while ($parentSub.length) {
                                    $parentSub.show().addClass('open'); // buka parent
                                    var $parentRow = $parentSub.prev('.menu-row');
                                    $parentRow.find('.toggle-btn').attr('aria-expanded', 'true');
                                    $parentRow.find('.tree-link').addClass('open-parent'); // parent cukup open-parent
                                    $parentSub = $parentSub.parent().closest('.submenu-wrapper');
                                }
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
    <!-- Dropdown Tahun -->

    <script>
        $('#tahun-pelaksana').select2();
        $(document).ready(function() {
            $('#tahun-pelaksana').on('change', function() {
                let tahun = $(this).val();
                if (tahun) {
                    // Tampilkan spinner
                    $('#loading-overlay').fadeIn(200);

                    $.ajax({
                        url: "<?= base_url('set_tahun') ?>", // ganti sesuai controller kamu
                        type: "POST",
                        data: {
                            tahun_pelaksana: tahun,
                            csrf_test_name: '<?= csrf_hash() ?>'
                        },
                        success: function(response) {
                            // Tutup spinner dan reload halaman
                            setTimeout(() => {
                                $('#loading-overlay').fadeOut(300, function() {
                                    location.reload();
                                });
                            }, 700);
                        },
                        error: function() {
                            $('#loading-overlay').fadeOut(300);
                            alert("Gagal menyimpan tahun pelaksanaan!");
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>