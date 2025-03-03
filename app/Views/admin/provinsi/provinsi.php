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
                <form action="<?= base_url('admin/provinsi/store-provinsi') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-row row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <input
                                    type="text"
                                    id="provinsi"
                                    name="provinsi"
                                    value="<?= set_value('provinsi'); ?>"
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
                                <th>Provinsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($provinsi as $key) : ?>
                                <tr>
                                    <td>
                                        <?= $no++ ?>
                                    </td>
                                    <td><?= $key['provinsi'] ?></td>
                                    <td>
                                        <a class="me-3" href="<?= base_url('admin/provinsi/edit-provinsi/' . $key['id']) ?>">
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