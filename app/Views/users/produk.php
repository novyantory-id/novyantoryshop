<?= $this->extend('users/layout.php') ?>

<?= $this->section('content') ?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">

</div>
<!-- Single Page Header End -->


<!-- Single Product Start -->
<div class="container-fluid">
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="border rounded">
                            <a href="#">
                                <img src="<?= base_url('assets/img/product/' . $produk['images_produk_galeri']) ?>" class="img-fluid rounded" alt="Image">
                            </a>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <h4 class="fw-bold mb-3"><?= $produk['nama_produk'] ?></h4>
                        <h5 class="fw-bold mb-3"><span class="fs-6">Rp</span><?= $harga_output ?></h5>
                        <div class="d-flex mb-4">
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <?= $produk['deskripsi_produk'] ?>
                        <div class="custom-number-wrapper">
                            <label for="minus" class="spinner-btn">-</label>
                            <input name="kuantitas" id="quantity-input" type="number" value="1" min="1" max="10">
                            <label for="plus" class="spinner-btn">+</label>
                        </div>

                        <!-- Harga dasar dan stok -->
                        <p><strong>Stok Total:</strong> <?= esc($totalStok) ?></p>

                        <!-- Atribut -->
                        <?php
                        $atributData = [];
                        foreach ($stokproduk as $stok) {
                            foreach ($stok['kombinasi_atribut'] as $atribut => $nilai) {
                                $atributData[$atribut] = array_unique(array_merge($atributData[$atribut] ?? [], $nilai));
                            }
                        }
                        ?>

                        <?php foreach ($atributData as $atribut => $nilai) : ?>
                            <p class="m-0"><?= $atribut; ?>:</p>
                            <span class="d-flex inline-block">
                                <?php foreach ($nilai as $item) : ?>
                                    <button class="btn btn-outline-primary atribut-btn my-1 me-1" data-atribut="<?= $atribut; ?>" data-nilai="<?= $item; ?>">
                                        <?= $item; ?>
                                    </button>
                                <?php endforeach; ?>
                            </span>
                        <?php endforeach; ?>

                        <form action="<?= base_url('user/belisekarang') ?>" method="post">
                            <?= csrf_field() ?>

                            <input type="hidden" name="user_id" value="<?= session()->get('user_id') ?>">
                            <input type="hidden" name="produk_id" value="<?= $produk['id'] ?>" readonly>
                            <input type="hidden" name="kuantitas" id="quantity_input" value="1" readonly>

                            <div>
                                <input type="hidden" name="bobot" class="form-control" id="bobot_varian_input" placeholder="bobot otomatis" value="">
                            </div>

                            <input type="hidden" name="totalbobot" id="total_bobot_input" placeholder="total bobot">

                            <div>
                                <input type="hidden" name="variasi" class="form-control" id="input-varian" placeholder="kombinasi variasi otomatis" value="">
                            </div>

                            <!-- tampil stok dan harga varian -->
                            <div id="stok-harga">
                                <p>Pilih atribut untuk melihat stok dan harga.</p>
                            </div>
                            <input type="hidden" name="harga_varian_order" id="harga_varian_input">
                            <input type="hidden" name="subtotal" id="total_harga_input">

                            <button type="submit" id="buy-button" class="btn border border-primary rounded-pill px-4 py-2 mb-4 text-primary disabled" disabled>
                                <i class="fa fa-shopping-bag me-2 text-primary"></i>Buy</button>
                        </form>

                    </div>


                    <div class="col-lg-12">
                        <nav>
                            <div class="nav nav-tabs mb-3">
                                <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                    id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                    aria-controls="nav-about" aria-selected="true">Description</button>
                                <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                    id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                    aria-controls="nav-mission" aria-selected="false">Reviews</button>
                            </div>
                        </nav>
                        <div class="tab-content mb-5">
                            <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                <?= $produk['deskripsi_panjang_produk'] ?>
                            </div>
                            <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                <div class="d-flex">
                                    <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                    <div class="">
                                        <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                        <div class="d-flex justify-content-between">
                                            <h5>Jason Smith</h5>
                                            <div class="d-flex mb-3">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <p>The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic
                                            words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                    <div class="">
                                        <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                        <div class="d-flex justify-content-between">
                                            <h5>Sam Peters</h5>
                                            <div class="d-flex mb-3">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="text-dark">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic
                                            words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="nav-vision" role="tabpanel">
                                <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                    amet diam et eos labore. 3</p>
                                <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                    Clita erat ipsum et lorem et sit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid vesitable py-5">
            <div class="container py-5">
                <h1 class="mb-1">Related Products</h1>
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
    </div>
