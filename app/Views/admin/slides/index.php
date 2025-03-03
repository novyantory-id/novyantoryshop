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
        <a href="<?= base_url('admin/slides/create') ?>" class="btn btn-added"><i class="ion-plus me-1"></i>Add Slides</a>
    </div>
</div>

<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="table-top">
            <div class="search-set">
                <div class="search-input">
                    <a class="btn btn-searchset"><img src="<?= base_url('assets/img/icons/search-white.svg') ?>" alt="img" /></a>
                </div>
            </div>
        </div>

        <div class="card" id="filter_inputs">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <input type="text" placeholder="Enter Slides Name" />
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <input
                                type="text"
                                placeholder="Enter Slides Description" />
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                        <div class="form-group">
                            <a class="btn btn-filters ms-auto"><img
                                    src="<?= base_url('assets/img/icons/search-whites.svg') ?>"
                                    alt="img" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table datanew">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Image</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($slides as $key) : ?>
                        <tr>
                            <td>
                                <?= $no++ ?>
                            </td>
                            <td>
                                <a class="product-img">
                                    <img
                                        src="<?= base_url('assets/img/slides/' . $key['images_slides']) ?> "
                                        alt="product" />
                                </a>
                            </td>
                            <td><?= $key['judul_slides'] ?></td>
                            <td><?= $key['deskripsi_slides'] ?></td>
                            <td>
                                <a class="me-3" href="<?= base_url('admin/slides/edit/' . $key['id']) ?>">
                                    <i class="ion-edit"></i> Edit
                                </a>
                                <a class="me-3 tombol-hapus" href="<?= base_url('admin/slides/delete/' . $key['id']) ?>">
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