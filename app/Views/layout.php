<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Dreams Pos admin template</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg">

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?> ">

    <link rel="stylesheet" href="<?= base_url('assets/css/animate.css') ?> ">

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
                    <a class="dropdown-item" href="signin.html">Logout</a>
                </div>
            </div>

        </div>


        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li>
                            <a href="<?= base_url('/') ?>"><i class="ion-speedometer fs-4" data-bs-toggle="tooltip"></i><span> Dashboard</span> </a>
                        </li>
                        <li class="submenu">
                            <span class="text-secondary"> Master Data</span>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="fe fe-grid fs-5"></i><span> Kategori</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="saleslist.html">Kategori</a></li>
                                <li><a href="pos.html">Sub Kategori</a></li>
                                <li><a href="pos.html">Sub-sub Kategori</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ion-ribbon-b fs-4"></i><span> Brand</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="saleslist.html">Daftar Brand</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="fe fe-fast-forward fs-5"></i><span> Slides</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="purchaselist.html">Daftar Slides</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="fe fe-box fs-5"></i><span> Produk</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="productlist.html">Daftar Produk</a></li>
                                <li><a href="productlist.html">Tambah Produk</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ion-flash fs-4"></i><span> Kupon</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="productlist.html">Daftar Kupon</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ion-earth fs-4"></i><span> Wilayah</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="productlist.html">Provinsi</a></li>
                                <li><a href="productlist.html">Kabupaten/Kota</a></li>
                                <li><a href="productlist.html">Kecamatan</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <span class="text-secondary"> Pesanan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-wrapper pagehead">
            <div class="content">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title"><?= $title; ?></h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Blank Page</li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <?= $this->renderSection('content') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?> "></script>

    <script src="<?= base_url('assets/js/feather.min.js') ?> "></script>

    <script src="<?= base_url('assets/js/jquery.slimscroll.min.js') ?> "></script>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?> "></script>

    <script src="<?= base_url('assets/js/script.js') ?> "></script>
</body>

</html>