</div>
<!-- Single Product End -->

<script>
    let stokProduk = <?= json_encode($stokproduk); ?>;
    let hargaDasar = <?= $hargaDasar; ?>;
    let totalStok = <?= $totalStok ?>;
    let selectedAttributes = {};
    let atributVariasi = [...new Set(stokProduk.flatMap(item => Object.keys(item.kombinasi_atribut)))];

    // Nonaktifkan tombol atribut jika stok 0
    function updateAttributeButtons() {
        document.querySelectorAll('.atribut-btn').forEach(button => {
            const atribut = button.dataset.atribut;
            const nilai = button.dataset.nilai;

            // Simulasikan atribut yang dipilih saat ini
            const simulatedSelection = {
                ...selectedAttributes,
                [atribut]: nilai
            };

            // cek jika kombinasi atribut tersedia
            const kombinasiAda = stokProduk.some(item => {
                return Object.keys(simulatedSelection).every(attr => {
                    return item.kombinasi_atribut[attr] && item.kombinasi_atribut[attr].includes(simulatedSelection[attr]);
                });
            });

            // mengatur disable/enable pada stok
            if (!kombinasiAda) {
                button.disabled = true;
                button.classList.add('disabled');
            } else {
                button.disabled = false;
                button.classList.remove('disabled');
            }

        });
    }

    // Fungsi untuk mengaktifkan/menonaktifkan tombol buy
    function updateBuyButton() {
        const buyButton = document.getElementById('buy-button');

        // Cek jika semua atribut telah dipilih
        const allSelected = atributVariasi.every(attr => selectedAttributes[attr]);

        if (allSelected) {
            buyButton.disabled = false;
            buyButton.classList.remove('disabled');
        } else {
            buyButton.disabled = true;
            buyButton.classList.add('disabled');
        }
    }

    document.querySelector('label[for="minus"]').addEventListener("click", function() {
        let input = document.getElementById('quantity-input');
        let button = document.querySelector('.atribut-btn');
        let value = parseInt(input.value) || 1;
        if (value > 1) input.value = value - 1;
        updateTotalPrice();
    });

    document.querySelector('label[for="plus"]').addEventListener("click", function() {
        let input = document.getElementById('quantity-input');
        let button = document.querySelector('.atribut-btn');
        let value = parseInt(input.value) || 1;
        if (value < 10) input.value = value + 1;
        updateTotalPrice();
    });

    // Fungsi untuk memperbarui harga total dan bobot berdasarkan kuantitas
    function updateTotalPrice() {

        // tampilkan hasil
        const stokHargaDiv = document.getElementById('stok-harga');
        const quantityInput = document.getElementById('quantity-input');
        const quantity = parseInt(quantityInput.value) || 1;

        document.getElementById('quantity_input').value = quantityInput.value;

        // filter stok berdasarkan kombinasi atribut yang dipilih
        const hasil = stokProduk.filter(item => {
            return Object.keys(selectedAttributes).every(attr => {
                return item.kombinasi_atribut[attr] &&
                    item.kombinasi_atribut[attr].includes(selectedAttributes[attr]);
            });
        });

        const formatRupiah = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });

        // Ambil atau buat input hidden untuk harga dan total
        let hargaInput = document.querySelector('input[name="harga_varian"]');
        let totalInput = document.querySelector('input[name="total_harga"]');
        if (!hargaInput) {
            hargaInput = document.createElement('input');
            hargaInput.type = 'hidden';
            hargaInput.name = 'harga_varian';
            document.querySelector('form').appendChild(hargaInput);
        }
        if (!totalInput) {
            totalInput = document.createElement('input');
            totalInput.type = 'hidden';
            totalInput.name = 'total_harga';
            document.querySelector('form').appendChild(totalInput);
        }

        if (hasil.length > 0) {
            // hitung total harga varian
            const hargaVarian = hasil[0].harga_varian;
            const totalHarga = hargaVarian * quantity;

            // hitung total bobot varian
            const bobotVarian = hasil[0].bobot;
            const totalBobot = bobotVarian * quantity;

            document.getElementById('harga_varian_input').value = hargaVarian;
            document.getElementById('bobot_varian_input').value = bobotVarian;
            document.getElementById('total_harga_input').value = totalHarga;
            document.getElementById('total_bobot_input').value = totalBobot;

            stokHargaDiv.innerHTML = `<p>Stok: ${hasil[0].stok}</p>
                <p>Harga: ${formatRupiah.format(hargaVarian)}</p>
                <p>Total Harga: ${formatRupiah.format(totalHarga)}</p>`;
        } else {
            // Jika tidak ada hasil, kosongkan input hidden dan tampilkan info stok tidak tersedia
            hargaInput.value = '';
            totalInput.value = '';

            stokHargaDiv.innerHTML = `<p>Stok tidak tersedia</p>`;
        }
    }


    // Fungsi untuk inisialisasi tombol yang stoknya 0
    function initializeButtons() {
        document.querySelectorAll('.atribut-btn').forEach(button => {
            const atribut = button.dataset.atribut;
            const nilai = button.dataset.nilai;

            // Periksa apakah kombinasi atribut tersedia di awal
            const kombinasiAda = stokProduk.some(item => {
                return item.kombinasi_atribut[atribut] && item.kombinasi_atribut[atribut].includes(nilai);
            });

            // jika kombinasi tidak ada, nonaktifkan tombol
            if (!kombinasiAda) {
                button.disabled = true;
                button.classList.add('disabled');
            }

            // periksa stok awal untuk setiap kombinasi atribut
            const hasil = stokProduk.filter(item => {
                return item.kombinasi_atribut[atribut] && item.kombinasi_atribut[atribut].includes(nilai);
            });

            const totalStok = hasil.reduce((sum, item) => sum + parseInt(item.stok), 0);
            if (totalStok === 0) {
                button.disabled = true;
                button.classList.add('disabled');
            }
        });

        // Awalnya, tombol "Buy' dinonaktifkan
        updateBuyButton();
    }

    document.querySelectorAll('.atribut-btn').forEach(button => {
        button.addEventListener('click', function() {
            const atribut = this.dataset.atribut;
            const nilai = this.dataset.nilai;

            const isActive = this.classList.contains('active');

            document.querySelectorAll(`.atribut-btn[data-atribut="${atribut}"]`).forEach(btn => {
                btn.classList.remove('active');
            });

            if (!isActive) {
                this.classList.add('active');
                selectedAttributes[atribut] = nilai;
            } else {
                delete selectedAttributes[atribut];
            }


            // updateTotalWeight();
            updateAttributeButtons();
            updateBuyButton();
            updateTotalPrice();


            // tampilkan atribut dari button ke input hidden
            const inputVarian = document.getElementById('input-varian');
            inputVarian.value = Object.entries(selectedAttributes)
                .map(([key, value]) => `${key}: ${value}`)
                .join(', ');

            // Perbarui stok stok produk yang tersedia
            // disableOutOfStockButtons();
        });
    });

    // Event listener untuk input kuantitas
    document.getElementById('quantity-input').addEventListener('input', function() {
        updateTotalPrice();
    });

    // Jalankan saat pertama kali halaman dimuat
    // disableOutOfStockButtons();
    initializeButtons();
</script>

<?= $this->endSection() ?>