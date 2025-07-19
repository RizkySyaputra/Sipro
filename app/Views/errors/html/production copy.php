<!-- <!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">

    <title><?= lang('Errors.whoops') ?></title>

    <style>
        <?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.css')) ?>
    </style>
</head>
<body>

    <div class="container text-center">

        <h1 class="headline"><?= lang('Errors.whoops') ?></h1>

        <p class="lead"><?= lang('Errors.weHitASnag') ?></p>

    </div>

</body>

</html> -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Halaman Tidak Ditemukan</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .error-container {
            text-align: center;
            padding: 30px;
        }
        .error-container h1 {
            font-size: 8rem;
            font-weight: bold;
            color: #dc3545;
            margin-bottom: 10px;
        }
        .error-container p {
            font-size: 1.5rem;
            color: #6c757d;
        }
        .error-container a {
            font-size: 1.2rem;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <div class="error-container">
       
        <p class="lead">Oops! Halaman yang Anda cari tidak ditemukan.</p>
        <p>Cobalah kembali ke halaman utama</p>
        <a href="<?= base_url() ?>" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

