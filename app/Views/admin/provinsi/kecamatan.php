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
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('admin/kecamatan/store-kecamatan') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-row row">

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select
                                    name="provinsi"
                                    id="provinsi"
                                    class="form-control <?= ($validation->hasError('provinsi')) ? 'is-invalid' : ''; ?>">
                                    <option value="">--Pilih Provinsi--</option>
                                    <?php foreach ($provinsi as $key) : ?>
                                        <option value="<?= $key['id'] ?>"><?= $key['provinsi'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('provinsi') ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Kabupaten</label>
                                <select
                                    name="kabupaten"
                                    id="kabupaten"
                                    class="form-control <?= ($validation->hasError('kabupaten')) ? 'is-invalid' : ''; ?>">
                                    <option value="">--Pilih Kabupaten--</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('kabupaten') ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <input
                                    type="text"
                                    id="kecamatan"
                                    name="kecamatan"
                                    value="<?= set_value('kecamatan'); ?>"
                                    class="form-control <?= ($validation->hasError('kecamatan')) ? 'is-invalid' : ''; ?>"
                                    placeholder="Input kecamatan..." />
                                <div class="invalid-feedback">
                                    <?= $validation->getError('kecamatan') ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit" style="width: 100%;">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
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
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Provinsi</th>
                                <th>Kabupaten/Kota</th>
                                <th>Kecamatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($kecamatan as $key) : ?>
                                <tr>
                                    <td>
                                        <?= $no++ ?>
                                    </td>
                                    <td><?= $key['provinsi'] ?></td>
                                    <td><?= $key['kabupaten'] ?></td>
                                    <td><?= $key['kecamatan'] ?></td>
                                    <td>
                                        <a class="me-3" href="<?= base_url('admin/kecamatan/edit-kecamatan/' . $key['id']) ?>">
                                            <i class="ion-edit"></i> Edit
                                        </a>
                                        <a class="me-3 tombol-hapus" href="<?= base_url('admin/kecamatan/delete-kecamatan/' . $key['id']) ?>">
                                            <i class="ion-trash-b"></i> Delete
                                        </a>
                                    </td>
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

<script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?> "></script>

<script>
    //make filter kabupaten

    // memastikan seluruh elemen pada DOM telah selesai dimuat oleh browser
    $(document).ready(function() {
        // titik untuk class, tagar untuk id
        // mendeteksi saat pengguna mengubah pilihan pada elemen
        $('#provinsi').change(function() {
            // mengambail nilai (value) dari elemen yang sedang berinteraksi dengan pengguna (select, input, textarea). ex: 1 untuk kategori "Pria" yang disimpan ke kategoriId
            var provinsiId = $(this).val();
            console.log('Provinsi ID:', provinsiId);
            if (provinsiId) {
                // mengirim permintaan AJAX ke server untuk mendapatkan data subkategori berdasarkan kategoriId
                $.ajax({
                    url: '/admin/kecamatan/get-kabupaten',
                    type: 'POST',
                    // key data AJAX kategori_id harus sama dengan data getVar("kategori_id")
                    data: {
                        provinsi_id: provinsiId
                    },
                    dataType: 'json',
                    // kirim ke controller

                    // menangani data yang berhasil diterima dari server
                    success: function(response) {
                        console.log('Response:', response);
                        var kabupatenSelect = $('#kabupaten');
                        // memastikan elemen <select> kosong sebelum menambah data baru. mencegah subkategori lama tetap muncul ketiga kategori baru dipilih
                        kabupatenSelect.empty().append('<option value="">Pilih Kabupaten</option>');
                        // melakukan iterasi pada array response yang berisi data subkategori dari server.
                        response.forEach(function(kabupaten) {
                            // meanmbah elemen <option> baru ke dalaman elemen <select id="subkategori">
                            kabupatenSelect.append('<option value="' + kabupaten.id + '">' + kabupaten.kabupaten + '</option>');
                        });
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat memuat data kabupaten.');
                    }
                });
            } else {
                $('#kabupaten').empty().append('<option value="">Pilih Kabupaten</option>');
            }
        });
    });
</script>

<?= $this->endSection() ?>