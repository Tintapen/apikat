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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <style>
        span.required {
            color: #ff0000;
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
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <?php if (!empty($this->session->flashdata('pesan'))) : ?>
                                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan') ?>"></div>
                            <?php elseif (!empty($this->session->flashdata('pesan_sukses'))) : ?>
                                <div class="flash-sukses" data-flashdata="<?= $this->session->flashdata('pesan_sukses') ?>"></div>
                            <?php endif; ?>
                            <div class="text-center text-muted mb-4">
                                <a class="navbar-brand" href="">
                                    <img src="<?= base_url(); ?>assets/login/img/logo-apikat.png" width="200px" />
                                </a>
                            </div>
                            <form action="<?= site_url('home/auth') ?>" method="POST" id="form-login">
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user-alt"></i></span>
                                        </div>
                                        <input class="form-control text-primary" placeholder="Masukkan Username" type="text" name="username" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text "><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control text-primary" placeholder="Masukkan Password" type="password" name="password" required>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-center">
                                        <a href="<?= site_url('home/forget') ?>" class="text-blue">Lupa Password ?</a>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-block my-4">Masuk</button>
                                    <a href="javascript:void(0)" class="btn btn-success btn-block my-4" id="btn_daftar">Daftar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div class=" modal fade" id="modal_daftar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="float-left">
                        <h4 class="modal-title" id="myModalLabel">Daftar Pengguna Baru</h4>
                    </div>
                    <div class="float-right">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                </div>
                <form id="form_pengguna_baru">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Lengkap <span class="required">*</span></label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                            <span id="error_nama"></span>
                        </div>
                        <div class="form-group">
                            <label>Telp <span class="required">*</span></label>
                            <input type="text" name="telp" class="form-control" placeholder="Telp">
                            <span id="error_telp"></span>
                        </div>
                        <div class="form-group">
                            <label>Email <span class="required">*</span></label>
                            <input type="text" name="email" class="form-control" placeholder="Email">
                            <span id="error_email"></span>
                        </div>
                        <div class="form-group">
                            <label>Username <span class="required">*</span></label>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                            <span id="error_username"></span>
                        </div>
                        <div class="form-group">
                            <label>Password <span class="required">*</span></label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <span id="error_password"></span>
                        </div>
                        <div class="form-group">
                            <label>Fungsi <span class="required">*</span></label>
                            <select name="idFungsi" class="form-control select2" style="width: 100%">
                                <option value="" disabled selected> -- Pilih Fungsi -- </option>
                                <?php foreach ($fungsi->result() as $fng) { ?>
                                    <option value="<?= $fng->id ?>"><?= $fng->fungsi ?></option>
                                <?php } ?>
                            </select>
                            <span id="error_idFungsi"></span>
                        </div>
                        <div class="form-group">
                            <label>Sebagai</label>
                            <select name="level" class="form-control" disabled>
                                <option value="User" selected>User</option>
                            </select>
                            <span id="error_user"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger">
                            <div class="fa fa-trash"></div> Reset
                        </button>
                        <button type="submit" class="btn btn-primary btn_simpan_pengguna">
                            <div class="fa fa-save"></div> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- jQuery 3 -->
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
        const flashSukses = $('.flash-sukses').data('flashdata');

        if (flashData) {
            swal({
                title: "Failed!",
                text: flashData,
                icon: "error",
            });
        }

        if (flashSukses) {
            swal({
                title: "Sukses!",
                text: flashSukses,
                icon: "success",
            });
        }

        // Sow Password
        $(document).ready(function() {
            $('#checkbox').click(function() {
                if ($(this).is(':checked')) {
                    $('#password').attr('type', 'text');
                } else {
                    $('#password').attr('type', 'password');
                }
            });

            $("#btn_daftar").click(function() {
                $('#modal_daftar').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });

            $(".btn_simpan_pengguna").click(function(e) {
                e.preventDefault();
                var _this = $(this);
                var oriElement = _this.html();
                var textElement = _this.text().trim();
                var form = $(this).closest('form');
                var url = '<?= site_url('home/signup') ?>';

                var disabled = form.find('[disabled]');

                //! Remove attribute disabled
                disabled.removeAttr('disabled');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    cache: false,
                    dataType: 'JSON',
                    beforeSend: function() {
                        $(this).prop('disabled', true);
                        $(_this).html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>' + textElement).prop('disabled', true);
                    },
                    complete: function() {
                        $(this).removeAttr('disabled');
                        $(_this).html(oriElement).prop('disabled', false);
                    },
                    success: function(response) {
                        if (response.success) {
                            swal({
                                title: 'Berhasil!',
                                text: 'Data Anda telah disimpan.',
                                type: 'success'
                            });

                            form[0].reset();

                            //! Set disabled
                            disabled.prop('disabled', true);

                            $('#modal_daftar').modal('hide');
                        }

                        if (response.error) {
                            if (response.error_nama != '') {
                                $('[name="nama"]').addClass('is-invalid');
                                $('#error_nama').addClass('text-danger').html(response.error_nama);
                            } else {
                                $('[name="nama"]').removeClass('is-invalid');
                                $('#error_nama').removeClass('text-danger').html('');
                            }
                            if (response.error_telp != '') {
                                $('[name="telp"]').addClass('is-invalid');
                                $('#error_telp').addClass('text-danger').html(response.error_telp);
                            } else {
                                $('[name="telp"]').removeClass('is-invalid');
                                $('#error_telp').removeClass('text-danger').html('');
                            }
                            if (response.error_email != '') {
                                $('[name="email"]').addClass('is-invalid');
                                $('#error_email').addClass('text-danger').html(response.error_email);
                            } else {
                                $('[name="email"]').removeClass('is-invalid');
                                $('#error_email').removeClass('text-danger').html('');
                            }
                            if (response.error_username != '') {
                                $('[name="username"]').addClass('is-invalid');
                                $('#error_username').addClass('text-danger').html(response.error_username);
                            } else {
                                $('[name="username"]').removeClass('is-invalid');
                                $('#error_username').removeClass('text-danger').html('');
                            }
                            if (response.error_password != '') {
                                $('[name="password"]').addClass('is-invalid');
                                $('#error_password').addClass('text-danger').html(response.error_password);
                            } else {
                                $('[name="password"]').removeClass('is-invalid');
                                $('#error_password').removeClass('text-danger').html('');
                            }
                            if (response.error_idFungsi != '') {
                                $('[name="idFungsi"]').addClass('is-invalid');
                                $('#error_idFungsi').addClass('text-danger').html(response.error_idFungsi);
                            } else {
                                $('[name="idFungsi"]').removeClass('is-invalid');
                                $('#error_idFungsi').removeClass('text-danger').html('');
                            }
                        } else {
                            $('[name="nama"]').removeClass('is-invalid');
                            $('#error_nama').removeClass('text-danger').html('');
                            $('[name="telp"]').removeClass('is-invalid');
                            $('#error_telp').removeClass('text-danger').html('');
                            $('[name="email"]').removeClass('is-invalid');
                            $('#error_email').removeClass('text-danger').html('');
                            $('[name="username"]').removeClass('is-invalid');
                            $('#error_username').removeClass('text-danger').html('');
                            $('[name="password"]').removeClass('is-invalid');
                            $('#error_password').removeClass('text-danger').html('');
                            $('[name="idFungsi"]').removeClass('is-invalid');
                            $('#error_idFungsi').removeClass('text-danger').html('');
                        }
                    },
                    error: function(jqXHR, exception) {
                        showError(jqXHR, exception);
                    }
                });
            });
        });

        $("#modal_daftar").on("hidden.bs.modal", function(e) {
            $("#form_pengguna_baru")[0].reset();

            $('[name="nama"]').removeClass('is-invalid');
            $('#error_nama').removeClass('text-danger').html('');
            $('[name="telp"]').removeClass('is-invalid');
            $('#error_telp').removeClass('text-danger').html('');
            $('[name="email"]').removeClass('is-invalid');
            $('#error_email').removeClass('text-danger').html('');
            $('[name="username"]').removeClass('is-invalid');
            $('#error_username').removeClass('text-danger').html('');
            $('[name="password"]').removeClass('is-invalid');
            $('#error_password').removeClass('text-danger').html('');
            $('[name="idFungsi"]').removeClass('is-invalid');
            $('#error_idFungsi').removeClass('text-danger').html('');
        });

        function showError(xhr, exception) {
            let msg = '';

            if (xhr.status === 0)
                msg = 'Not connect.\n Verify Network.';
            else if (xhr.status == 404)
                msg = 'Requested page not found. [404]';
            else if (xhr.status == 500)
                msg = 'Internal Server Error [500].';
            else if (exception === 'parsererror')
                msg = 'Requested JSON parse failed.';
            else if (exception === 'timeout')
                msg = 'Time out error.';
            else if (exception === 'abort')
                msg = 'Ajax request aborted.';
            else
                msg = 'Uncaught Error.\n' + xhr.responseText;

            swal({
                title: 'Error!',
                text: msg,
                type: 'error'
            });
        }
    </script>
</body>

</html>