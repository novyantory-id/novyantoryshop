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
        <a href="<?= base_url('admin/kupon/create') ?>" class="btn btn-added"><i class="ion-plus me-1"></i>Add Kupon</a>
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
                        <th>Nama Kupon</th>
                        <th>Diskon(%)</th>
                        <th>Validasi</th>
                        <th>Status Kupon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($kupon as $key) : ?>
                        <tr>
                            <td>
                                <?= $no++ ?>
                            </td>
                            <td><?= $key['nama_kupon'] ?></td>
                            <td><?= $key['diskon_kupon'] ?>%</td>
                            <td><?= $key['validasi'] ? date('D, d-m-Y', strtotime($key['validasi'])) : ''; ?></td>
                            <td>
                                <?php if ($key['status_kupon'] == 'valid') : ?>
                                    <p class="btn btn-success btn-sm"><?= $key['status_kupon'] ?></p>
                                <?php else: ?>
                                    <p class="btn btn-danger btn-sm"><?= $key['status_kupon'] ?></p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a class="me-3" href="<?= base_url('admin/kupon/edit/' . $key['id']) ?>">
                                    <i class="ion-edit"></i> Edit
                                </a>
                                <a class="me-3 tombol-hapus" href="<?= base_url('admin/kupon/delete/' . $key['id']) ?>">
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