<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Galeri;
use App\Models\Pengajar;
use App\Models\ProfilAlumni;
use App\Models\Pengumuman;
use App\Models\Category;
use App\Models\PesanKelas;


class DashboardController extends Controller
{
    public function index()
    {
        $jumlahProgram      = Program::count();
        $jumlahGaleri       = Galeri::count();
        $jumlahPengajar     = Pengajar::count();
        $jumlahAlumni       = ProfilAlumni::count();
        $jumlahPengumuman   = Pengumuman::count();
        $jumlahCategory     = Category::count();
        $jumlahPemesanan    = PesanKelas::count();

            return view('admin.dashboard', compact(
                'jumlahProgram',
                'jumlahGaleri',
                'jumlahPengajar',
                'jumlahAlumni',
                'jumlahPengumuman',
                'jumlahCategory',
                'jumlahPemesanan'
            ));
    }
}
