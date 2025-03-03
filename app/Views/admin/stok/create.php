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
                <form action="<?= base_url('admin/stock/store') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-row row">

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Pilih Produk<span class="text-danger fs-5">*</span></label>
                                        <select
                                            name="produk"
                                            id="produk"
                                            class="form-control <?= ($validation->hasError('produk')) ? 'is-invalid' : ''; ?>">
                                            <option value="">--Pilih Produk--</option>
                                            <?php foreach ($produk as $key) : ?>
                                                <option value="<?= $key['id'] ?>"><?= $key['kode_produk'] ?> | <?= $key['nama_produk'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('produk') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Kode Produk<span class="text-danger fs-5">*</span></label>
                                        <input
                                            type="text"
                                            id="kode_produk"
                                            name="kode_produk"
                                            value="<?= set_value('kode_produk'); ?>"
                                            class="form-control <?= ($validation->hasError('kode_produk')) ? 'is-invalid' : ''; ?>"
                                            readonly />
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('kode_produk') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Nama Produk<span class="text-danger fs-5">*</span></label>
                                        <input
                                            type="text"
                                            id="nama_produk"
                                            name="nama_produk"
                                            value="<?= set_value('nama_produk'); ?>"
                                            class="form-control <?= ($validation->hasError('nama_produk')) ? 'is-invalid' : ''; ?>"
                                            readonly />
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_produk') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Nama Brand<span class="text-danger fs-5">*</span></label>
                                        <input
                                            type="text"
                                            id="nama_brand"
                                            name="nama_brand"
                                            value="<?= set_value('nama_brand'); ?>"
                                            class="form-control <?= ($validation->hasError('nama_brand')) ? 'is-invalid' : ''; ?>"
                                            readonly />
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_brand') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <?php foreach ($atribut as $nama_atribut => $nilai_atribut) : ?>
                                        <div class="form-group">
                                            <label for=""><?= $nama_atribut ?></label>
                                            <?php foreach ($nilai_atribut as $id => $nilai) : ?>
                                                <div class=" d-flex">
                                                    <input class="me-3" type="checkbox"
                                                        name="kombinasi_atribut[<?= $nama_atribut ?>][]"
                                                        value="<?= $nilai ?>"
                                                        id="attr-<?= $id ?>">
                                                    <label for="attr-<?= $id ?>"><?= $nilai ?></label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Bobot<span class="text-danger fs-5">*</span></label>
                                        <input
                                            type="number"
                                            id="bobot"
                                            name="bobot"
                                            value="<?= set_value('bobot'); ?>"
                                            class="form-control <?= ($validation->hasError('bobot')) ? 'is-invalid' : ''; ?>"
                                            placeholder="Input bobot produk..." />
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('bobot') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Stok<span class="text-danger fs-5">*</span></label>
                                        <input
                                            type="text"
                                            id="stok"
                                            name="stok"
                                            value="<?= set_value('stok'); ?>"
                                            class="form-control <?= ($validation->hasError('stok')) ? 'is-invalid' : ''; ?>"
                                            placeholder="Input stok produk..." />
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('stok') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Harga Variasi<span class="text-danger fs-5">*</span></label>
                                        <input
                                            type="number"
                                            id="harga_varian"
                                            name="harga_varian"
                                            min="1000"
                                            max="100000000"
                                            value="<?= set_value('harga_varian'); ?>"
                                            class="form-control <?= ($validation->hasError('harga_varian')) ? 'is-invalid' : ''; ?>"
                                            placeholder="Input harga variasi..." />
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('harga_varian') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-submit" style="width: 100%;">Simpan Stok</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

</div>

<!-- End contents -->

<script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?> "></script>

<script>
    // filter produk
    $(document).ready(function() {
        $('#produk').on('change', function() {
            const produkId = $(this).val();

            if (produkId) {
                $.ajax({
                    url: '<?= base_url('admin/stock/getProdukData'); ?>/' + produkId,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#nama_produk').val(response.data.nama_produk);
                            $('#kode_produk').val(response.data.kode_produk);
                            $('#nama_brand').val(response.data.nama_brand);
                        } else {
                            alert(response.message);
                        }
                    }
                });
            } else {
                $('#nama_produk').val('');
                $('#kode_produk').val('');
                $('#nama_brand').val('');
            }
        });
    });
</script>



<?= $this->endSection() ?>