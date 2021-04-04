<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// admin
Route::get('admin/', 'Admin\AdminLoginController@getLogin')->middleware('guest');
Route::get('admin/login', 'Admin\AdminLoginController@getLogin')->middleware('guest')->name('admin.login');
Route::post('admin/login', 'Admin\AdminLoginController@postLogin');
Route::get('admin/logout', 'Admin\AdminLoginController@Logout')->name('admin.logout');
//
Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {
    //---DASHBOARD---//
    Route::get('/dashboard', 'Admin\AdminDashboardController@index')->name('admin.dashboard');
    Route::get('/dashboard/week', 'Admin\AdminDashboardController@lastweek')->name('admin.week');
    Route::get('/dashboard/month', 'Admin\AdminDashboardController@lastmonth')->name('admin.month');
    //---MASAKAN---//
    Route::resource('menu', 'Admin\AdminMenuController');
    //---MEJA---///
    Route::resource('meja', 'Admin\AdminMejaController');
    //------------------------------ USER ACCOUNT ------------------------------//
    //---OWNER-ACCOUNT---//
    Route::resource('owneraccount', 'Admin\ManajemenAccount\OwnerController');
    //---ADMIN-ACCOUNT---//
    Route::resource('adminaccount', 'Admin\ManajemenAccount\AdminController');
    //---PELANGGAN-ACCOUNT---//
    Route::resource('pelangganaccount', 'Admin\ManajemenAccount\PelangganController');
    //---KASIR-ACCOUNT---//
    route::resource('kasiraccount', 'Admin\ManajemenAccount\KasirController');
    //---WAITER-ACCOUNT---//
    route::resource('waiteraccount', 'Admin\ManajemenAccount\WaiterController');
    //---ORDER---//
    Route::get('/order', 'Admin\AdminOrderController@index')->name('adminorder.index');
    Route::get('/order/kategori/{kategori}', 'Admin\AdminOrderController@Kategori')->name('adminorder.kategori');
    Route::post('/order/prosses/order', 'Admin\AdminOrderController@Order')->name('adminorder.order');
    Route::get('/order/cart/{id_petugas}', 'Admin\AdminOrderController@OpenCart')->name('adminorder.cart');
    Route::post('/order/cart/delete/{id_petugas}/{kode_order}/{id_detail_order}', 'Admin\AdminOrderController@DeleteCartItem')->name('adminorder.destroy');
    Route::get('/order/prosses/reset/{id_petugas}', 'Admin\AdminOrderController@ResetCart')->name('adminorder.reset');
    Route::post('/order/cart/ubah', 'Admin\AdminOrderController@UbahJumlahPesan')->name('adminorder.ubah');
    Route::post('/order/cart/prosses', 'Admin\AdminOrderController@Prosses')->name('adminorder.prosses');
    //---ENTRI-ORDER---//
    Route::get('entriorder', 'Admin\AdminEntriOrderController@index')->name('adminentriorder.index');
    Route::get('entriorder/status/order', 'Admin\AdminEntriOrderController@StatusOrder')->name('adminadminentriorder.status.order');
    Route::get('entriorder/status/belumbayar', 'Admin\AdminEntriOrderController@StatusBelumbayar')->name('adminadminentriorder.status.belumbayar');
    Route::get('entriorder/cari', 'Admin\AdminEntriOrderController@cari')->name('adminadminentriorder.cari');
    Route::get('entriorder/detail/edit/{kode_order}', 'Admin\AdminEntriOrderController@detail')->name('adminadminentriorder.detail');
    Route::get('entriorder/detail/tambahmenu/{kode_order}', 'Admin\AdminEntriOrderController@ShowTambahMenu')->name('adminadminentriorder.tambahmenu');
    Route::post('entriorder/detail/tambahmenu/proses', 'Admin\AdminEntriOrderController@TambahMenu')->name('adminadminentriorder.tambahmenu.proses');
    Route::post('entriorder/detail/update', 'Admin\AdminEntriOrderController@update')->name('adminadminentriorder.update');
    Route::post('entriorder/detail/tambahmenu/tambahjumlah/proses', 'Admin\AdminEntriOrderController@TambahJumlah')->name('adminadminentriorder.tambahjml');
    Route::post('entriorder/detail/order/proses', 'Admin\AdminEntriOrderController@ProsesOrder')->name('adminadminentriorder.proses');
    Route::get('entriorder/destroy/{kodeorder}', 'Admin\AdminEntriOrderController@hapusdata')->name('adminadminentriorder.destroy');
    //---TRANSAKSI---//
    Route::get('/transaksi', 'Admin\AdminTransaksiController@order')->name('admin.transaksi');
    Route::post('/transaksi/kodeorder', 'Admin\AdminTransaksiController@CariKodeOrder')->name('admintransaksi.carikode');
    Route::post('/transaksi/bayar', 'Admin\AdminTransaksiController@Bayar')->name('admintransaksi.bayar');
    Route::post('/transaksi/bayar/report', 'Admin\AdminTransaksiController@CetakStruk')->name('admintransaksi.bayar.report');
    //---ENTRI-TRANSAKSI---//
    Route::get('/entritransaksi', 'Admin\AdminEntriTransaksiController@index')->name('adminentritransaksi.index');
    Route::get('/entritransaksi/{kodeorder}', 'Admin\AdminEntriTransaksiController@OpenPDF')->name('adminentritransaksi.view');
    Route::get('/entritransaksi/status/selesai', 'Admin\AdminEntriTransaksiController@StatusSelesai')->name('adminadminentritransaksi.status.selesai');
    Route::get('/entritransaksi/status/belumbayar', 'Admin\AdminEntriTransaksiController@StatusBelumbayar')->name('adminadminentritransaksi.status.belumbayar');
    Route::get('entritransaksi/cari', 'Admin\AdminEntriTransaksiController@cari')->name('adminadminentritransaksi.cari');
    //---LAPORAN---//
    Route::get('/laporan', 'Admin\AdminLaporanController@index')->name('adminlaporan.index');
    Route::get('/laporan/lastweek', 'Admin\AdminLaporanController@index')->name('adminlaporan.week');
    Route::get('/laporan/lastmonth', 'Admin\AdminLaporanController@index')->name('adminlaporan.month');
    Route::get('/laporan/lastyear', 'Admin\AdminLaporanController@index')->name('adminlaporan.year');
    Route::get('/laporan/lastweek/export', 'Admin\AdminLaporanController@weekexport')->name('adminlaporan.week.export');
    Route::get('/laporan/lastmonth/export', 'Admin\AdminLaporanController@monthexport')->name('adminlaporan.month.export');
    Route::get('/laporan/lastyear/export', 'Admin\AdminLaporanController@yearexport')->name('adminlaporan.year.export');
});
//end-admin

