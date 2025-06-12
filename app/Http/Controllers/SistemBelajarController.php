<?php

namespace App\Http\Controllers;

use App\Models\SistemBelajar;
use App\Models\User; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Tambahkan ini
use Illuminate\Support\Facades\Storage; // Tambahkan jika Anda mengelola file

class SistemBelajarController extends Controller
{
    /**
     * Menampilkan daftar semua Sistem Belajar. (Admin)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sistemBelajars = SistemBelajar::latest()->paginate(10);
        return view('admin.sistem_belajar.index', compact('sistemBelajars'));
    }

    /**
     * Menampilkan form untuk membuat Sistem Belajar baru. (Admin)
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil daftar user dengan role admin (sesuaikan sesuai kebutuhan)
        $users = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'admin');
        })->get();

        return view('admin.sistem_belajar.create', compact('users')); // Kirim data $users ke view
    }

    /**
     * Menyimpan Sistem Belajar baru ke database. (Admin)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'ikon' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        $data['user_id'] = auth()->id();

        try {
            SistemBelajar::create($data);
            return redirect()->route('admin.sistem_belajar.index')
                             ->with('success', 'Sistem Belajar berhasil ditambahkan.');
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Menampilkan detail spesifik Sistem Belajar. (Admin)
     *
     * @param  \App\Models\SistemBelajar  $sistemBelajar
     * @return \Illuminate\Http\Response
     */
    public function show(SistemBelajar $sistemBelajar)
    {
        return view('admin.sistem_belajar.show', compact('sistemBelajar'));
    }

    /**
     * Menampilkan form untuk mengedit Sistem Belajar. (Admin)
     *
     * @param  \App\Models\SistemBelajar  $sistemBelajar
     * @return \Illuminate\Http\Response
     */
    public function edit(SistemBelajar $sistemBelajar)
    {
        $users = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'admin');
        })->get();

        return view('admin.sistem_belajar.edit', compact('sistemBelajar', 'users'));
    }

    /**
     * Memperbarui Sistem Belajar yang ada di database. (Admin)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SistemBelajar  $sistemBelajar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SistemBelajar $sistemBelajar)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'ikon' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except('user_id');

        try {
            $sistemBelajar->update($data);
            return redirect()->route('admin.sistem_belajar.index')
                             ->with('success', 'Sistem Belajar berhasil diperbarui.');
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    /**
     * Menghapus Sistem Belajar dari database. (Admin)
     *
     * @param  \App\Models\SistemBelajar  $sistemBelajar
     * @return \Illuminate\Http\Response
     */
    public function destroy(SistemBelajar $sistemBelajar)
    {
        try {
            // Hapus file terkait (jika ada)
            // if ($sistemBelajar->gambar && Storage::exists('public/sistem_belajar/' . $sistemBelajar->gambar)) {
            //     Storage::delete('public/sistem_belajar/' . $sistemBelajar->gambar);
            // }

            $sistemBelajar->delete();
            return redirect()->route('admin.sistem_belajar.index')
                             ->with('success', 'Sistem Belajar berhasil dihapus.');
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    /**
     * Menampilkan daftar semua Sistem Belajar untuk publik. (Public)
     *
     * @param  \App\Models\SistemBelajar  $sistemBelajar
     * @return \Illuminate\Http\Response
     */
    public function showPublic() // Menyesuaikan nama parameter
    {
        $sistemBelajars = SistemBelajar::all();
        return view('SistemBelajar.index', compact('sistemBelajars'));
    }
}
