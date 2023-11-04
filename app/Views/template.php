<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= $title; ?> - <?= $web['title']; ?></title>

        <meta name="description" content="<?= strip_tags($web['description']); ?>">
        <meta name="keywords" content="<?= strip_tags($web['keywords']); ?>">

        <link rel="shortcut icon" href="<?= base_url(); ?>/assets/images/<?= $web['logo']; ?>">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/simplebar/css/simplebar.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/animate.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/icons.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/horizontal-menu.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/app-style.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style-main.css">

        <link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

        <style>
            :root {
                --warna: #1f2a36;
                --warna_2: #141f2a;
                --warna_3: #ffc107;
                --warna_4: #0d47a1;
            }
            .content {
                padding-top: 110px;
                min-height: 446px;
            }
            .table-white tr th, .table-white tr td {
                color: #fff;
                border-color: #242f3a;
            }
            label {
                font-weight: 500;
                text-transform: none;
            }
            .col-form-label {
                padding-top: calc(.375rem + 3px);
            }
            .card-tools {
                float: right;
                margin-top: -25px;
            }
            .cursor-pointer {
                cursor: pointer;
            }
            .menu-user a {
                padding: 10px 16px;
                border-radius: 5px;
            }
            .menu-user a:hover {
                background: var(--warna_2);
            }
            .menu-user a i {
                font-size: 19px;
                width: 20px;
            }
            .menu-user {
                margin-bottom: 26px;
            }
            .daterangepicker td, .daterangepicker th {
                color: #626262;
            }
            body, .circle-primary {
                background: var(--warna);
            }
            .bg-footer {
                background-color: var(--warna);
            }
            .bg-theme1, .bg-custom, .card {
                background: var(--warna_2) !important;
            }
            .btn-topup, .back-to-top {
                background: var(--warna_3);
            }
            .section {
                background: var(--warna_2);
            }
            .radio-nominal + label, .radio-nominale + label {
                background: var(--warna);  
                border: none !important;
            }
            .radio-nominale:checked + label, .radio-nominal:checked + label {
                background: var(--warna_3);
                color: #fff;
            }
            .strip-primary {
                background: #ffee00;
            }
            .btn-primary {
                background: var(--warna_3) !important;
                border-color: var(--warna_3) !important;
            }
            .sidenav {
                background: var(--warna_2);
            }
            .radio-nominal:checked + label, .table-white tr th, .table-white tr td {
                border-color: var(--warna);
            }
            .menu-utama div a {
                margin: 0 4px;
            }
            .menu-utama div a:hover, .menu-utama div a.active {
                background: var(--warna_3);
                border-radius: 14px 4px;
            }
            .navbar-collapse {
                background: var(--warna_2);
            }
            .menu-list {
                list-style: none;
                padding-left: 0;
            }
            .menu-list li a {
                display: block;
                padding: 10px 0;
                border-bottom: 1px dashed var(--warna_3);
                transition: .4s;
            }
            .menu-list li a:hover {
                padding-left: 6px;
            }
        </style>

        <?php $this->renderSection('css'); ?>
    </head>
    <body>
        <div id="wrapper">
            <header>
                <nav class="navbar navbar-expand-lg fixed-top navbar-dark shadow-sm bg-custom">
                    <div class="container">
                        <a class="navbar-brand" href="<?= base_url(); ?>">
                            <img src="<?= base_url(); ?>/assets/images/<?= $web['logo']; ?>" width="50" alt="logo icon" class="rounded">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse menu-utama" id="navbarNavAltMarkup">
                            <div class="navbar-nav ml-auto">
                                <a class="nav-item nav-link <?= $menu_active == 'Home' ? 'active' : ''; ?>" href="<?= base_url(); ?>">Home</a>
                                <a class="nav-item nav-link <?= $menu_active == 'Cek' ? 'active' : ''; ?>" href="<?= base_url(); ?>/payment">Cek Pesanan</a>
                                <a class="nav-item nav-link <?= $menu_active == 'Price' ? 'active' : ''; ?>" href="<?= base_url(); ?>/price">Daftar Harga</a>
                                <a class="nav-item nav-link <?= $menu_active == 'Method' ? 'active' : ''; ?>" href="<?= base_url(); ?>/method">Metode Pembayaran</a>
                                <a class="nav-item nav-link <?= $menu_active == 'Login' ? 'active' : ''; ?>" href="<?= base_url(); ?>/login">Login Member</a>
                                <?php if ($admin !== false): ?>
                                <a class="nav-item nav-link" href="<?= base_url(); ?>/admin">Administrator</a>
                                <?php endif ?>
                                <?php if ($users !== false): ?>
                                <a class="nav-item nav-link" href="<?= base_url(); ?>/user">Beranda</a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <?php $this->renderSection('content'); ?>

            <footer id="aboutus" class="bg-footer">
                <img src="<?= base_url(); ?>/assets/images/waves2.png" alt="" width="100%">
                <div style="background: var(--warna_2);margin-top: -4px;">
                    <div class="pt-5 pb-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-sm-3">
                                    <img src="<?= base_url(); ?>/assets/images/<?= $web['logo']; ?>" height="40" alt="logo icon" class="mb-3">
                                    <h5 class="mb-2"><?= $web['name']; ?></h5>
                                    <?= $web['description']; ?>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <h5 class="pb-2">Games Terpopuler</h5>
                                    <div class="row">
                                        <?php foreach ($games_populer as $loop): ?>
                                        <div class="col-4 p-2">
                                            <a href="<?= base_url(); ?>/games/<?= $loop['slug']; ?>">
                                                <img src="<?= base_url(); ?>/assets/images/games/<?= $loop['image']; ?>" alt="" width="100%" style="border-radius: 10px;">
                                            </a>
                                        </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <h5 class="pb-2">Halaman</h5>
                                    <ul class="menu-list">
                                        <li><a href="<?= base_url(); ?>/">Halaman Utama</a></li>
                                        <li><a href="<?= base_url(); ?>/payment">Cek Pesanan</a></li>
                                        <li><a href="<?= base_url(); ?>/price">Daftar Harga</a></li>
                                        <li><a href="<?= base_url(); ?>/syarat-ketentuan">Syarat & Ketentuan</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <h5 class="pb-2">Sosial Media Kami</h5>
                                    <a href="<?= $sm['ig']; ?>" style="font-size: 35px;">
                                        <i class="fa fa-instagram pr-4"></i>
                                    </a>
                                    <a href="<?= $sm['yt']; ?>" style="font-size: 35px;">
                                        <i class="fa fa-youtube pr-4"></i>
                                    </a>
                                    <a href="<?= $sm['fb']; ?>" style="font-size: 35px;">
                                        <i class="fa fa-facebook pr-4"></i>
                                    </a>
                                    <a href="<?= $sm['tw']; ?>" style="font-size: 35px;">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-theme1 text-center pb-4"> Copyright © 2022 <?= $web['name']; ?>. All Rights Reserved </div>
            </footer>
        </div>

        <a href="javaScript:void();" class="back-to-top">
            <i class="fa fa-angle-double-up"></i>
        </a>
        
