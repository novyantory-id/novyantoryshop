<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Users\Home::index');
$routes->get('user/home/kategori/(:segment)', 'Users\Home::index/$1');
$routes->get('user/market', 'Users\Market::index');
$routes->get('user/market/kategori/(:segment)', 'Users\Market::index/$1');

$routes->get('user/product/(:segment)', 'Users\Produk::index/$1', ['filter' => 'usersFilter']);

//  login & logout
$routes->get('signin', 'Login::index', ['filter' => 'checkLoginRoleFilter']);

$routes->post('login', 'Login::login');
$routes->get('logout', 'Login::logout');

// Register
//  login & logout
$routes->get('register', 'Register::index', ['filter' => 'checkLoginRoleFilter']);
$routes->post('register/store', 'Register::store', ['filter' => 'checkLoginRoleFilter']);
$routes->get('akun/verifikasi', 'Register::verifikasi', ['filter' => 'checkLoginRoleFilter']);

// ----------------Role Admin--------------------------
// home
$routes->get('admin/home', 'Admin\Home::index', ['filter' => 'adminFilter']);

// brand
$routes->get('admin/brand', 'Admin\Brand::index', ['filter' => 'adminFilter']);
$routes->get('admin/brand/create', 'Admin\Brand::create', ['filter' => 'adminFilter']);
$routes->post('admin/brand/store', 'Admin\Brand::store', ['filter' => 'adminFilter']);
$routes->get('admin/brand/edit/(:segment)', 'Admin\Brand::edit/$1', ['filter' => 'adminFilter']);
$routes->post('admin/brand/update/(:segment)', 'Admin\Brand::update/$1', ['filter' => 'adminFilter']);
$routes->get('admin/brand/delete/(:segment)', 'Admin\Brand::delete/$1', ['filter' => 'adminFilter']);

// slides
$routes->get('admin/slides', 'Admin\Slides::index', ['filter' => 'adminFilter']);
$routes->get('admin/slides/create', 'Admin\Slides::create', ['filter' => 'adminFilter']);
$routes->post('admin/slides/store', 'Admin\Slides::store', ['filter' => 'adminFilter']);
$routes->get('admin/slides/edit/(:num)', 'Admin\Slides::edit/$1', ['filter' => 'adminFilter']);
$routes->post('admin/slides/update/(:num)', 'Admin\Slides::update/$1', ['filter' => 'adminFilter']);
$routes->get('admin/slides/delete/(:num)', 'Admin\Slides::delete/$1', ['filter' => 'adminFilter']);

// kupon
$routes->get('admin/kupon', 'Admin\Kupon::index', ['filter' => 'adminFilter']);
$routes->get('admin/kupon/create', 'Admin\Kupon::create', ['filter' => 'adminFilter']);
$routes->post('admin/kupon/store', 'Admin\Kupon::store', ['filter' => 'adminFilter']);
$routes->get('admin/kupon/edit/(:num)', 'Admin\Kupon::edit/$1', ['filter' => 'adminFilter']);
$routes->post('admin/kupon/update/(:num)', 'Admin\Kupon::update/$1', ['filter' => 'adminFilter']);
$routes->get('admin/kupon/delete/(:num)', 'Admin\Kupon::delete/$1', ['filter' => 'adminFilter']);

// kategori
$routes->get('admin/kategori', 'Admin\Kategori::kategori', ['filter' => 'adminFilter']);
$routes->post('admin/kategori/store-kategori', 'Admin\Kategori::storekategori', ['filter' => 'adminFilter']);
$routes->get('admin/kategori/edit-kategori/(:num)', 'Admin\Kategori::editkategori/$1', ['filter' => 'adminFilter']);
$routes->post('admin/kategori/update-kategori/(:num)', 'Admin\Kategori::updatekategori/$1', ['filter' => 'adminFilter']);

// sub kategori
$routes->get('admin/subkategori', 'Admin\Kategori::subkategori', ['filter' => 'adminFilter']);
$routes->post('admin/subkategori/store-subkategori', 'Admin\Kategori::storesubkategori', ['filter' => 'adminFilter']);
$routes->get('admin/subkategori/edit-subkategori/(:num)', 'Admin\Kategori::editsubkategori/$1', ['filter' => 'adminFilter']);
$routes->post('admin/subkategori/update-subkategori/(:num)', 'Admin\Kategori::updatesubkategori/$1', ['filter' => 'adminFilter']);

