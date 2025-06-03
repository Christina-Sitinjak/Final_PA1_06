<?php

namespace App\Http\Controllers;

use App\Models\PesanKelas;
use App\Models\Program;
use App\Models\Category;
use Illuminate\Http\Request;

class DaftarPemesananController extends Controller
{
    // Tampilkan semua PesanKelas
public function index(Request $request)
{
    $query = PesanKelas::with('user', 'program.category');

    if ($request->filled('category')) {
        $query->whereHas('program', function ($q) use ($request) {
            $q->where('kategori_id', $request->category);
        });
    }

    if ($request->filled('program')) {
        $query->whereHas('program', function ($q) use ($request) {
            $q->where('nama_program', $request->program);
        });
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $pesanans = $query->orderBy('created_at', 'desc')->get();

    // Summary
    $summary = [
        'approved' => $pesanans->where('status', 'approved')->count(),
        'pending' => $pesanans->where('status', 'pending')->count(),
        'cancelled' => $pesanans->where('status', 'cancelled')->count(),
    ];

    $semua_kategori = Category::all();
    $programs = Program::all();
    $selectedCategory = $request->category;

    return view('admin.daftar_pemesanan.index', compact('pesanans', 'summary', 'semua_kategori', 'programs', 'selectedCategory'));
}



    // Setujui PesanKelas (Diubah namanya menjadi approve)
    public function approve($id)
    {
        $pesan = PesanKelas::findOrFail($id);
        $pesan->status = 'approved';
        $pesan->save();

        return redirect()->back()->with('success', 'Pemesanan disetujui.');
    }

    // Tolak PesanKelas (Diubah namanya menjadi cancel)
    public function cancel($id)
    {
        $pesan = PesanKelas::findOrFail($id);
        $pesan->status = 'cancelled';
        $pesan->save();

        return redirect()->back()->with('error', 'Pemesanan ditolak.');
    }

public function getProgramByCategory(Request $request)
{
    $category = $request->query('category');

    if ($category && $category !== '') {
        // Hanya ambil program berdasarkan kategori_id
        $programs = Program::where('kategori_id', $category)->get(['id', 'nama_program']);
    } else {
        // Jika tidak ada kategori, ambil semua program
        $programs = Program::all(['id', 'nama_program']);
    }

    return response()->json($programs);
}

}
