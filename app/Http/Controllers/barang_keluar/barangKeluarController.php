<?php

namespace App\Http\Controllers\barang_keluar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class barangKeluarController extends Controller
{
    public function updateStock(Request $request){
        DB::table('t_barang')
            ->where('kd_barang',$request->kd_barang)
            ->update([
                'stok_barang' => DB::raw('stok_barang - '.$request->qty) 
            ]);
    }

    public function addBarangKeluar(Request $request){
        date_default_timezone_set('Asia/Jakarta');

        $rules = [
            'tanggal_keluar' => 'required',
            'kd_barang' => 'required'
        ];

        $messages = [
            'required' => 'Tidak Boleh Kosong!'
        ];

        $this->validate($request, $rules, $messages);

        if($request->qty > $request->stok_awal){
            return back()->with('error','Jumlah Melebihi Stok Awal!');
        } else if($request->stok_awal == 0){
            return back()->with('error','Stok Barang Sudah Habis!');
        }

        try {
            $query = DB::table('t_barang_keluar')
                            ->insert([
                                'kd_barang' => $request->kd_barang,
                                'tanggal_keluar' => $request->tanggal_keluar,
                                'jumlah_barang_keluar' => (int)$request->qty,
                                'keterangan_barang_keluar' => $request->keterangan,
                            ]);
            if($query){
                $this->updateStock($request);
                return redirect('/barang_keluar')->with('success','Data Barang Keluar Berhasil Disimpan!');
            } else {
                throw new Exception();
            }
        } catch (\Exception $e) {
            return back()->with('error','Data Barang Keluar Gagal Disimpan!');
        }
    }

    public function getAllBarangKeluar(){
        $data = DB::table('t_barang_keluar')
                    ->join('t_barang','t_barang.kd_barang','=','t_barang_keluar.kd_barang')
                    ->get();
        return $data;
    }

    public function chartBulanan(){
        $label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        for ($bulan=1; $bulan<=12 ; $bulan++) {
            $data[] = DB::table('t_barang_keluar')->whereMonth('tanggal_keluar', $bulan)->count();
        }

        $monthly = [
            'data' => $data,
            'bulan' => $label
        ];

        return response()->json($monthly);
    }

    public function lapBarangKeluar(Request $request){
        $bulan = date('F',strtotime($request->bulan));
        $data = DB::table('t_barang_keluar')
                    ->join('t_barang','t_barang_keluar.kd_barang','=','t_barang.kd_barang')
                    ->where(DB::raw('DATE_FORMAT(t_barang_keluar.tanggal_keluar, "%M")'), $bulan);
        return $data;
    }

    public function totalBarangKeluar(Request $request){
        $bulan = date('F',strtotime($request->bulan));
        $data = DB::table('t_barang_keluar')
                    ->join('t_barang','t_barang_keluar.kd_barang','=','t_barang.kd_barang')
                    ->where(DB::raw('DATE_FORMAT(t_barang_keluar.tanggal_keluar, "%M")'), $bulan)
                    ->count();
        return $data;
    }

    public function cetakBarangKeluar(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->lapBarangKeluar($request);
        $bulan = $request->bulan;
        $total = $this->totalBarangKeluar($request);

        if($data->count() > 0 ){
            $data = $data->get();

            $pdf = PDF::loadview('admin.barang_keluar.lap_barang_keluar',[
                'data' => $data,
                'bulan' => $bulan,
                'total' => $total
            ])
            ->setPaper('a4','landscape')
            ->setWarnings(false);
    
            return $pdf->download('barang_keluar_bulan_'.strtolower($bulan));
        } else {
            return back()->with('error','Data Tidak Ada!');
        }
    }
}
