<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class StudyProgramController extends Controller
{
    /**
     * List / daftar program studi
     */
    public function index(Request $request)
    {
        $token = session('auth.token');

        $search = $request->search;

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . '/admin/master/study-programs', [
                'search' => $search,
                'faculty_id' => $request->faculty_id,
            ]);

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil data program studi',
                'error'
            )->position('top-end');

            return back();
        }

        $studyPrograms = $response->json('data.data') ?? [];
        $pagination    = $response->json('data');

        return view(
            'pages.master.study-program-index',
            compact('studyPrograms', 'pagination', 'search')
        );
    }

    /**
     * Halaman tambah program studi
     * + ambil data fakultas untuk select
     */
    public function create()
    {
        $token = session('auth.token');

        /** @var Response $facultyResponse */
        $facultyResponse = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . '/admin/master/faculties');

        if ($facultyResponse->failed()) {
            Alert::toast('Gagal mengambil data fakultas', 'error')
                ->position('top-end');

            return back();
        }

        $faculties = $facultyResponse->json('data') ?? [];

        return view(
            'pages.master.study-program-create',
            compact('faculties')
        );
    }

    /**
     * Simpan program studi
     */
    public function store(Request $request)
    {
        $request->validate([
            'faculty_id' => 'required',
            'name'       => 'required|string|max:100',
            'degree'     => 'required|in:D3,D4,S1,S2,S3',
            'code'       => 'required|string|max:20',
        ]);

        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->post(config('services.api.base_url') . '/admin/master/study-programs', [
                'faculty_id' => $request->faculty_id,
                'name'       => $request->name,
                'degree'     => $request->degree,
                'code'       => $request->code,
            ]);

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal menambahkan program studi',
                'error'
            )->position('top-end');

            return back()->withInput();
        }

        Alert::toast('Program studi berhasil ditambahkan', 'success')
            ->position('top-end');

        return redirect()->route('master.study-programs.index');
    }

    /**
     * Halaman edit program studi
     * + detail prodi
     * + data fakultas
     */
    public function edit($id)
    {
        $token = session('auth.token');

        /** @var Response $studyProgramResponse */
        $studyProgramResponse = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . "/admin/master/study-programs/{$id}");

        if ($studyProgramResponse->failed()) {
            Alert::toast(
                $studyProgramResponse->json('message') ?? 'Program studi tidak ditemukan',
                'error'
            )->position('top-end');

            return redirect()->route('master.study-programs-index');
        }

        /** @var Response $facultyResponse */
        $facultyResponse = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . '/admin/master/faculties');

        if ($facultyResponse->failed()) {
            Alert::toast('Gagal mengambil data fakultas', 'error')
                ->position('top-end');

            return back();
        }

        $studyProgram = $studyProgramResponse->json('data');
        $faculties    = $facultyResponse->json('data') ?? [];

        return view(
            'pages.master.study-program-update',
            compact('studyProgram', 'faculties')
        );
    }

    /**
     * Update program studi
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'faculty_id' => 'required',
            'name'       => 'required|string|max:100',
            'degree'     => 'required|in:D3,D4,S1,S2,S3',
            'code'       => 'required|string|max:20',
        ]);

        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->put(config('services.api.base_url') . "/admin/master/study-programs/{$id}", [
                'faculty_id' => $request->faculty_id,
                'name'       => $request->name,
                'degree'     => $request->degree,
                'code'       => $request->code,
            ]);

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal memperbarui program studi',
                'error'
            )->position('top-end');

            return back()->withInput();
        }

        Alert::toast('Program studi berhasil diperbarui', 'success')
            ->position('top-end');

        return redirect()->route('master.study-programs.index');
    }

    /**
     * Hapus program studi
     */
    public function destroy($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->delete(config('services.api.base_url') . "/admin/master/study-programs/{$id}");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Program studi gagal dihapus',
                'error'
            )->position('top-end');

            return back();
        }

        Alert::toast('Program studi berhasil dihapus', 'success')
            ->position('top-end');

        return redirect()->route('master.study-programs.index');
    }
}
