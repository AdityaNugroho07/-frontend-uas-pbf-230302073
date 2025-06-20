<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session; // <-- Tambahkan ini!

class AuthController extends Controller
{
    protected $apiBase = 'http://localhost:8080'; // tanpa slash di akhir

    public function register(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $response = Http::post("{$this->apiBase}/register", [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        if ($response->successful()) {
            $token = $response->json('token');
            Session::put('jwt_token', $token);
            return redirect()->route('dashboard')->with('success', 'Registrasi berhasil');
        }

        return back()->withErrors(['message' => $response->json('message') ?? 'Gagal registrasi'])->withInput();
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $response = Http::post("{$this->apiBase}/login", $validated);

        if ($response->successful()) {
            $json = $response->json();

            // Simpan token & role ke session
            Session::put('jwt_token', $json['token']);
            Session::put('role', $json['role']);
            Session::put('email', $validated['email']);

            // Arahkan berdasarkan role
            if ($json['role'] === 'admin') {
                return redirect()->route('admin.index');
            } elseif ($json['role'] === 'mahasiswa') {
                return redirect()->route('mahasiswa.index');
            } elseif ($json['role'] === 'dosen') {
                return redirect()->route('dosen.index');
            }

            return redirect('/')->with('success', 'Login berhasil');
        }

        return back()->withErrors(['message' => $response->json('message') ?? 'Email atau password salah'])->withInput();
    }
}
