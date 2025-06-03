<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // Tambahkan ini
use Illuminate\Support\Facades\Auth;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource. (Admin)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galeris = Galeri::paginate(8);  // Ambil semua data Galeri
        return view('admin.galeri.index', compact('galeris')); // Kirim data ke view admin
    }

    /**
     * Show the form for creating a new resource. (Admin)
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil daftar user dengan role admin
        $users = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'admin');
        })->get();
        return view('admin.galeri.create', compact('users')); // Kirim data ke view create
    }

    /**
     * Store a newly created resource in storage. (Admin)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data menggunakan Validator
        $validator = Validator::make($request->all(), [
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan gambar
        $gambarName = time().'.'.$request->gambar->extension();
        $request->gambar->storeAs('public/galeri', $gambarName);

        // Buat Galeri baru
        Galeri::create([
            'user_id' => auth()->id(),
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
        // Ambil daftar user dengan role admin
        $users = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'admin');
        })->get();
        return view('admin.galeri.edit', compact('galeri', 'users')); // Kirim data user ke view
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
        // Validasi data menggunakan Validator
        $validator = Validator::make($request->all(), [
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except('user_id');

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
        $galeri->update($data);

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
        return view('Galeri.index', compact('galeris')); //  Tampilkan detail Galeri untuk publik
    }
}
