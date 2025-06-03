<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Pengajar;
use App\Models\Galeri;
use App\Models\ProfilAlumni;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $programs = Program::limit(5)->get();
        $pengajars = Pengajar::limit(5)->get(); // Ambil 5 data pengajar pertama
        $galeris = Galeri::limit(5)->get(); // Ambil 5 data galeri pertama
        $profilAlumnis = ProfilAlumni::limit(5)->get();

        return view('welcome', compact('pengajars','galeris','profilAlumnis','programs'));
    }
}
