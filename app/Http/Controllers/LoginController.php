<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use function Symfony\Component\String\s;

class LoginController extends Controller
{
    //
    public function index(){
        if (!session("username")) {
            return view("login");
        }
        return Redirect()->route("dashboard.index");
    }

    public function proses(Request $request){
        $username = $request->username;
        $password = $request->password;
        
        if($username == "admin" && $password == "1234"){
            //jika berhasil
            session([
                "username" => $username,
                "role" => "Dosen"
            ]);
            return Redirect()->route("dashboard.index");
        }
        return back()->with("error", "Username atau password salah!");
    }
}
