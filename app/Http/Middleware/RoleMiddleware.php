<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $auth = session('auth');

        /**
         * Belum login
         */
        if (!$auth || empty($auth['user'])) {
            Alert::toast(
                'Silakan login terlebih dahulu',
                'warning'
            )->position('top-end');

            return redirect()->route('auth.index');
        }

        $userRole = $auth['user']['role'] ?? null;

        /**
         * Role tidak sesuai
         */
        if (!in_array($userRole, $roles)) {
            Alert::toast(
                'Anda tidak memiliki akses ke halaman ini',
                'error'
            )->position('top-end');

            return redirect()->route('dashboard.index');
        }

        return $next($request);
    }
}
