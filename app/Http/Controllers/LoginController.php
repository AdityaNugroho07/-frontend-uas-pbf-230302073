<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $response = Http::post(env('CI_API_BASE_URL') . '/auth/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $token = $data['token'] ?? null;

            if ($token) {
                session(['jwt_token' => $token]);
                return redirect()->route('admin.dosen.tambah'); // sesuaikan halaman utama
            }
        }

        return back()->withErrors(['message' => 'Email atau password salah.']);
    }

    public function logout()
    {
        session()->forget('jwt_token');
        return redirect()->route('login');
    }
}
