<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<!-- Main contents -->

<div class="page-header">
    <div class="page-title">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/brand') ?>"><?= $title; ?></a></li>
            <li class="breadcrumb-item active"><?= $title_detail; ?></li>
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-body">

        <form action="<?= base_url('admin/subkategori/update-subkategori/' . $subkategori['id']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-row row">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select
                            name="kategori"
                            id="kategori"
                            class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>">
                            <option value="<?= $subkategori['kategori_id'] ?>"><?= $subkategori['kategori'] ?></option>
                            <?php foreach ($kategori as $key) : ?>
                                <option value="<?= $key['id'] ?>"><?= $key['kategori'] ?></option>
                            <?php endforeach ?>
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
                            value="<?= $subkategori['subkategori'] ?>"
                            class="form-control <?= ($validation->hasError('subkategori')) ? 'is-invalid' : ''; ?>"
                            placeholder="Input brand name..." />
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
                            value="<?= $subkategori['slug_subkategori'] ?>"
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