<!-- Squareshop widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "6285176762260", // WhatsApp number
            telegram: "@pasartopupid", // Telegram bot username               
            email: "tafshopindonesia@gmail.com", // Email
            facebook: "61550775795907", // Facebook page ID
            instagram: "@pasartopupid", // Instagram username
            call_to_action: "Contact us", // Call to action
            button_color: "#FF6550", // Color of button
            position: "right", // Position may be 'right' or 'left'
            order: "instagram,whatsapp,facebook,email,telegram", // Order of buttons
            pre_filled_message: "Halo Admin", // WhatsApp pre-filled message
        };
        var proto = document.location.protocol, host = "squareshop.my.id", url = proto + "//topup." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/assets/js/v3wa.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /Squareshop widget -->        

        <!--End wrapper-->
        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url(); ?>/assets/js/jquery.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/popper.min.js"></script>
        <script src="<?= base_url(); ?>/assets/js/bootstrap.min.js"></script>
        <!-- simplebar js -->
        <script src="<?= base_url(); ?>/assets/plugins/simplebar/js/simplebar.js"></script>
        <!-- Custom scripts -->
        <script src="<?= base_url(); ?>/assets/js/app-script.js"></script>
        <script src="<?= base_url(); ?>/assets/plugins/summernote/dist/summernote-bs4.min.js"></script>
        <!--Select Plugins Js-->
        <script src="<?= base_url(); ?>/assets/plugins/select2/js/select2.min.js"></script>
        <!--Data Tables js-->
        <script src="<?= base_url(); ?>/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

        <script>
            // $(document).ready(function() {
            //     $('#default-datatable').DataTable();
            // });

            function openNav() {
                document.getElementById("mySidenav").style.width = "300px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            }
        </script>
        <script>
            <?php if ($admin !== false): ?>
            function hapus(link) {
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data akan dihapus permanen",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tetap hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                    }
                });
            }
            <?php endif; ?>

        </script>
        
        <?php $this->renderSection('js'); ?>
    </body>
</html>