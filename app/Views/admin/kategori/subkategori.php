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
                <form action="<?= base_url('admin/subkategori/store-subkategori') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-row row">

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select
                                    name="kategori"
                                    id="kategori"
                                    class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>">
                                    <option value="">--Pilih Kategori--</option>
                                    <?php foreach ($kategori as $key) : ?>
                                        <option value="<?= $key['id'] ?>"><?= $key['kategori'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('kategori') ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Sub Kategori</label>
                                <input
                                    type="text"
                                    id="subkategori"
                                    name="subkategori"
                                    oninput="sinkronInput()"
                                    value="<?= set_value('subkategori'); ?>"
                                    class="form-control <?= ($validation->hasError('subkategori')) ? 'is-invalid' : ''; ?>"
                                    placeholder="Input sub kategori name..." />
                                <div class="invalid-feedback">
                                    <?= $validation->getError('subkategori') ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Slug</label>
                                <input
                                    type="text"
                                    id="slug_subkategori"
                                    name="slug_subkategori"
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
                                <th>Sub Kategori</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($subkategori as $key) : ?>
                                <tr>
                                    <td>
                                        <?= $no++ ?>
                                    </td>
                                    <td><?= $key['kategori'] ?></td>
                                    <td><?= $key['subkategori'] ?></td>
                                    <td><?= $key['slug_subkategori'] ?></td>
                                    <td>
                                        <a class="me-3" href="<?= base_url('admin/subkategori/edit-subkategori/' . $key['id']) ?>">
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