<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/img/apple-icon.png') ?>">
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.ico') ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Sipro | Login
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
    <style>
        .input-group-login {
            display: flex;
            column-gap: 20px;
            row-gap: 10px;
            border: 2px solid #000066;
            border-radius: 30px;
            padding: 5px 70px 5px 20px;
            width: 100%;
            max-width: 300px;
        }

        .btn-login {
            border: 2px solid #000066;
            background-color: #000066;
            color: #ffffff;
            border-radius: 30px;
            padding: 10px 30px 10px 30px;
            margin-top: 10px;
            cursor: pointer;
            width: 100%;
            max-width: 300px;
        }

        .form-control {
            background-image: none;
        }

        .bmd-form-group {
            margin-top: 3px;
        }

        .container-section {
            width: 100%;
        }

        .container-subsection {
            display: flex;
            justify-content: flex-end;
            margin-top: -120px;
        }

        .content-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 100%;
            /* background-color: cyan; */
        }

        .login-page {
            background-image: url('<?= base_url('assets/img/login-page.png') ?>');
            background-size: cover;
            background-position: top center;
        }

        @media (min-width: 992px) {
            .content-section {
                width: 500px;
            }
        }
    </style>
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
        <div class="container-fluid d-flex">
            <!-- <div class="navbar-wrapper">
                <a class="navbar-brand" href="#pablo">SIPRO 2024 </a>
            </div> -->
            <div class="navbar-wrapper d-flex align-items-center ml-auto mr-5">
                <div class="d-flex align-items-center">
                    <img class=" mr-3" src="<?= base_url('assets/img/logo-bpiw.png') ?>" alt="Logo BPIW" width="50" height="50">
                    <img src="<?= base_url('assets/img/logo-pu.png') ?>" alt="Logo PU" width="50" height="50">
                </div>
                <!-- <a class="navbar-brand" href="#pablo">SIPRO 2024 </a> -->
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="wrapper wrapper-full-page">
        <div class="page-header login-page">
            <div class="container container-section" style="display: none;">
                <div class="container-subsection col-sm-8 col-md-12 col-lg-12">
                    <form class="form" method="post" action="<?= url_to('login') ?>">
                        <div class="content-section col-sm-8 col-md-12 col-lg-12">
                            <div class="d-flex justify-content-center mb-2">
                                <img src="<?= base_url('assets/img/logo-sipro.png') ?>" alt="Logo Sipro" width="150">
                            </div>
                            <span class="text-center mb-3" style="font-family: Arial, Helvetica, sans-serif; font-size: 24px; color: #000066; font-weight: 900">Hai, Selamat Datang!</span>
                            <div class="input-group-login mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons" style="color: #000066">person</i>
                                    </span>
                                </div>
                                <input type="text" class="form-control no-border-bottom" name="login" placeholder="Username...">
                            </div>
                            <div class="input-group-login mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons" style="color: #000066">lock_outline</i>
                                    </span>
                                </div>
                                <input type="password" name="password" class="form-control no-border-bottom" placeholder="Password...">
                            </div>
                            <?php if (session()->has('error')) : ?>
                                <div class="my-2 text-center">
                                    <span class="text-danger font-weight-bold" style="font-size:14px">
                                        <?= session('error'); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            <button type="submit" class="btn-login">MASUK</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <footer class="footer">
                <div class="container">
                    <div class="copyright float-right" style="color: #000000">
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
            $('.container-section').show();

            md.checkFullPageBackgroundImage();
            setTimeout(function() {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700);
        });
    </script>
</body>

</html>