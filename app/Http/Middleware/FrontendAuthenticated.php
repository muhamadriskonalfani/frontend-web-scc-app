<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class FrontendAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Mengecek apakah frontend memiliki token API di session
        if (!session()->has('auth.token') || !session()->has('auth.user')) {

            Alert::toast(
                'Sesi Anda telah berakhir, silakan login kembali',
                'warning'
            )->position('top-end');

            return redirect()->route('auth.index');
        }

        return $next($request);
    }
}