//pelanggan
Route::get('/', function () {
    return redirect('pelanggan/home');
});
Route::get('/t', function () {
    return view('pelanggan.test.index');
});
Route::get('pelanggan/', 'Pelanggan\PelangganLoginController@getLogin')->middleware('guest');
Route::get('pelanggan/login', 'Pelanggan\PelangganLoginController@getLogin')->middleware('guest')->name('pelanggan.login');
Route::post('pelanggan/login/qr', 'Pelanggan\PelangganLoginController@postLoginQr')->name('pelanggan.login.qr');
Route::post('pelanggan/login', 'Pelanggan\PelangganLoginController@postLogin');
Route::get('pelanggan/logout', 'Pelanggan\PelangganLoginController@Logout')->name('pelanggan.logout');
//home
Route::get('pelanggan/home', 'Pelanggan\PelangganHomeController@index')->name('home');
Route::get('pelanggan/daftar', 'Pelanggan\PelangganDaftarController@index')->name('pelanggan.daftar');
Route::post('pelanggan/daftar/prosses', 'Pelanggan\PelangganDaftarController@prosses')->name('pelanggan.daftar.prosses');
//makanan
Route::get('pelanggan/makanan', 'Pelanggan\PelangganMenuMakananController@index')->name('pelanggan.makanan');
Route::get('pelanggan/minuman', 'Pelanggan\PelangganMenuMinumanController@index')->name('pelanggan.minuman');
Route::get('pelanggan/dessert', 'Pelanggan\PelangganMenuDessertController@index')->name('pelanggan.dessert');
//order
Route::group(['prefix' => 'pelanggan', 'middleware' => ['auth:pelanggan']], function () {
    //order
    Route::post('/order/prosses/order', 'Pelanggan\PelangganOrderController@Order')->name('pelangganorder.order');
    Route::get('/order/cart/{id_pelanggan}', 'Pelanggan\PelangganOrderController@OpenCart')->name('pelangganorder.cart');
    Route::post('/order/cart/delete/{id_pelanggan}/{kode_order}/{id_detail_order}', 'Pelanggan\PelangganOrderController@DeleteCartItem')->name('pelangganorder.destroy');
    Route::get('/order/prosses/reset/{id_pelanggan}', 'Pelanggan\PelangganOrderController@ResetCart')->name('pelangganorder.reset');
    Route::post('/order/cart/ubah', 'Pelanggan\PelangganOrderController@UbahJumlahPesan')->name('pelangganorder.ubah');
    Route::post('/order/cart/prosses', 'Pelanggan\PelangganOrderController@Prosses')->name('pelangganorder.prosses');
    Route::get('/pengaturan', 'Pelanggan\PelangganPengaturanAkunController@index')->name('pelanggan.pengaturan');
    Route::post('/pengaturan/proses', 'Pelanggan\PelangganPengaturanAkunController@proses')->name('pelanggan.pengaturan.submit');
    Route::get('/pengaturan/generate/qrcode', 'Pelanggan\PelangganPengaturanAkunController@generate')->name('pelanggan.pengaturan.generate');
    Route::get('/pengaturan/Qrcodedownload', 'Pelanggan\PelangganPengaturanAkunController@QrDownload')->name('pelanggan.pengaturan.download');
});

//end-pelanggan
