<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ObatController extends Controller
{
    private $apiBase = 'http://localhost:8080/api/obat';

    public function index()
    {
        $response = Http::get($this->apiBase);

        $data = $response->successful() ? $response->json() : [];
        if (!$response->successful()) {
            session()->flash('error', 'Gagal mengambil data obat dari API.');
        }

        return view('admin.obat.index', compact('data'));
    }

    public function create()
    {
        return view('admin.obat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_obat' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'stok' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        try {
            $response = Http::asJson()->post($this->apiBase . '/create', $validated);

            if ($response->failed()) {
                $errorMessage = $response->json('message') ?? 'Terjadi kesalahan saat menambahkan obat.';
                return redirect()->back()
                    ->withErrors(['api' => $errorMessage])
                    ->withInput();
            }

            return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil ditambahkan.');
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
            $obat = $response->json()['data'];
            return view('admin.obat.edit', compact('obat'));
        }

        return redirect()->route('admin.obat.index')->withErrors('Gagal mengambil data obat.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_obat' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'stok' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        try {
            $response = Http::asJson()->put("{$this->apiBase}/update/{$id}", $validated);

            if ($response->failed()) {
                $errorMessage = $response->json('message') ?? 'Gagal memperbarui data obat.';
                return redirect()->back()
                    ->withErrors(['api' => $errorMessage])
                    ->withInput();
            }

            return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil diperbarui.');
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
                $errorMessage = $response->json('message') ?? 'Gagal menghapus obat.';
                return redirect()->back()->withErrors(['api' => $errorMessage]);
            }

            return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['exception' => $e->getMessage()]);
        }
    }
}
