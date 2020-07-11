<?php

namespace App\Http\Controllers\barang_masuk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class barangMasukController extends Controller
{
    public function updateStock(Request $request){
        DB::table('t_barang')
            ->where('kd_barang',$request->kd_barang)
            ->update([
                'stok_barang' => DB::raw('stok_barang + '.$request->qty) 
            ]);
    }

    public function addBarangMasuk(Request $request){
        date_default_timezone_set('Asia/Jakarta');

        $rules = [
            'tanggal_masuk' => 'required',
            'kd_barang' => 'required'
        ];

        $messages = [
            'required' => 'Tidak Boleh Kosong!'
        ];

        $this->validate($request, $rules, $messages);

        try {
            $query = DB::table('t_barang_masuk')
                            ->insert([
                                'kd_barang' => $request->kd_barang,
                                'tanggal_masuk' => $request->tanggal_masuk,
                                'jumlah_barang_masuk' => (int)$request->qty,
                                'keterangan_barang_masuk' => $request->keterangan,
                                'kd_supplier' => $request->supplier
                            ]);
            if($query){
                $this->updateStock($request);
                return redirect('/barang_masuk')->with('success','Data Barang Masuk Berhasil Disimpan!');
            } else {
                throw new Exception();
            }
        } catch (\Exception $e) {
            return back()->with('error','Data Barang Masuk Gagal Disimpan!');
        }
    }

    public function getAllBarangMasuk(){
        $data = DB::table('t_barang_masuk')
                    ->join('t_barang','t_barang.kd_barang','=','t_barang_masuk.kd_barang')
                    ->leftJoin('m_supplier','t_barang_masuk.kd_supplier','=','t_barang_masuk.kd_supplier')
                    ->get();
        return $data;
    }

    public function chartBulanan(){
        $label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        for ($bulan=1; $bulan<=12 ; $bulan++) {
            $data[] = DB::table('t_barang_masuk')->whereMonth('tanggal_masuk', $bulan)->count();
        }

        $monthly = [
            'data' => $data,
            'bulan' => $label
        ];

        return response()->json($monthly);
    }

    public function lapBarangMasuk(Request $request){
        $bulan = date('F',strtotime($request->bulan));
        $data = DB::table('t_barang_masuk')
                    ->join('t_barang','t_barang_masuk.kd_barang','=','t_barang.kd_barang')
                    ->leftJoin('m_supplier','t_barang_masuk.kd_supplier','=','t_barang_masuk.kd_supplier')
                    ->where(DB::raw('DATE_FORMAT(t_barang_masuk.tanggal_masuk, "%M")'), $bulan);
        return $data;
    }
    public function totalBarangMasuk(Request $request){
        $bulan = date('F',strtotime($request->bulan));
        $data = DB::table('t_barang_masuk')
                    ->join('t_barang','t_barang_masuk.kd_barang','=','t_barang.kd_barang')
                    ->leftJoin('m_supplier','t_barang_masuk.kd_supplier','=','t_barang_masuk.kd_supplier')
                    ->where(DB::raw('DATE_FORMAT(t_barang_masuk.tanggal_masuk, "%M")'), $bulan)
                    ->count();
        return $data;
    }
    public function cetakBarangMasuk(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->lapBarangMasuk($request);
        $bulan = $request->bulan;
        $total = $this->totalBarangMasuk($request);

        if($data->count() > 0 ){
            $data = $data->get();

            $pdf = PDF::loadview('admin.barang_masuk.lap_barang_masuk',[
                'data' => $data,
                'bulan' => $bulan,
                'total' => $total
            ])
            ->setPaper('a4','landscape')
            ->setWarnings(false);
    
            return $pdf->download('barang_masuk_bulan_'.strtolower($bulan));
        } else {
            return back()->with('error','Data Tidak Ada!');
        }
    }
}
