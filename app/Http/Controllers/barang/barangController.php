<?php

namespace App\Http\Controllers\barang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class barangController extends Controller
{
    public function autoNumber(){
        $kdBarang = DB::table('t_barang')
                        ->select(DB::raw('MAX(RIGHT(kd_barang, 9)) as maxKode'));
        
        if($kdBarang->count() > 0){
            foreach($kdBarang->get() as $row){
                $noUrut = (int) substr($row->maxKode,3, 6);
                $noUrut++;
                $kodeBaru = "BRG".sprintf("%05s", $noUrut);
            }
        } else {
            $kodeBaru = "BRG00001";
        }

        return $kodeBaru;
    }

    public function getItems(){
        $items = DB::table('t_barang')
                     ->join('m_kategori','t_barang.kd_kategori','=','m_kategori.kd_kategori')
                     ->leftJoin('m_satuan','t_barang.kd_satuan','=','m_satuan.kd_satuan')
                     ->leftJoin('m_jenis','t_barang.kd_jenis','=','m_jenis.kd_jenis')
                     ->get();
        return $items;
    }

    public function getItem($id){
        $item = DB::table('t_barang')
                    ->join('m_kategori','t_barang.kd_kategori','=','m_kategori.kd_kategori')
                    ->join('m_satuan','t_barang.kd_satuan','=','m_satuan.kd_satuan')
                    ->join('m_jenis','t_barang.kd_jenis','=','m_jenis.kd_jenis')
                    ->where('t_barang.kd_barang',$id)
                    ->get();
        return $item;
    }

    public function createItem(Request $request) {
        $request->validate([
            'kd_barang' => 'required',
            'nm_barang' => 'required'
        ]);

        try {
            DB::table('t_barang')->insert([
                'kd_barang' => $request->kd_barang,
                'nm_barang' => $request->nm_barang,
                'kd_jenis' => $request->jenis,
                'kd_kategori' => $request->kategori,
                'kd_satuan' => $request->satuan,
                'harga_barang' => (int) $request->harga_barang,
                'stok_barang' => (int) $request->stok_barang
            ]);

            return redirect('/barang')->with('success','Data Barang Berhasil Disimpan!');
        } catch (\Exception $e) {
            return back()->with('error','Data Barang Gagal Disimpan!');
        }
    }

    public function updateItem(Request $request){
        $request->validate([
            'kd_barang' => 'required',
            'nm_barang' => 'required'
        ]);

        try {
            DB::table('t_barang')->where('kd_barang',$request->kd_barang)
                ->update([
                    'nm_barang' => $request->nm_barang,
                    'kd_jenis' => $request->jenis,
                    'kd_kategori' => $request->kategori,
                    'kd_satuan' => $request->satuan,
                    'harga_barang' => (int) $request->harga_barang,
                    'stok_barang' => (int) $request->stok_barang
                ]);
            
            return redirect('/barang')->with('success','Data Barang Berhasil Diupdate!');
        } catch (\Exception $e) {
            return back()->with('error','Data Barang Gagal Diupdate!');
        }
    }

    public function deleteItem($id){
        try {
            DB::table('t_barang')->where('kd_barang',$id)->delete();

            return back()->with('success','Data Barang Berhasil Dihapus!');
        } catch (\Exception $e) {
            return back()->with('error','Data Barang Gagal Dihapus!');
        }
    }

    public function totalItem(){
        $totalItem = DB::table('t_barang')->count();
        return $totalItem;
    }
}
