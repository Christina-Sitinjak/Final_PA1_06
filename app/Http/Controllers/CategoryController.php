<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Tambahkan ini

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar semua kategori di admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil semua data Category, urutkan dari yang terbaru, gunakan paginasi
        $category = Category::latest()->paginate(10);
        return view('admin.kategori.index', compact('category'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil daftar user dengan role admin
        $users = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'admin');
        })->get();

        // Kirim data users ke view
        return view('admin.kategori.create', compact('users'));
    }


    /**
     * Menyimpan kategori baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all(); // Ambil semua data dari form
        $data['user_id'] = auth()->id();

        // Buat Category baru menggunakan data yang sudah divalidasi
        Category::create($data);

        // Redirect ke halaman index kategori dengan pesan sukses
        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail spesifik kategori.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // Tampilkan view 'kategori.show' dengan data kategori yang dipilih
        return view('admin.kategori.show', compact('category'));
    }

    /**
     * Menampilkan form untuk mengedit kategori.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $kategori)
    {
        // Tampilkan view 'kategori.edit' dengan data kategori yang akan diedit
        $users = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'admin');
        })->get();

        return view('admin.kategori.edit', compact('kategori', 'users')); // Kirim data users ke view
    }

    /**
     * Memperbarui kategori yang ada di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $kategori)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except('user_id'); // Ambil semua data dari form

        // Update data category yang ada dengan data yang sudah divalidasi
        $kategori->update($data);

        // Redirect ke halaman index kategori dengan pesan sukses
        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori dari database.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $kategori)
    {
        // Hapus data category
        $kategori->delete();

        // Redirect ke halaman index kategori dengan pesan sukses
        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }

    /**
     * Menampilkan daftar semua kategori untuk publik.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPublic()
    {
        $semua_kategori = Category::all();
        return view('Category.index', compact('semua_kategori'));
    }
}
