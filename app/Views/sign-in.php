<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Login - Novyantoryshop.com</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/logo.png') ?> ">

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?> ">

    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/fontawesome.min.css') ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/all.min.css') ?> ">

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?> ">
</head>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <img src="<?= base_url('assets/img/startup/novyantoryshop.png') ?>" alt="img" style="height: 70px;">
                        </div>
                        <div class="login-userheading">
                            <h3>Sign In</h3>
                            <h4>Please login to your account</h4>
                        </div>
                        <form action="<?= base_url('login') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="form-login">

                                <?php if (!empty(session()->getFlashdata('pesan'))) : ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?= session()->getFlashdata('pesan') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty(session()->getFlashdata('verifikasi'))) : ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <?= session()->getFlashdata('verifikasi') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <label>Email atau Username</label>
                                <div class="form-addons">
                                    <input type="text" name="username" placeholder="Enter your email address">
                                    <img src="<?= base_url('assets/img/icons/mail.svg') ?>" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" name="password" class="pass-input" placeholder="Enter your password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login">Sign In</button>
                            </div>
                        </form>

                        <div class="signinform text-center">
                            <h4>Don’t have an account? <a href="<?= base_url('register') ?>" class="hover-a">Sign Up</a></h4>
                        </div>
                    </div>
                </div>
                <div class="login-img">
                    <img src="<?= base_url('assets/img/login.jpg') ?>" alt="img">
                </div>
            </div>
        </div>
    </div>


    <script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>

    <script src="<?= base_url('assets/js/feather.min.js') ?>"></script>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?> "></script>

    <script src="<?= base_url('assets/js/script.js') ?> "></script>
</body>

</html>