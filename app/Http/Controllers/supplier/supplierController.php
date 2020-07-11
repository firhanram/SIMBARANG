<?php

namespace App\Http\Controllers\supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class supplierController extends Controller
{
    public function getSuppliers(){
        $suppliers = DB::table('m_supplier')->get();

        return $suppliers;
    }

    public function getSupplier($id){
        $supplier = DB::table('m_supplier')->where('kd_supplier',$id)->get();

        return $supplier;
    }

    public function createSupplier(Request $request){
        $request->validate([
            'nm_supplier' => 'required'
        ]);

        try {
            DB::table('m_supplier')
                ->insert([
                    'nm_supplier' => $request->nm_supplier,
                    'alamat_supplier' => $request->alamat,
                    'no_telp_supplier' => $request->no_telp 
                ]);

            return redirect('/supplier')->with('success','Data Supplier Berhasil Disimpan!'); 
        } catch (\Exception $e) {
            return back()->with('error','Data Supplier Gagal Disimpan!');
        }
    }

    public function updateSupplier(Request $request){
        $request->validate([
            'nm_supplier' => 'required'
        ]); 

        try {
            DB::table('m_supplier')->where('kd_supplier',$request->kd_supplier)
                ->update([
                    'nm_supplier' => $request->nm_supplier,
                    'alamat_supplier' => $request->alamat,
                    'no_telp_supplier' => $request->no_telp
                ]);
            
            return redirect('/supplier')->with('success','Data Supplier Berhasil Diupdate!');
        } catch (\Exception $e) {
            return back()->with('error','Data Supplier Gagal Diupdate!');
        }
    }

    public function deleteSupplier($id){
        try {
            DB::table('m_supplier')->where('kd_supplier',$id)->delete();

            return back()->with('success','Data Supplier Berhasil Dihapus!');
        } catch (\Exception $e) {
            return back()->with('error','Data Supplier Gagal Dihapus!');
        }
    }
}
