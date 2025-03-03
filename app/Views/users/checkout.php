<?= $this->extend('users/layout.php') ?>

<?= $this->section('content') ?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">

</div>
<!-- Single Page Header End -->


<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Checkout</h1>
        <form action="<?= base_url('user/checkout/placeorder/' . $order['nomor_pesanan']) ?>" method="post">
            <?= csrf_field() ?>

            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <div class="row g-5">

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-item">
                                <label class="form-label my-3">Full Name <sup>*</sup></label>
                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                <input type="hidden" name="nomor_pemesanan" value="<?= $nomor_pemesanan ?>">
                                <input type="text" name="nama_penerima" class="form-control border-0 border-bottom" value="<?= $order['nama_user'] ?>" placeholder="Your full name">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Email <sup>*</sup></label>
                                <input type="email" class="form-control border-0 border-bottom"
                                    value="<?= $order['email_user'] ?>" placeholder="Your active email">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">No.Telp/HP <sup>*</sup></label>
                                <input type="number" name="nohp_penerima" class="form-control border-0 border-bottom" minlength="7" maxlength="13"
                                    value="<?= $order['nohp_user'] ?>"
                                    placeholder="Your phone number">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="form-item <?= ($validation->hasError('province_id')) ? 'has-error' : '' ?>">
                                <label class="form-label my-3">Provinsi<sup>*</sup></label>
                                <select name="province_id" id="province" class="form-select border-0 border-bottom" oninput="mixAllElements()">
                                    <option value="" selected disabled>Pilih Provinsi Tujuan</option>
                                    <?php foreach ($province as $p) : ?>
                                        <option value="<?= $p['province_id'] ?>"><?= $p['province'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="text-danger fst-italic">
                                    <?= $validation->getError('province_id') ?>
                                </div>
                            </div>
                            <div class="form-item <?= ($validation->hasError('city')) ? 'has-error' : '' ?>">
                                <label class="form-label my-3">Kab/Kota<sup>*</sup></label>
                                <select name="city" id="city" class="form-select border-0 border-bottom" oninput="mixAllElements()">
                                    <option value="" selected disabled>Pilih Kota/Kabupaten</option>
                                </select>
                                <div class="text-danger fst-italic">
                                    <?= $validation->getError('city') ?>
                                </div>
                            </div>
                            <div class="form-item <?= ($validation->hasError('subdistrict')) ? 'has-error' : '' ?>">
                                <label class="form-label my-3">Kecamatan<sup>*</sup></label>
                                <input type="text" name="subdistrict" id="subdistrict" oninput="mixAllElements()" class="form-control border-0 border-bottom" placeholder="Masukkan kecamatan" required>
                                <div class="text-danger fst-italic">
                                    <?= $validation->getError('subdistrict') ?>
                                </div>
                            </div>
                            <div class="form-item <?= ($validation->hasError('kodepos')) ? 'has-error' : '' ?>">
                                <label class="form-label my-3">Kode Pos<sup>*</sup></label>
                                <input type="number" name="kodepos" id="mix_kodepos" oninput="mixAllElements()" class="form-control border-0 border-bottom" maxlength="5" placeholder="Your postcode/Zip" required>
                                <div class="text-danger fst-italic">
                                    <?= $validation->getError('kodepos') ?>
                                </div>
                            </div>
                            <div class="form-item <?= ($validation->hasError('alamat')) ? 'has-error' : '' ?>">
                                <label class="form-label my-3">Alamat<sup>*</sup></label>
                                <textarea id="mix_alamat" name="alamat" oninput="mixAllElements()" class="form-control border-0 border-bottom" spellcheck="false" cols="30" rows="2" placeholder="Order Notes (Optional)"></textarea>
                                <div class="text-danger fst-italic">
                                    <?= $validation->getError('alamat') ?>
                                </div>
                            </div>
                            <input type="hidden" id="mix_all" name="alamat_penerima" class="form-control border-0 border-bottom">
                        </div>


                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-5">
                    <div class="table-responsive">
                        <table class="table fs-table-th-td">
                            <thead>
                                <tr>
                                    <th scope="col" style="font-size: 12px;">Products</th>
                                    <th scope="col" style="font-size: 12px;">Name</th>
                                    <th scope="col" style="font-size: 12px;">Price</th>
                                    <th scope="col" style="font-size: 12px;">Qty</th>
                                    <th scope="col" style="font-size: 12px;">Total</th>
                                    <!-- <th scope="col">Bobot</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orderdetails as $detail) : ?>
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center mt-2">
                                                <img src="<?= base_url('assets/img/product/' . $detail['images_produk_thumbnail']) ?>" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                            </div>
                                        </th>
                                        <td class="py-5" style="font-size: 12px;"><?= esc($detail['nama_produk']) ?> (<?= esc($detail['variasi']) ?>)</td>
                                        <td class="py-5" style="font-size: 12px;"><?= number_format($detail['harga_varian_order']) ?></td>
                                        <td class="py-5" style="font-size: 12px;">x <?= esc($detail['kuantitas']) ?></td>
                                        <td class="py-5" style="font-size: 12px;"><?= number_format($detail['subtotal']) ?></td>
                                        <!-- <td class="py-5">number_format($detail['totalbobot'])</td> -->
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark py-3" style="font-size: 12px;">Total Harga Produk</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div id="totalhargaproduk" class="py-3 border-bottom border-top" style="font-size: 12px;">
                                            <?= number_format($totalHarga, 0, ',', '.') ?>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row g-4 text-start align-items-center justify-content-center border-bottom py-3">
                        <input type="hidden" id="weight" name="weight" class="form-control" placeholder="Berat dalam gram" value="<?= ceil($totalBobot); ?>" readonly required>

                        <div class="mb-3 <?= ($validation->hasError('courier')) ? 'has-error' : '' ?>">
                            <label for="courier" class="form-label">Kurir</label>
                            <select name="courier" required id="courier" class="form-select border-0 border-bottom" required>
                                <option value="">-- Pilih Kurir --</option>
                                <option value="jne">JNE</option>
                            </select>
                            <div class="text-danger fst-italic">
                                <?= $validation->getError('courier') ?>
                            </div>
                        </div>
                        <!-- <button type="button" id="calculate" class="btn btn-primary">Hitung Ongkir</button> -->

                        <!-- Radio buttons akan muncul -->
                        <div id="shipping-options"></div>

                        <!-- Input untuk menyimpan data ongkir yang dipilih -->
                        <input type="hidden" id="selected-service" name="service">
                        <input type="hidden" id="selected-cost" name="cost_value" value="20000">
                        <input type="hidden" id="selected-etd" name="cost_etd">

                        <!-- Hasil Ongkir -->
                        <div id="shipping-cost"></div>
                        <div class="col-12 <?= ($validation->hasError('payment_method')) ? 'has-error' : '' ?>">
                            <label for="payment_method">Metode Pembayaran</label>
                            <select name="payment_method" required id="payment_method" class="form-select border-0 border-bottom" required>
                                <option value="">-- Pilih Metode Pembayaran --</option>
                                <option value="cod">Cash on Delivery (COD)</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="dompet digital">Dompet Digital</option>
                            </select>
                            <div class="text-danger fst-italic">
                                <?= $validation->getError('payment_method') ?>
                            </div>

                            <div id="cod-options" style="display: none; margin-top:10px;">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="payment_detail" value="cod"> <img src="<?= base_url('assets/img/icons/cod.png') ?>" style="width: 25px; height: 25px;" alt=""> Cash on Delivery (COD)
                                    </label>
                                </div>
                            </div>

                            <div id="transfer-options" style="display: none; margin-top:10px;">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="payment_detail" value="bni"> <img src="<?= base_url('assets/img/icons/bni.png') ?>" style="width: 25px; height: 25px;" alt=""> Bank BNI
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="payment_detail" value="bri"> <img src="<?= base_url('assets/img/icons/bri.png') ?>" style="width: 25px; height: 25px;" alt=""> Bank BRI
                                    </label>
                                </div>
                            </div>

                            <div id="digital-wallet-options" style="display: none; margin-top:10px;">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="payment_detail" value="dana"> <img src="<?= base_url('assets/img/icons/dana.jpeg') ?>" style="width: 25px; height: 25px;" alt=""> DANA
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="payment_detail" value="ovo">
                                        <img src="<?= base_url('assets/img/icons/ovo.png') ?>" style="width: 25px; height: 25px;" alt=""> OVO
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="total-ongkir" class="form-label">Total Ongkir</label>
                            <input type="hidden" id="total-ongkir" name="totalongkir" class="form-control border-0" placeholder="" value="" readonly required>
                            <input type="text" id="total-ongkir-khusus" class="form-control border-0" placeholder="" value="" readonly required>
                        </div>
                        <input type="hidden" id="total-harga-produk" name="subtotalproduk" value="" readonly>
                        <div class="mb-3">
                            <label for="total-bayar" class="form-label">Total Bayar</label>
                            <input type="hidden" id="total-bayar" name="totalbayar" class="form-control border-0" placeholder="" value="" readonly required>
                            <input type="text" id="total-bayar-khusus" class="form-control border-0" placeholder="" value="" readonly required>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button type="submit" class="btn border-primary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Page End -->

