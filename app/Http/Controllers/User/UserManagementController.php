<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class UserManagementController extends Controller
{
    /**
     * Halaman daftar mahasiswa
     */
    public function index(Request $request)
    {
        $token = session('auth.token');

        $filters = [
            'type'              => $request->type,
            'search'            => $request->search,
            'faculty_id'        => $request->faculty_id,
            'study_program_id'  => $request->study_program_id,
            'entry_year_from'   => $request->entry_year_from,
            'entry_year_to'     => $request->entry_year_to,
        ];

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(
                config('services.api.base_url') . '/admin/users',
                array_filter($filters)
            );

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil data pengguna',
                'error'
            )->position('top-end');

            return back();
        }

        $result = $response->json();

        return view('pages.users.user-index', [
            'users'         => $result['data']['data'] ?? [],
            'faculties'     => $result['faculties'] ?? [],
            'studyPrograms' => $result['study_programs'] ?? [],
            'filters'       => $filters,
        ]);
    }

    /**
     * Halaman daftar mahasiswa
     */
    public function create()
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . '/admin/get-master');

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil data master',
                'error'
            )->position('top-end');

            return back();
        }

        return view('pages.users.user-create', [
            'faculties' => $response->json('faculties'),
            'studyPrograms' => $response->json('study_programs'),
        ]);
    }

    /**
     * Halaman daftar mahasiswa
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'role' => 'required|in:student,alumni',
            'gender' => 'required|in:male,female',
            'student_id_number' => 'required|string|max:30',
            'faculty_id' => 'required',
            'study_program_id' => 'required',
            'entry_year' => 'required|digits:4|integer',
            'graduation_year' => 'nullable|digits:4|integer|gte:entry_year',
        ]);

        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->post(
                config('services.api.base_url') . '/admin/users',
                $validated
            );

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal menambahkan pengguna',
                'error'
            )->position('top-end');

            return back()->withInput();
        }

        Alert::toast('Pengguna berhasil ditambahkan', 'success')
            ->position('top-end');

        return redirect()->route('users.index');
    }

    /**
     * Detail mahasiswa / alumni
     */
    public function show($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . "/admin/users/{$id}");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil detail user',
                'error'
            )->position('top-end');

            return back();
        }

        $result = $response->json();

        return view('pages.users.user-detail', [
            'user' => $result['data'] ?? [],
            'is_same_faculty' => $result['is_same_faculty'],
        ]);
    }

    /**
     * Approve user
     */
    public function approve($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->put(config('services.api.base_url') . "/admin/users/{$id}/approve");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal menyetujui user',
                'error'
            )->position('top-end');

            return back();
        }

        Alert::toast('User berhasil disetujui', 'success')
            ->position('top-end');

        return back();
    }

    /**
     * Reject user
     */
    public function reject($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->put(config('services.api.base_url') . "/admin/users/{$id}/reject");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal menolak user',
                'error'
            )->position('top-end');

            return back();
        }

        Alert::toast('User berhasil ditolak', 'success')
            ->position('top-end');

        return back();
    }
}
