<?php

namespace App\Http\Controllers;

use App\Models\JadwalBelajar;
use App\Models\Program;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; // Pastikan ini ada

class JadwalBelajarController extends Controller
{
    public function __construct()
    {
        // Hanya admin yang bisa mengakses method ini, kecuali showPublic
        $this->middleware('auth')->except('showPublic');
        $this->middleware('is_admin')->except('showPublic');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalBelajars = JadwalBelajar::with('program', 'user')->latest()->paginate(10);
        return view('admin.jadwal_belajar.index', compact('jadwalBelajars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $programs = collect();
        $users = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'admin');
        })->get();
        return view('admin.jadwal_belajar.create', compact('categories', 'programs', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->validateJadwalBelajar($request);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['user_id'] = auth()->id(); // Menggunakan auth()->id()

        JadwalBelajar::create($data);

        return redirect()->route('admin.jadwal_belajar.index')
                         ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalBelajar $jadwalBelajar)
    {
        return view('admin.jadwal_belajar.show', compact('jadwalBelajar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalBelajar $jadwalBelajar)
    {
        $categories = Category::all();
        $program = Program::find($jadwalBelajar->program_id);
        $programs = Program::where('kategori_id', $program->kategori_id)->get();
        $users = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'admin');
        })->get();
        return view('admin.jadwal_belajar.edit', compact('jadwalBelajar', 'categories', 'programs', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalBelajar $jadwalBelajar)
    {
        $validator = $this->validateJadwalBelajar($request);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except('user_id');

        $jadwalBelajar->update($data);

        return redirect()->route('admin.jadwal_belajar.index')
                         ->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalBelajar $jadwalBelajar)
    {
        $jadwalBelajar->delete();

        return redirect()->route('admin.jadwal_belajar.index')
                         ->with('success', 'Jadwal berhasil dihapus.');
    }

    /**
     * Method untuk get program berdasarkan kategori yang dipilih.
     */
    public function getPrograms(Request $request)
    {
        $kategoriId = $request->input('kategori_id');
        $programs = Program::where('kategori_id', $kategoriId)->get();

        return response()->json($programs);
    }

    /**
     * Menampilkan daftar jadwal yang aktif untuk publik (opsional).
     *
     * @return \Illuminate\Http\Response
     */
    public function showPublic(Request $request)
    {
        $programId = $request->input('program_id');

        $query = JadwalBelajar::with('program', 'user');

        if ($programId) {
            $query->where('program_id', $programId);
        }

        $jadwalBelajars = $query->get();
        $programs = Program::all();

        return view('JadwalBelajar.index', compact('jadwalBelajars', 'programs'));
    }

    /**
     * Fungsi validasi jadwal belajar (digunakan di store dan update).
     */
    private function validateJadwalBelajar(Request $request)
    {
        return Validator::make($request->all(), [
            'program_id' => 'required|exists:programs,program_id',
            'hari' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_berakhir' => 'required|date_format:H:i|after:jam_mulai',
        ]);
    }
}
