<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya user yang login yang bisa akses
        $this->middleware('is_murid'); // Pastikan hanya role user yang bisa akses
    }

    public function index()
    {
        $user = Auth::user(); // Dapatkan data user yang login
        return view('user.dashboard', compact('user')); // Kirim ke view user.dashboard
    }
}
