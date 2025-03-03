<?= $this->extend('users/layout.php') ?>

<?= $this->section('content') ?>

<!-- Single Page Header start -->
<div class="container-fluid page-header-profile py-5">

    <img src="<?= base_url('assets/frontend/img/' . $user['images_user']) ?>" alt="" class="profile-picture">
    <a href="<?= base_url('user/profile/edit') ?>" class="edit-profile-btn btn-primary text-white"><i class="fe fe-edit"></i></a>
</div>
<div class="profile-card mt-1">
    <h2><?= $user['nama_user'] ?></h2>
    <p class="username">@<?= $user['username'] ?></p>
    <div class="profile-details text-around">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="profile-item">
                    <strong>Tanggal Lahir:</strong>
                    <span><?= date('d-m-Y', strtotime($user['tgl_lahir_user'])) ?></span>
                </div>
                <div class="profile-item">
                    <strong>Jenis Kelamin:</strong>
                    <span><?= ($user['jk_user'] === '') ? 'Belum diatur' : $user['jk_user']; ?></span>
                </div>
                <div class="profile-item">
                    <strong>Email:</strong>
                    <span><?= $user['email_user'] ?></span>
                </div>
                <div class="profile-item">
                    <strong>No. Telepon:</strong>
                    <span><?= $user['nohp_user'] ?></span>
                </div>
            </div>

        </div>
    </div>

</div>


<!-- Content -->
<!-- Content End -->

<?= $this->endSection() ?>