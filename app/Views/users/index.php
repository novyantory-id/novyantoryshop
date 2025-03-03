<?= $this->extend('users/layout.php') ?>

<?= $this->section('content') ?>

<!-- Main contents -->

<!-- Hero Start -->
<div class="container-fluid py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-md-12 col-lg-7">
                <h4 class="mb-3 text-secondary">100% Quality Brands</h4>
                <h1 class="mb-5 display-3 text-primary">Find Anything What You Want in Indonesia</h1>
                <div class="position-relative mx-auto">
                    <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="number" placeholder="Search">
                    <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Submit Now</button>
                </div>
            </div>
            <div class="col-md-12 col-lg-5">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <?php foreach ($carousel_slides as $key => $image) : ?>
                            <div class="carousel-item <?= ($key === 0) ? 'active' : ''; ?> rounded">
                                <img src="<?= base_url('assets/img/slides/' . $image['images_slides']) ?>" class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded fs-6"><?= $image['judul_slides'] ?></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->


<!-- Featurs Section Start -->
<div class="container-fluid featurs py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-primary mb-5 mx-auto">
                        <i class="fas fa-car-side fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Free Shipping</h5>
                        <p class="mb-0">Free on order over Rp.500.000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-primary mb-5 mx-auto">
                        <i class="fas fa-user-shield fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Security Payment</h5>
                        <p class="mb-0">100% security payment</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-primary mb-5 mx-auto">
                        <i class="fas fa-exchange-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>30 Day Return</h5>
                        <p class="mb-0">30 day money guarantee</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-primary mb-5 mx-auto">
                        <i class="fa fa-phone-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>24/7 Support</h5>
                        <p class="mb-0">Support every time fast</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Featurs Section End -->


<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Our Categories Products</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                            <a href="<?= base_url('user/home') ?>" class="d-flex m-2 py-2 bg-light rounded-pill <?= empty($selected_category === null) ? '' : 'active'; ?>">
                                <span class="text-dark" style="width: 130px;">All Products</span>
                            </a>
                        </li>
                        <?php foreach ($kategori as $key) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url('user/home/kategori/' . $key['slug_kategori']) ?>" class="d-flex m-2 py-2 bg-light rounded-pill <?= ($selected_category === $key['slug_kategori']) ? 'active' : '' ?>">
                                    <span class="text-dark" style="width: 130px;"><?= $key['kategori'] ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="product-catalog">
                <?php if ($produk) : ?>
                    <?php foreach ($produk as $key) : ?>
                        <div class="product-card">
                            <div class="product-image">
                                <img src="<?= base_url('assets/img/product/' . $key['images_produk_thumbnail']) ?>" alt="">
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px; font-size:12px;"><?= $key['kategori'] ?></div>
                            <h3 class="product-name"><?= $key['nama_produk'] ?></h3>
                            <p class="product-price">Rp.<?= number_format($key['harga_produk'], 0, ',', ',') ?></p>
                            <a href="<?= base_url('user/product/' . $key['slug_produk']) ?>" class="product-link mt-auto">View Product</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Tidak ada produk ditemukan.</p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->


<!-- Featurs Start -->
<div class="container-fluid service py-5">
    <div class="container py-5">
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <a href="#">
                    <div class="service-item bg-secondary rounded border border-secondary">
                        <img src="img/featur-1.jpg" class="img-fluid rounded-top w-100" alt="">
                        <div class="px-4 rounded-bottom">
                            <div class="service-content bg-primary text-center p-4 rounded">
                                <h5 class="text-white">Diskon Hingga</h5>
                                <h3 class="mb-0 text-secondary">20%</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="#">
                    <div class="service-item bg-dark rounded border border-dark">
                        <img src="img/featur-2.jpg" class="img-fluid rounded-top w-100" alt="">
                        <div class="px-4 rounded-bottom">
                            <div class="service-content bg-light text-center p-4 rounded">
                                <h5 class="text-primary">Banyak Untungnya</h5>
                                <h3 class="mb-0">Free delivery</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="#">
                    <div class="service-item bg-primary rounded border border-primary">
                        <img src="img/featur-3.jpg" class="img-fluid rounded-top w-100" alt="">
                        <div class="px-4 rounded-bottom">
                            <div class="service-content bg-secondary text-center p-4 rounded">
                                <h5 class="text-white">Promo Menarik</h5>
                                <h3 class="mb-0">Setiap Hari</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Featurs End -->

