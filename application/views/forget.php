<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <link href="<?= base_url(); ?>assets/img/icon-apikat.png" rel="icon" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/login/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/login/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/login/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <style>
        .forget-box-msg {
            text-align: justify;
            text-justify: inter-word;
            font-size: 15px;
        }
    </style>
</head>

<body class="bg-primary">
    <div class="main-content">
        <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
        </nav>
        <div class="header py-7 py-lg-8">
            <div class="container">
                <div class="header-body text-center mb-5">
                </div>
            </div>
        </div>
        <div class="container mt--8 pb-4">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan') ?>"></div>
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <a class="navbar-brand" href="">
                                    <img src="<?= base_url(); ?>assets/login/img/logo-apikat.png" width="200px" />
                                </a>
                            </div>
                            <form action="<?= site_url('home/lupa_password') ?>" method="POST" id="form_forget">
                                <p class="forget-box-msg">Silakan masukkan alamat email Anda untuk mencari akun Anda.</p>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control text-primary" placeholder="Masukkan Email" type="text" name="email" autofocus>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <a class="btn btn-default my-4 btn_cancel" href="<?= site_url('home/login') ?>">Cancel </a>
                                    <button type="submit" class="btn btn-primary my-4 btn_search">Search </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets') ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url('assets') ?>/bower_components/sweetalert/sweetalert.min.js"></script>
    <script src="<?= base_url(); ?>assets/login/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/login/js/argon-dashboard.min.js?v=1.1.0"></script>
    <script src="<?= base_url(); ?>assets/https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script>
        window.TrackJS &&
            TrackJS.install({
                token: "ee6fab19c5a04ac1a32a645abde4613a",
                application: "argon-dashboard-free"
            });
    </script>
    <script>
        // Notifikasi
        const flashData = $('.flash-data').data('flashdata');
        if (flashData) {
            swal({
                title: "Failed!",
                text: flashData,
                icon: "error",
            });
        }

        $("#form_forget").submit(function(e) {
            $(".btn_cancel").prop('disabled', true);
            $(".btn_search").prop('disabled', true);
        });
    </script>
</body>

</html>