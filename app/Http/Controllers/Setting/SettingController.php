<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $token = session('auth.token');

        $search = $request->search;

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . '/admin/setting/users', [
                'search' => $search,
            ]);

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil data pengguna',
                'error'
            )->position('top-end');

            return back();
        }

        $result = $response->json('data');

        return view('pages.setting.setting-user-index', [
            'users' => $result['data'] ?? [],
            'pagination' => $result
        ]);
    }
    
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

        return view('pages.setting.setting-user-create', [
            'faculties' => $response->json('faculties'),
            'studyPrograms' => $response->json('study_programs'),
        ]);
    }

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
                config('services.api.base_url') . '/admin/setting/users',
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

        return redirect()->route('setting.user.index');
    }
}
