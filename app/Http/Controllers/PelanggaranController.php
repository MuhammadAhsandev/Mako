<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggaran;
use App\Models\Siswa; 

class PelanggaranController extends Controller
{
    public function index()
    {
        $pelanggarans = Pelanggaran::with('siswa')->get(); // Input pelanggaran siswa
        $siswas = Siswa::all(); // Ambil daftar siswa
        return view('guru.pelanggaran.index', compact('pelanggarans', 'siswas'));
    }

    public function create()
    {
        $siswas = Siswa::all(); // Ambil daftar siswa
        return view('guru.pelanggaran.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'pelanggaran' => 'required|string|max:255',
            'point' => 'nullable|integer|max:255',
            'tanggal_melanggar' => 'required|date',
            'kategori' => 'required|string|max:255',
            'input_data' => 'required|string|max:255',
        ]);

        Pelanggaran::create($request->all());

        return redirect()->route('guru.pelanggaran')->with('success', 'Pelanggran berhasil ditambahkan!');
    }
}
