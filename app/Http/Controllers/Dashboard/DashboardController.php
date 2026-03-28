<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $token = session('auth.token');

        if (!$token) {
            Alert::toast(
                'Sesi login Anda telah berakhir, silakan login kembali',
                'warning'
            )->position('top-end');

            return redirect()->route('auth.index');
        }

        // default angkatan = null
        $entryYear = $request->entry_year;
        $graduationYear = $request->graduation_year;

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . '/admin/dashboard', [
                'entry_year' => $entryYear,
                'graduation_year' => $graduationYear,
            ]);

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil data dashboard',
                'error'
            )->position('top-end');

            return redirect()->route('auth.index');
        }

        $dashboard = $response->json('data');

        return view('pages.dashboard.dashboard-index', [
            'dashboard' => $dashboard,
            'userChart' => $dashboard['userChart'],
            'tracerChart' => $dashboard['tracerChart'],
        ]);
    }
}
