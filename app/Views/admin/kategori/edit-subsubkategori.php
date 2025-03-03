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

        <form action="<?= base_url('admin/subsubkategori/update-subsubkategori/' . $subsubkategori['id']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-row row">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select
                            name="kategori"
                            id="kategori"
                            class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>">
                            <option value="<?= $subsubkategori['kategori_id'] ?>"><?= $subsubkategori['kategori'] ?></option>
                            <?php foreach ($kategori as $key) : ?>
                                <option value="<?= $key['id'] ?>"><?= $key['kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('kategori') ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Sub Kategori</label>
                        <select
                            name="subkategori"
                            id="subkategori"
                            class="form-control <?= ($validation->hasError('subkategori')) ? 'is-invalid' : ''; ?>">
                            <option value="<?= $subsubkategori['subkategori_id'] ?>"><?= $subsubkategori['subkategori'] ?></option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('subkategori') ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Sub-sub Kategori</label>
                        <input
                            type="text"
                            id="subsubkategori"
                            name="subsubkategori"
                            oninput="sinkronInput()"
                            value="<?= $subsubkategori['subsubkategori'] ?>"
                            class="form-control <?= ($validation->hasError('subsubkategori')) ? 'is-invalid' : ''; ?>"
                            placeholder="Input Sub-sub kategori name..." />
                        <div class="invalid-feedback">
                            <?= $validation->getError('subsubkategori') ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Slug</label>
                        <input
                            type="text"
                            id="slug_subsubkategori"
                            name="slug_subsubkategori"
                            value="<?= $subsubkategori['slug_subsubkategori'] ?>"
                            class="form-control"
                            readonly />
                    </div>
                </div>

                <div class="col-lg-12">
                    <button type="submit" class="btn btn-submit" style="width: 100%;">Submit</button>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- End contents -->

<script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?> "></script>

<script>
    // make slug
    function sinkronInput() {
        const kategori = document.getElementById('subsubkategori').value;
        const slug_kategori = document.getElementById('slug_subsubkategori');
        // ganti spasi dengan tanda "-"
        const slug = kategori.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9\-]/g, '');

        // sinkronisasi ke slug_kategori
        slug_kategori.value = slug;
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
                    url: '/admin/subsubkategori/get-subkategori',
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
</script>

<?= $this->endSection() ?>