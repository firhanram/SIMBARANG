<?php

namespace App\Http\Controllers\jenis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class jenisController extends Controller
{
    public function getTypes(){
        $types = DB::table('m_jenis')->get();

        return $types;
    }

    public function getType($id){
        $type = DB::table('m_jenis')
                        ->where('kd_jenis',$id)
                        ->get();
        return $type;
    }

    public function createType(Request $request){
        $request->validate([
            'jenis' => 'required'
        ]);

        try {

            DB::table('m_jenis')
                ->insert([
                    'nm_jenis' => $request->jenis
                ]);
            
            return redirect('/jenis')->with('success','Data Jenis Berhasil Disimpan!');
        } catch (\Exception $e) {
            return back()->with('error','Data Jenis Gagal Disimpan!');
        }
    }

    public function updateType(Request $request){
        $request->validate([
            'jenis' => 'required'
        ]);

        try {
            DB::table('m_jenis')->where('kd_jenis',$request->kd_jenis)
                ->update([
                    'nm_jenis' => $request->jenis
                ]);
            return redirect('/jenis')->with('success','Data Jenis Berhasil Diupdate!');
        } catch (\Exception $e) {
            return back()->with('error','Data Jenis Gagal Diupdate!');
        }
    }

    public function deleteType($id) {
        try {
            DB::table('m_jenis')->where('kd_jenis',$id)->delete();

            return back()->with('success','Data Jenis Berhasil Dihapus!');
        } catch (\Exception $e) {
            return back()->with('error','Data Jenis Gagal Dihapus!');
        }
    }
}