<script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?> "></script>

<script>
    const paymentMethod = document.getElementById('payment_method');
    const digitalWalletOptions = document.getElementById('digital-wallet-options');
    const transferOptions = document.getElementById('transfer-options');
    const codOptions = document.getElementById('cod-options');

    paymentMethod.addEventListener('change', function() {
        const selectMethod = this.value;

        if (selectMethod === 'transfer') {
            transferOptions.style.display = 'block';
            digitalWalletOptions.style.display = 'none';
            codOptions.style.display = 'none';
        } else if (selectMethod === 'dompet_digital') {
            digitalWalletOptions.style.display = 'block';
            transferOptions.style.display = 'none';
            codOptions.style.display = 'none';
        } else {
            codOptions.style.display = 'block';
            transferOptions.style.display = 'none';
            digitalWalletOptions.style.display = 'none';
        }
    });

    // mix alamat_pengiriman
    function mixAllElements() {
        const mixProvinsi = document.getElementById('province').selectedOptions[0].text;
        const mixKabupaten = document.getElementById('city').selectedOptions[0].text;
        const mixKecamatan = document.getElementById('subdistrict').value;
        const mixKodepos = document.getElementById('mix_kodepos').value;
        const mixAlamat = document.getElementById('mix_alamat').value;
        const mixAll = document.getElementById('mix_all');

        gabungkan_semua = mixAlamat + ', ' + mixKecamatan.toUpperCase() + ', ' + mixKabupaten.toUpperCase() + ', ' + mixProvinsi.toUpperCase() + ', ' + mixKodepos;

        mixAll.value = gabungkan_semua;
    }
