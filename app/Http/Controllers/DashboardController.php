<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index(){
        if (session("username")) {
            // data barang
            session([
                "data_barang" => [
                    "BRG001" => [
                        "nama" => "Handuk",
                        "harga" => 4500
                    ],
                    "BRG002" => [
                        "nama" => "Lampu",
                        "harga" => 3000
                    ],
                ]
            ]);
            return view("dashboard");
        }
        return back()->with("error", "Silahkan login terlebih dahulu");
    }
}
