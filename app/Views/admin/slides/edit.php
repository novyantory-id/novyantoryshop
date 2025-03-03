<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<!-- Main contents -->

<div class="page-header">
    <div class="page-title">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/slides') ?>"><?= $title; ?></a></li>
            <li class="breadcrumb-item active"><?= $title_detail; ?></li>
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-body">

        <form action="<?= base_url('admin/slides/update/' . $slides['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="form-row row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Judul Slides</label>
                        <input
                            type="text"
                            id="judul_slides"
                            name="judul_slides"
                            oninput="sinkronInput()"
                            value="<?= $slides['judul_slides']; ?>"
                            class="form-control <?= ($validation->hasError('judul_slides')) ? 'is-invalid' : ''; ?>"
                            placeholder="Input slides title..." />
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul_slides') ?>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea
                            name="deskripsi_slides"
                            id="deskripsi_slides"
                            placeholder="Input deskripsi slides..."
                            class="form-control <?= ($validation->hasError('deskripsi_slides')) ? 'is-invalid' : ''; ?>"><?= $slides['deskripsi_slides'] ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('deskripsi_slides') ?>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label> Slides Image</label>
                        <div class="image-upload">
                            <input
                                type="file"
                                id="fileInput"
                                onchange="displayFileName()"
                                accept="image/"
                                name="images_slides" />
                            <div class="image-uploads">
                                <img src="<?= base_url('assets/img/icons/upload.svg') ?>" alt="img" />
                                <h4 id="dragText">Drag and drop a file to upload</h4>
                                <p id="fileName" style="margin-top: 5px; font-style:italic;"></p>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('images_slides') ?>
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
                                            <input type="hidden" value="<?= $slides['images_slides'] ?>" name="images_lama">
                                            <img src="<?= base_url('assets/img/slides/' . $slides['images_slides']) ?>" alt="img" />
                                        </div>
                                        <div class="productviewscontent">
                                            <div class="productviewsname">
                                                <h2><?= $slides['images_slides']; ?></h2>
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
                    <a href="<?= base_url('admin/slides') ?>" class="btn btn-cancel" style="width: 48%;">Cancel</a>
                </div>
        </form>

    </div>
</div>

<!-- End contents -->

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
</script>

<?= $this->endSection() ?>