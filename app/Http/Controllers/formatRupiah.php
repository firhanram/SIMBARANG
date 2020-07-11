<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class formatRupiah extends Controller
{
    public function formatRupiah($harga){
        $rupiah = "Rp ".number_format($harga,0,",",".");
        return $rupiah;
    }
}
