<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsMurid
{
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan relasi role sudah dimuat
        $user = auth()->user()->load('role');

        // Cek apakah user login dan rolenya 'murid'
        if ($user && $user->role && $user->role->nama_role === 'murid') {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}

