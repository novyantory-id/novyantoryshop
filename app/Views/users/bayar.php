<?= $this->extend('users/layout.php') ?>

<?= $this->section('content') ?>

<!-- Single Page Header start -->
<div class="container-fluid py-5">

</div>
<!-- Content -->
<div class="container mt-5">
    <!-- Menu Status Pesanan -->
    <div class="back-my-purchase">
        <a href="<?= base_url('user/purchase') ?>" class="text-primary fs-5 me-1">
            <i class="ion-arrow-left-c" data-bs-toggle="tooltip" title="ion-arrow-left-c"></i>
        </a><span class="fs-5 fw-bold text-dark"> Info Pembayaran</span>
    </div>
    <div class="info-pembayaran">
        <h3 class="fs-6">Total Pembayaran</h3>
        <h2 class="text-primary fs-2">Rp.<?= number_format($orders['totalbayar'], 0, ',', ',') ?></h2>
        <p class="text-warning">Bayar pesanan sesuai jumlah di atas</p>
    </div>
    <div class="info-payment">
        <h6>
            <div class="row pt-2">
                <div class="col-1 text-end">
                    <i class="ion-information-circled"></i>
                </div>
                <div class="col-11 ps-0">
                    <p>Gunakan ATM / iBanking / mBanking / setor tunai untuk transfer ke rekening berikut ini:</p>
                </div>
            </div>
        </h6>
    </div>

    <div>
        <?php if ($orders['payment_detail'] === 'bni') : ?>
            <div class="info-rekening">
                <div class="row">
                    <div class="col-1">
                        <img src="<?= base_url('assets/img/icons/bni.png') ?>" style="width: 25px; height: 25px;" alt="">
                    </div>
                    <div class="col-11">
                        <h4>Bank BNI</h4>
                        <p>No. Rekening: 123456789</p>
                        <p>Cabang: Natar</p>
                        <p>Nama Rekening: PT Novyantory Payment Indonesia</p>
                    </div>
                </div>
            </div>
        <?php elseif ($orders['payment_detail'] === 'bri') : ?>
            <div class="info-rekening">
                <div class="row">
                    <div class="col-1">
                        <img src="<?= base_url('assets/img/icons/bri.png') ?>" style="width: 25px; height: 25px;" alt="">
                    </div>
                    <div class="col-11">
                        <h3>Bank BRI</h3>
                        <p>No. Rekening: 123456789</p>
                        <p>Cabang: Natar</p>
                        <p>Nama Rekening: PT Novyantory Payment Indonesia</p>
                    </div>
                </div>
            </div>
        <?php elseif ($orders['payment_detail'] === 'ovo') : ?>
            <div class="info-rekening">
                <div class="row">
                    <div class="col-1">
                        <img src="<?= base_url('assets/img/icons/ovo.png') ?>" style="width: 25px; height: 25px;" alt="">
                    </div>
                    <div class="col-11">
                        <h3>OVO</h3>
                        <p>No. Telepon: 08123456789</p>
                        <p>Atas Nama: PT Novyantory Payment Indonesia</p>
                    </div>
                </div>
            </div>
        <?php elseif ($orders['payment_detail'] === 'bni') : ?>
            <div class="info-rekening">
                <div class="row">
                    <div class="col-1">
                        <img src="<?= base_url('assets/img/icons/dana.jpeg') ?>" style="width: 25px; height: 25px;" alt="">
                    </div>
                    <div class="col-11">
                        <h3>DANA</h3>
                        <p>No. Telepon: 08123456789</p>
                        <p>Atas Nama: PT Novyantory Payment Indonesia</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>
<!-- Content End -->


<?= $this->endSection() ?>