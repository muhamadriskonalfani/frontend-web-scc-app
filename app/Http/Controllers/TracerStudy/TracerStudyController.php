<?php

namespace App\Http\Controllers\TracerStudy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class TracerStudyController extends Controller
{
    /**
     * Daftar tracer study
     */
    public function index(Request $request)
    {
        $token = session('auth.token');

        $filters = [
            'search'            => $request->search,
            'faculty_id'        => $request->faculty_id,
            'study_program_id'  => $request->study_program_id,
            'entry_year_from'   => $request->entry_year_from,
            'entry_year_to'     => $request->entry_year_to,
            'page'              => $request->page,
        ];

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(
                config('services.api.base_url') . '/admin/tracer-studies',
                array_filter($filters)
            );

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil data tracer study',
                'error'
            )->position('top-end');

            return back();
        }

        $result = $response->json();

        return view('pages.tracer-study.tracer-study-index', [
            'tracerStudies' => $result['data']['data'] ?? [],
            'pagination'    => $result['data'] ?? [],
            'faculties'     => $result['faculties'] ?? [],
            'studyPrograms' => $result['study_programs'] ?? [],
            'filters'       => $filters,
        ]);
    }

    /**
     * Detail tracer study
     */
    public function show($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . "/admin/tracer-studies/{$id}");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil detail tracer study',
                'error'
            )->position('top-end');

            return back();
        }

        $userTracerStudy = $response->json('data');

        return view('pages.tracer-study.tracer-study-detail', compact('userTracerStudy'));
    }

    /**
     * Ekspor tracer study
     */
    public function export(Request $request)
    {
        $request->validate([
            'type' => 'required|in:excel,pdf'
        ]);

        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(
                config('services.api.base_url') . '/admin/tracer-studies/export', 
                $request->all()
            );

        return response($response->body())
            ->header('Content-Type', $response->header('Content-Type'))
            ->header('Content-Disposition', $response->header('Content-Disposition'));
    }
}
