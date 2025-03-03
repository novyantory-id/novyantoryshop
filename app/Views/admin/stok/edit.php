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
                <form action="<?= base_url('admin/stock/update/' . $stok['id']) ?>" method="post" enctype="multipart/form-data">
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
                                            class="form-control <?= ($validation->hasError('produk')) ? 'is-invalid' : ''; ?>" disabled>
                                            <option value="<?= $stok['id'] ?>"><?= $stok['kode_produk'] ?> | <?= $stok['nama_produk'] ?></option>
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
                                            value="<?= $stok['kode_produk'] ?>"
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
                                            value="<?= $stok['nama_produk'] ?>"
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
                                            value="<?= $stok['nama_brand'] ?>"
                                            class="form-control <?= ($validation->hasError('nama_brand')) ? 'is-invalid' : ''; ?>"
                                            readonly />
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_brand') ?>
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
                                            value="<?= $stok['stok'] ?>"
                                            class="form-control <?= ($validation->hasError('stok')) ? 'is-invalid' : ''; ?>"
                                            placeholder="Input stok produk..." readonly />
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
                                            value="<?= $stok['harga_varian'] ?>"
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