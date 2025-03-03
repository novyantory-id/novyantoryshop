<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<!-- Main contents -->

<div class="page-header">
    <div class="page-title">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/provinsi') ?>"><?= $title; ?></a></li>
            <li class="breadcrumb-item active"><?= $title_detail; ?></li>
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-body">

        <form action="<?= base_url('admin/provinsi/update-provinsi/' . $provinsi['id']) ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-row row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Provinsi</label>
                        <input
                            type="text"
                            id="provinsi"
                            name="provinsi"
                            value="<?= $provinsi['provinsi']; ?>"
                            class="form-control <?= ($validation->hasError('provinsi')) ? 'is-invalid' : ''; ?>"
                            placeholder="Input provinsi..." />
                        <div class="invalid-feedback">
                            <?= $validation->getError('provinsi') ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <button type="submit" class="btn btn-submit" style="width: 100%;">Submit</button>
                </div>
        </form>

    </div>
</div>

<!-- End contents -->

<?= $this->endSection() ?>