// sub-sub kategori
$routes->get('admin/subsubkategori', 'Admin\Kategori::subsubkategori', ['filter' => 'adminFilter']);
$routes->post('admin/subsubkategori/get-subkategori', 'Admin\Kategori::getSubkategori', ['filter' => 'adminFilter']);
$routes->post('admin/subsubkategori/store-subsubkategori', 'Admin\Kategori::storesubsubkategori', ['filter' => 'adminFilter']);
$routes->get('admin/subsubkategori/edit-subsubkategori/(:num)', 'Admin\Kategori::editsubsubkategori/$1', ['filter' => 'adminFilter']);
$routes->post('admin/subsubkategori/update-subsubkategori/(:num)', 'Admin\Kategori::updatesubsubkategori/$1', ['filter' => 'adminFilter']);
$routes->get('admin/subsubkategori/delete-subsubkategori/(:num)', 'Admin\Kategori::deletesubsubkategori/$1', ['filter' => 'adminFilter']);

//provinsi
$routes->get('admin/provinsi', 'Admin\Provinsi::provinsi', ['filter' => 'adminFilter']);
$routes->post('admin/provinsi/store-provinsi', 'Admin\Provinsi::storeprovinsi', ['filter' => 'adminFilter']);
$routes->get('admin/provinsi/edit-provinsi/(:num)', 'Admin\Provinsi::editprovinsi/$1', ['filter' => 'adminFilter']);
$routes->post('admin/provinsi/update-provinsi/(:num)', 'Admin\Provinsi::updateprovinsi/$1', ['filter' => 'adminFilter']);

//kabupaten
$routes->get('admin/kabupaten', 'Admin\Provinsi::kabupaten', ['filter' => 'adminFilter']);
$routes->post('admin/kabupaten/store-kabupaten', 'Admin\Provinsi::storekabupaten', ['filter' => 'adminFilter']);
$routes->get('admin/kabupaten/edit-kabupaten/(:num)', 'Admin\Provinsi::editkabupaten/$1', ['filter' => 'adminFilter']);
$routes->post('admin/kabupaten/update-kabupaten/(:num)', 'Admin\Provinsi::updatekabupaten/$1', ['filter' => 'adminFilter']);

//kecamatan
$routes->get('admin/kecamatan', 'Admin\Provinsi::kecamatan', ['filter' => 'adminFilter']);
$routes->post('admin/kecamatan/get-kabupaten', 'Admin\Provinsi::getKabupaten', ['filter' => 'adminFilter']);
$routes->post('admin/kecamatan/store-kecamatan', 'Admin\Provinsi::storekecamatan', ['filter' => 'adminFilter']);
$routes->get('admin/kecamatan/edit-kecamatan/(:num)', 'Admin\Provinsi::editkecamatan/$1', ['filter' => 'adminFilter']);
$routes->post('admin/kecamatan/update-kecamatan/(:num)', 'Admin\Provinsi::updatekecamatan/$1', ['filter' => 'adminFilter']);
$routes->get('admin/kecamatan/delete-kecamatan/(:num)', 'Admin\Provinsi::deletekecamatan/$1', ['filter' => 'adminFilter']);

//Customers
$routes->get('admin/customers', 'Admin\Customers::index', ['filter' => 'adminFilter']);

//Product
$routes->get('admin/product', 'Admin\Produk::index', ['filter' => 'adminFilter']);
$routes->post('admin/product/get-subkategori', 'Admin\Produk::getSubkategori', ['filter' => 'adminFilter']);
$routes->post('admin/product/get-subsubkategori', 'Admin\Produk::getSubsubkategori', ['filter' => 'adminFilter']);
$routes->get('admin/product/create', 'Admin\Produk::create', ['filter' => 'adminFilter']);
$routes->post('admin/product/store', 'Admin\Produk::store', ['filter' => 'adminFilter']);
$routes->get('admin/product/edit/(:num)', 'Admin\Produk::edit/$1', ['filter' => 'adminFilter']);
$routes->post('admin/product/update/(:num)', 'Admin\Produk::update/$1', ['filter' => 'adminFilter']);

// stok barang
$routes->get('admin/stock', 'Admin\Stok::index', ['filter' => 'adminFilter']);
$routes->get('admin/stock/getProdukData/(:num)', 'Admin\Stok::getProdukData/$1', ['filter' => 'adminFilter']);
$routes->get('admin/stock/create', 'Admin\Stok::create', ['filter' => 'adminFilter']);
$routes->post('admin/stock/store', 'Admin\Stok::store', ['filter' => 'adminFilter']);
$routes->get('admin/stock/edit/(:num)', 'Admin\Stok::edit/$1', ['filter' => 'adminFilter']);
$routes->post('admin/stock/update/(:num)', 'Admin\Stok::update/$1', ['filter' => 'adminFilter']);

