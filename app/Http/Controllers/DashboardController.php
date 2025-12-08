<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index(){
        if (session("username")) {
            // list barang
            $list_barang = [
                "BRG001" => [
                    "nama" => "Handuk",
                    "harga" => 4500,
                ],
                "BRG002" => [
                    "nama" => "Lampu",
                    "harga" => 3000,
                ],
                "BRG003" => [
                    "nama" => "Penggaris",
                    "harga" => 2500,
                ],
                "BRG004" => [
                    "nama" => "Pulpen",
                    "harga" => 1500,
                ],
            ];
            // data barang
            session([
                "data_barang" => [
                    "BRG001" => [
                        "nama" => "Handuk",
                        "harga" => 4500,
                        "jumlah" => 3
                    ],
                    "BRG002" => [
                        "nama" => "Lampu",
                        "harga" => 3000,
                        "jumlah" => 2
                    ],
                ]
            ]);
            return view("dashboard", compact("list_barang"));
        }
        return back()->with("error", "Silahkan login terlebih dahulu");
    }
}
