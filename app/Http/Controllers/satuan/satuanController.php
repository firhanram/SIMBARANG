<?php

namespace App\Http\Controllers\satuan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class satuanController extends Controller
{
    public function getUnits(){
        $units = DB::table('m_satuan')->get();

        return $units;
    }

    public function getUnit($id){
        $unit = DB::table('m_satuan')
                        ->where('kd_satuan',$id)
                        ->get();
        return $unit;
    }

    public function createUnit(Request $request){
        $request->validate([
            'satuan' => 'required'
        ]);

        try {

            DB::table('m_satuan')
                ->insert([
                    'nm_satuan' => $request->satuan
                ]);
            
            return redirect('/satuan')->with('success','Data Satuan Berhasil DIsimpan!');
        } catch (\Exception $e) {
            return back()->with('error','Data Satuan Gagal Disimpan!');
        }
    }

    public function updateUnit(Request $request){
        $request->validate([
            'satuan' => 'required'
        ]);

        try {
            DB::table('m_satuan')->where('kd_satuan',$request->kd_satuan)
                ->update([
                    'nm_satuan' => $request->satuan
                ]);
            return redirect('/satuan')->with('success','Data Satuan Berhasil Diupdate!');
        } catch (\Exception $e) {
            return back()->with('error','Data Satuan Gagal Diupdate!');
        }
    }

    public function deleteUnit($id) {
        try {
            DB::table('m_satuan')->where('kd_satuan',$id)->delete();

            return back()->with('success','Data Satuan Berhasil Dihapus!');
        } catch (\Exception $e) {
            return back()->with('error','Data Satuan Gagal Dihapus!');
        }
    }
}
