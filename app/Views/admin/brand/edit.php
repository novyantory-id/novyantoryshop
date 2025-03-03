<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<!-- Main contents -->

<div class="page-header">
    <div class="page-title">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/brand') ?>"><?= $title; ?></a></li>
            <li class="breadcrumb-item active"><?= $title_detail; ?></li>
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-body">

        <form action="<?= base_url('admin/brand/update/' . $brand['slug_brand']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="form-row row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Brand Name</label>
                        <input
                            type="text"
                            id="nama_brand"
                            name="nama_brand"
                            oninput="sinkronInput()"
                            value="<?= $brand['nama_brand']; ?>"
                            class="form-control <?= ($validation->hasError('nama_brand')) ? 'is-invalid' : ''; ?>"
                            placeholder="Input brand name..." />
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_brand') ?>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Slug Brand</label>
                        <input
                            type="text"
                            id="slug_brand"
                            name="slug_brand"
                            value="<?= $brand['slug_brand']; ?>"
                            class="form-control"
                            readonly />
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label> Brand Image</label>
                        <div class="image-upload">
                            <input
                                type="file"
                                id="fileInput"
                                onchange="displayFileName()"
                                accept="image/"
                                name="images_brand" />
                            <div class="image-uploads">
                                <img src="<?= base_url('assets/img/icons/upload.svg') ?>" alt="img" />
                                <h4 id="dragText">Drag and drop a file to upload</h4>
                                <p id="fileName" style="margin-top: 5px; font-style:italic;"></p>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('images_brand') ?>
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
                                            <input type="hidden" value="<?= $brand['images_brand'] ?>" name="images_lama">
                                            <img src="<?= base_url('assets/img/brand/' . $brand['images_brand']) ?>" alt="img" />
                                        </div>
                                        <div class="productviewscontent">
                                            <div class="productviewsname">
                                                <h2><?= $brand['images_brand']; ?></h2>
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

                <div class="col-lg-12">
                    <button type="submit" class="btn btn-submit" style="width: 50%;">Submit</button>
                    <a href="<?= base_url('admin/brand') ?>" class="btn btn-cancel" style="width: 48%;">Cancel</a>
                </div>
        </form>

    </div>
</div>

<!-- End contents -->

<script>
    // make slug
    function sinkronInput() {
        const nama_brand = document.getElementById('nama_brand').value;
        const slug_brand = document.getElementById('slug_brand');
        const lowerCase = nama_brand.toLowerCase();

        // ganti spasi dengan tanda "-"
        const updateSpasi = nama_brand.replace(/\s+/g, '-');

        // sinkronisasi ke slug_brand
        slug_brand.value = updateSpasi;
        slug_brand.value = lowerCase;
    }

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
</script>

<?= $this->endSection() ?>