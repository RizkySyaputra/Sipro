<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/img/apple-icon.png') ?>">
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.ico') ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Sipro | Login2
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->
    <!--  Social tags      -->
    <meta name="description" content="Login Sipro Keterpaduan Program. Silahkan log in menggunakan akun yang telah terdaftar. ">
    <!-- Schema.org markup for Google+ -->
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="<?= base_url('assets/css/material-dashboard.min.css?v=2.1.0') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?= base_url('assets/demo/demo.css') ?>" rel="stylesheet" />

</head>

<body class="off-canvas-sidebar">
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
        <div class="container">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="#pablo">SIPRO 2024 </a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="wrapper wrapper-full-page">
        <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('<?= base_url('assets/img/jakarta.jpg') ?>'); background-size: cover; background-position: top center;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                        <form class="form" method="post" action="<?= url_to('login') ?>">
                            <div class="card card-login card-hidden">
                                <div class="card-header card-header-rose text-center">
                                    <h4 class="card-title">Login</h4>

                                </div>
                                <div class="card-body ">
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">person</i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="login" placeholder="Username...">
                                        </div>
                                    </span>

                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                            </div>
                                            <input type="password" name="password" class="form-control" placeholder="Password...">
                                        </div>
                                    </span>
                                </div>
                                <div class="card-footer justify-content-center">
                                    <button type="submit" class="btn btn-rose btn-link btn-lg">login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <footer class="footer">
                <div class="container">
                    <div class="copyright float-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>, made with <i class="material-icons">favorite</i> by BPIW DEV
                    </div>
                </div>

            </footer>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="<?= base_url('assets/js/core/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/core/bootstrap-material-design.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.jquery.min.js') ?>"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Chartist JS -->
    <script src="<?= base_url('assets/js/plugins/chartist.min.js') ?>"></script>
    <!--  Notifications Plugin    -->
    <script src="<?= base_url('assets/js/plugins/bootstrap-notify.js') ?>"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url('assets/js/material-dashboard.min.js?v=2.1.0') ?>" type="text/javascript"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="<?= base_url('assets/demo/demo.js') ?>"></script>

    <!-- Sharrre libray -->
    <script src="<?= base_url('assets/demo/jquery.sharrre.js') ?>"></script>

    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
    </noscript>
    <script>
        $(document).ready(function() {
            localStorage.clear();

            md.checkFullPageBackgroundImage();
            setTimeout(function() {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700);
        });
    </script>
</body>

</html>