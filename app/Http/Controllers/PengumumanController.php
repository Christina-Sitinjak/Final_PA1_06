<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    /**
     * Menampilkan daftar semua pengumuman.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil semua data Pengumuman, urutkan dari yang terbaru, gunakan paginasi
        $pengumuman = Pengumuman::latest()->paginate(10);
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    /**
     * Menampilkan form untuk membuat pengumuman baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Tampilkan view 'pengumuman.create'
        return view('admin.pengumuman.create');
    }

    /**
     * Menyimpan pengumuman baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form
        $validatedData = $request->validate([
            'judul_pengumuman' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
        ]);

        // Buat Pengumuman baru menggunakan data yang sudah divalidasi
        Pengumuman::create($validatedData);

        // Redirect ke halaman index pengumuman dengan pesan sukses
        return redirect()->route('admin.pengumuman.index')
                         ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail spesifik pengumuman.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show(Pengumuman $pengumuman) // Menggunakan Route Model Binding
    {
        // Tampilkan view 'pengumuman.show' dengan data pengumuman yang dipilih
        return view('pengumuman.show', compact('pengumuman'));
    }

    /**
     * Menampilkan form untuk mengedit pengumuman.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengumuman $pengumuman) // Menggunakan Route Model Binding
    {
        // Tampilkan view 'pengumuman.edit' dengan data pengumuman yang akan diedit
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Memperbarui pengumuman yang ada di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengumuman $pengumuman) // Menggunakan Route Model Binding
    {
        // Validasi data yang masuk dari form edit
        $validatedData = $request->validate([
            'judul_pengumuman' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
        ]);

        // Update data pengumuman yang ada dengan data yang sudah divalidasi
        $pengumuman->update($validatedData);

        // Redirect ke halaman index pengumuman dengan pesan sukses
        return redirect()->route('admin.pengumuman.index')
                         ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Menghapus pengumuman dari database.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengumuman $pengumuman) // Menggunakan Route Model Binding
    {
        // Hapus data pengumuman
        $pengumuman->delete();

        // Redirect ke halaman index pengumuman dengan pesan sukses
        return redirect()->route('admin.pengumuman.index')
                         ->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function showPublic(Pengumuman $pengumuman) // Nama parameter $pengumuman sesuai model binding
    {
        $semua_pengumuman = Pengumuman::all(); // Ambil semua data pengumuman
        return view('Pengumuman.index', compact('semua_pengumuman')); // Tampilkan detail Pngumuman untuk publik
    }
}
