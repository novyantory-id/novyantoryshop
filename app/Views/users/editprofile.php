<?= $this->extend('users/layout.php') ?>

<?= $this->section('content') ?>

<!-- Single Page Header start -->
<form action="<?= base_url('user/profile/update') ?>" method="post">
    <?= csrf_field() ?>

    <div class="container-fluid page-header-profile py-5">
        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
        <img src="<?= base_url('assets/frontend/img/' . $user['images_user']) ?>" alt="" class="profile-picture">
        <button type="submit" class="edit-profile-btn btn-primary text-white"><i class="fe fe-save"></i></button>
    </div>

    <div class="profile-card mt-1">
        <h2><input type="text" name="nama_user" class="border-0 border-bottom text-center" value="<?= $user['nama_user'] ?>"></h2>
        <p class="username">@<?= $user['username'] ?></p>
        <div class="profile-details text-around">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="profile-item">
                        <strong>Tanggal Lahir:</strong>
                        <span><input type="date" name="tgl_lahir_user" class="border-0 border-bottom text-end" value="<?= $user['tgl_lahir_user'] ?>"></span>
                    </div>
                    <div class="profile-item">
                        <strong>Jenis Kelamin:</strong>

                        <span>
                            <select name="jk_user" class="border-0 border-bottom text-end">
                                <?php if ($user['jk_user'] === 'Laki-laki') : ?>
                                    <option value="<?= $user['jk_user'] ?>">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                <?php endif; ?>
                                <?php if ($user['jk_user'] === 'Perempuan') : ?>
                                    <option value="<?= $user['jk_user'] ?>">Perempuan</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                <?php endif; ?>
                            </select>
                        </span>
                    </div>
                    <div class="profile-item">
                        <strong>Email:</strong>
                        <span><input type="email" name="email_user" class="border-0 border-bottom text-end" value="<?= $user['email_user'] ?>"></span>
                    </div>
                    <div class="profile-item">
                        <strong>No. Telepon:</strong>
                        <span><input type="text" name="nohp_user" class="border-0 border-bottom text-end" value="<?= $user['nohp_user'] ?>"></span>
                    </div>
                </div>

            </div>
        </div>

    </div>
</form>


<!-- Content -->
<!-- Content End -->

<?= $this->endSection() ?>