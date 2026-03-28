<?php

namespace App\Http\Controllers\JobVacancy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class JobVacancyController extends Controller
{
    /**
     * Daftar loker
     */
    public function index(Request $request)
    {
        $token = session('auth.token');

        $search = $request->search;

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . '/admin/jobvacancy', [
                'status'        => $request->status,
                'company_name'  => $request->company_name,
                'from_date'     => $request->from_date,
                'to_date'       => $request->to_date,
                'search'        => $search,
            ]);

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil data lowongan kerja',
                'error'
            )->position('top-end');

            return back();
        }

        $vacancies = $response->json('data') ?? [];

        return view(
            'pages.jobvacancy.jobvacancy-index',
            compact('vacancies')
        );
    }

    /**
     * Detail loker
     */
    public function show($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . "/admin/jobvacancy/{$id}");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil detail lowongan kerja',
                'error'
            )->position('top-end');

            return redirect()->route('jobvacancy.index');
        }

        $vacancy = $response->json('data');

        // tambahan image_url
        $vacancy['image_url'] = $vacancy['image']
            ? config('services.api.domain_url') . '/storage/' . $vacancy['image']
            : null;

        return view(
            'pages.jobvacancy.jobvacancy-detail',
            compact('vacancy')
        );
    }

    public function approve($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->put(config('services.api.base_url') . "/admin/jobvacancy/{$id}/approve");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal menyetujui loker',
                'error'
            )->position('top-end');

            return back();
        }

        Alert::toast('Loker berhasil disetujui', 'success')
            ->position('top-end');

        return redirect()->route('jobvacancy.show', $id);
    }

    public function reject($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->put(config('services.api.base_url') . "/admin/jobvacancy/{$id}/reject");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal menolak loker',
                'error'
            )->position('top-end');

            return back();
        }

        Alert::toast('Loker berhasil ditolak', 'success')
            ->position('top-end');

        return redirect()->route('jobvacancy.show', $id);
    }

    public function end($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->put(config('services.api.base_url') . "/admin/jobvacancy/{$id}/end");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengakhiri loker',
                'error'
            )->position('top-end');

            return back();
        }

        Alert::toast('Loker berhasil diakhiri', 'success')
            ->position('top-end');

        return redirect()->route('jobvacancy.index');
    }
}
