<?= $this->extend('users/layout.php') ?>

<?= $this->section('content') ?>

<!-- Single Page Header start -->
<div class="container-fluid py-5">

</div>
<!-- Content -->
<div class="container">
    <!-- Menu Status Pesanan -->
    <div class="back-my-purchase">
        <a href="<?= base_url('user/purchase') ?>" class="text-primary fs-5 me-1">
            <i class="ion-arrow-left-c" data-bs-toggle="tooltip" title="ion-arrow-left-c"></i>
        </a><span class="fs-5 fw-bold text-dark"> Rincian Pesanan</span>
    </div>
    <div class="status-order mb-3">
        <div class="row">
            <div class="col-9">
                <h5>Pesanan sedang dalam pengiriman</h5>
                <p>Estimasi Pengiriman <?= $orders['cost_etd'] ?> hari</p>
            </div>
            <div class="col-3 d-flex align-items-center justify-content-center">
                <i class="fe fe-truck fs-1"></i>
            </div>
        </div>
    </div>
    <div class="detail-pengiriman mb-3">
        <div class="mb-3">
            <h5>Informasi Pengiriman</h5>
            <p><?= $orders['service'] ?></p>
            <p><?= strtoupper($orders['courier']) ?> - <?= $orders['no_resi'] ?></p>
        </div>
        <div class="mb-3">
            <h5>Alamat Pengiriman</h5>
            <p><?= $orders['nama_penerima'] ?></p>
            <p><?= $orders['nohp_penerima'] ?></p>
            <p><?= $orders['alamat_penerima'] ?></p>
        </div>
    </div>
    <div class="detail-order mb-3">
        <div class="d-flex justify-content-between">
            <h5><?= $orders['nomor_pesanan'] ?></h5>
            <p class="text-end text-primary fst-italic"><?= $orders['status_order'] ?></p>
        </div>
        <div>
            <div class="row">
                <?php $no = 1;
                foreach ($orderdetails as $order) : ?>
                    <div class="col-3">
                        <img src="<?= base_url('assets/img/product/' . $order['images_produk_thumbnail']) ?>" alt="">
                    </div>
                    <div class="col-9 text-end mb-3">
                        <h4><?= $order['nama_produk'] ?></h4>
                        <p><?= $order['variasi'] ?></p>
                        <p>x <?= $order['kuantitas'] ?></p>
                        <p>Rp<?= number_format($order['harga_varian_order'], 0, ',', ',') ?></p>
                    </div>
                <?php endforeach; ?>
                <div class="col-6">
                    <p>Subtotal Produk</p>
                    <p>Subtotal Pengiriman</p>
                    <p>Total Pesanan</p>
                </div>
                <div class="col-6 text-end">
                    <p>Rp<?= number_format($orders['subtotalproduk'], 0, ',', ',') ?></p>
                    <p>Rp<?= number_format($orders['subtotalcost'], 0, ',', ',') ?></p>
                    <p class="text-primary fw-bold">Rp<?= number_format($orders['totalbayar'], 0, ',', ',') ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="detail-pembayaran mb-3">
        <h5>Metode Pembayaran</h5>
        <?php if ($orders['payment_detail'] === 'cod') : ?>
            <img src="<?= base_url('assets/img/icons/cod.png') ?>" style="width: 15px; height: 15px;" alt="">
            <span>
                COD (Cash on Delivery)
            </span>
        <?php elseif ($orders['payment_detail'] === 'bni') : ?>
            <img src="<?= base_url('assets/img/icons/bni.png') ?>" style="width: 15px; height: 15px;" alt="">
            <span>
                Bank BNI
            </span>
        <?php elseif ($orders['payment_detail'] === 'bri') : ?>
            <img src="<?= base_url('assets/img/icons/bri.png') ?>" style="width: 15px; height: 15px;" alt="">
            <span>
                Bank BRI
            </span>
        <?php elseif ($orders['payment_detail'] === 'dana') : ?>
            <img src="<?= base_url('assets/img/icons/dana.jpeg') ?>" style="width: 15px; height: 15px;" alt="">
            <span>
                DANA
            </span>
        <?php else: ?>
            <img src="<?= base_url('assets/img/icons/ovo.png') ?>" style="width: 15px; height: 15px;" alt="">
            <span>
                OVO
            </span>
        <?php endif; ?>
    </div>
    <div class="detail-waktu mb-3">
        <div class="d-flex justify-content-between">
            <h5>No. Pesanan</h5>
            <h5><?= $orders['nomor_pesanan'] ?></h5>
        </div>
        <div class="row">
            <div class="col-6">
                <p>Waktu Pemesanan</p>
            </div>
            <div class="col-6 text-end">
                <p><?= date('d-m-Y H:i', strtotime($orders['created_order_at'])) ?></p>
            </div>
        </div>
    </div>
    <div>
        <form action="<?= base_url('user/purchase/accept/' . $orders['nomor_pesanan']) ?>" method="post">
            <input type="hidden" name="nomor_pesanan" value="<?= $orders['nomor_pesanan'] ?>">
            <button type="submit" class="btn-accept-order">Pesanan Diterima</button>
        </form>
    </div>


</div>
<!-- Content End -->


<?= $this->endSection() ?>