<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource. (Admin)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::all(); // Ambil semua data Kelas
        return view('admin.kelas.index', compact('kelas')); // Kirim data ke view
    }

    /**
     * Show the form for creating a new resource. (Admin)
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kelas.create'); // Tampilkan form untuk membuat Kelas baru
    }

    /**
     * Store a newly created resource in storage. (Admin)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'masa_belajar' => 'required|integer|min:1',
            'harga_pendaftaran' => 'required|numeric|min:0',
            'harga_kursus' => 'required|numeric|min:0',
        ]);

        // Buat Kelas baru
        Kelas::create($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource. (Admin)
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        return view('Kelas.show', compact('kelas')); // Tampilkan detail kelas
    }

    /**
     * Show the form for editing the specified resource. (Admin)
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        return view('admin.kelas.edit', compact('kelas')); // Tampilkan form untuk mengedit kelas
    }

    /**
     * Update the specified resource in storage. (Admin)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        // Validasi data
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'masa_belajar' => 'required|integer|min:1',
            'harga_pendaftaran' => 'required|numeric|min:0',
            'harga_kursus' => 'required|numeric|min:0',
        ]);

        // Update data kelas
        $kelas->update($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage. (Admin)
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }

    /**
     * Display the specified resource for public viewing. (Public)
     *
     * @param  \App\Models\Kelas  $Kelas
     * @return \Illuminate\Http\Response
     */
    public function showPublic(Kelas $Kelas)
    {
        $kelas = Kelas::all();
        return view('Kelas.index', compact('kelas')); // Tampilkan detail Kelas untuk publik
    }
}
