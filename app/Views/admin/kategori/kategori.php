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
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('admin/kategori/store-kategori') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-row row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Kategori</label>
                                <input
                                    type="text"
                                    id="kategori"
                                    name="kategori"
                                    oninput="sinkronInput()"
                                    value="<?= set_value('kategori'); ?>"
                                    class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>"
                                    placeholder="Input kategori name..." />
                                <div class="invalid-feedback">
                                    <?= $validation->getError('kategori') ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Slug</label>
                                <input
                                    type="text"
                                    id="slug_kategori"
                                    name="slug_kategori"
                                    value=""
                                    class="form-control"
                                    readonly />
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit" style="width: 100%;">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
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
                                <th>Kategori</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($kategori as $key) : ?>
                                <tr>
                                    <td>
                                        <?= $no++ ?>
                                    </td>
                                    <td><?= $key['kategori'] ?></td>
                                    <td><?= $key['slug_kategori'] ?></td>
                                    <td>
                                        <a class="me-3" href="<?= base_url('admin/kategori/edit-kategori/' . $key['id']) ?>">
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
        const kategori = document.getElementById('kategori').value;
        const slug_kategori = document.getElementById('slug_kategori');

        // ganti spasi dengan tanda "-"
        const slug = kategori.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9\-]/g, '');

        // sinkronisasi ke slug_kategori
        slug_kategori.value = slug;
    }
</script>

<?= $this->endSection() ?>