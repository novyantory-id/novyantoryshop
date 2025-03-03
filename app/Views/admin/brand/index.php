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
        <a href="<?= base_url('admin/brand/create') ?>" class="btn btn-added"><i class="ion-plus me-1"></i>Add Brand</a>
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

        <div class="card" id="filter_inputs">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <input type="text" placeholder="Enter Brand Name" />
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="form-group">
                            <input
                                type="text"
                                placeholder="Enter Brand Description" />
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
                        <th>Brand Name</th>
                        <th>Brand Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($brand as $key) : ?>
                        <tr>
                            <td>
                                <?= $no++ ?>
                            </td>
                            <td>
                                <a class="product-img">
                                    <img
                                        src="<?= base_url('assets/img/brand/' . $key['images_brand']) ?> "
                                        alt="product" />
                                </a>
                            </td>
                            <td><?= $key['nama_brand'] ?></td>
                            <td><?= $key['slug_brand'] ?></td>
                            <td>
                                <a class="me-3" href="<?= base_url('admin/brand/edit/' . $key['slug_brand']) ?>">
                                    <i class="ion-edit"></i> Edit
                                </a>
                                <a class="me-3 tombol-hapus" href="<?= base_url('admin/brand/delete/' . $key['slug_brand']) ?>">
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