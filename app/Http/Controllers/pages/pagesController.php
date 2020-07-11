<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\user\userController;
use App\Http\Controllers\kategori\kategoriController;
use App\Http\Controllers\jenis\jenisController;
use App\Http\Controllers\satuan\satuanController;
use App\Http\Controllers\supplier\supplierController;
use App\Http\Controllers\barang\barangController;
use App\Http\Controllers\formatRupiah;
use App\Http\Controllers\barang_masuk\barangMasukController;
use App\Http\Controllers\barang_keluar\barangKeluarController;

class pagesController extends Controller
{
    //Dashboard
    public function dashboardPage(){
        $item = new barangController;
        $user = new userController;

        return view('admin.dashboard',[
            'totalItem' => $item->totalItem(),
            'totalUser' => $user->totalUser()
        ]);
    }

    // Login
    public function loginPage(){
        return view('admin.login');
    }

    // User
    public function userPage(){
        $user = new userController; 

        return view('admin.user.user',[
            'users' => $user->getUsers()
        ]);
    }

    public function tambahUserPage(){
        $user = new userController; 
        
        return view('admin.user.tambah_user',[
            'role' => $user->getRole()
        ]);
    }

    public function editUserPage($id) {
        $user = new userController; 

        return view('admin.user.edit_user',[
            'role' => $user->getRole(),
            'user' => $user->getUser($id) 
        ]);
    }

    // Kategori
    public function kategoriPage(){
        $category = new kategoriController;

        return view('admin.kategori.kategori',[
            'categories' => $category->getCategories()
        ]);
    }

    public function tambahKategoriPage(){
        return view('admin.kategori.tambah_kategori');
    }

    public function editKategoriPage($id){
        $category = new kategoriController;

        return view('admin.kategori.edit_kategori',[
            'category' => $category->getCategory($id)
        ]);
    }

    // Jenis
    public function jenisPage(){
        $type = new jenisController;

        return view('admin.jenis.jenis',[
            'types' => $type->getTypes()
        ]);
    }

    public function tambahJenisPage(){
        return view('admin.jenis.tambah_jenis');
    }

    public function editJenisPage($id){
        $type = new jenisController;

        return view('admin.jenis.edit_jenis',[
            'type' => $type->getType($id)
        ]);
    }

    // Satuan
    public function satuanPage(){
        $unit = new satuanController;

        return view('admin.satuan.satuan',[
            'units' => $unit->getUnits()
        ]);
    }

    public function tambahSatuanPage(){
        return view('admin.satuan.tambah_satuan');
    }

    public function editSatuanPage($id){
        $unit = new satuanController;

        return view('admin.satuan.edit_satuan',[
            'unit' => $unit->getUnit($id)
        ]);
    }

    // Supplier
    public function supplierPage(){
        $supplier = new supplierController;

        return view('admin.supplier.supplier',[
            'suppliers' => $supplier->getSuppliers()
        ]);
    }

    public function tambahSupplierPage(){
        return view('admin.supplier.tambah_supplier');
    }

    public function editSupplierPage($id){
        $supplier = new supplierController;

        return view('admin.supplier.edit_supplier',[
            'supplier' => $supplier->getSupplier($id)
        ]);
    }

    // Barang
    public function barangPage(){
        $item = new barangController;
        $formatRupiah = new formatRupiah;

        return view('admin.barang.barang',[
            'items' => $item->getItems(),
            'formatRupiah' => $formatRupiah
        ]);
    }

    public function tambahBarangPage(){
        $item = new barangController;
        $category = new kategoriController;
        $type = new jenisController; 
        $unit = new satuanController;

        return view('admin.barang.tambah_barang',[
            'autoNumber' => $item->autoNumber(),
            'categories' => $category->getCategories(),
            'types' => $type->getTypes(),
            'units' => $unit->getUnits()
        ]);
    }

    public function editBarangPage($id){
        $item = new barangController;
        $category = new kategoriController;
        $type = new jenisController; 
        $unit = new satuanController;

        return view('admin.barang.edit_barang',[
            'item' => $item->getItem($id),
            'categories' => $category->getCategories(),
            'types' => $type->getTypes(),
            'units' => $unit->getUnits()
        ]);
    }

    // Barang Masuk
    public function barangMasukPage(){
        $barangMasuk = new barangMasukController;
        $formatRupiah = new formatRupiah;

        return view('admin.barang_masuk.barang_masuk',[
            'barangMasuk' => $barangMasuk->getAllBarangMasuk(),
            'formatRupiah' => $formatRupiah
        ]);
    }

    public function tambahBarangMasukPage(){
        $supplier = new supplierController;
        $item = new barangController;

        return view('admin.barang_masuk.tambah_barang_masuk',[
            'items' => $item->getItems(),
            'suppliers' => $supplier->getSuppliers() 
        ]);
    }

    // Barang Keluar
    public function barangKeluarPage(){
        $barangKeluar = new barangKeluarController;

        return view('admin.barang_keluar.barang_keluar',[
            'barangKeluar' => $barangKeluar->getAllBarangKeluar()
        ]);
    }

    public function tambahBarangKeluarPage(){
        $item = new barangController;

        return view('admin.barang_keluar.tambah_barang_keluar',[
            'items' => $item->getItems()
        ]);
    }

    //Laporan Barang Masuk
    public function lapBarangMasukPage(){
        return view('admin.laporan.lap_barang_masuk');
    }

    // Laporan Barang Keluar
    public function lapBarangKeluarPage(){
        return view('admin.laporan.lap_barang_keluar');
    }
}
