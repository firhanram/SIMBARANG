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

Route::get('/', function () {
    return view('admin.login');
});

Route::get('/login', 'pages\pagesController@loginPage');
Route::post('/user_login','login\loginController@login')->name('login');
Route::get('/logout', 'login\loginController@logout')->name('logout');
Route::get('/test','barang_masuk\barangMasukController@chartBulanan')->name('test');

Route::group(['middleware' => ['checkLogin','isAdmin']], function(){
    Route::get('/dashboard','pages\pagesController@dashboardPage');
    Route::get('/user','pages\pagesController@userPage');
    Route::get('/user/tambah_user','pages\pagesController@tambahUserPage');
    Route::post('/user/tambah_user/add','user\userController@createUser');
    Route::get('/user/edit_user/{id}','pages\pagesController@editUserPage');
    Route::post('/user/edit_user/update','user\userController@updateUser');
    Route::get('/user/delete_user/{id}','user\userController@deleteUser');
    Route::get('/kategori','pages\pagesController@kategoriPage');
    Route::get('/kategori/edit_kategori/{id}','pages\pagesController@editKategoriPage');
    Route::get('/kategori/tambah_kategori','pages\pagesController@tambahKategoriPage');
    Route::post('/kategori/tambah_kategori/add','kategori\kategoriController@createCategory');
    Route::post('/kategori/edit_kategori/update','kategori\kategoriController@updateCategory');
    Route::get('/kategori/delete_kategori/{id}','kategori\kategoriController@deleteCategory');
    Route::get('/jenis','pages\pagesController@jenisPage');
    Route::get('/jenis/edit_jenis/{id}','pages\pagesController@editJenisPage');
    Route::get('/jenis/tambah_jenis','pages\pagesController@tambahJenisPage');
    Route::post('/jenis/tambah_jenis/add','jenis\jenisController@createType');
    Route::post('/jenis/edit_jenis/update','jenis\jenisController@updateType');
    Route::get('/jenis/delete_jenis/{id}','jenis\jenisController@deleteType');
    Route::get('/satuan','pages\pagesController@satuanPage');
    Route::get('/satuan/edit_satuan/{id}','pages\pagesController@editSatuanPage');
    Route::get('/satuan/tambah_satuan','pages\pagesController@tambahSatuanPage');
    Route::post('/satuan/tambah_satuan/add','satuan\satuanController@createUnit');
    Route::post('/satuan/edit_satuan/update','satuan\satuanController@updateUnit');
    Route::get('/satuan/delete_satuan/{id}','satuan\satuanController@deleteUnit');
    Route::get('/supplier','pages\pagesController@supplierPage');
    Route::get('/supplier/tambah_supplier','pages\pagesController@tambahSupplierPage');
    Route::get('/supplier/edit_supplier/{id}','pages\pagesController@editSupplierPage');
    Route::post('/supplier/tambah_supplier/add','supplier\supplierController@createSupplier');
    Route::post('/supplier/edit_supplier/update','supplier\supplierController@updateSupplier');
    Route::get('/supplier/delete_supplier/{id}','supplier\supplierController@deleteSupplier');
    Route::get('/barang','pages\pagesController@barangPage');
    Route::get('/barang/tambah_barang','pages\pagesController@tambahBarangPage');
    Route::get('/barang/edit_barang/{id}','pages\pagesController@editBarangPage');
    Route::post('/barang/tambah_barang/add','barang\barangController@createItem');
    Route::post('/barang/edit_barang/update','barang\barangController@updateItem');
    Route::get('/barang/delete_barang/{id}','barang\barangController@deleteItem');
    Route::get('/barang_masuk','pages\pagesController@barangMasukPage');
    Route::get('/barang_masuk/tambah_barang_masuk','pages\pagesController@tambahBarangMasukPage');
    Route::post('/barang_masuk/tambah_barang_masuk/add','barang_masuk\barangMasukController@addBarangMasuk');
    Route::get('/barang_keluar','pages\pagesController@barangKeluarPage');
    Route::get('/barang_keluar/tambah_barang_keluar','pages\pagesController@tambahBarangKeluarPage');
    Route::post('/barang_keluar/tambah_barang_keluar/add','barang_keluar\barangKeluarController@addBarangKeluar');

    // Chart
    Route::get('/chartBarangMasukBulanan','barang_masuk\barangMasukController@chartBulanan');
    Route::get('/chartBarangKeluarBulanan','barang_keluar\barangKeluarController@chartBulanan');

    // Laporan
    Route::get('/lap_barang_masuk','pages\pagesController@lapBarangMasukPage');
    Route::get('/lap_barang_keluar','pages\pagesController@lapBarangKeluarPage');
    Route::post('/lap_barang_masuk/cetak','barang_masuk\barangMasukController@cetakBarangMasuk');
    Route::post('/lap_barang_keluar/cetak','barang_keluar\barangKeluarController@cetakBarangKeluar');
});
