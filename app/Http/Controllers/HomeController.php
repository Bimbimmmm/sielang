<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class HomeController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(Request $request)
  {
    if ($request->user()->role->name == "Administrator"){
         Alert::success('Selamat Datang', 'Anda Berhasil Login Sebagai Admin');
         return redirect()->route('administrator');
    }

    else if ($request->user()->role->name == "Guru"){
         Alert::success('Selamat Datang', 'Anda Berhasil Login Sebagai Guru');
         return redirect()->route('teacher');
    }

    else if ($request->user()->role->name == "Kepala Sekolah"){
         Alert::success('Selamat Datang', 'Anda Berhasil Login Sebagai Kepala Sekolah');
         return redirect()->route('principal');
    }

    else if ($request->user()->role->name == "Pelajar"){
         Alert::success('Selamat Datang', 'Anda Berhasil Login Sebagai Peserta Didik');
         return redirect()->route('student');
    }

    else if ($request->user()->role->name == "Operator Sekolah"){
         Alert::success('Selamat Datang', 'Anda Berhasil Login Sebagai Operator Sekolah');
         return redirect()->route('operator');
    }

    else if ($request->user()->role->name == "Eksekutif"){
         Alert::success('Selamat Datang', 'Anda Berhasil Login Sebagai Eksekutif');
         return redirect()->route('executive');
    }

    else if($request->user()->id == null){
      return redirect()->route('login');
    }

  }
}
