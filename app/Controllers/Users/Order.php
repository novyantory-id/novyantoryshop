<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\OrderdetailsModel;
use App\Models\OrderModel;
use CodeIgniter\HTTP\Request;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

use function PHPUnit\Framework\isNull;

class Order extends BaseController
{
    private $orderModel;
    private $orderdetailsModel;
    private $apiKey = 'd2bf5f9b5cc24d636cd22da2135d43e5';

    function __construct()
    {
        helper(['url', 'form']);
        $this->orderModel = new OrderModel();
        $this->orderdetailsModel = new OrderdetailsModel();
    }

    public function getCities()
    {
        $provinceId = $this->request->getPost('province_id');
        log_message('info', 'Province ID Received: ' . print_r($provinceId, true));

        if (!$provinceId) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Province ID is required']);
        }

        try {
            // Ambil data kota/kabupaten berdasarkan provinsi
            $cities = $this->fetchData("https://api.rajaongkir.com/starter/city", ['province' => $provinceId]);

            log_message('info', 'Cities Data; ' . json_encode($cities));

            if (!isset($cities['rajaongkir']['results'])) {
                throw new \Exception("Invalid API Response");
            }
            // print_r($cities);
            return $this->response->setJSON($cities['rajaongkir']['results']);
        } catch (\Exception $e) {
            log_message('error', 'Error Fetching Cities; ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    // public function getSubdistrict()
    // {
    //     $cityId = $this->request->getPost('city_id');
    //     log_message('info', 'City ID Received: ' . print_r($cityId, true));

    //     if (!$cityId) {
    //         return $this->response->setStatusCode(400)->setJSON(['error' => 'City ID is required']);
    //     }

    //     try {
    //         // Ambil data kota/kabupaten berdasarkan provinsi
    //         $subdistrict = $this->fetchData("https://pro.rajaongkir.com/api/subdistrict", ['city' => $cityId]);

    //         log_message('info', 'Subdistrict Data; ' . json_encode($subdistrict));

    //         if (!isset($subdistrict['rajaongkir']['results'])) {
    //             throw new \Exception("Invalid API Response");
    //         }
    //         // print_r($subdistrict);
    //         return $this->response->setJSON($subdistrict['rajaongkir']['results']);
    //     } catch (\Exception $e) {
    //         log_message('error', 'Error Fetching Subdistrict; ' . $e->getMessage());
    //         return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
    //     }
    // }

    public function getCost()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query([
                'origin' => $this->request->getPost('origin'),
                'destination' => $this->request->getPost('destination'),
                'weight' => $this->request->getPost('weight'),
                'courier' => $this->request->getPost(strtolower('courier'))
            ]),
            CURLOPT_HTTPHEADER => [
                "key: d2bf5f9b5cc24d636cd22da2135d43e5",
                "Content-Type: application/x-www-form-urlencoded"
            ],
        ]);
        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        // Debug respons
        if ($error) {
            echo json_encode(['error' => "cURL Error: $error"]);
            return;
        } else {
            $result = json_decode($response, true);
            if (isset($result['rajaongkir']['status']['code']) && $result['rajaongkir']['status']['code'] == 200) {
                echo json_encode($result['rajaongkir']['results']);
            } else {
                echo json_encode(['error' => $result['rajaongkir']['status']['description'] ?? 'Unknown error']);
            }
        }

