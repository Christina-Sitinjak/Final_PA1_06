<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\User; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Tambahkan ini
use Illuminate\Support\Facades\Storage; // Tambahkan jika Anda mengelola file

class PengumumanController extends Controller
{
    /**
     * Menampilkan daftar semua pengumuman. (Admin)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengumumans = Pengumuman::latest()->paginate(10);
        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    /**
     * Menampilkan form untuk membuat pengumuman baru. (Admin)
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil daftar user dengan role admin
        $users = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'admin');
        })->get();

        return view('admin.pengumuman.create', compact('users')); // Kirim data $users ke view
    }

    /**
     * Menyimpan pengumuman baru ke database. (Admin)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_pengumuman' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        $data['user_id'] = auth()->id();

        try {
            Pengumuman::create($data);
            return redirect()->route('admin.pengumuman.index')
                             ->with('success', 'Pengumuman berhasil ditambahkan.');
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Menampilkan detail spesifik pengumuman. (Admin)
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.show', compact('pengumuman'));
    }

    /**
     * Menampilkan form untuk mengedit pengumuman. (Admin)
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengumuman $pengumuman)
    {
        $users = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'admin');
        })->get();

        return view('admin.pengumuman.edit', compact('pengumuman', 'users'));
    }

    /**
     * Memperbarui pengumuman yang ada di database. (Admin)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validator = Validator::make($request->all(), [
            'judul_pengumuman' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except('user_id');

        try {
            $pengumuman->update($data);
            return redirect()->route('admin.pengumuman.index')
                             ->with('success', 'Pengumuman berhasil diperbarui.');
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    /**
     * Menghapus pengumuman dari database. (Admin)
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengumuman $pengumuman)
    {
        try {
            // Hapus file terkait (jika ada)
            // if ($pengumuman->gambar && Storage::exists('public/pengumuman/' . $pengumuman->gambar)) {
            //     Storage::delete('public/pengumuman/' . $pengumuman->gambar);
            // }

            $pengumuman->delete();
            return redirect()->route('admin.pengumuman.index')
                             ->with('success', 'Pengumuman berhasil dihapus.');
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    /**
     * Menampilkan daftar semua pengumuman untuk publik. (Public)
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function showPublic() // Menyesuaikan nama parameter
    {
        $pengumumans = Pengumuman::all();
        return view('Pengumuman.index', compact('pengumumans'));
    }
}
