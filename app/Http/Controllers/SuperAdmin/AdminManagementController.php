<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class AdminManagementController extends Controller
{
    /**
     * Daftar admin
     */
    public function index(Request $request)
    {
        $token = session('auth.token');

        $search = $request->search;

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . '/admin/admins', [
                'search' => $search,
                'page' => $request->get('page', 1),
            ]);

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil data admin',
                'error'
            )->position('top-end');

            return back();
        }

        $admins = $response->json('data');

        return view('pages.admins.admin-index', [
            'admins' => $admins,
            'search' => $search
        ]);
    }

    /**
     * Detail admin
     */
    public function show($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . "/admin/admins/{$id}");

        if ($response->status() === 404) {
            Alert::toast('Admin tidak ditemukan', 'error')
                ->position('top-end');

            return redirect()->route('admins.index');
        }

        if ($response->failed()) {
            Alert::toast('Gagal mengambil detail admin', 'error')
                ->position('top-end');

            return redirect()->route('admins.index');
        }

        $admin = $response->json('data');

        return view('pages.admins.admin-detail', compact('admin'));
    }

    /**
     * Form tambah admin
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

        return view('pages.admins.admin-create', [
            'faculties' => $response->json('faculties'),
            'studyPrograms' => $response->json('study_programs'),
        ]);
    }

    /**
     * Submit tambah admin ke API
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'email'      => 'required|email',
            'password'   => 'required|min:6|confirmed',
            'faculty_id' => 'required',
            'nip'        => 'nullable|string|max:30',
            'position'   => 'nullable|string|max:100',
        ]);

        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->post(config('services.api.base_url') . '/admin/admins', [
                'name'                  => $request->name,
                'email'                 => $request->email,
                'password'              => $request->password,
                'password_confirmation' => $request->password_confirmation,
                'faculty_id'            => $request->faculty_id,
                'nip'                   => $request->nip,
                'position'              => $request->position,
            ]);

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal menambahkan admin',
                'error'
            )->position('top-end');

            return back()->withInput();
        }

        Alert::toast('Admin berhasil ditambahkan', 'success')
            ->position('top-end');

        return redirect()->route('admins.index');
    }

    public function edit($id)
    {
        $token = session('auth.token');

        // ambil data admin
        /** @var Response $adminResponse */
        $adminResponse = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . "/admin/admins/{$id}");

        if ($adminResponse->failed()) {
            Alert::toast('Admin tidak ditemukan', 'error')
                ->position('top-end');

            return redirect()->route('admins.index');
        }

        // ambil master data
        /** @var Response $masterResponse */
        $masterResponse = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . '/admin/get-master');

        if ($masterResponse->failed()) {
            Alert::toast('Gagal mengambil data master', 'error')
                ->position('top-end');

            return back();
        }

        $admin = $adminResponse->json('data');

        return view('pages.admins.admin-update', [
            'admin' => $admin,
            'faculties' => $masterResponse->json('faculties'),
            'studyPrograms' => $masterResponse->json('study_programs'),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'email'      => 'required|email',
            'password'   => 'nullable|min:6|confirmed',
            'faculty_id' => 'required',
            'nip'        => 'nullable|string|max:30',
            'position'   => 'nullable|string|max:100',
            'status'     => 'required|in:active,banned',
        ]);

        $token = session('auth.token');

        $payload = [
            'name'       => $request->name,
            'email'      => $request->email,
            'faculty_id' => $request->faculty_id,
            'nip'        => $request->nip,
            'position'  => $request->position,
            'status'    => $request->status,
        ];

        if ($request->password) {
            $payload['password'] = $request->password;
            $payload['password_confirmation'] = $request->password_confirmation;
        }

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->put(config('services.api.base_url') . "/admin/admins/{$id}", $payload);

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal update admin',
                'error'
            )->position('top-end');

            return back()->withInput();
        }

        Alert::toast('Admin berhasil diperbarui', 'success')
            ->position('top-end');

        return redirect()->route('admins.index');
    }
}
