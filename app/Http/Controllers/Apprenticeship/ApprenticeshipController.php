<?php

namespace App\Http\Controllers\Apprenticeship;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class ApprenticeshipController extends Controller
{
    /**
     * Daftar info magang
     */
    public function index(Request $request)
    {
        $token = session('auth.token');

        $search = $request->search;

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . '/admin/apprenticeships', [
                'status'        => $request->status,
                'company_name'  => $request->company_name,
                'from_date'     => $request->from_date,
                'to_date'       => $request->to_date,
                'search'        => $search,
            ]);

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil data magang',
                'error'
            )->position('top-end');

            return back();
        }

        $apprenticeships = $response->json('data.data') ?? [];

        return view(
            'pages.apprenticeship.apprenticeship-index',
            compact('apprenticeships')
        );
    }

    /**
     * Detail info magang
     */
    public function show($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . "/admin/apprenticeships/{$id}");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil detail magang',
                'error'
            )->position('top-end');

            return redirect()->route('apprenticeship.index');
        }

        $apprenticeship = $response->json('data');

        // tambahan image_url
        $apprenticeship['image_url'] = $apprenticeship['image']
            ? config('services.api.domain_url') . '/storage/' . $apprenticeship['image']
            : null;

        return view(
            'pages.apprenticeship.apprenticeship-detail',
            compact('apprenticeship')
        );
    }

    public function approve($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->put(config('services.api.base_url') . "/admin/apprenticeships/{$id}/approve");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal menyetujui informasi magang',
                'error'
            )->position('top-end');

            return back();
        }

        Alert::toast('Informasi magang berhasil disetujui', 'success')
            ->position('top-end');

        return redirect()->route('apprenticeship.show', $id);
    }

    public function reject($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->put(config('services.api.base_url') . "/admin/apprenticeships/{$id}/reject");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal menolak informasi magang',
                'error'
            )->position('top-end');

            return back();
        }

        Alert::toast('Informasi magang berhasil ditolak', 'success')
            ->position('top-end');

        return redirect()->route('apprenticeship.show', $id);
    }

    public function end($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->put(config('services.api.base_url') . "/admin/apprenticeships/{$id}/end");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengakhiri informasi magang',
                'error'
            )->position('top-end');

            return back();
        }

        Alert::toast('Informasi magang berhasil diakhiri', 'success')
            ->position('top-end');

        return redirect()->route('apprenticeship.index');
    }
}
