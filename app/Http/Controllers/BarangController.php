<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    //
    public function index(){
        $barang = Barang::where('harga', '>', 1000)->get();
        dd($barang);
    }
}
