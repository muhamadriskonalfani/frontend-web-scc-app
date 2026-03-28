<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class CampusInformationController extends Controller
{
    /**
     * Daftar informasi kampus
     */
    public function index(Request $request)
    {
        $token = session('auth.token');

        $search = $request->search;

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . '/admin/campus', [
                'search' => $search,
                'page' => $request->get('page', 1),
            ]);

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil data informasi kampus',
                'error'
            )->position('top-end');

            return back();
        }

        $campusInfos = $response->json('data.data') ?? [];

        return view('pages.campus.campus-info-index', [
            'campusInfos' => $campusInfos,
            'search' => $search,
        ]);
    }

    /**
     * Form tambah informasi kampus
     */
    public function create()
    {
        return view('pages.campus.campus-info-create');
    }

    /**
     * Detail informasi kampus
     */
    public function show($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . "/admin/campus/{$id}");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil detail informasi kampus',
                'error'
            )->position('top-end');

            return redirect()->route('campus-info.index');
        }

        $campusInfo = $response->json('data');
        
        // Tambahan image_url
        $campusInfo['image_url'] = $campusInfo['image']
            ? config('services.api.domain_url') . '/storage/' . $campusInfo['image']
            : null;

        return view('pages.campus.campus-info-detail', compact('campusInfo'));
    }

    /**
     * Submit tambah informasi kampus
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $token = session('auth.token');

        $http = Http::withToken($token)->acceptJson();

        // jika ada file
        if ($request->hasFile('image')) {
            $http = $http->attach(
                'image',
                file_get_contents($request->file('image')->getRealPath()),
                $request->file('image')->getClientOriginalName()
            );
        }

        /** @var Response $response */
        $response = $http->post(
            config('services.api.base_url') . '/admin/campus',
            [
                'title'       => $request->title,
                'description' => $request->description,
            ]
        );

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal menambahkan informasi kampus',
                'error'
            )->position('top-end');

            return back()->withInput();
        }

        Alert::toast(
            'Informasi kampus berhasil ditambahkan',
            'success'
        )->position('top-end');

        return redirect()->route('campus-info.index');
    }

    /**
     * Form edit informasi kampus (sama dengan show diatas)
     */
    public function edit($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->get(config('services.api.base_url') . "/admin/campus/{$id}");

        if ($response->status() === 404) {
            Alert::toast('Informasi kampus tidak ditemukan', 'error')
                ->position('top-end');

            return redirect()->route('campus-info.index');
        }

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengambil detail informasi kampus',
                'error'
            )->position('top-end');

            return redirect()->route('campus-info.index');
        }

        $campusInfo = $response->json('data');

        // Tambahan image_url
        $campusInfo['image_url'] = $campusInfo['image']
            ? config('services.api.domain_url') . '/storage/' . $campusInfo['image']
            : null;

        if ($campusInfo['created_by'] !== session('auth.user.id')) {
            Alert::toast('Akses ditolak. Anda tidak dapat mengubah informasi ini.', 'error')
                ->position('top-end');

            return redirect()->route('campus-info.index');
        }

        return view('pages.campus.campus-info-update', compact('campusInfo'));
    }

    /**
     * Update informasi kampus
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'required|in:active,ended',
        ]);

        $token = session('auth.token');

        $http = Http::withToken($token)->acceptJson();

        // attach file jika ada
        if ($request->hasFile('image')) {
            $http = $http->attach(
                'image',
                file_get_contents($request->file('image')->getRealPath()),
                $request->file('image')->getClientOriginalName()
            );
        }

        /** @var Response $response */
        $response = $http->post(
            config('services.api.base_url') . "/admin/campus/{$id}",
            [
                '_method'     => 'PUT', // 🔥 penting
                'title'       => $request->title,
                'description' => $request->description,
                'status'      => $request->status,
            ]
        );

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal memperbarui informasi kampus',
                'error'
            )->position('top-end');

            return back()->withInput();
        }

        Alert::toast(
            'Informasi kampus berhasil diperbarui',
            'success'
        )->position('top-end');

        return redirect()->route('campus-info.index');
    }

    /**
     * Akhiri / nonaktifkan informasi kampus
     */
    public function end($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->acceptJson()
            ->put(config('services.api.base_url') . "/admin/campus/{$id}/end");

        if ($response->failed()) {
            Alert::toast(
                $response->json('message') ?? 'Gagal mengakhiri informasi kampus',
                'error'
            )->position('top-end');

            return back();
        }

        Alert::toast(
            'Informasi kampus berhasil diakhiri',
            'success'
        )->position('top-end');

        return redirect()->route('campus-info.index');
    }
}
