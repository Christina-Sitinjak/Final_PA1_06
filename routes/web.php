<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\SistemBelajarController;
use App\Http\Controllers\JadwalBelajarController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\ProfilAlumniController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PesanKelasController;
use App\Http\Controllers\DaftarPemesananController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('logins');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('registers');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute public untuk menampilkan daftar Sistem Belajar
Route::get('/sistem-belajar', [SistemBelajarController::class, 'showPublic'])->name('sistem_belajar');

// Rute public untuk menampilkan daftar Jadwal Belajar
Route::get('/jadwal-belajar', [JadwalBelajarController::class, 'showPublic'])->name('jadwal_belajar');

// Rute public untuk menampilkan daftar kelas
Route::get('/programs', [ProgramController::class, 'showPublic'])->name('program');

// Rute public untuk menampilkan daftar galeri (Perbaikan: URL dan Namespace Nama Route)
Route::get('/galeri', [GaleriController::class, 'showPublic'])->name('galeri');

// Rute public untuk menampilkan daftar pengajar
Route::get('/pengajar-belajar', [PengajarController::class, 'showPublic'])->name('pengajar');

// Rute public untuk menampilkan daftar profil alumni
Route::get('/profil-alumni', [ProfilAlumniController::class, 'showPublic'])->name('profil_alumni');

// Rute public untuk menampilkan daftar pengumuman
Route::get('/pengumuman', [PengumumanController::class, 'showPublic'])->name('pengumuman');

// Rute public untuk menampilkan daftar kategori
Route::get('/kategori', [CategoryController::class, 'showPublic'])->name('kategori');

// Rute-rute yang dilindungi (admin)
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // CRUD Sistem Belajar
    Route::get('/sistem-belajar', [SistemBelajarController::class, 'index'])->name('admin.sistem_belajar.index');
    Route::get('/sistem-belajar/create', [SistemBelajarController::class, 'create'])->name('admin.sistem_belajar.create');
    Route::post('/sistem-belajar', [SistemBelajarController::class, 'store'])->name('admin.sistem_belajar.store');
    Route::get('/sistem-belajar/{sistem_belajar}', [SistemBelajarController::class, 'show'])->name('admin.sistem_belajar.show');
    Route::get('/sistem-belajar/{sistem_belajar}/edit', [SistemBelajarController::class, 'edit'])->name('admin.sistem_belajar.edit');
    Route::put('/sistem-belajar/{sistem_belajar}', [SistemBelajarController::class, 'update'])->name('admin.sistem_belajar.update');
    Route::patch('/sistem-belajar/{sistem_belajar}', [SistemBelajarController::class, 'update']); // Optional, tergantung kebutuhan
    Route::delete('/sistem-belajar/{sistem_belajar}', [SistemBelajarController::class, 'destroy'])->name('admin.sistem_belajar.destroy');

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

// CRUD Jadwal Belajar
Route::get('/jadwal-belajar', [JadwalBelajarController::class, 'index'])->name('admin.jadwal_belajar.index');
Route::get('/jadwal-belajar/create', [JadwalBelajarController::class, 'create'])->name('admin.jadwal_belajar.create');
Route::post('/jadwal-belajar', [JadwalBelajarController::class, 'store'])->name('admin.jadwal_belajar.store');
Route::get('/jadwal-belajar/{jadwal_belajar}', [JadwalBelajarController::class, 'show'])->name('admin.jadwal_belajar.show');
Route::get('/jadwal-belajar/{jadwal_belajar}/edit', [JadwalBelajarController::class, 'edit'])->name('admin.jadwal_belajar.edit');
Route::put('/jadwal-belajar/{jadwal_belajar}', [JadwalBelajarController::class, 'update'])->name('admin.jadwal_belajar.update');
Route::patch('/jadwal-belajar/{jadwal_belajar}', [JadwalBelajarController::class, 'update']); // Optional, tergantung kebutuhan
Route::delete('/jadwal-belajar/{jadwal_belajar}', [JadwalBelajarController::class, 'destroy'])->name('admin.jadwal_belajar.destroy');

