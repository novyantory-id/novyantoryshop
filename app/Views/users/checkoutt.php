<?= $this->extend('users/layout.php') ?>

<?= $this->section('content') ?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Product Detail</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>" class="text-border-primary">Home</a></li>
        <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Checkout</h1>
        <div class="col-lg-6 col-md-12 col-sm-12">

            <div class="mb-3">
                <label for="weight" class="form-label">Berat Barang (gram)</label>
                <input type="number" id="weight" name="weight" class="form-control" placeholder="Berat dalam gram" min="1" value="1" required>
            </div>
            <div class="mb-3">
                <label for="courier" class="form-label">Kurir</label>
                <select name="cost" required id="cost" class="form-select border-0 border-bottom" required>
                    <option value="">-- Pilih Kurir --</option>
                    <option value="48000">JNE: Rp 48.000</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="ongkir" class="form-label">Ongkir</label>
                <input type="number" id="selected-cost" name="totalbayar" class="form-control" placeholder="ongkir otomatis" value="" required>
            </div>
            <div class="mb-3">
                <label for="total-ongkir" class="form-label">Total Ongkir</label>
                <input type="number" id="total-ongkir" name="totalbayar" class="form-control" placeholder="Total ongkir otomatis" value="" required>
            </div>
            <button type="button" id="calculate" class="btn btn-primary">Hitung Ongkir</button>

            <!-- Hasil Ongkir -->
            <div id="shipping-cost"></div>
        </div>
    </div>
</div>

<script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        // saat memilih provinsi, ambil data kota/kabupaten
        $('#province').change(function() {
            const provinceId = $(this).val();
            console.log('Province ID:', provinceId);

            if (provinceId) {
                $.post('/get-cities', {
                    province_id: provinceId
                }, function(data) {
                    console.log('Cities Data:', data);
                    let cityOptions = '<option value="" selected disabled>Pilih Kota/Kabupaten</option>';
                    data.forEach(city => {
                        cityOptions += `<option value="${city.city_id}">${city.city_name}</option>`;
                    });
                    $('#city').html(cityOptions).prop('disabled', false);
                }).fail(function(xhr) {
                    console.error('AJAX Error:', xhr.responseText);
                })
            }
        });

        // Saat tombol hitung ongkir diklik
        $('#calculate').click(function(e) {
            const data = {
                origin: 224, // ID kota lampung selatan
                destination: $('#city').val(),
                weight: $('#weight').val(),
                courier: $('#courier').val(),
            };
            // const nomor_pemesanan = $('#nomor_pemesanan').val();

            console.log('Data yang dikirim:', data);

            $.post('<?= base_url('user/get-cost') ?>', data, function(response) {
                console.log("Respons dari server:", response);

                if (response.error) {
                    alert(response.error); //Menampilkan pesan error
                } else if (Array.isArray(response)) {
                    // Tampilkan hasil ke pengguna
                    let costs = response[0].costs;
                    let output = '';
                    costs.forEach(cost => {
                        output += `<p>${cost.service}: Rp. ${cost.cost[0].value} (${cost.cost[0].etd} hari)</p>`;
                    });
                    $('#shipping-cost').html(output);
                } else {
                    alert('Unexpected response from server');
                }
            }, 'json').fail(function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Failed to fetch shipping cost');
            })
        });

    });
</script>

<script>
    // document.getElementById('cost').addEventListener('change', function() {
    //     var selectedValue = this.value;
    //     document.getElementById('selected-cost').value = selectedValue;


    // });

    document.getElementById('cost').addEventListener('change', function() {
        var selectedValue = parseInt(this.value);
        var weight = parseInt(document.getElementById('weight').value) || 0;


        document.getElementById('selected-cost').value = selectedValue;

        var totalOngkir = weight * selectedValue;
        document.getElementById('total-ongkir').value = totalOngkir;
    });
</script>

<?= $this->endSection() ?>