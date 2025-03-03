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

<div class="card">
    <div class="card-body">
        <div class="table-top">
            <div class="search-set">
                <div class="search-input">
                    <a class="btn btn-searchset"><img src="<?= base_url('assets/img/icons/search-white.svg') ?>" alt="img" /></a>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-7 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pembayaran</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>:</td>
                                <td><?= $orders['nama_user'] ?></td>
                            </tr>
                            <tr>
                                <th>No.Hp/Email</th>
                                <td>:</td>
                                <td><?= $orders['nohp_user'] ?> | <?= $orders['email_user'] ?></td>
                            </tr>
                            <tr>
                                <th>No Pesanan</th>
                                <td>:</td>
                                <td><?= $orders['nomor_pesanan'] ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Pesanan</th>
                                <td>:</td>
                                <td><?= date('d F Y', strtotime($orders['created_order_at'])) ?></td>
                            </tr>
                            <tr>
                                <th>Metode Pembayaran</th>
                                <td>:</td>
                                <td><?= $orders['payment_method'] ?></td>
                            </tr>
                            <tr>
                                <th>Detail Pembayaran</th>
                                <td>:</td>
                                <td><?= $orders['payment_detail'] ?></td>
                            </tr>
                            <tr>
                                <th>Total Bayar</th>
                                <td>:</td>
                                <td>Rp.<?= number_format($orders['totalbayar'], 0, ',', ',') ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pengiriman</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <tr>
                                <th>Nama Penerima</th>
                                <td>:</td>
                                <td><?= $orders['nama_penerima'] ?></td>
                            </tr>
                            <tr>
                                <th>No.Hp Penerima</th>
                                <td>:</td>
                                <td><?= $orders['nohp_penerima'] ?>
                            </tr>
                            <tr>
                                <th>Alamat Penerima</th>
                                <td>:</td>
                                <td><?= $orders['alamat_penerima'] ?></td>
                            </tr>
                            <form action="<?= base_url('admin/order/shipping/status/' . $orders['nomor_pesanan']) ?>" method="post">
                                <tr>
                                    <th>Status Pesanan</th>
                                    <td>:</td>
                                    <td>
                                        <p class="btn btn-success"><?= $orders['status_order'] ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kurir</th>
                                    <td>:</td>
                                    <td>
                                        <?= strtoupper($orders['courier']) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>No.Resi</th>
                                    <td>:</td>
                                    <td>
                                        <input type="text" class="form-control border-0 border-bottom" name="no_resi" value="<?= $orders['no_resi'] ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                    </th>
                                    <td></td>
                                    <td>

                                        <input type="hidden" name="order_id" value="<?= $orders['id'] ?>">
                                        <button type="submit" class="btn btn-primary">
                                            Selesaikan Pesanan
                                        </button>
                                    </td>
                                </tr>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Name Produk</th>
                                <th>Variasi</th>
                                <th>Bobot</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>SubTotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($orderdetails as $order) : ?>
                                <tr>
                                    <td>
                                        <?= $no++ ?>
                                    </td>
                                    <td><img src="<?= base_url('assets/img/product/' . $order['images_produk_thumbnail']) ?>" alt=""></td>
                                    <td><?= $order['nama_produk'] ?></td>
                                    <td><?= $order['variasi'] ?></td>
                                    <td><?= $order['totalbobot'] ?> gram</td>
                                    <td>x <?= $order['kuantitas'] ?></td>
                                    <td><?= number_format($order['harga_varian_order'], 0, ',', ',') ?></td>
                                    <td>Rp.<?= number_format($order['subtotal'], 0, ',', ',') ?></td>
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