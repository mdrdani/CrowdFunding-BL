<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class TestController extends Controller
{
    //
    public function admin(){
        // dd(FacadesAuth::user());
        return "Berhasil Masuk";
    }

    public function ver_email(){
        return "Berhasil Masuk Verifikasi email";
    }
}