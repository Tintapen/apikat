<!DOCTYPE html>
<html lang="zxx" class="no-js">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <!-- <link rel="icon" href="<?= base_url('assets/img/icon-apikat.png') ?>" type="image/x-icon" /> -->
    <!-- <link rel="shortcut icon" href="img/favicon6654.png?v1" type="image/x-icon" /> -->
    <!-- Author Meta -->
    <meta name="author" content="">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title><?= $title ?></title>

    <!--CSS-->
    <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/aos.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
    <style>
        .btn-info:hover {
            color: #007bff;
            background-color: #fff;
            border-color: #fff;
        }
    </style>
</head>

<body>
    <section class="banner-section relative section-gap-full">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="row">
                    <div class="col-md-6 banner-left" style="margin-top: 100px;">
                        <h1 data-aos="fade-down" class="text-white">Aplikasi Peminjaman Perangkat</h1>
                        <a href="<?= site_url('home/login'); ?>" class="btn btn-info mt-3" role="button" data-aos="fade-down" data-aos-delay="700"><b>Login</b></a>
                    </div>
                    <div data-aos="fade-up" data-aos-delay="700" class="col-md-6 banner-right text-center">
                        <img class="img-fluid" src="<?= base_url('assets/img/banner1.png') ?>" alt="Gambar Banner">
                    </div>
                </div>
            </div>
        </div>
        <div class="wave">
            <svg class="nectar-shape-divider" fill="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 285" preserveAspectRatio="none">
                <path d="M 1000 299 l 2 -279 c -155 -36 -310 135 -415 164 c -102.64 28.35 -149 -32 -232 -31 c -80 1 -142 53 -229 80 c -65.54 20.34 -101 15 -126 11.61 v 54.39 z">
                </path>
                <path d="M 1000 286 l 2 -252 c -157 -43 -302 144 -405 178 c -101.11 33.38 -159 -47 -242 -46 c -80 1 -145.09 54.07 -229 87 c -65.21 25.59 -104.07 16.72 -126 10.61 v 22.39 z">
                </path>
                <path d="M 1000 300 l 1 -230.29 c -217 -12.71 -300.47 129.15 -404 156.29 c -103 27 -174 -30 -257 -29 c -80 1 -130.09 37.07 -214 70 c -61.23 24 -108 15.61 -126 10.61 v 22.39 z">
                </path>
            </svg>
        </div>
    </section>

    <!-- Start about section -->
    <section class="about-section section-gap-half relative" id="paa">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 col-md-12 about-left">
                    <img data-aos="fade-right" data-aos-delay="200" class="img-fluid" src="<?= base_url('assets/img/banner2.png') ?>" alt="Gambar Banner">
                </div>
                <div class="col-lg-5 col-md-7 about-right">
                    <h1 data-aos="fade-left" data-aos-delay="200">Aplikasi Peminjaman Perangkat ICT</h1>
                    <p data-aos="fade-left" data-aos-delay="400">Teknologi sudah berkembang sangat pesat di segala bidang. Saat ini semua aktivitas yang dilakukan sebagian besar sudah menggunakan perangkat digital agar berkomunikasi menjadi lebih mudah. Perangkat ICT memegang peran penting dalam komunikasi di era saat ini. Apikat hadir sebagai sarana untuk memudahkan pengguna dalam pengajuan peminjaman perangkat ICT sehingga pengguna dapat meminjam perangkat dengan prosedur yang praktis dan efisien.
                    </p>
                    <p data-aos="fade-left" data-aos-delay="400">
                        Aplikasi ini dirancang dengan desain yang menarik serta praktis sehinnga mudah dipahami oleh orang awam
                    </p>
                </div>
            </div>
        </div>

    </section>
    <!-- End about section -->

    <!-- Start footer section -->
    <footer class="footer-section section-gap-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 footer-left">
                    <a href="#">
                        <img src="<?= base_url('assets/login/img/logo-putih.png') ?>" alt="" width="200px">
                    </a>
                </div>
                <div class="col-lg-7">
                </div>
            </div>
        </div>
    </footer>
    <!-- End footer section -->

    <div class="scroll-top">
        <i class="ti-angle-up"></i>
    </div>

    <script src="<?= base_url('assets/js/vendor/jquery-2.2.4.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/vendor/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.easing.1.3.js') ?>"></script>
    <script src="<?= base_url('assets/js/vendor/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.parallax-scroll.js') ?>"></script>
    <script src="<?= base_url('assets/js/dopeNav.js') ?>"></script>
    <script src="<?= base_url('assets/js/owl.carousel.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/waypoints.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.stellar.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.counterup.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script src="<?= base_url('assets/js/aos.js') ?>"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out-quart',
            once: true,
        });
    </script>
</body>

</html>