// Order
$routes->get('admin/order/entry', 'Admin\Order::entry', ['filter' => 'adminFilter']);
$routes->get('admin/order/entry/(:segment)', 'Admin\Order::entryDetail/$1', ['filter' => 'adminFilter']);
$routes->post('admin/order/entry/status/(:segment)', 'Admin\Order::statusEntry/$1', ['filter' => 'adminFilter']);

$routes->get('admin/order/confirm', 'Admin\Order::confirm', ['filter' => 'adminFilter']);
$routes->get('admin/order/confirm/(:segment)', 'Admin\Order::confirmDetail/$1', ['filter' => 'adminFilter']);
$routes->post('admin/order/confirm/status/(:segment)', 'Admin\Order::statusConfirm/$1', ['filter' => 'adminFilter']);

$routes->get('admin/order/packing', 'Admin\Order::packing', ['filter' => 'adminFilter']);
$routes->get('admin/order/packing/(:segment)', 'Admin\Order::packingDetail/$1', ['filter' => 'adminFilter']);
$routes->post('admin/order/packing/status/(:segment)', 'Admin\Order::statusPacking/$1', ['filter' => 'adminFilter']);

$routes->get('admin/order/sending', 'Admin\Order::sending', ['filter' => 'adminFilter']);
$routes->get('admin/order/sending/(:segment)', 'Admin\Order::sendingDetail/$1', ['filter' => 'adminFilter']);
$routes->post('admin/order/sending/status/(:segment)', 'Admin\Order::statusSending/$1', ['filter' => 'adminFilter']);

$routes->get('admin/order/shipping', 'Admin\Order::shipping', ['filter' => 'adminFilter']);
$routes->get('admin/order/shipping/(:segment)', 'Admin\Order::shippingDetail/$1', ['filter' => 'adminFilter']);
$routes->post('admin/order/shipping/status/(:segment)', 'Admin\Order::statusShipping/$1', ['filter' => 'adminFilter']);

$routes->get('admin/order/finished', 'Admin\Order::finished', ['filter' => 'adminFilter']);
$routes->get('admin/order/finished/(:segment)', 'Admin\Order::finishedDetail/$1', ['filter' => 'adminFilter']);

// -------------------Users----------------------------

// Home
$routes->get('user/home', 'Users\Home::index', ['filter' => 'usersFilter']);

// Product
$routes->get('user/product/(:segment)', 'Users\Produk::index/$1', ['filter' => 'usersFilter']);

// Transaksi
$routes->post('user/belisekarang', 'Users\Order::beliSekarang', ['filter' => 'usersFilter']);
$routes->get('user/checkout/(:segment)', 'Users\Order::checkout/$1', ['filter' => 'usersFilter']);
$routes->get('user/checkoutt', 'Users\Order::checkoutt', ['filter' => 'usersFilter']);
$routes->post('get-cities', 'Users\Order::getCities', ['filter' => 'usersFilter']);
// $routes->post('get-subdistrict', 'Users\Order::getSubdistrict', ['filter' => 'usersFilter']);
$routes->post('user/get-cost', 'Users\Order::getCost', ['filter' => 'usersFilter']);
$routes->post('user/checkout/placeorder/(:segment)', 'Users\Order::placeOrder/$1', ['filter' => 'usersFilter']);

// Profile & Status Order
$routes->get('user/profile', 'Users\Profile::index', ['filter' => 'usersFilter']);
$routes->get('user/profile/edit', 'Users\Profile::edit', ['filter' => 'usersFilter']);
$routes->post('user/profile/update', 'Users\Profile::update', ['filter' => 'usersFilter']);
$routes->get('user/purchase', 'Users\Purchase::index', ['filter' => 'usersFilter']);
$routes->get('user/purchase/bayar/(:segment)', 'Users\Purchase::bayar/$1', ['filter' => 'usersFilter']);
$routes->get('user/purchase/packing/(:segment)', 'Users\Purchase::dikemas/$1', ['filter' => 'usersFilter']);
$routes->get('user/purchase/confirmed/(:segment)', 'Users\Purchase::dikonfirmasi/$1', ['filter' => 'usersFilter']);
$routes->get('user/purchase/sending/(:segment)', 'Users\Purchase::dikirim/$1', ['filter' => 'usersFilter']);
$routes->get('user/purchase/shipping/(:segment)', 'Users\Purchase::dalamperjalanan/$1', ['filter' => 'usersFilter']);
$routes->get('user/purchase/finished/(:segment)', 'Users\Purchase::selesai/$1', ['filter' => 'usersFilter']);
$routes->post('user/purchase/accept/(:segment)', 'Users\Purchase::acceptOrder/$1', ['filter' => 'usersFilter']);
