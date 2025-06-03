<?php

namespace App\Http\Controllers;

use App\Models\ProfilAlumni;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProfilAlumniController extends Controller
{
    /**
     * Display a listing of the resource. (Admin)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profilAlumnis = ProfilAlumni::paginate(5);
        return view('admin.profil_alumni.index', compact('profilAlumnis'));
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
        return view('admin.profil_alumni.create', compact('users'));
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
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan gambar
        $gambarName = time().'.'.$request->gambar->extension(); // Nama file unik
        $request->gambar->storeAs('public/profil_alumni', $gambarName);// Simpan di public/galeri (sama seperti GaleriController)

        // Simpan data ke database
        ProfilAlumni::create([
            'user_id' => auth()->id(),
            'nama' => $request->nama,
            'tahun_lulus' => $request->tahun_lulus,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarName, // Simpan nama file saja
        ]);

        return redirect()->route('admin.profil_alumni.index')->with('success', 'Profil Alumni berhasil ditambahkan.');
    }

    /**
     * Display the specified resource. (Admin)
     *
     * @param  \App\Models\ProfilAlumni  $profilAlumni
     * @return \Illuminate\Http\Response
     */
    public function show(ProfilAlumni $profilAlumni)
    {
        return view('admin.profil_alumni.show', compact('profilAlumni'));
    }

    /**
     * Show the form for editing the specified resource. (Admin)
     *
     * @param  \App\Models\ProfilAlumni  $profilAlumni
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfilAlumni $profilAlumni)
    {
        // Ambil daftar user dengan role admin
        $users = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'admin');
        })->get();
        return view('admin.profil_alumni.edit', compact('profilAlumni', 'users'));
    }

    /**
     * Update the specified resource in storage. (Admin)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProfilAlumni  $profilAlumni
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfilAlumni $profilAlumni)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except('user_id');

        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            Storage::delete('public/galeri/' . $profilAlumni->gambar);

            // Simpan gambar baru
            $gambarName = time().'.'.$request->gambar->extension(); // Nama file unik
            $request->gambar->storeAs('public/galeri', $gambarName);  // Simpan di public/galeri

            $data['gambar'] = $gambarName;
        }

        $profilAlumni->update($data);

        return redirect()->route('admin.profil_alumni.index')->with('success', 'Profil Alumni berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage. (Admin)
     *
     * @param  \App\Models\ProfilAlumni  $profilAlumni
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfilAlumni $profilAlumni)
    {
        // Hapus gambar
        Storage::delete('public/galeri/' . $profilAlumni->gambar);  // Hapus dari public/galeri

        // Hapus data
        $profilAlumni->delete();

        return redirect()->route('admin.profil_alumni.index')->with('success', 'Profil Alumni berhasil dihapus.');
    }

    /**
     * Display the specified resource for public viewing. (Public)
     *
     * @return \Illuminate\Http\Response
     */
    public function showPublic()
    {
        $profilAlumnis = ProfilAlumni::all();
        return view('ProfilAlumni.index', compact('profilAlumnis'));
    }
}
