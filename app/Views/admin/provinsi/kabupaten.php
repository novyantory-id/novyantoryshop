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
                <form action="<?= base_url('admin/kabupaten/store-kabupaten') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-row row">

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select
                                    name="provinsi"
                                    id="provinsi"
                                    class="form-control <?= ($validation->hasError('provinsi')) ? 'is-invalid' : ''; ?>">
                                    <option value="">--Pilih Provinsi--</option>
                                    <?php foreach ($provinsi as $key) : ?>
                                        <option value="<?= $key['id'] ?>"><?= $key['provinsi'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('provinsi') ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Kabupaten</label>
                                <input
                                    type="text"
                                    id="kabupaten"
                                    name="kabupaten"
                                    value="<?= set_value('kabupaten'); ?>"
                                    class="form-control <?= ($validation->hasError('kabupaten')) ? 'is-invalid' : ''; ?>"
                                    placeholder="Input kabupaten..." />
                                <div class="invalid-feedback">
                                    <?= $validation->getError('kabupaten') ?>
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
                                <th>Kabupaten/Kota</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($kabupaten as $key) : ?>
                                <tr>
                                    <td>
                                        <?= $no++ ?>
                                    </td>
                                    <td><?= $key['provinsi'] ?></td>
                                    <td><?= $key['kabupaten'] ?></td>
                                    <td>
                                        <a class="me-3" href="<?= base_url('admin/kabupaten/edit-kabupaten/' . $key['id']) ?>">
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