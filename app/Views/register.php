<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Register - NovyantoryShop</title>

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/logo.png') ?> ">

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?> ">

    <link rel="stylesheet" href="<?= base_url('assets/plugins/icons/feather/feather.css') ?>">

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
                            <h3>Register</h3>
                            <h4>Create to your account</h4>
                        </div>
                        <form action="<?= base_url('register/store') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="form-login">
                                <label>Fullname</label>
                                <div class="form-addons">
                                    <input type="text" name="nama_user" class="<?= ($validation->hasError('nama_user')) ? 'is-invalid' : ''; ?>" placeholder="Enter your email address">
                                    <i class="fe fe-user"></i>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_user') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Username</label>
                                <div class="form-addons">
                                    <input type="text" name="username" class="<?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" placeholder="Enter your username" minlength="6" maxlength="30">
                                    <i class="fe fe-user"></i>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('username') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input type="email" name="email_user" class="<?= ($validation->hasError('email_user')) ? 'is-invalid' : ''; ?>" placeholder="Enter your email address">
                                    <i class="fe fe-mail"></i>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email_user') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Tanggal Lahir</label>
                                <div class="form-addons">
                                    <input type="date" name="tgl_lahir_user" class="<?= ($validation->hasError('tgl_lahir_user')) ? 'is-invalid' : ''; ?>" placeholder="Enter your birthday">
                                    <i class="fe fe-calender"></i>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tgl_lahir_user') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>No.HP</label>
                                <div class="form-addons">
                                    <input type="number" name="nohp_user" class="<?= ($validation->hasError('nohp_user')) ? 'is-invalid' : ''; ?>" placeholder="Enter your phone number" minlength="11" maxlength="13">
                                    <i class="fe fe-phone"></i>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nohp_user') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" name="password_user" class="pass-input" placeholder="Enter your password" min="4">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Repeat Password</label>
                                <div class="pass-group">
                                    <input type="password" name="konfirmasi_password" class="pass-input" placeholder="Repeat your password" min="4">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login">Register</button>
                            </div>
                        </form>

                        <div class="signinform text-center">
                            <h4>Do have an account? <a href="<?= base_url('sign-in') ?>" class="hover-a">Sign In</a></h4>
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