// Get Programs berdasarkan Category (AJAX)
Route::get('/admin/jadwal-belajar/get-programs', [JadwalBelajarController::class, 'getPrograms'])->name('admin.jadwal_belajar.getPrograms');

    // CRUD Kategori
    Route::get('/kategori', [CategoryController::class, 'index'])->name('admin.kategori.index');
    Route::get('/kategori/create', [CategoryController::class, 'create'])->name('admin.kategori.create');
    Route::post('/kategori', [CategoryController::class, 'store'])->name('admin.kategori.store');
    Route::get('/kategori/{kategori}', [CategoryController::class, 'show'])->name('admin.kategori.show');
    Route::get('/kategori/{kategori}/edit', [CategoryController::class, 'edit'])->name('admin.kategori.edit');
    Route::put('/kategori/{kategori}', [CategoryController::class, 'update'])->name('admin.kategori.update');
    Route::delete('/kategori/{kategori}', [CategoryController::class, 'destroy'])->name('admin.kategori.destroy');

    // CRUD Program
    Route::get('/get-programs', [ProgramController::class, 'getPrograms'])->name('getPrograms');
    Route::get('/programs', [ProgramController::class, 'index'])->name('admin.program.index');
    Route::get('/programs/create', [ProgramController::class, 'create'])->name('admin.program.create');
    Route::post('/programs', [ProgramController::class, 'store'])->name('admin.program.store');
    Route::get('/programs/{program}', [ProgramController::class, 'show'])->name('admin.program.show');
    Route::get('/programs/{program}/edit', [ProgramController::class, 'edit'])->name('admin.program.edit');
    Route::put('/programs/{program}', [ProgramController::class, 'update'])->name('admin.program.update');
    Route::patch('/programs/{program}', [ProgramController::class, 'update']); // Boleh menggunakan patch jika hanya sebagian data yang diupdate
    Route::delete('/programs/{program}', [ProgramController::class, 'destroy'])->name('admin.program.destroy');

    // Daftar Pemesanan
    Route::get('/daftar_pemesanan', [DaftarPemesananController::class, 'index'])->name('admin.daftar_pemesanan.index');
    Route::get('/get-program-by-category', [DaftarPemesananController::class, 'getProgramByCategory'])->name('getProgramByCategory');
    Route::post('/daftar_pemesanan/{pesanKelas}/approve', [DaftarPemesananController::class, 'approve'])->name('admin.daftar_pemesanan.approve'); // Ubah nama route
    Route::post('/daftar_pemesanan/{pesanKelas}/cancel', [DaftarPemesananController::class, 'cancel'])->name('admin.daftar_pemesanan.cancel'); // Ubah nama route
    Route::get('/admin/get-program-by-category', [DaftarPemesananController::class, 'getProgramByCategory'])->name('getProgramByCategory');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});



// Rute-rute yang dilindungi (user)
Route::middleware(['auth', 'is_murid'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

//CRUD Pesan Kelas (User)
Route::middleware(['auth'])->group(function () {

    // Daftar Pemesanan Kelas (Dashboard User)
    Route::get('/user/pesan_kelas', [PesanKelasController::class, 'index'])->name('user.pesan_kelas.index');

    // Form untuk Membuat Pemesanan Baru
    Route::get('/user/pesan_kelas/create', [PesanKelasController::class, 'create'])->name('user.pesan_kelas.create');

    // Menyimpan Pemesanan Baru
    Route::post('/user/pesan_kelas', [PesanKelasController::class, 'store'])->name('user.pesan_kelas.store');

    // Menampilkan Detail Pemesanan (Approved)
    Route::get('/user/pesan_kelas/{pesanKelas}/approved', [PesanKelasController::class, 'showApproved'])->name('user.pesan_kelas.show_approved');

    // Menampilkan Detail Pemesanan (Opsional)
    // Route::get('/user/pesan_kelas/{pesanKelas}', [PesanKelasController::class, 'show'])->name('user.pesan_kelas.show');

    // Form untuk Mengedit Pemesanan
    Route::get('/user/pesan_kelas/{pesanKelas}/edit', [PesanKelasController::class, 'edit'])->name('user.pesan_kelas.edit');

    // Mengupdate Pemesanan
    Route::put('/user/pesan_kelas/{pesanKelas}', [PesanKelasController::class, 'update'])->name('user.pesan_kelas.update');

    // Menghapus Pemesanan
    Route::delete('/user/pesan_kelas/{pesanKelas}', [PesanKelasController::class, 'destroy'])->name('user.pesan_kelas.destroy');

    // Mengambil Program Berdasarkan Kategori
    Route::get('/get-programs', [PesanKelasController::class, 'getPrograms'])->name('getPrograms');

});

Route::get('/profile/{user}', [UserController::class, 'profile'])->name('profile.show');


Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'id'])) {
        abort(400);
    }
    session(['locale' => $locale]);
    return redirect()->back();
})->name('lang.switch');

