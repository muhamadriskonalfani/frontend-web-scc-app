<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class FacultyController extends Controller
{
    /**
     * List fakultas
     */
    public function index(Request $request)
    {
        $token = session('auth.token');

        $search = $request->search;

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . '/admin/master/faculties', [
                'search' => $search,
            ]);

        if ($response->failed()) {
            Alert::toast('Gagal mengambil data fakultas', 'error')
                ->position('top-end');

            return back();
        }

        $faculties = $response->json('data') ?? [];

        return view('pages.master.faculty-index', [
            'faculties' => $faculties,
            'search' => $search,
        ]);
    }

    /**
     * Form tambah fakultas
     */
    public function create()
    {
        return view('pages.master.faculty-create');
    }

    /**
     * Simpan fakultas
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:10',
        ]);

        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->post(config('services.api.base_url') . '/admin/master/faculties', [
                'name' => $request->name,
                'code' => $request->code,
            ]);

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal menambah fakultas',
                'error'
            )->position('top-end');

            return back()->withInput();
        }

        Alert::toast('Fakultas berhasil ditambahkan', 'success')
            ->position('top-end');

        return redirect()->route('master.faculties.index');
    }

    /**
     * Ambil data fakultas
     */
    public function edit($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . "/admin/master/faculties/{$id}");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil detail Fakultas',
                'error'
            )->position('top-end');

            return redirect()->route('master.faculties.index');
        }

        $faculty = $response->json('data');
        
        return view('pages.master.faculty-update', compact('faculty'));
    }

    /**
     * Update fakultas
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'code'       => 'required|string|max:10',
        ]);

        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->put(config('services.api.base_url') . "/admin/master/faculties/{$id}", [
                'name'       => $request->name,
                'code'       => $request->code,
            ]);

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal memperbarui Fakultas',
                'error'
            )->position('top-end');

            return back()->withInput();
        }

        Alert::toast('Fakultas berhasil diperbarui', 'success')
            ->position('top-end');

        return redirect()->route('master.faculties.index');
    }

    /**
     * Hapus fakultas
     */
    public function destroy($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->delete(config('services.api.base_url') . "/admin/master/faculties/{$id}");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Fakultas gagal dihapus',
                'error'
            )->position('top-end');

            return back();
        }

        Alert::toast('Fakultas berhasil dihapus', 'success')
            ->position('top-end');

        return redirect()->route('master.faculties.index');
    }
}
