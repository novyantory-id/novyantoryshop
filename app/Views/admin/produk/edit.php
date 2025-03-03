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
                <form action="<?= base_url('admin/product/update/' . $produk['id']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-row row">

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Nama Produk<span class="text-danger fs-5">*</span></label>
                                        <input
                                            type="text"
                                            id="nama_produk"
                                            name="nama_produk"
                                            value="<?= $produk['nama_produk'] ?>"
                                            class="form-control <?= ($validation->hasError('nama_produk')) ? 'is-invalid' : ''; ?>"
                                            placeholder="Input nama produk..." />
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_produk') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Berat Produk (gr)<span class="text-danger fs-5">*</span></label>
                                        <input
                                            type="text"
                                            id="berat_produk"
                                            name="berat_produk"
                                            value="<?= $produk['berat_produk'] ?>"
                                            class="form-control <?= ($validation->hasError('berat_produk')) ? 'is-invalid' : ''; ?>"
                                            placeholder="Input berat produk..." />
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('berat_produk') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Harga Produk<span class="text-danger fs-5">*</span></label>
                                        <input
                                            type="number"
                                            id="harga_produk"
                                            name="harga_produk"
                                            min="1000"
                                            max="100000000"
                                            value="<?= $produk['harga_produk'] ?>"
                                            class="form-control <?= ($validation->hasError('harga_produk')) ? 'is-invalid' : ''; ?>"
                                            placeholder="Input harga produk..." />
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('harga_produk') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Deskripsi Pendek Produk<span class="text-danger fs-5">*</span></label>
                                        <textarea
                                            name="deskripsi_produk"
                                            id="deskripsi_produk"
                                            placeholder="Input deskripsi produk..."
                                            class="form-control <?= ($validation->hasError('deskripsi_produk')) ? 'is-invalid' : ''; ?>"><?= $produk['deskripsi_produk'] ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('deskripsi_produk') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Deskripsi Panjang Produk<span class="text-danger fs-5">*</span></label>
                                        <textarea
                                            name="deskripsi_panjang_produk"
                                            id="summernote"
                                            placeholder="Input deskripsi panjang_produk..."
                                            class="form-control <?= ($validation->hasError('deskripsi_panjang_produk')) ? 'is-invalid' : ''; ?>"><?= $produk['deskripsi_panjang_produk'] ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('deskripsi_panjang_produk') ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-row row">

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Pilih Brand<span class="text-danger fs-5">*</span></label>
                                        <select
                                            name="brand"
                                            id="brand"
                                            class="form-control <?= ($validation->hasError('brand')) ? 'is-invalid' : ''; ?>">
                                            <option value="<?= $produk['brand_id'] ?>"><?= $produk['nama_brand'] ?></option>
                                            <?php foreach ($brand as $key) : ?>
                                                <option value="<?= $key['id'] ?>"><?= $key['nama_brand'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('brand') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Kategori<span class="text-danger fs-5">*</span></label>
                                        <select
                                            name="kategori"
                                            id="kategori"
                                            class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>">
                                            <option value="<?= $produk['kategori_id'] ?>"><?= $produk['kategori'] ?></option>
                                            <?php foreach ($kategori as $key) : ?>
                                                <option value="<?= $key['id'] ?>"><?= $key['kategori'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('kategori') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Sub Kategori<span class="text-danger fs-5">*</span></label>
                                        <select
                                            name="subkategori"
                                            id="subkategori"
                                            class="form-control <?= ($validation->hasError('subkategori')) ? 'is-invalid' : ''; ?>">
                                            <option value="<?= $produk['subkategori_id'] ?>"><?= $produk['subkategori'] ?></option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('subkategori') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Sub-sub Kategori<span class="text-danger fs-5">*</span></label>
                                        <select
                                            name="subsubkategori"
                                            id="subsubkategori"
                                            class="form-control <?= ($validation->hasError('subsubkategori')) ? 'is-invalid' : ''; ?>">
                                            <option value="<?= $produk['subsubkategori_id'] ?>"><?= $produk['subsubkategori'] ?></option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('subsubkategori') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                <div class="form-check">
                                                    <input
                                                        name="is_promo"
                                                        id="is_promo" class="form-check-input"
                                                        type="checkbox"
                                                        <?= ($produk['is_promo'] == 1) ? 'checked' : ''; ?>
                                                        value="1">
                                                    <label for="is_promo">Promo</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                <div class="form-check">
                                                    <input
                                                        name="is_baru"
                                                        id="is_baru" class="form-check-input"
                                                        type="checkbox"
                                                        <?= ($produk['is_baru'] == 1) ? 'checked' : ''; ?>
                                                        value="1">
                                                    <label for="is_baru">Produk Baru</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12">
                                                <div class="form-check">
                                                    <input
                                                        name="is_bestseller"
                                                        id="is_bestseller" class="form-check-input"
                                                        type="checkbox"
                                                        <?= ($produk['is_bestseller'] == 1) ? 'checked' : ''; ?>
                                                        value="1">
                                                    <label for="is_bestseller">Best Seller</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label> Thumbnail Produk<span class="text-danger fs-5">*</span></label>
                                        <div class="image-upload">
                                            <input
                                                type="file"
                                                id="fileInput"
                                                onchange="displayFileName()"
                                                accept="image/"
                                                name="images_produk_thumbnail" />
                                            <div class="image-uploads">
                                                <img src="<?= base_url('assets/img/icons/upload.svg') ?>" alt="img" />
                                                <h4 id="dragText">Drag and drop a file to upload</h4>
                                                <p id="fileName" style="margin-top: 5px; font-style:italic;"></p>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('images_produk_thumbnail') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="product-list">
                                        <ul class="row">
                                            <div class="col-sm-12">
                                                <li>
                                                    <div class="productviews">
                                                        <div class="productviewsimg">
                                                            <input type="hidden" value="<?= $produk['images_produk_thumbnail'] ?>" name="images_produk_thumbnail_lama">
                                                            <img src="<?= base_url('assets/img/product/' . $produk['images_produk_thumbnail']) ?>" alt="img" />
                                                        </div>
                                                        <div class="productviewscontent">
                                                            <div class="productviewsname">
                                                                <h2><?= $produk['images_produk_thumbnail']; ?></h2>
                                                                <!-- <h3 id="fileInfo">581kb</h3> -->
                                                            </div>
                                                            <a href="javascript:void(0);">x</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </div>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label> Galeri Produk<span class="text-danger fs-5">*</span></label>
                                        <div class="image-upload">
                                            <input
                                                type="file"
                                                id="fileInput2"
                                                onchange="displayFileName2()"
                                                accept="image/"
                                                name="images_produk_galeri" />
                                            <div class="image-uploads">
                                                <img src="<?= base_url('assets/img/icons/upload.svg') ?>" alt="img" />
                                                <h4 id="dragText2">Drag and drop a file to upload</h4>
                                                <p id="fileName2" style="margin-top: 5px; font-style:italic;"></p>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('images_produk_galeri') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="product-list">
                                        <ul class="row">
                                            <div class="col-sm-12">
                                                <li>
                                                    <div class="productviews">
                                                        <div class="productviewsimg">
                                                            <input type="hidden" value="<?= $produk['images_produk_galeri'] ?>" name="images_produk_galeri_lama">
                                                            <img src="<?= base_url('assets/img/product/' . $produk['images_produk_galeri']) ?>" alt="img" />
                                                        </div>
                                                        <div class="productviewscontent">
                                                            <div class="productviewsname">
                                                                <h2><?= $produk['images_produk_galeri']; ?></h2>
                                                                <!-- <h3 id="fileInfo">581kb</h3> -->
                                                            </div>
                                                            <a href="javascript:void(0);">x</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </div>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Pilih Status<span class="text-danger fs-5">*</span></label>
                                        <select
                                            name="status_active_produk"
                                            id="status_active_produk"
                                            class="form-control <?= ($validation->hasError('status_active_produk')) ? 'is-invalid' : ''; ?>">
                                            <option value="<?= $produk['status_active_produk'] ?>"><?= $produk['status_active_produk'] ?></option>
                                            <option value="aktif">Aktif</option>
                                            <option value="tidak aktif">Tidak Aktif</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('brand') ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-submit" style="width: 100%;">Update Produk</button>
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
    //make display image name
    function displayFileName() {
        const fileInput = document.getElementById('fileInput');
        const fileNameDisplay = document.getElementById('fileName');
        const dragText = document.getElementById('dragText');

        if (!dragText) {
            console.error('element with ID "dragText" not found!');
            return;
        }

        // cek jika ada file yang dipilih
        if (fileInput.files.length > 0) {
            const fileName = fileInput.files[0].name;
            fileNameDisplay.textContent = `File yang dipilih: ${fileName}`;
            dragText.style.display = 'none';
        } else {
            fileNameDisplay.textContent = "Tidak ada file yang dipilih.";
        }
    }

    function displayFileName2() {
        const fileInput = document.getElementById('fileInput2');
        const fileNameDisplay = document.getElementById('fileName2');
        const dragText = document.getElementById('dragText2');

        if (!dragText) {
            console.error('element with ID "dragText" not found!');
            return;
        }

        // cek jika ada file yang dipilih
        if (fileInput.files.length > 0) {
            const fileName = fileInput.files[0].name;
            fileNameDisplay.textContent = `File yang dipilih: ${fileName}`;
            dragText.style.display = 'none';
        } else {
            fileNameDisplay.textContent = "Tidak ada file yang dipilih.";
        }
    }

    //make filter sub kategori

    // memastikan seluruh elemen pada DOM telah selesai dimuat oleh browser
    $(document).ready(function() {
        // titik untuk class, tagar untuk id
        // mendeteksi saat pengguna mengubah pilihan pada elemen
        $('#kategori').change(function() {
            // mengambail nilai (value) dari elemen yang sedang berinteraksi dengan pengguna (select, input, textarea). ex: 1 untuk kategori "Pria" yang disimpan ke kategoriId
            var kategoriId = $(this).val();
            console.log('Kategori ID:', kategoriId);
            if (kategoriId) {
                // mengirim permintaan AJAX ke server untuk mendapatkan data subkategori berdasarkan kategoriId
                $.ajax({
                    url: '/admin/product/get-subkategori',
                    type: 'POST',
                    // key data AJAX kategori_id harus sama dengan data getVar("kategori_id")
                    data: {
                        kategori_id: kategoriId
                    },
                    dataType: 'json',
                    // kirim ke controller

                    // menangani data yang berhasil diterima dari server
                    success: function(response) {
                        console.log('Response:', response);
                        var subkategoriSelect = $('#subkategori');
                        // memastikan elemen <select> kosong sebelum menambah data baru. mencegah subkategori lama tetap muncul ketiga kategori baru dipilih
                        subkategoriSelect.empty().append('<option value="">Pilih Subkategori</option>');
                        // melakukan iterasi pada array response yang berisi data subkategori dari server.
                        response.forEach(function(subkategori) {
                            // meanmbah elemen <option> baru ke dalaman elemen <select id="subkategori">
                            subkategoriSelect.append('<option value="' + subkategori.id + '">' + subkategori.subkategori + '</option>');
                        });
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat memuat data subkategori.');
                    }
                });
            } else {
                $('#subkategori').empty().append('<option value="">Pilih Subkategori</option>');
            }
        });
    });

    $(document).ready(function() {
        // titik untuk class, tagar untuk id
        // mendeteksi saat pengguna mengubah pilihan pada elemen
        $('#subkategori').change(function() {
            // mengambail nilai (value) dari elemen yang sedang berinteraksi dengan pengguna (select, input, textarea). ex: 1 untuk kategori "Pria" yang disimpan ke kategoriId
            var subkategoriId = $(this).val();
            console.log('Sub Kategori ID:', subkategoriId);
            if (subkategoriId) {
                // mengirim permintaan AJAX ke server untuk mendapatkan data subkategori berdasarkan kategoriId
                $.ajax({
                    url: '/admin/product/get-subsubkategori',
                    type: 'POST',
                    // key data AJAX kategori_id harus sama dengan data getVar("kategori_id")
                    data: {
                        subkategori_id: subkategoriId
                    },
                    dataType: 'json',
                    // kirim ke controller

                    // menangani data yang berhasil diterima dari server
                    success: function(response) {
                        console.log('Response:', response);
                        var subsubkategoriSelect = $('#subsubkategori');
                        // memastikan elemen <select> kosong sebelum menambah data baru. mencegah subkategori lama tetap muncul ketiga kategori baru dipilih
                        subsubkategoriSelect.empty().append('<option value="">Pilih Sub-sub Kategori</option>');
                        // melakukan iterasi pada array response yang berisi data subkategori dari server.
                        response.forEach(function(subsubkategori) {
                            // meanmbah elemen <option> baru ke dalaman elemen <select id="subkategori">
                            subsubkategoriSelect.append('<option value="' + subsubkategori.id + '">' + subsubkategori.subsubkategori + '</option>');
                        });
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat memuat data subkategori.');
                    }
                });
            } else {
                $('#subsubkategori').empty().append('<option value="">Pilih Sub-sub Kategori</option>');
            }
        });
    });
</script>

<?= $this->endSection() ?>