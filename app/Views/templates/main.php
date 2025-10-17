<!DOCTYPE html>
<html lang="en">

<head>
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

        /* Tambahan styling */
        .nav-item {
            margin-bottom: 10px;
        }

        .content {
            margin-top: -20px !important;
        }

        #peta {
            height: 400px;
            width: 100%;
            margin-right: 10px;
        }

        button.filter {
            background-color: #222cb1;
            /* Hijau */
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* old */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            max-height: 200px;
            /* Tinggi maksimum */
            overflow-y: auto;
            /* Scroll jika konten lebih tinggi */
        }

        .dropdown-content label {
            padding: 12px 16px;
            cursor: pointer;
            display: block;
        }

        .dropdown-content label:hover {
            background-color: #222cb1;
        }

        .show {
            display: block;
        }
    </style>
    <meta charset="utf-8" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />


    <!-- CSS for Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">

    <?= isset($_style) ? $_style : null ?>
</head>

<body>

    <!-- Elemen Loading -->
    <div id="loading">
        <div class="spinner"></div>
    </div>
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="wrapper ">
        <div class="sidebar" data-color="rose" data-background-color="black">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo">
                <a href="#" class="simple-text logo-mini">
                </a>
                <a href="#" class="simple-text logo-normal">
                    SIPRO
                </a>
            </div>
            <!-- app/Views/layout/sidebar.php -->
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="<?= base_url('assets/img/faces/profile-user.png') ?>" />
                    </div>
                    <div class="user-info">
                        <a data-toggle="collapse" href="#user" class="username">
                            <span><?= user()->username ?><b class="caret"></b></span>
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
                    </div>
                </div>

                <ul class="nav">
                    <?= renderMenuTree($menuTree) ?>
                </ul>

            </div>

        </div>

        <div class="main-panel">

            <div class="content">

                <?= isset($contents) ? $contents : null ?>
                <?= isset($_script) ? $_script : null ?>
                <div class="container-fluid">
                    <div class="row">
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="float-left">
                            <ul>
                                <li>
                                    <a href="https://www.bpiw.pu.go.id">
                                        BPIW
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="copyright float-right">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>, made with <i class="material-icons">favorite</i> by
                            <a href="https://bpiw.pu.go.id" target="_blank">BPIW Tim</a> for a better web.
                        </div>
                    </div>
                </footer>
            </div>

            <!--   Core JS Files   -->

            <!-- Load JQUery -->
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
            <!-- <script src="<?= base_url('assets/js/core/jquery.min.js') ?>"></script> -->
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

            <!-- Bootstrap bundle with Popper.js -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

            <!-- Plugins -->
            <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.jquery.min.js') ?>"></script>
            <!-- Plugin for the momentJs  -->
            <script src="<?= base_url('assets/js/plugins/moment.min.js') ?>"></script>
            <!--  Plugin for Sweet Alert -->
            <script src="<?= base_url('assets/js/plugins/sweetalert2.js') ?>"></script>
            <!-- Forms Validations Plugin -->
            <script src="<?= base_url('assets/js/plugins/jquery.validate.min.js') ?>"></script>
            <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
            <script src="<?= base_url('assets/js/plugins/jquery.bootstrap-wizard.js') ?>"></script>
            <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
            <script src="<?= base_url('assets/js/plugins/bootstrap-selectpicker.js') ?>"></script>
            <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
            <script src="<?= base_url('assets/js/plugins/bootstrap-datetimepicker.min.js') ?>"></script>
            <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
            <script src="<?= base_url('assets/js/plugins/bootstrap-tagsinput.js') ?>"></script>
            <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
            <script src="<?= base_url('assets/js/plugins/jasny-bootstrap.min.js') ?>"></script>
            <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
            <script src="<?= base_url('assets/js/plugins/fullcalendar.min.js') ?>"></script>
            <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
            <script src="<?= base_url('assets/js/plugins/jquery-jvectormap.js') ?>"></script>
            <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
            <script src="<?= base_url('assets/js/plugins/nouislider.min.js') ?>"></script>
            <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
            <!-- Library for adding dinamically elements -->
            <script src="<?= base_url('assets/js/plugins/arrive.min.js') ?>"></script>
            <!-- Chartist JS -->
            <script src="<?= base_url('assets/js/plugins/chartist.min.js') ?>"></script>
            <!--  Notifications Plugin    -->
            <script src="<?= base_url('assets/js/plugins/bootstrap-notify.js') ?>"></script>
            <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
            <!-- Material Dashboard DEMO methods, don't include it in your project! -->
            <script src="<?= base_url('assets/demo/demo.js') ?>"></script>
            <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script> -->
            <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

            <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
            <script src="<?= base_url('assets/js/plugins/jquery.dataTables.min.js') ?>"></script>

            <!-- Material Design -->
            <!-- <script src="<?= base_url('assets/js/material-dashboard.min.js?v=2.1.0') ?>" type="text/javascript"></script> -->

            <!-- Bootstrap Icons -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

            <!-- External async scripts -->
            <!--  Google Maps Plugin    -->
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
            <!-- Place this tag in your head or just before your close body tag. -->
            <script async defer src="https://buttons.github.io/buttons.js"></script>

            <!-- <script>
                $(document).ready(function() {
                    // Mendapatkan URL saat ini
                    var currentUrl = window.location.pathname; // Menggunakan pathname untuk hanya mendapatkan bagian path

                    // Memeriksa setiap link dalam sidebar
                    $('.nav-link').each(function() {
                        var linkUrl = $(this).attr('href');

                        // Jika URL saat ini cocok dengan link
                        if (currentUrl === linkUrl) {
                            // Menambahkan kelas 'active' pada link yang cocok
                            $(this).parents('.nav-item').addClass('active');

                            // Jika link tersebut memiliki elemen collapsible, pastikan terbuka
                            $(this).parents('.collapse').addClass('show');
                        }
                    });
                });
            </script> -->
            <script>
                $(document).ready(function() {
                    $().ready(function() {
                        $sidebar = $('.sidebar');

                        $sidebar_img_container = $sidebar.find('.sidebar-background');

                        $full_page = $('.full-page');

                        $sidebar_responsive = $('body > .navbar-collapse');

                        window_width = $(window).width();

                        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                            if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                                $('.fixed-plugin .dropdown').addClass('open');
                            }

                        }

                        $('.fixed-plugin a').click(function(event) {
                            // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                            if ($(this).hasClass('switch-trigger')) {
                                if (event.stopPropagation) {
                                    event.stopPropagation();
                                } else if (window.event) {
                                    window.event.cancelBubble = true;
                                }
                            }
                        });

                        $('.fixed-plugin .active-color span').click(function() {
                            $full_page_background = $('.full-page-background');

                            $(this).siblings().removeClass('active');
                            $(this).addClass('active');

                            var new_color = $(this).data('color');

                            if ($sidebar.length != 0) {
                                $sidebar.attr('data-color', new_color);
                            }

                            if ($full_page.length != 0) {
                                $full_page.attr('filter-color', new_color);
                            }

                            if ($sidebar_responsive.length != 0) {
                                $sidebar_responsive.attr('data-color', new_color);
                            }
                        });

                        $('.fixed-plugin .background-color .badge').click(function() {
                            $(this).siblings().removeClass('active');
                            $(this).addClass('active');

                            var new_color = $(this).data('background-color');

                            if ($sidebar.length != 0) {
                                $sidebar.attr('data-background-color', new_color);
                            }
                        });

                        $('.fixed-plugin .img-holder').click(function() {
                            $full_page_background = $('.full-page-background');

                            $(this).parent('li').siblings().removeClass('active');
                            $(this).parent('li').addClass('active');


                            var new_image = $(this).find("img").attr('src');

                            if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                                $sidebar_img_container.fadeOut('fast', function() {
                                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                                    $sidebar_img_container.fadeIn('fast');
                                });
                            }

                            if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                                $full_page_background.fadeOut('fast', function() {
                                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                                    $full_page_background.fadeIn('fast');
                                });
                            }

                            if ($('.switch-sidebar-image input:checked').length == 0) {
                                var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                                $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                                $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                            }

                            if ($sidebar_responsive.length != 0) {
                                $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                            }
                        });

                        // $('.switch-sidebar-image input').change(function() {
                        //     $full_page_background = $('.full-page-background');

                        //     $input = $(this);

                        //     if ($input.is(':checked')) {
                        //         if ($sidebar_img_container.length != 0) {
                        //             $sidebar_img_container.fadeIn('fast');
                        //             $sidebar.attr('data-image', '#');
                        //         }

                        //         if ($full_page_background.length != 0) {
                        //             $full_page_background.fadeIn('fast');
                        //             $full_page.attr('data-image', '#');
                        //         }

                        //         background_image = true;
                        //     } else {
                        //         if ($sidebar_img_container.length != 0) {
                        //             $sidebar.removeAttr('data-image');
                        //             $sidebar_img_container.fadeOut('fast');
                        //         }

                        //         if ($full_page_background.length != 0) {
                        //             $full_page.removeAttr('data-image', '#');
                        //             $full_page_background.fadeOut('fast');
                        //         }

                        //         background_image = false;
                        //     }
                        // });

                        $('.switch-sidebar-mini input').change(function() {
                            $body = $('body');

                            $input = $(this);

                            if (md.misc.sidebar_mini_active == true) {
                                $('body').removeClass('sidebar-mini');
                                md.misc.sidebar_mini_active = false;

                                $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                            } else {

                                $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                                setTimeout(function() {
                                    $('body').addClass('sidebar-mini');

                                    md.misc.sidebar_mini_active = true;
                                }, 300);
                            }

                            // we simulate the window Resize so the charts will get updated in realtime.
                            var simulateWindowResize = setInterval(function() {
                                window.dispatchEvent(new Event('resize'));
                            }, 180);

                            // we stop the simulation of Window Resize after the animations are completed
                            setTimeout(function() {
                                clearInterval(simulateWindowResize);
                            }, 1000);

                        });
                    });
                });
            </script>
            <!-- Sharrre libray -->
            <script src="<?= base_url('assets/demo/jquery.sharrre.js') ?>"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('#datatables').DataTable({
                        "pagingType": "full_numbers",
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        responsive: true,
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search records",
                        }
                    });

                });
                $(document).ready(function() {
                    const dropdownButtons = document.querySelectorAll('.dropdown button');
                    const dropdownContents = document.querySelectorAll('.dropdown-content');
                    const checkboxes = document.querySelectorAll('.filter-checkbox');

                    dropdownButtons.forEach((btn, index) => {
                        btn.addEventListener('click', function(event) {
                            // Cegah klik dari menutup dropdown yang aktif
                            event.stopPropagation();

                            // Tutup semua dropdown kecuali yang diklik
                            dropdownContents.forEach((content, idx) => {
                                if (idx !== index) {
                                    content.classList.remove('show');
                                }
                            });

                            // Toggle dropdown yang diklik
                            dropdownContents[index].classList.toggle('show');
                        });
                    });

                    checkboxes.forEach(checkbox => {
                        checkbox.addEventListener('click', function(event) {
                            event.stopPropagation(); // Prevent click from closing the dropdown
                            filterTable(); // Call filter function on checkbox click
                        });
                    });

                    checkboxes.forEach(checkbox => {
                        checkbox.addEventListener('change', function() {
                            filterTable(); // Panggil fungsi filter
                        });
                    });

                    // Event listener untuk checkbox "All" di setiap dropdown
                    document.querySelectorAll('[id^="selectAll"]').forEach(selectAllCheckbox => {
                        selectAllCheckbox.addEventListener('change', function() {
                            const allCheckboxes = Array.from(selectAllCheckbox.closest('.dropdown-content').querySelectorAll('.filter-checkbox'));
                            allCheckboxes.forEach(checkbox => {
                                if (checkbox !== selectAllCheckbox) {
                                    checkbox.checked = selectAllCheckbox.checked; // Centang atau batal centang semua checkbox
                                }
                            });
                            filterTable(); // Panggil fungsi filter setelah mengubah status checkbox
                        });
                    });

                    function filterTable() {
                        const filters = {
                            provinsi: [],
                            unor: [],
                            kawasan: [],
                            pendanaan: [],
                            updated_at: []
                        };

                        checkboxes.forEach(checkbox => {
                            if (checkbox.checked && checkbox.id !== 'selectAllProvinsi' && checkbox.id !== 'selectAllUnor' && checkbox.id !== 'selectAllKawasan' && checkbox.id !== 'selectAllPendanaan' && checkbox.id !== 'selectAllUpdated_at') {
                                const category = checkbox.closest('.dropdown-content').id.replace('dropdown', '').replace('Content', '').toLowerCase();
                                filters[category].push(checkbox.value.toLowerCase());
                            }
                        });

                        const dataTable = $('#datatables').DataTable();
                        // Apply filters to DataTables
                        dataTable.column(1).search(filters.provinsi.join('|'), true, false); // Provinsi
                        dataTable.column(2).search(filters.unor.join('|'), true, false); // Unor
                        dataTable.column(3).search(filters.kawasan.join('|'), true, false); // Kawasan
                        dataTable.column(4).search(filters.pendanaan.join('|'), true, false); // Sumber Pendanaan
                        dataTable.column(8).search(filters.updated_at.join('|'), true, false); // Updated_at
                        dataTable.draw(); // Refresh the DataTable
                    }

                    // Close the dropdown if clicked outside or on another button
                    window.addEventListener('click', function(event) {
                        dropdownContents.forEach(content => {
                            if (content.classList.contains('show')) {
                                content.classList.remove('show');
                            }
                        });
                    });
                });
            </script>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Tampilkan loading pada saat DOM selesai dimuat
                    document.getElementById("loading").style.display = "flex";
                });

                window.addEventListener("load", function() {
                    // Sembunyikan loading setelah seluruh elemen halaman selesai dimuat
                    document.getElementById("loading").style.display = "none";
                });
            </script>
            <script>
                $(document).ready(function() {
                    $('.nav-link[data-toggle="collapse"]').on('click', function(e) {
                        let $this = $(this);
                        let $submenu = $($this.attr('href'));

                        // Kalau submenu belum terbuka → tutup yang lain dulu
                        if (!$submenu.hasClass('show')) {
                            $('.collapse.show').collapse('hide');
                        }
                        // Tidak perlu else, biar Bootstrap yang handle toggle buka/tutup
                    });
                });
            </script>

</body>

</html>