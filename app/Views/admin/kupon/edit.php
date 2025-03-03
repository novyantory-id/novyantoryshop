<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<!-- Main contents -->

<div class="page-header">
    <div class="page-title">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/kupon') ?>"><?= $title; ?></a></li>
            <li class="breadcrumb-item active"><?= $title_detail; ?></li>
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-body">

        <form action="<?= base_url('admin/kupon/update/' . $kupon['id']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-row row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Nama Kupon</label>
                        <input
                            type="text"
                            id="nama_kupon"
                            name="nama_kupon"
                            maxlength="25"
                            pattern="[A-Z,0-9]{0,25}"
                            title="harus menggunakan huruf kapital dan angka"
                            value="<?= $kupon['nama_kupon'] ?>"
                            class="form-control <?= ($validation->hasError('nama_kupon')) ? 'is-invalid' : ''; ?>"
                            placeholder="Input coupon code..." />
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_kupon') ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Diskon(%)</label>
                        <input
                            type="number"
                            id="diskon_kupon"
                            name="diskon_kupon"
                            min="1"
                            max="99"
                            value="<?= $kupon['diskon_kupon'] ?>"
                            class="form-control <?= ($validation->hasError('diskon_kupon')) ? 'is-invalid' : ''; ?>"
                            placeholder="Input discount coupon..." />
                        <div class="invalid-feedback">
                            <?= $validation->getError('diskon_kupon') ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Validation Date</label>
                        <input
                            type="date"
                            id="validasi"
                            name="validasi"
                            min="1"
                            max="99"
                            value="<?= $kupon['validasi'] ?>"
                            class="form-control <?= ($validation->hasError('validasi')) ? 'is-invalid' : ''; ?>"
                            placeholder="Input validation date..." />
                        <div class="invalid-feedback">
                            <?= $validation->getError('validasi') ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Status</label>
                        <select
                            name="status_kupon"
                            id="status_kupon"
                            class="form-select <?= ($validation->hasError('status_kupon')) ? 'is-invalid' : ''; ?>">
                            <option value="">--Pilih Status--</option>
                            <option <?php if ($kupon['status_kupon'] == 'valid') {
                                        echo 'selected';
                                    } ?> value="valid">Valid</option>
                            <option <?php if ($kupon['status_kupon'] == 'invalid') {
                                        echo 'selected';
                                    } ?> value="invalid">Invalid</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('status_kupon') ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <button type="submit" class="btn btn-submit" style="width: 50%;">Submit</button>
                    <a href="<?= base_url('admin/kupon') ?>" class="btn btn-cancel" style="width: 48%;">Cancel</a>
                </div>
        </form>

    </div>
</div>

<!-- End contents -->

<script>
    function upperCase() {
        // uppercase kupon
        const nama_kupon = document.getElementById('nama_kupon').value;
        // const nama_kuponn = document.getElementById('nama_kuponn');
        const upperCase = nama_kupon.toUpperCase();

        nama_kupon.value = upperCase;
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