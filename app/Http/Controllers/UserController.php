<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile(User $user)
    {
        // Pastikan user yang mengakses adalah user yang sama dengan profil yang diminta
        if (Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.profile.show', compact('user'));
    }
}
