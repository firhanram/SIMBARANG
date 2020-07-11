<?php

namespace App\Http\Controllers\kategori;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class kategoriController extends Controller
{
    public function getCategories(){
        $categories = DB::table('m_kategori')->get();

        return $categories;
    }

    public function getCategory($id){
        $category = DB::table('m_kategori')
                        ->where('kd_kategori',$id)
                        ->get();
        return $category;
    }

    public function createCategory(Request $request){
        $request->validate([
            'kategori' => 'required'
        ]);

        try {

            DB::table('m_kategori')
                ->insert([
                    'nm_kategori' => $request->kategori
                ]);
            
            return redirect('/kategori')->with('success','Data Kategori Berhasil Disimpan!');
        } catch (\Exception $th) {
            return back()->with('error','Data Kategori Gagal Disimpan!');
        }
    }

    public function updateCategory(Request $request){
        $request->validate([
            'kategori' => 'required'
        ]);

        try {
            DB::table('m_kategori')->where('kd_kategori',$request->kd_kategori)
                ->update([
                    'nm_kategori' => $request->kategori
                ]);
            return redirect('/kategori')->with('success','Data Kategori Berhasil Diupdate!');
        } catch (\Exception $e) {
            return back()->with('error','Data Kategori Gagal Diupdate!');
        }
    }

    public function deleteCategory($id) {
        try {
            DB::table('m_kategori')->where('kd_kategori',$id)->delete();

            return back()->with('success','Data Kategori Berhasil Dihapus!');
        } catch (\Exception $e) {
            return back()->with('error','Data Kategori Gagal Dihapus!');
        }
    }
}
