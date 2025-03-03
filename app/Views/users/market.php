<?= $this->extend('users/layout.php') ?>

<?= $this->section('content') ?>

<!-- Main contents -->

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">

</div>
<!-- Single Page Header End -->


<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4 text-primary">Get Your Products</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                        <div class="input-group w-100 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                            <label for="fruits">Default Sorting:</label>
                            <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform">
                                <option value="volvo">Nothing</option>
                                <option value="saab">Popularity</option>
                                <option value="opel">Organic</option>
                                <option value="audi">Fantastic</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Categories</h4>
                                    <ul class="list-unstyled fruite-categorie">
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="<?= base_url('user/market') ?>" class="<?= empty($selected_category === null) ? '' : 'active'; ?>">All Categories</a>
                                                <span>(<?= $produkdata ?>)</span>
                                            </div>
                                        </li>
                                        <?php foreach ($kategoridata as $key) : ?>
                                            <li>
                                                <div class="d-flex justify-content-between fruite-name">
                                                    <a class="<?= ($selected_category === $key['slug_kategori']) ? 'active' : '' ?>" href="<?= base_url('user/market/kategori/' . $key['slug_kategori']) ?>"><?= $key['kategori'] ?></a>
                                                    <span>(<?= $key['total_produk'] ?>)</span>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4 class="mb-2">Price</h4>
                                    <input type="range" class="form-range w-100" id="hargaRange" min="0" max="100000000" step="50000" value="<?= $hargaMaksimal ?? 100000000 ?>" oninput="filterProducts()">
                                    <p id="hargaValue">Harga Maksimal: Rp <?= number_format($hargaMaksimal ?? 100000000, 0, ',', ',') ?></p>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-9">
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
        </div>
    </div>
</div>
<!-- Fruits Shop End-->

<!-- End contents -->

<script>
    const hargaRange = document.getElementById('hargaRange');
    const hargaValue = document.getElementById('hargaValue');

    hargaRange.addEventListener('input', function() {
        const harga = this.value;
        hargaValue.textContent = `Harga Maksimal: Rp ${new Intl.NumberFormat('id-ID').format(harga)}`;

        // update URL
        const url = new URL(window.location.href);
        url.searchParams.set('harga', harga);

        <?php if ($selected_category): ?>
            url.pathname = "user/market/kategori/<?= $selected_category ?>"; //jika ada kategori
        <?php else: ?>
            url.pathname = "user/market"; //jika tidak ada kategori
        <?php endif; ?>

        window.location.href = url.toString();
    });

    function formatRupiah(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(value);
    }

    // function filterProducts() {
    //     const minPrice = document.getElementById('minPrice').value;
    //     const maxPrice = document.getElementById('maxPrice').value;

    //     // Update output harga
    //     document.getElementById('minPriceValue').textContent = formatRupiah(minPrice);
    //     document.getElementById('maxPriceValue').textContent = formatRupiah(maxPrice);

    //     // Ambil kateegori dari URL
    //     const currentUrl = window.location.href;
    //     const url = new URL(currentUrl);
    //     const slugCategory = url.pathname.split('/')[2] || ''; //Ambil slug kategori

    //     const filterUrl = `<?= base_url('market/kategori'); ?>/${slugCategory}?minPrice=${minPrice}&maxPrice=${maxPrice}`;
    //     fetch(filterUrl)
    //         .then(response => response.text())
    //         .then(data => {
    //             document.getElementById('productList').innerHTML = data;
    //         })
    //         .catch(error => console.error('Error:', error));
    // }
</script>

<?= $this->endSection() ?>