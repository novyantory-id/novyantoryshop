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
                                <th>Brand</th>
                                <th>Berat (gr)</th>
                                <th>Harga</th>
                                <th>Promo</th>
                                <th>Produk Baru</th>
                                <th>Best Seller</th>
                                <th>Kategori</th>
                                <th>Sub Kategori</th>
                                <th>Sub-sub Kategori</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($produk as $key) : ?>
                                <tr>
                                    <td>
                                        <?= $no++ ?>
                                    </td>
                                    <td><img src="<?= base_url('assets/img/product/' . $key['images_produk_thumbnail']) ?>" alt=""></td>
                                    <td><?= $key['kode_produk'] ?></td>
                                    <td><?= $key['nama_produk'] ?></td>
                                    <td><?= $key['nama_brand'] ?></td>
                                    <td><?= $key['berat_produk'] ?></td>
                                    <td>Rp <?= number_format($key['harga_produk'], 0, ',', ',') ?></td>
                                    <td><?= ($key['is_promo'] == 1) ? 'Ya' : 'Tidak'; ?></td>
                                    <td><?= ($key['is_baru'] == 1) ? 'Ya' : 'Tidak'; ?></td>
                                    <td><?= ($key['is_bestseller'] == 1) ? 'Ya' : 'Tidak'; ?></td>
                                    <td><?= $key['kategori'] ?></td>
                                    <td><?= $key['subkategori'] ?></td>
                                    <td><?= $key['subsubkategori'] ?></td>
                                    <td>
                                        <?php if ($key['status_active_produk'] == 'aktif') : ?>
                                            <p class="btn btn-primary btn-sm"><?= $key['status_active_produk'] ?></p>
                                        <?php else: ?>
                                            <p class="btn btn-danger btn-sm"><?= $key['status_active_produk'] ?></p>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a class="me-3" href="<?= base_url('admin/product/edit/' . $key['id']) ?>">
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

<script>
    // make slug
    function sinkronInput() {
        const kategori = document.getElementById('subkategori').value;
        const slug_kategori = document.getElementById('slug_subkategori');
        // ganti spasi dengan tanda "-"
        const slug = kategori.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9\-]/g, '');

        // sinkronisasi ke slug_kategori
        slug_kategori.value = slug;
    }
</script>

<?= $this->endSection() ?>