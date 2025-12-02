<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
 public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastikan user sudah login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Ambil role user dari tabel users
        $userRole = auth()->user()->role;

        // Jika userRole ada di daftar roles yang diteruskan ke middleware
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Kalau tidak punya role yang diizinkan, tampilkan 403
        abort(403, 'Aku cinta idn');
    }
}