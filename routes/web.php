<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\ProfilAlumniController;
use App\Http\Controllers\PengumumanController;

Route::get('/', function () {return view('welcome');})->name('welcome');
Route::get('/sistem-belajar', function () {return view('Sistem Belajar.index');})->name('sistembelajar');
Route::get('/jadwal-belajar', function () {return view('Jadwal Belajar.index');})->name('jadwalbelajar');
// Route::get('/profil-alumni', function () {return view('Profil Alumni.index');})->name('profilalumni');
// Route::get('/pengumuman', function () {return view('Pengumuman.index');})->name('pengumuman');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('logins');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('registers');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute public untuk menampilkan daftar kelas
Route::get('/kelas-belajar', [KelasController::class, 'showPublic'])->name('kelas');

// Rute public untuk menampilkan daftar galeri (Perbaikan: URL dan Namespace Nama Route)
Route::get('/galeri', [GaleriController::class, 'showPublic'])->name('galeri');

// Rute public untuk menampilkan daftar pengajar
Route::get('/pengajar-belajar', [PengajarController::class, 'showPublic'])->name('pengajar');

// Rute public untuk menampilkan daftar profil alumni
Route::get('/profil-alumni', [ProfilAlumniController::class, 'showPublic'])->name('profil_alumni');

// Rute public untuk menampilkan daftar pengumuman
Route::get('/pengumuman', [PengumumanController::class, 'showPublic'])->name('pengumuman');

// Rute-rute yang dilindungi (admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // CRUD Kelas
    Route::get('/kelas', [KelasController::class, 'index'])->name('admin.kelas.index');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('admin.kelas.create');
    Route::post('/kelas', [KelasController::class, 'store'])->name('admin.kelas.store');
    Route::get('/kelas/{kelas}', [KelasController::class, 'show'])->name('admin.kelas.show');
    Route::get('/kelas/{kelas}/edit', [KelasController::class, 'edit'])->name('admin.kelas.edit');
    Route::put('/kelas/{kelas}', [KelasController::class, 'update'])->name('admin.kelas.update');
    Route::patch('/kelas/{kelas}', [KelasController::class, 'update']); // Boleh menggunakan patch jika hanya sebagian data yang diupdate
    Route::delete('/kelas/{kelas}', [KelasController::class, 'destroy'])->name('admin.kelas.destroy');

    // CRUD Galeri
    Route::get('/galeri', [GaleriController::class, 'index'])->name('admin.galeri.index');
    Route::get('/galeri/create', [GaleriController::class, 'create'])->name('admin.galeri.create');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('admin.galeri.store');
    Route::get('/galeri/{galeri}', [GaleriController::class, 'show'])->name('admin.galeri.show');
    Route::get('/galeri/{galeri}/edit', [GaleriController::class, 'edit'])->name('admin.galeri.edit');
    Route::put('/galeri/{galeri}', [GaleriController::class, 'update'])->name('admin.galeri.update');
    Route::patch('/galeri/{galeri}', [GaleriController::class, 'update']); // Boleh menggunakan patch jika hanya sebagian data yang diupdate
    Route::delete('/galeri/{galeri}', [GaleriController::class, 'destroy'])->name('admin.galeri.destroy');

    // CRUD Pengajar
    Route::get('/pengajar', [PengajarController::class, 'index'])->name('admin.pengajar.index');
    Route::get('/pengajar/create', [PengajarController::class, 'create'])->name('admin.pengajar.create');
    Route::post('/pengajar', [PengajarController::class, 'store'])->name('admin.pengajar.store');
    Route::get('/pengajar/{pengajar}', [PengajarController::class, 'show'])->name('admin.pengajar.show');
    Route::get('/pengajar/{pengajar}/edit', [PengajarController::class, 'edit'])->name('admin.pengajar.edit');
    Route::put('/pengajar/{pengajar}', [PengajarController::class, 'update'])->name('admin.pengajar.update');
    Route::patch('/pengajar/{pengajar}', [PengajarController::class, 'update']); // Boleh menggunakan patch jika hanya sebagian data yang diupdate
    Route::delete('/pengajar/{pengajar}', [PengajarController::class, 'destroy'])->name('admin.pengajar.destroy');

    // CRUD Profil Alumni
    Route::get('/profil_alumni', [ProfilAlumniController::class, 'index'])->name('admin.profil_alumni.index');
    Route::get('/profil_alumni/create', [ProfilAlumniController::class, 'create'])->name('admin.profil_alumni.create');
    Route::post('/profil_alumni', [ProfilAlumniController::class, 'store'])->name('admin.profil_alumni.store');
    Route::get('/profil_alumni/{profil_alumni}', [ProfilAlumniController::class, 'show'])->name('admin.profil_alumni.show');
    Route::get('/profil_alumni/{profil_alumni}/edit', [ProfilAlumniController::class, 'edit'])->name('admin.profil_alumni.edit');
    Route::put('/profil_alumni/{profil_alumni}', [ProfilAlumniController::class, 'update'])->name('admin.profil_alumni.update');
    Route::patch('/profil_alumni/{profil_alumni}', [ProfilAlumniController::class, 'update']); // Boleh menggunakan patch jika hanya sebagian data yang diupdate
    Route::delete('/profil_alumni/{profil_alumni}', [ProfilAlumniController::class, 'destroy'])->name('admin.profil_alumni.destroy');

    // CRUD Pengumuman
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('admin.pengumuman.index');
    Route::get('/pengumuman/create', [PengumumanController::class, 'create'])->name('admin.pengumuman.create');
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('admin.pengumuman.store');
    Route::get('/pengumuman/{pengumuman}', [PengumumanController::class, 'show'])->name('admin.pengumuman.show');
    Route::get('/pengumuman/{pengumuman}/edit', [PengumumanController::class, 'edit'])->name('admin.pengumuman.edit');
    Route::put('/pengumuman/{pengumuman}', [PengumumanController::class, 'update'])->name('admin.pengumuman.update');
    Route::patch('/pengumuman/{pengumuman}', [PengumumanController::class, 'update']);
    Route::delete('/pengumuman/{pengumuman}', [PengumumanController::class, 'destroy'])->name('admin.pengumuman.destroy');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

// Rute-rute yang dilindungi (user)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/profile', function () {
        return view ('users.dashboard');
    })->name('user.profile');
});
