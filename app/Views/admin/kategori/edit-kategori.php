<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<!-- Main contents -->

<div class="page-header">
    <div class="page-title">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/kategori') ?>"><?= $title; ?></a></li>
            <li class="breadcrumb-item active"><?= $title_detail; ?></li>
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-body">

        <form action="<?= base_url('admin/kategori/update-kategori/' . $kategori['id']) ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-row row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Kategori</label>
                        <input
                            type="text"
                            id="kategori"
                            name="kategori"
                            oninput="sinkronInput()"
                            value="<?= $kategori['kategori']; ?>"
                            class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>"
                            placeholder="Input kategory name..." />
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
        </form>

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