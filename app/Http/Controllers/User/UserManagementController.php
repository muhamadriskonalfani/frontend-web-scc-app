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
    public function student(Request $request)
    {
        $token = session('auth.token');

        $search = $request->search;

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . '/admin/students', [
                'status' => $request->status,
                'study_program_id' => $request->study_program_id,
                'entry_year' => $request->entry_year,
                'search' => $search,
            ]);

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil data mahasiswa',
                'error'
            )->position('top-end');

            return back();
        }

        $users = $response->json('data.data') ?? [];

        return view('pages.users.student-index', compact('users'));
    }

    /**
     * Halaman daftar alumni
     */
    public function alumni(Request $request)
    {
        $token = session('auth.token');

        $search = $request->search;

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . '/admin/alumni', [
                'status' => $request->status,
                'study_program_id' => $request->study_program_id,
                'graduation_year' => $request->graduation_year,
                'search' => $search,
            ]);

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil data alumni',
                'error'
            )->position('top-end');

            return back();
        }

        $users = $response->json('data.data') ?? [];

        return view('pages.users.alumni-index', compact('users'));
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

        $user = $response->json('data');

        return view('pages.users.user-detail', compact('user'));
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
