<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<!-- Main contents -->

<div class="page-header">
    <div class="page-title">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href=""><?= $title; ?></a></li>
            <li class="breadcrumb-item active"><?= $title_detail; ?></li>
        </ul>
    </div>
    <div class="page-btn">
        <a href="<?= base_url('register') ?>" class="btn btn-added" target="_blank"><i class="ion-plus me-1"></i>Add Customers</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-top">
            <div class="search-set">
                <div class="search-input">
                    <a class="btn btn-searchset"><img src="<?= base_url('assets/img/icons/search-white.svg') ?>" alt="img" /></a>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table datanew">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Image</th>
                        <th>Username</th>
                        <th>Nama Customer</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($customers as $key) : ?>
                        <tr>
                            <td>
                                <?= $no++ ?>
                            </td>
                            <td>
                                <a class="product-img">
                                    <img
                                        src="<?= base_url('assets/img/profiles/' . $key['images_user']) ?> "
                                        alt="product" />
                                </a>
                            </td>
                            <td><?= $key['username'] ?></td>
                            <td><?= $key['nama_user'] ?></td>
                            <td><?= $key['email_user'] ?></td>
                            <td><?= $key['status_aktif_user'] ?></td>
                            <td>
                                <a class="me-3" href="<?= base_url('admin/customers/edit/' . $key['username']) ?>">
                                    <i class="ion-edit"></i> Edit
                                </a>
                                <a class="me-3 tombol-hapus" href="<?= base_url('admin/customers/delete/' . $key['username']) ?>">
                                    <i class="ion-trash-b"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- End contents -->

<?= $this->endSection() ?>