<?= $this->extend('users/layout.php') ?>

<?= $this->section('content') ?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">

</div>
<!-- Content -->
<div class="container mt-4">
    <!-- Menu Status Pesanan -->
    <div class="status-menu">
        <a id="link-belumBayar" onclick="showPesanan('belumBayar')">Belum Bayar</a>
        <a id="link-dikemas" onclick="showPesanan('dikemas')">Dikemas</a>
        <a id="link-dikirim" onclick="showPesanan('dikirim')">Dikirim</a>
        <a id="link-selesai" onclick="showPesanan('selesai')">Selesai</a>
    </div>



    <div class="pesanan-list" id="belumBayar">
        <?php if ($orders) : ?>
            <?php foreach ($orders as $order) : ?>
                <div class="card mb-3">
                    <div class="card-header border-0">
                        <div class="row justify-content-between fs-6 head-purchase">
                            <div class="col-7">
                                <p><?= $order['nomor_pesanan'] ?></p>
                            </div>
                            <div class="col-5 text-end">
                                <p class=""><?= ucfirst($order['status_order']) ?></p>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <!-- data order -->
                        <?php foreach ($order['details'] as $detail) : ?>
                            <div class="row mb-3 me-0">
                                <div class="col-3">
                                    <div class="rounded">
                                        <img src="<?= base_url('assets/img/product/' . $detail['images_produk_thumbnail']) ?>" class="img-fluid rounded" alt="">
                                    </div>
                                </div>
                                <div class="col-9 p-0 body-purchase">
                                    <h5><?= $detail['nama_produk'] ?></h5>
                                    <div class="row justify-content-between fs-6">
                                        <div class="col-10">
                                            <p><?= $detail['variasi'] ?></p>
                                        </div>
                                        <div class="col-2 text-end">
                                            <p>x <?= $detail['kuantitas'] ?></p>
                                        </div>
                                        <p class="text-end"><?= number_format($detail['harga_varian_order'], 0, ',', ',') ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <p class="text-end">Total produk: Rp<?= number_format($order['totalbayar'], 0, ',', ',') ?></p>
                        <p class="text-end"><a href="<?= base_url('user/purchase/bayar/' . $order['nomor_pesanan']) ?>" class="btn btn-primary">Bayar Sekarang</a></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Tidak ada pesanan</p>
        <?php endif; ?>
    </div>

    <div class="pesanan-list" id="dikemas">
        <?php if ($orders2) : ?>
            <?php foreach ($orders2 as $order) : ?>
                <div class="card mb-3">
                    <div class="card-header border-0">
                        <div class="row justify-content-between fs-6 head-purchase">
                            <div class="col-7">
                                <p><?= $order['nomor_pesanan'] ?></p>
                            </div>
                            <div class="col-5 text-end">
                                <p class=""><?= ucfirst($order['status_order']) ?></p>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <!-- data order -->
                        <?php foreach ($order['details'] as $detail) : ?>
                            <div class="row mb-3 me-0">
                                <div class="col-3">
                                    <div class="rounded">
                                        <img src="<?= base_url('assets/img/product/' . $detail['images_produk_thumbnail']) ?>" class="img-fluid rounded" style="height: 50px; width:auto;" alt="">
                                    </div>
                                </div>
                                <div class="col-9 p-0 body-purchase">
                                    <h5><?= $detail['nama_produk'] ?></h5>
                                    <div class="row justify-content-between fs-6">
                                        <div class="col-10">
                                            <p><?= $detail['variasi'] ?></p>
                                        </div>
                                        <div class="col-2 text-end">
                                            <p>x <?= $detail['kuantitas'] ?></p>
                                        </div>
                                        <p class="text-end">Rp<?= number_format($detail['harga_varian_order'], 0, ',', ',') ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <p class="text-end">Total produk: Rp<?= number_format($order['totalbayar'], 0, ',', ',') ?></p>
                        <?php if ($order['status_order'] === 'confirmed') : ?>
                            <div class="info-packing text-warning ">
                                <p>Produk akan segera dikemas</p>
                                <a href="<?= base_url('user/purchase/confirmed/' . $order['nomor_pesanan']) ?>">
                                    <i class="fe fe-chevron-right text-end fw-bold text-warning"></i>
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="info-etd text-success">

                                <p>Estimasi Pengiriman: <?= $order['cost_etd'] ?> hari </p>
                                <a href="<?= base_url('user/purchase/packing/' . $order['nomor_pesanan']) ?>">
                                    <i class="fe fe-chevron-right text-end text-success fw-bold"></i>
                                </a>

                            </div>
                        <?php endif ?>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Tidak ada pesanan</p>
        <?php endif; ?>
    </div>

    <div class="pesanan-list" id="dikirim">
        <?php if ($orders3) : ?>
            <?php foreach ($orders3 as $order) : ?>
                <div class="card mb-3">
                    <div class="card-header border-0">
                        <div class="row justify-content-between fs-6 head-purchase">
                            <div class="col-7">
                                <p><?= $order['nomor_pesanan'] ?></p>
                            </div>
                            <div class="col-5 text-end">
                                <p class=""><?= ucfirst($order['status_order']) ?></p>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <!-- data order -->
                        <?php foreach ($order['details'] as $detail) : ?>
                            <div class="row mb-3 me-0">
                                <div class="col-3">
                                    <div class="rounded">
                                        <img src="<?= base_url('assets/img/product/' . $detail['images_produk_thumbnail']) ?>" class="img-fluid rounded" style="height: 50px; width:auto;" alt="">
                                    </div>
                                </div>
                                <div class="col-9 p-0 body-purchase">
                                    <h5><?= $detail['nama_produk'] ?></h5>
                                    <div class="row justify-content-between fs-6">
                                        <div class="col-10">
                                            <p><?= $detail['variasi'] ?></p>
                                        </div>
                                        <div class="col-2 text-end">
                                            <p>x <?= $detail['kuantitas'] ?></p>
                                        </div>
                                        <p class="text-end">Rp<?= number_format($detail['harga_varian_order'], 0, ',', ',') ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <p class="text-end">Total produk: Rp<?= number_format($order['totalbayar'], 0, ',', ',') ?></p>
                        <?php if ($order['status_order'] === 'sending') : ?>
                            <div class="info-etd text-success">
                                <p>Pesanan menunggu diterima kurir</p>
                                <a href="<?= base_url('user/purchase/sending/' . $order['nomor_pesanan']) ?>">
                                    <i class="fe fe-chevron-right text-end fw-bold text-success"></i>
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="info-etd text-success">
                                <p>Pesanan dalam pengiriman</p>
                                <a href="<?= base_url('user/purchase/shipping/' . $order['nomor_pesanan']) ?>">
                                    <i class="fe fe-chevron-right text-end text-success fw-bold"></i>
                                </a>

                            </div>
                        <?php endif ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Tidak ada pesanan</p>
        <?php endif; ?>
    </div>

    <div class="pesanan-list" id="selesai">
        <?php if ($orders4) : ?>
            <?php foreach ($orders4 as $order) : ?>
                <div class="card mb-3">
                    <div class="card-header border-0">
                        <div class="row justify-content-between fs-6 head-purchase">
                            <div class="col-7">
                                <p><?= $order['nomor_pesanan'] ?></p>
                            </div>
                            <div class="col-5 text-end">
                                <p class=""><?= ucfirst($order['status_order']) ?></p>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <!-- data order -->
                        <?php foreach ($order['details'] as $detail) : ?>
                            <div class="row mb-3 me-0">
                                <div class="col-3">
                                    <div class="rounded">
                                        <img src="<?= base_url('assets/img/product/' . $detail['images_produk_thumbnail']) ?>" class="img-fluid rounded" style="height: 50px; width:auto;" alt="">
                                    </div>
                                </div>
                                <div class="col-9 p-0 body-purchase">
                                    <h5><?= $detail['nama_produk'] ?></h5>
                                    <div class="row justify-content-between fs-6">
                                        <div class="col-10">
                                            <p><?= $detail['variasi'] ?></p>
                                        </div>
                                        <div class="col-2 text-end">
                                            <p>x <?= $detail['kuantitas'] ?></p>
                                        </div>
                                        <p class="text-end">Rp<?= number_format($detail['harga_varian_order'], 0, ',', ',') ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <p class="text-end">Total produk: Rp<?= number_format($order['totalbayar'], 0, ',', ',') ?></p>
                        <div class="info-etd text-success">
                            <p>Pesanan selesai</p>
                            <a href="<?= base_url('user/purchase/finished/' . $order['nomor_pesanan']) ?>">
                                <i class="fe fe-chevron-right text-end fw-bold text-success"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Tidak ada pesanan</p>
        <?php endif; ?>
    </div>

</div>
<!-- Content End -->

<script>
    function showPesanan(status) {

        // Sembunyikan semua daftar pesanan
        var pesananList = document.querySelectorAll('.pesanan-list');
        pesananList.forEach(function(list) {
            list.classList.remove('active');
        });

        // Tampilkan daftar pesanan yang dipilih 
        document.getElementById(status).classList.add('active');

        // Hapus kelas aktif pada semua link menu
        var menuLinks = document.querySelectorAll('.status-menu a');
        menuLinks.forEach(function(link) {
            link.classList.remove('active');
        });

        // Tambahkan kelas aktif pada link yang dipilih
        document.getElementById('link-' + status).classList.add('active');
    }

    showPesanan('belumBayar');
</script>

<?= $this->endSection() ?>