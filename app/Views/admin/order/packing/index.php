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

        <div class="table-responsive">
            <table class="table datanew" style="font-size: x-small;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tgl Pesanan</th>
                        <th>No.Pesanan</th>
                        <th>Pembayaran</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($orders as $order) : ?>
                        <tr>
                            <td>
                                <?= $no++ ?>
                            </td>
                            <td><?= date('d M Y', strtotime($order['created_order_at'])) ?></td>
                            <td><?= $order['nomor_pesanan'] ?></td>
                            <td><?= ($order['payment_method'] == 'cod') ? 'Cash On Delivery' : $order['payment_method']; ?></td>
                            <td>Rp.<?= number_format($order['totalbayar'], 0, ',', ',') ?></td>
                            <td>
                                <p class="btn btn-sm btn-success" style="font-size: x-small;"><?= $order['status_order'] ?></p>
                            </td>
                            <td>
                                <a class="btn btn-primary me-3 text-white" style="font-size: x-small;" href="<?= base_url('admin/order/packing/' . $order['nomor_pesanan']) ?>"> Detail Order
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- End contents -->

<?= $this->endSection() ?>