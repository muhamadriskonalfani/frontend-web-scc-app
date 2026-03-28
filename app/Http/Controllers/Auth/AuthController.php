<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    /**
     * Submit login ke API
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $apiUrl = config('services.api.base_url') . '/admin/login';

        try {
            $response = Http::post($apiUrl, [
                'email' => $request->email,
                'password' => $request->password,
            ]);

            if ($response->failed()) {
                Alert::toast(
                    $response->json('message') ?? 'Email atau password salah',
                    'error'
                )->position('top-end');

                return back()->withInput();
            }

            // Simpan token & user ke session
            session([
                'auth' => [
                    'token' => $response->json('token'),
                    'user'  => $response->json('user'),
                ]
            ]);

            Alert::toast('Login berhasil', 'success')->position('top-end');

            return redirect()->route('dashboard.index');

        } catch (\Exception $e) {
            Alert::toast('Tidak dapat terhubung ke server', 'error')
                ->position('top-end');

            return back()->withInput();
        }
    }

    public function logout()
    {
        $token = session('auth.token');

        try {
            if ($token) {
                Http::withToken($token)
                    ->acceptJson()
                    ->post(config('services.api.base_url') . '/admin/logout');
            }
        } catch (\Exception $e) {
            // Abaikan error API logout
            // Yang penting session frontend dibersihkan
        }

        // Hapus session frontend
        session()->forget('auth');

        // Toast sukses logout (kanan atas)
        Alert::toast('Berhasil logout', 'success')
            ->position('top-end');

        return redirect()->route('auth.index');
    }
}
