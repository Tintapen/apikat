<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?> | <?= $this->session->userdata('level') ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/AdminLTE.min.css">
</head>

<body>
    <p>Salam Hormat <?= ucwords($user->nama) ?>,</p>
    <?= $message ?>
    <p>Best Regards, <br>
        ICT</p>

    <!-- jQuery 3 -->
    <script src="<?= base_url('assets') ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url('assets') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>
</body>

</html>