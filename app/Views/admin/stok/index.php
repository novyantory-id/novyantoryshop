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
</div>

<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12">
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
                                <th>Thumbnail</th>
                                <th>Kode Produk</th>
                                <th>Produk</th>
                                <th>Atribut</th>
                                <th>Stok</th>
                                <th>Harga Varian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($stok as $key) : ?>
                                <tr>
                                    <td>
                                        <?= $no++ ?>
                                    </td>
                                    <td><img src="<?= base_url('assets/img/product/' . $key['images_produk_thumbnail']) ?>" alt=""></td>
                                    <td><?= $key['kode_produk'] ?></td>
                                    <td><?= $key['nama_produk'] ?></td>
                                    <td><?= $key['kombinasi_atribut'] ?></td>
                                    <td><?= $key['stok'] ?></td>
                                    <td>Rp <?= number_format($key['harga_varian'], 0, ',', ',') ?></td>
                                    <td>
                                        <a class="me-3" href="<?= base_url('admin/stock/edit/' . $key['id']) ?>">
                                            <i class="ion-edit"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End contents -->

<?= $this->endSection() ?>