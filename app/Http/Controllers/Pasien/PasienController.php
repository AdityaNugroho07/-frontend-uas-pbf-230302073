<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PasienController extends Controller
{
    private $apiBase = 'http://localhost:8080/api/pasien';

    public function index()
    {
        $response = Http::get($this->apiBase);

        $data = $response->successful() ? $response->json() : [];
        if (!$response->successful()) {
            session()->flash('error', 'Gagal mengambil data pasien dari API.');
        }

        return view('admin.pasien.index', compact('data'));
    }

    public function create()
    {
        return view('admin.pasien.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        ]);

        try {
            $response = Http::asJson()->post($this->apiBase . '/create', $validated);

            if ($response->failed()) {
                $errorMessage = $response->json('message') ?? 'Terjadi kesalahan saat menambahkan pasien.';
                return redirect()->back()
                    ->withErrors(['api' => $errorMessage])
                    ->withInput();
            }

            return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['exception' => $e->getMessage()])
                ->withInput();
        }
    }

    public function edit($id)
    {
        $response = Http::get("{$this->apiBase}/$id");

        if ($response->successful()) {
            $pasien = $response->json()['data'];
            return view('admin.pasien.edit', compact('pasien'));
        }

        return redirect()->route('admin.pasien.index')->withErrors('Gagal mengambil data pasien.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        ]);

        try {
            $response = Http::asJson()->put("{$this->apiBase}/update/{$id}", $validated);

            if ($response->failed()) {
                $errorMessage = $response->json('message') ?? 'Gagal memperbarui data pasien.';
                return redirect()->back()
                    ->withErrors(['api' => $errorMessage])
                    ->withInput();
            }

            return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['exception' => $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $response = Http::delete("{$this->apiBase}/delete/{$id}");

            if ($response->failed()) {
                $errorMessage = $response->json('message') ?? 'Gagal menghapus pasien.';
                return redirect()->back()->withErrors(['api' => $errorMessage]);
            }

            return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['exception' => $e->getMessage()]);
        }
    }
}
