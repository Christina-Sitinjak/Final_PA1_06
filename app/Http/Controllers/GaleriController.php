<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource. (Admin)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galeris = Galeri::all(); // Ambil semua data Galeri
        return view('admin.galeri.index', compact('galeris')); // Kirim data ke view admin
    }

    /**
     * Show the form for creating a new resource. (Admin)
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.galeri.create'); // Tampilkan form untuk membuat Galeri baru
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
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        // Simpan gambar
        $gambarName = time().'.'.$request->gambar->extension();
        $request->gambar->storeAs('public/galeri', $gambarName);

        // Buat Galeri baru
        Galeri::create([
            'gambar' => $gambarName,
            'deskripsi' => $request->deskripsi,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    /**
     * Display the specified resource. (Admin)
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function show(Galeri $galeri)
    {
        return view('admin.galeri.show', compact('galeri')); // Tampilkan detail galeri untuk admin
    }

    /**
     * Show the form for editing the specified resource. (Admin)
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri')); // Tampilkan form untuk mengedit galeri
    }

    /**
     * Update the specified resource in storage. (Admin)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galeri $galeri)
    {
        // Validasi data
        $request->validate([
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            Storage::delete('public/galeri/' . $galeri->gambar);

            // Simpan gambar baru
            $gambarName = time().'.'.$request->gambar->extension();
            $request->gambar->storeAs('public/galeri', $gambarName);
            $galeri->gambar = $gambarName;
        }

        // Update data galeri
        $galeri->deskripsi = $request->deskripsi;
        $galeri->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage. (Admin)
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galeri $galeri)
    {
        // Hapus gambar dari storage
        Storage::delete('public/galeri/' . $galeri->gambar);

        // Hapus data galeri
        $galeri->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }


    /**
     * Display the specified resource for public viewing. (Public)
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function showPublic()
    {
        $galeris = Galeri::all(); // Ambil semua data Galeri
        return view('Galeri.index', compact('galeris')); //  Tampilkan detail Galeri untuk publik
    }
}
