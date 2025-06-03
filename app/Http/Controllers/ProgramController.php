<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::latest()->paginate(10);
        return view('admin.program.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori
        // Ambil daftar user dengan role admin
        $users = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'admin');
        })->get();
        return view('admin.program.create', compact('categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:categories,kategori_id',
            'nama_program' => 'required|string|max:255',
            'harga_pendaftaran' => 'required|numeric|min:0',
            'harga_kursus' => 'required|numeric|min:0',
            'masa_belajar' => 'required|integer|min:1',
            'stok' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['user_id'] = auth()->id();

        Program::create($data);

        return redirect()->route('admin.program.index')
                         ->with('success', 'Program berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        return view('admin.programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        $categories = Category::all(); // Ambil semua kategori
        // Ambil daftar user dengan role admin
        $users = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'admin');
        })->get();
        return view('admin.program.edit', compact('program', 'categories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:categories,kategori_id',
            'nama_program' => 'required|string|max:255',
            'harga_pendaftaran' => 'required|numeric|min:0',
            'harga_kursus' => 'required|numeric|min:0',
            'masa_belajar' => 'required|integer|min:1',
            'stok' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except('user_id');

        $program->update($data);

        return redirect()->route('admin.program.index')
                         ->with('success', 'Program berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('admin.program.index')
                         ->with('success', 'Program berhasil dihapus.');
    }

    /**
     * Menampilkan daftar semua program yang aktif untuk publik.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPublic(Request $request)
    {
        $kategoriId = $request->input('kategori_id');
        $query = Program::query()->with('category'); // Eager load relasi category

        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }

        $programs = $query->get();
        $categories = Category::all();

        return view('Kelas.index', compact('programs', 'categories'));
    }
    public function getPrograms(Request $request)
    {
        $programs = Program::where('kategori_id', $request->kategori_id)->get();
        return response()->json($programs);
    }
}
