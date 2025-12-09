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
            // Check apakah ada sesi data_barang
            if (!session("data_barang")){
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
            }
            return view("dashboard", compact("list_barang"));
        }
        return back()->with("error", "Silahkan login terlebih dahulu");
    }

    // Larang akses get ke "dashboard/barang"
    public function denied(){
        return back();
    }
    
    // Check aksi
    public function aksi(Request $request){
        if ($request->add) {
            $this->tambahBarang($request);
        }
        return Redirect()->route("dashboard.index");
    }

    // Tambah Barang
    protected function tambahBarang(Request $request) {
        $data_barang = session("data_barang", []);
        // Check apakah barang sudah ada
        if ($data_barang[$request->kode_barang] ?? false) {
            $data_barang[$request->kode_barang]["jumlah"] += $request->jumlah;
        } else {
            $data_barang[$request->kode_barang] = [
                "nama" => $request->nama_barang,
                "harga" => $request->harga_barang,
                "jumlah" => $request->jumlah
            ];
        }
        session(["data_barang" => $data_barang]);
    }
}