        die();
    }

    private function fetchData($url, $postData = [])
    {
        $curl = curl_init();

        if (!empty($postData)) {
            $url .= '?' . http_build_query($postData);
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "key: $this->apiKey"
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        log_message('info', "HTTP Code: $httpCode");
        log_message('info', "API Response: $response");

        if (curl_errno($curl)) {
            log_message('error', "cURL Error: " . curl_error($curl));
            throw new \Exception("cURL Error: " . curl_error($curl));
        }

        if ($httpCode !== 200) {
            throw new \Exception("API Error: $response");
        }
        curl_close($curl);

        return json_decode($response, true);
    }

    public function generateUniqueOrderNumber()
    {
        $date = date('ymd'); //250112
        $randomString = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10); //10 karakter acak
        return $date . $randomString;
    }

    public function beliSekarang()
    {
        $dataOrder = [
            'user_id'   => session()->get('user_id'),
            'nomor_pesanan' => $this->generateUniqueOrderNumber(),
            'total_harga_keseluruhan' => 0,
            'status'    => 'waiting',
            'created_order_at' => date('Y-m-d H:i:s'),
        ];
        $orderId = $this->orderModel->insert($dataOrder);

        if ($orderId) {
            $dataDetail = [
                'order_id' => $orderId,
                'produk_id' => $this->request->getPost('produk_id'),
                'variasi' => $this->request->getPost('variasi'),
                'harga_varian_order' => $this->request->getPost('harga_varian_order'),
                'kuantitas' => $this->request->getPost('kuantitas'),
                'subtotal' => $this->request->getPost('subtotal'),
                'totalbobot' => $this->request->getPost('totalbobot'),
            ];

            $this->orderdetailsModel->insert($dataDetail);

            // Perbarui total_harga_keseluruhan di tabel order
            // $totalHarga = $this->orderdetailsModel->where('order_id', $orderId)->selectSum('subtotal')->first()['subtotal'];
            // $this->orderModel->update($orderId, ['total_harga_keseluruhan' => $totalHarga]);

            session()->setFlashdata('berhasil', 'Data stok berhasil disimpan');
            return redirect()->to(base_url("user/checkout/{$dataOrder['nomor_pesanan']}"));
        }

        return redirect()->back()->with('error', 'Gagal memproses pesanan');
    }

    public function checkout($nomorPesanan)
    {
        $user_id = session()->get('user_id');
        $order = $this->orderModel->detailOrderById()
            ->where('order.nomor_pesanan', $nomorPesanan)
            ->where('order.user_id', $user_id)
            ->first();

        if (!$order && isNull($order)) {
            return redirect()->to(base_url('user/home'));
        }

        if ($order['status_order'] !== 'waiting') {
            return redirect()->to(base_url('user/home'));
        }

        // $user_id = $this->request->getPost('user_id');

        // $orderName = $this->orderModel->detailOrderById()->find($user_id);

        // memanggil data order detail berdasarkan order id
        $orderDetails = $this->orderdetailsModel->detailProdukOrderByUser()->where('order_id', $order['id'])->findAll();

        // mencari jumlah bobot dalama gram
        $totalbobot = array_sum(array_column($orderDetails, 'totalbobot'));


        $province = $this->fetchData("https://api.rajaongkir.com/starter/province");
        // print_r($province);
        $data = [
            'title' => 'Checkout - Novyantoryshop',
            'validation' => \Config\Services::validation(),
            'orderdetails' => $orderDetails,
            'order' => $order,
            'totalHarga' => array_sum(array_column($orderDetails, 'subtotal')),
            'totalBobot' => $totalbobot / 1000,
            'province' => $province['rajaongkir']['results'],
            'nomor_pemesanan' => $nomorPesanan,
        ];
        // dd($data);

        return view('users/checkout', $data);
    }

    public function placeOrder($nomorPesanan)
    {
        $validation = \Config\Services::validation();
        $rules = [
            'province_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Provinsi harus diisi'
                ],
            ],
            'city' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kabupaten/Kota harus diisi'
                ],
            ],
            'subdistrict' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kecamatan harus diisi'
                ],
            ],
            'kodepos' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kodepos harus diisi'
                ],
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi'
                ],
            ],
            'courier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kurir harus dipilih'
                ],
            ],
            'service' => 'required',
            'cost_value' => 'required',
            'cost_etd' => 'required',
            'payment_method' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Metode pembayaran harus dipilih'
                ],
            ],
            'payment_detail' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilihan pembayaran harus diisi'
                ],
            ],
        ];

        // validasi
        if (!$this->validate($rules)) {
            $user_id = session()->get('user_id');
            $order = $this->orderModel->detailOrderById()
                ->where('order.nomor_pesanan', $nomorPesanan)
                ->where('order.user_id', $user_id)
                ->first();

            if (!$order && isNull($order)) {
                return redirect()->to(base_url('user/home'));
            }

            if ($order['status_order'] !== 'pending') {
                return redirect()->to(base_url('user/home'));
            }

            // $user_id = $this->request->getPost('user_id');

            // $orderName = $this->orderModel->detailOrderById()->find($user_id);

            // memanggil data order detail berdasarkan order id
            $orderDetails = $this->orderdetailsModel->detailProdukOrderByUser()->where('order_id', $order['id'])->findAll();

            // mencari jumlah bobot dalama gram
            $totalbobot = array_sum(array_column($orderDetails, 'totalbobot'));


            $province = $this->fetchData("https://api.rajaongkir.com/starter/province");
            // print_r($province);
            $data = [
                'title' => 'Checkout - Novyantoryshop',
                'validation' => \Config\Services::validation(),
                'orderdetails' => $orderDetails,
                'order' => $order,
                'totalHarga' => array_sum(array_column($orderDetails, 'subtotal')),
                'totalBobot' => $totalbobot / 1000,
                'province' => $province['rajaongkir']['results'],
                'nomor_pemesanan' => $nomorPesanan,
            ];
            // dd($data);

            return view('users/checkout', $data);
        }

        $orderId = $this->request->getPost('order_id');
        $order = $this->orderModel->find($orderId);

        if (!$order || $order['status_order'] !== 'waiting') {
            return redirect()->to(base_url('user/home'));
        }

        $payment_method = $this->request->getPost('payment_method');

        if ($payment_method === 'cod') {
            $status_order = 'confirmed';
        } else {
            $status_order = 'pending';
        }

        // Update order
        $this->orderModel->update($orderId, [
            'nama_penerima' => $this->request->getPost('nama_penerima'),
            'nohp_penerima' => $this->request->getPost('nohp_penerima'),
            'alamat_penerima' => $this->request->getPost('alamat_penerima'),
            'payment_method' => $payment_method,
            'payment_detail' => $this->request->getPost('payment_detail'),
            'subtotalproduk' => $this->request->getPost('subtotalproduk'),
            'subtotalcost' => $this->request->getPost('totalongkir'),
            'totalbayar' => $this->request->getPost('totalbayar'),
            'courier' => $this->request->getPost('courier'),
            'service' => $this->request->getPost('service'),
            'cost_etd' => $this->request->getPost('cost_etd'),
            'status_order' => $status_order,
            'created_order_at' => date('Y-m-d H:i:s'),
        ]);

        session()->setFlashdata('success', 'Pesanan berhasil dibuat');
        return redirect()->to(base_url("user/purchase"));
    }

    public function checkoutt()
    {
        // $province = $this->fetchData("https://api.rajaongkir.com/starter/province");
        // // print_r($province);
        $data = [
            'title' => 'Checkout - Novyantoryshop',
        ];
        // dd($data);

        return view('users/checkoutt', $data);
    }
}