<!-- Vesitable Shop Start-->
<div class="container-fluid vesitable py-5">
    <div class="container py-5">
        <h1 class="mb-0">New Product in Here</h1>
        <div class="owl-carousel vegetable-carousel justify-content-center">

            <?php foreach ($newproduk as $key) : ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?= base_url('assets/img/product/' . $key['images_produk_thumbnail']) ?>" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px; font-size:12px;"><?= $key['kategori'] ?></div>
                    <h3 class="product-name"><?= $key['nama_produk'] ?></h3>
                    <p class="product-price">Rp.<?= number_format($key['harga_produk'], 0, ',', ',') ?></p>
                    <a href="<?= base_url('user/product/' . $key['slug_produk']) ?>" class="product-link mt-auto">View Details</a>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
<!-- Vesitable Shop End -->


<!-- Banner Section Start-->
<div class="container-fluid banner bg-primary my-5">
    <div class="container py-5">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="py-4">
                    <h1 class="display-3 text-white">Hottest Products</h1>
                    <p class="fw-normal display-3 text-secondary mb-4">in Our Store</p>
                    <p class="mb-4 text-white">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="img/baner-1.png" class="img-fluid w-100 rounded" alt="">
                    <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute" style="width: 140px; height: 140px; top: 0; left: 0;">
                        <h1 style="font-size: 100px;">1</h1>
                        <div class="d-flex flex-column">
                            <span class="h2 mb-0">st</span>
                            <span class="h4 text-muted mb-0">grade</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Section End -->


<!-- Bestsaler Product Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;">
            <h1 class="display-4">Bestseller Products</h1>
            <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($bestseller as $key) : ?>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="<?= base_url('assets/img/product/' . $key['images_produk_thumbnail']) ?>" class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5"><?= $key['nama_produk'] ?></a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">Rp <?= number_format($key['harga_produk'], 0, ',', ',') ?></h4>
                                <a href="<?= base_url('user/product/' . $key['slug_produk']) ?>" class="btn border border-primary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2"></i> View Product</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
<!-- Bestsaler Product End -->


<!-- Fact Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="bg-light p-5 rounded">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter bg-white rounded p-5">
                        <i class="fa fa-users text-primary"></i>
                        <h4 class="text-secondary">satisfied customers</h4>
                        <h1><?= $userdata ?></h1>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter bg-white rounded p-5">
                        <i class="fa fa-users text-primary"></i>
                        <h4 class="text-secondary">quality of service</h4>
                        <h1>99%</h1>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="counter bg-white rounded p-5">
                        <i class="fa fa-users text-primary"></i>
                        <h4 class="text-secondary">Available Products</h4>
                        <h1><?= $produkdata ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fact Start -->


<!-- Tastimonial Start -->
<div class="container-fluid testimonial py-5">
    <div class="container py-5">
        <div class="testimonial-header text-center">
            <h4 class="text-primary">Our Team</h4>
            <h1 class="display-5 mb-5 text-dark">Our Team Saying!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel">
            <div class="testimonial-item img-border-radius bg-light rounded p-4">
                <div class="position-relative">
                    <i class="fa fa-quote-right fa-2x text-primary position-absolute" style="bottom: 30px; right: 0;"></i>
                    <div class="mb-4 pb-4 border-bottom border-primary">
                        <p class="mb-0">Muter nggak, nih?
                        </p>
                    </div>
                    <div class="d-flex align-items-center flex-nowrap">
                        <div class="bg-primary rounded">
                            <img src="<?= base_url('assets/frontend/img/oiia.jpeg') ?>" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                        </div>
                        <div class="ms-4 d-block">
                            <h4 class="text-dark">Oiia Cat</h4>
                            <p class="m-0 pb-3">Spinning Director</p>
                            <div class="d-flex pe-5">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-item img-border-radius bg-light rounded p-4">
                <div class="position-relative">
                    <i class="fa fa-quote-right fa-2x text-primary position-absolute" style="bottom: 30px; right: 0;"></i>
                    <div class="mb-4 pb-4 border-bottom border-secondary">
                        <p class="mb-0"><?= $patrickMessage; ?>
                        </p>
                    </div>
                    <div class="d-flex align-items-center flex-nowrap">
                        <div class="bg-secondary rounded">
                            <img src="<?= base_url('assets/frontend/img/patrick.jpg') ?>" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                        </div>
                        <div class="ms-4 d-block">
                            <h4 class="text-dark">Patrick Star</h4>
                            <p class="m-0 pb-3">Stone Expert</p>
                            <div class="d-flex pe-5">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tastimonial End -->

<!-- End contents -->

<?= $this->endSection() ?>