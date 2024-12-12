<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasis = Prestasi::with('siswa')->get(); // Ambil data prestasi beserta relasi siswa
        $siswas = Siswa::all(); // Ambil daftar siswa
        return view('guru.prestasi.index', compact('prestasis', 'siswas'));
    }

    public function create()
    {
        $siswas = Siswa::all(); // Ambil daftar siswa
        return view('guru.prestasi.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'nama_prestasi' => 'required|string|max:255',
            'lv_prestasi' => 'required|string|max:255',
            'tanggal_prestasi' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'input_data' => 'required|string|max:255',
        ]);

        Prestasi::create($request->all());

        return redirect()->route('guru.prestasi')->with('success', 'Prestasi berhasil ditambahkan!');
    }
}
