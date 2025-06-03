<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;
use App\Models\User; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // Tambahkan ini

class PengajarController extends Controller
{
    /**
     * Display a listing of the resource. (Admin)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajars = Pengajar::paginate(7); // Ambil semua data pengajar
        return view('admin.pengajar.index', compact('pengajars')); // Kirim data ke view admin
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
        return view('admin.pengajar.create', compact('users')); // Tampilkan form untuk membuat pengajar baru (admin) dan kirim data users
    }

    /**
     * Store a newly created resource in storage. (Admin)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = User::find($value);
                    if (!$user || $user->role?->nama_role !== 'admin') {
                        $fail('The selected user is not an admin.');
                    }
                },
            ],
            'nama_pengajar' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20', // Sesuaikan panjang max jika perlu
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        $data = $request->all();

        $data['user_id'] = auth()->id();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('pengajars', 'public');
            $data['gambar'] = $gambar;
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
        // Ambil daftar user dengan role admin
        $users = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'admin');
        })->get();
        return view('admin.pengajar.edit', compact('pengajar', 'users')); // Tampilkan form untuk mengedit pengajar (admin) dan kirim data users
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
        $validator = Validator::make($request->all(), [
            'user_id' => [
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = User::find($value);
                    if (!$user || $user->role?->nama_role !== 'admin') {
                        $fail('The selected user is not an admin.');
                    }
                },
            ],
            'nama_pengajar' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20', // Sesuaikan panjang max jika perlu
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        $data = $request->except('user_id');

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($pengajar->gambar && Storage::exists('public/pengajars/' . $pengajar->gambar)) {
                Storage::delete('public/pengajars/' . $pengajar->gambar);
            }

            $gambar = $request->file('gambar')->store('pengajars', 'public');
            $data['gambar'] = $gambar;
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
        if ($pengajar->gambar && Storage::exists('public/pengajars/' . $pengajar->gambar)) {
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
        return view('Pengajar.index', compact('pengajars')); // Tampilkan detail Pengajar untuk publik
    }
}
