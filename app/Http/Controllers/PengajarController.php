<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import facade Storage

class PengajarController extends Controller
{
    /**
     * Display a listing of the resource. (Admin)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajars = Pengajar::all(); // Ambil semua data pengajar
        return view('admin.pengajar.index', compact('pengajars')); // Kirim data ke view admin
    }

    /**
     * Show the form for creating a new resource. (Admin)
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pengajar.create'); // Tampilkan form untuk membuat pengajar baru (admin)
    }

    /**
     * Store a newly created resource in storage. (Admin)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengajar' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20', // Sesuaikan panjang max jika perlu
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('public/pengajars', $nama_gambar); // Simpan gambar ke storage/app/public/pengajars

            $data['gambar'] = $nama_gambar; // Simpan nama file gambar ke database
        }

        Pengajar::create($data);

        return redirect()->route('admin.pengajar.index') // Redirect ke route admin
            ->with('success', 'Pengajar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource. (Admin)
     *
     * @param  \App\Models\Pengajar  $pengajar
     * @return \Illuminate\Http\Response
     */
    public function show(Pengajar $pengajar)
    {
        return view('admin.pengajar.show', compact('pengajar')); // Tampilkan detail pengajar (admin)
    }

    /**
     * Show the form for editing the specified resource. (Admin)
     *
     * @param  \App\Models\Pengajar  $pengajar
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengajar $pengajar)
    {
        return view('admin.pengajar.edit', compact('pengajar')); // Tampilkan form untuk mengedit pengajar (admin)
    }

    /**
     * Update the specified resource in storage. (Admin)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengajar  $pengajar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengajar $pengajar)
    {
        $request->validate([
            'nama_pengajar' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20', // Sesuaikan panjang max jika perlu
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($pengajar->gambar) {
                Storage::delete('public/pengajars/' . $pengajar->gambar);
            }

            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('public/pengajars', $nama_gambar);

            $data['gambar'] = $nama_gambar;
        }

        $pengajar->update($data);

        return redirect()->route('admin.pengajar.index') // Redirect ke route admin
            ->with('success', 'Pengajar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage. (Admin)
     *
     * @param  \App\Models\Pengajar  $pengajar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengajar $pengajar)
    {
        // Hapus gambar jika ada
        if ($pengajar->gambar) {
            Storage::delete('public/pengajars/' . $pengajar->gambar);
        }

        $pengajar->delete();

        return redirect()->route('admin.pengajar.index') // Redirect ke route admin
            ->with('success', 'Pengajar berhasil dihapus.');
    }

    /**
     * Display the specified resource for public viewing. (Public)
     *
     * @param  \App\Models\Pengajar  $Pengajar
     * @return \Illuminate\Http\Response
     */
    public function showPublic(Pengajar $Pengajar)
    {
        $pengajars = Pengajar::all(); // Ambil semua data pengajar
        return view('Pengajar.index', compact('pengajars')); // Tampilkan detail Pengajar untuk publik
    }
}
