<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index(){
        if (session("username")) {
            return view("dashboard");
        }
        return back()->with("error", "Silahkan login terlebih dahulu");
    }
}
