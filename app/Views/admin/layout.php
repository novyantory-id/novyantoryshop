<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title><?= $title_tab; ?></title>

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/logo.png') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?> ">

    <link rel="stylesheet" href="<?= base_url('assets/css/animate.css') ?> ">

    <link rel="stylesheet" href="<?= base_url('assets/plugins/summernote/summernote-bs4.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css') ?>" />

    <link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap4.min.css') ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/icons/ionic/ionicons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/icons/feather/feather.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/fontawesome.min.css') ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/all.min.css') ?> ">


    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?> ">
</head>

<body>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>

    <div class="main-wrapper">

        <div class="header">

            <div class="header-left active">
                <a href="index.html" class="logo">
                    <img src="<?= base_url('assets/img/startup/novyantoryshop.png') ?> " alt="">
                </a>
                <a href="index.html" class="logo-small">
                    <img src="<?= base_url('assets/img/logo-small.png') ?> " alt="">
                </a>
                <a id="toggle_btn" href="javascript:void(0);">
                </a>
            </div>

            <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <ul class="nav user-menu">

                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-img"><img src="<?= base_url('assets/img/profiles/' . session()->get('admin_images')) ?> " alt="">
                            <span class="status online"></span></span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img"><img src="<?= base_url('assets/img/profiles/' . session()->get('admin_images')) ?> " alt="">
                                    <span class="status online"></span></span>
                                <div class="profilesets">
                                    <h6><?= session()->get('admin_name') ?></h6>
                                    <h5><?= session()->get('username') ?></h5>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item" href="profile.html"> <i class="me-2" data-feather="user"></i> My Profile</a>
                            <a class="dropdown-item" href="generalsettings.html"><i class="me-2" data-feather="settings"></i>Settings</a>
                            <hr class="m-0">
                            <a class="dropdown-item logout pb-0" href="<?= base_url('logout') ?>"><img src="<?= base_url('assets/img/icons/log-out.svg') ?> " class="me-2" alt="img">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>


            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="generalsettings.html">Settings</a>
                    <a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
                </div>
            </div>

        </div>


        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">

                    <?php
                    // $uri = service('uri');
                    // $current_url = current_url();
                    $url_string = uri_string();
                    // echo "Current URL: " . $current_url;
                    ?>
                    <ul>
                        <li>
                            <a href="<?= base_url('admin/home') ?>" class="<?= ($url_string === 'admin/home') ? 'active' : '' ?>"><i class="ion-speedometer fs-4" data-bs-toggle="tooltip"></i><span> Dashboard</span> </a>
                        </li>
                        <li class="submenu">
                            <span class="text-secondary"> Master Data</span>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="fe fe-grid fs-5"></i><span> Kategori</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= base_url('admin/kategori') ?>" class="<?= ($url_string === 'admin/kategori') ? 'active' : '' ?>">Kategori</a></li>
                                <li><a href="<?= base_url('admin/subkategori') ?>" class="<?= ($url_string === 'admin/subkategori') ? 'active' : '' ?>">Sub Kategori</a></li>
                                <li><a href="<?= base_url('admin/subsubkategori') ?>" class="<?= ($url_string === 'admin/subsubkategori') ? 'active' : '' ?>">Sub-sub Kategori</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ion-ribbon-b fs-4"></i><span> Brand</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= base_url('admin/brand') ?>" class="<?= ($url_string === 'admin/brand') ? 'active' : '' ?>">Daftar Brand</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="fe fe-fast-forward fs-5"></i><span> Slides</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= base_url('admin/slides') ?>" class="<?= ($url_string === 'admin/slides') ? 'active' : '' ?>">Daftar Slides</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="fe fe-box fs-5"></i><span> Produk</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= base_url('admin/product') ?>" class="<?= ($url_string === 'admin/product') ? 'active' : '' ?>">Daftar Produk</a></li>
                                <li><a href="<?= base_url('admin/product/create') ?>" class="<?= ($url_string === 'admin/product/create') ? 'active' : '' ?>">Tambah Produk</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ion-flash fs-4"></i><span> Kupon</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= base_url('admin/kupon') ?>" class="<?= ($url_string === 'admin/kupon') ? 'active' : '' ?>">Daftar Kupon</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ion-earth fs-4"></i><span> Wilayah</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= base_url('admin/provinsi') ?>" class="<?= ($url_string === 'admin/provinsi') ? 'active' : '' ?>">Provinsi</a></li>
                                <li><a href="<?= base_url('admin/kabupaten') ?>" class="<?= ($url_string === 'admin/kabupaten') ? 'active' : '' ?>">Kabupaten/Kota</a></li>
                                <li><a href="<?= base_url('admin/kecamatan') ?>" class="<?= ($url_string === 'admin/kecamatan') ? 'active' : '' ?>">Kecamatan</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <span class="text-secondary"> Pesanan</span>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ion-clipboard fs-4"></i><span> Pesanan</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= base_url('admin/order/entry') ?>" class="<?= ($url_string === 'admin/order/entry') ? 'active' : '' ?>">Pesanan Masuk</a></li>
                                <li><a href="<?= base_url('admin/order/confirm') ?>" class="<?= ($url_string === 'admin/order/confirm') ? 'active' : '' ?>">Pesanan Dikonfirmasi</a></li>
                                <li><a href="<?= base_url('admin/order/packing') ?>" class="<?= ($url_string === 'admin/order/packing') ? 'active' : '' ?>">Pesanan Dikemas</a></li>
                                <li><a href="<?= base_url('admin/order/sending') ?>" class="<?= ($url_string === 'admin/order/sending') ? 'active' : '' ?>">Pesanan Dikirim</a></li>
                                <li><a href="<?= base_url('admin/order/shipping') ?>" class="<?= ($url_string === 'admin/order/shiping') ? 'active' : '' ?>">Pesanan Dalam Perjalanan</a></li>
                                <li><a href="<?= base_url('admin/order/finished') ?>" class="<?= ($url_string === 'admin/order/finished') ? 'active' : '' ?>">Pesanan Selesai</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ion-pie-graph fs-4"></i><span> Stok Barang</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= base_url('admin/stock') ?>" class="<?= ($url_string === 'admin/stock') ? 'active' : '' ?>">Stok</a></li>
                                <li><a href="<?= base_url('admin/stock/create') ?>" class="<?= ($url_string === 'admin/stock/create') ? 'active' : '' ?>">Tambah Stok</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <span class="text-secondary"> Settings</span>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ion-person-stalker fs-4"></i><span> Data Pelanggan</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= base_url('admin/customers') ?>" class="<?= ($url_string === 'admin/customers') ? 'active' : '' ?>">Pelanggan</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ion-person fs-4"></i><span> Data Admin</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="<?= base_url('admin/admin') ?>" class="<?= ($url_string === 'admin/admin') ? 'active' : '' ?>">Admin</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-wrapper pagehead">
            <div class="content">
                <?php if (!empty(session()->getFlashdata('success'))) : ?>
                    <div id="alert-success" class="alert-custom alert-successs">
                        <i class="fe fe-check-circle"></i> <?= session()->getFlashdata('success') ?>
                        <div class="progress-bar"></div>
                    </div>
                <?php endif; ?>
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>


    <script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?> "></script>

    <script src="<?= base_url('assets/js/feather.min.js') ?> "></script>

    <script src="<?= base_url('assets/js/jquery.slimscroll.min.js') ?> "></script>

    <script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/dataTables.bootstrap4.min.js') ?>"></script>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?> "></script>

    <script src="<?= base_url('assets/plugins/select2/js/select2.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/summernote/summernote-bs4.min.js') ?>"></script>

    <script src="<?= base_url('assets/js/script.js') ?> "></script>

    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        //sweet alert konfirmasi hapus
        $('.tombol-hapus').on('click', function() {
            var getLink = $(this).attr('href');

            Swal.fire({
                title: "Yakin hapus?",
                text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus sekarang!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = getLink
                }
            });

            return false;
        });
    </script>

    <script>
        function showAlert(type) {
            let alertBox = document.getElementById(type === 'success' ? 'alert-success' : 'alert-failed');
            if (!alertBox) return;

            let progressBar = alertBox.querySelector('.progress-bar');
            alertBox.style.display = 'block';
            alertBox.style.opacity = '1';
            progressBar.style.width = '0%';

            setTimeout(() => {
                progressBar.style.width = '100%';
            }, 100);

            setTimeout(() => {
                let fadeOut = setInterval(() => {
                    if (parseFloat(alertBox.style.opacity > 0)) {
                        alertBox.style.opacity -= '0.1';
                    } else {
                        clearInterval(fadeOut);
                        alertBox.style.display = 'none';
                    }
                }, 50);
            }, 5000);
        }

        // Tampilkan alert jika ada flashdata
        if (document.getElementById("alert-success")) showAlert("success");
        if (document.getElementById("alert-failed")) showAlert("failed");
    </script>


</body>

</html>