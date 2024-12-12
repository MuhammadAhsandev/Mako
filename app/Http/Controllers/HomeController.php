<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\Pelanggaran;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function guruDashboard(){
        $prestasis = Prestasi::with('siswa')->get(); // Ambil data prestasi beserta relasi siswa
        $pelanggarans = Pelanggaran::with('siswa')->get();
        $siswas = Siswa::all(); // Ambil daftar siswa
        return view('guru.dashboard', compact('prestasis', 'pelanggarans', 'siswas'));
    }
    public function orangtuaDashboard(){
        return view('orangtua.dashboard');
    }

    public function siswaDashboard(){
        $siswas = Auth::user()->userType == 'siswa';
        return view('siswa.dashboard', compact('siswas'));
    }

    public function walikelasDashboard(){
        return view('waliKelas.dashboard');
    }
}