</script>

<script>
    function formatRupiah(angka) {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0
        }).format(angka);
    }
</script>

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


        // Saat pilih kurir,...
        $('#courier').change(function(e) {
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
                    // let output = '';
                    // costs.forEach(cost => {
                    //     output += `<p>${cost.service}: Rp. ${cost.cost[0].value} (${cost.cost[0].etd} hari)</p>`;
                    // });
                    // $('#shipping-cost').html(output);

                    let options = '';
                    costs.forEach(cost => {
                        options += `
                        <div>
                        <input type="radio" name="shipping" value="${cost.service}" data-cost="${cost.cost[0].value}" data-etd="${cost.cost[0].etd}">
                        ${cost.service} - Rp ${cost.cost[0].value} (Estimasi: ${cost.cost[0].etd} hari)
                        </div>
                        `;
                    });
                    document.getElementById('shipping-options').innerHTML = options;

                    // Event listener untuk radio buttons
                    document.querySelectorAll('input[name="shipping"]').forEach(radio => {
                        radio.addEventListener('change', function() {
                            document.getElementById('selected-service').value = this.value;
                            document.getElementById('selected-cost').value = this.dataset.cost;
                            document.getElementById('selected-etd').value = this.dataset.etd;

                            // hitung jumlah ongkir
                            var selectedValue = parseInt(this.dataset.cost);
                            var weight = parseInt(document.getElementById('weight').value) || 0;

                            if (this.value === "JTR") {
                                var beratDihitung = weight <= 10 ? 1 : weight;
                                var totalOngkir = beratDihitung * selectedValue;
                            } else {
                                var totalOngkir = weight * selectedValue;
                            }
                            document.getElementById('total-ongkir').value = totalOngkir;
                            document.getElementById('total-ongkir-khusus').value = formatRupiah(totalOngkir);

                            // menyalin total harga produk untuk dikalikan
                            var totalHargaProduk = document.getElementById('totalhargaproduk').innerText;
                            // ambil angka (buang tanda titik)
                            var angkaSaja = totalHargaProduk.match(/\d+/g).join("");
                            document.getElementById('total-harga-produk').value = angkaSaja;

                            // total ongkir + total bayar
                            var copyTotalHargaProduk = parseInt(document.getElementById('total-harga-produk').value);
                            var copyTotalOngkir = parseInt(document.getElementById('total-ongkir').value);
                            var totalBayar = copyTotalHargaProduk + copyTotalOngkir;
                            document.getElementById('total-bayar').value = totalBayar;
                            document.getElementById('total-bayar-khusus').value = formatRupiah(totalBayar);
                        })
                    })
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

<!-- <script>
    function hitungOngkir() {
        var weight = parseInt(document.getElementById('weight').value) || 0;
        var cost = parseInt(document.getElementById('selected-cost').value) || 0;

        console.log("Weight:", weight);
        console.log("Cost:", cost);

        var totalOngkir = weight * cost;
        console.log("Total Bayar:", totalOngkir);

        document.getElementById('total-ongkir').value = totalOngkir;

    }

    document.getElementById('selected-cost').addEventListener('change', function() {
        var selectedValue = this.value;
        var costInput = document.getElementById('selected-cost');

        costInput.value = selectedValue;

        hitungOngkir();
    });

    var costInput = document.createElement('input');
    costInput.type = 'text';
    costInput.id = 'selected-cost';
    document.body.appendChild(costInput);

    // function totalBayar() {
    //     var totalHargaOngkir = parseFloat(document.getElementById('total-ongkir').value) || 0;
    // }
</script> -->

<?= $this->endSection() ?>