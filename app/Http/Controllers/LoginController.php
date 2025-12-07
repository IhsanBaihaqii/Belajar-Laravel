<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Symfony\Component\String\s;

class LoginController extends Controller
{
    //
    public function index(){
        if (!session("username")) {
            return redirect()->route("login.index");
        }
        return "Anda sudah login sebagai ".session("username");
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
            return "Berhasil login!";
        }
        return back()->with("error", "Username atau password salah!");
    }
}
