<?php

namespace App\Http\Controllers;

use App\Models\ProfilAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilAlumniController extends Controller
{
    /**
     * Display a listing of the resource. (Admin)
     */
    public function index()
    {
        $profilAlumnis = ProfilAlumni::all();
        return view('admin.profil_alumni.index', compact('profilAlumnis'));
    }

    /**
     * Show the form for creating a new resource. (Admin)
     */
    public function create()
    {
        return view('admin.profil_alumni.create');
    }

    /**
     * Store a newly created resource in storage. (Admin)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tahun_lulus' => 'required|integer|min:1900|max:' . date('Y'),
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('public/profil_alumnis', $nama_gambar);

            $data['gambar'] = $nama_gambar;
        }

        ProfilAlumni::create($data);

        return redirect()->route('admin.profil_alumni.index')
            ->with('success', 'Profil Alumni berhasil ditambahkan.');
    }

    /**
     * Display the specified resource. (Admin)
     */
    public function show(ProfilAlumni $profilAlumni)
    {
        return view('admin.profil_alumni.show', compact('profilAlumni'));
    }

    /**
     * Show the form for editing the specified resource. (Admin)
     */
    public function edit(ProfilAlumni $profilAlumni)
    {
        return view('admin.profil_alumni.edit', compact('profilAlumni'));
    }

    /**
     * Update the specified resource in storage. (Admin)
     */
    public function update(Request $request, ProfilAlumni $profilAlumni)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tahun_lulus' => 'required|integer|min:1900|max:' . date('Y'),
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($profilAlumni->gambar) {
                Storage::delete('public/profil_alumnis/' . $profilAlumni->gambar);
            }

            $gambar = $request->file('gambar');
            $nama_gambar = time() . '_' . $gambar->getClientOriginalName();
            $path = $gambar->storeAs('public/profil_alumnis', $nama_gambar);

            $data['gambar'] = $nama_gambar;
        }

        $profilAlumni->update($data);

        return redirect()->route('admin.profil_alumni.index')
            ->with('success', 'Profil Alumni berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage. (Admin)
     */
    public function destroy(ProfilAlumni $profilAlumni)
    {
        if ($profilAlumni->gambar) {
            Storage::delete('public/profil_alumnis/' . $profilAlumni->gambar);
        }

        $profilAlumni->delete();

        return redirect()->route('admin.profil_alumni.index')
            ->with('success', 'Profil Alumni berhasil dihapus.');
    }

    /**
     * Display the specified resource for public viewing. (Public)
     *
     * @param  \App\Models\ProfilAlumni  $ProfilAlumni
     * @return \Illuminate\Http\Response
     */
    public function showPublic(ProfilAlumni $ProfilAlumni)
    {
        $profilAlumnis = ProfilAlumni::all();
        return view('ProfilAlumni.index', compact('profilAlumnis'));
    }
}
