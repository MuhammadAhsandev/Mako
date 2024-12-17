<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\Pelanggaran;
use App\models\waliKelas;
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

    public function siswaDashboard()
    {
        $user = Auth::user();
    
        // Ambil siswa beserta relasi prestasi dan pelanggaran
        $siswa = Siswa::with(['prestasi', 'pelanggaran'])->where('user_id', $user->id)->first();
    
        // Jika siswa tidak ditemukan
        if (!$siswa) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }
        
        $totalPoin = $siswa->pelanggaran->sum('point');
        // Kirim data ke view
        return view('siswa.dashboard', [
            'prestasis' => $siswa->prestasi,
            'pelanggarans' => $siswa->pelanggaran,
            'totalPoin' => $totalPoin,
        ]);
    }
    
}
