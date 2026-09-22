<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublikasiController extends Controller
{
    public function index(Request $request)
    {
        $keyword = trim((string) $request->query('q', ''));
        $publikasi = Publikasi::query()
            ->when($keyword !== '', fn($query) => $query->where('judul', 'like', "%{$keyword}%"))
            ->orderByDesc('tanggal_rilis')->orderByDesc('no')->paginate(10)->withQueryString();

        return view('publikasi.index', compact('publikasi', 'keyword'));
    }

    public function create() { return view('publikasi.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal_rilis' => ['required', 'date'],
            'link' => ['nullable', 'url', 'max:1000'],
            'sampul' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $data['no'] = ((int) Publikasi::max('no')) + 1;
        $data['sampul'] = $request->hasFile('sampul')
            ? $request->file('sampul')->store('publikasi', 'public')
            : null;

        Publikasi::create($data);
        return redirect()->route('publikasi.index')->with('success', 'Publikasi berhasil ditambahkan.');
    }

    public function edit(Publikasi $publikasi) { return view('publikasi.edit', compact('publikasi')); }

    public function update(Request $request, Publikasi $publikasi)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal_rilis' => ['required', 'date'],
            'link' => ['nullable', 'url', 'max:1000'],
            'sampul' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        unset($data['sampul']);
        if ($request->hasFile('sampul')) {
            if ($publikasi->sampul) Storage::disk('public')->delete($publikasi->sampul);
            $data['sampul'] = $request->file('sampul')->store('publikasi', 'public');
        }

        $publikasi->update($data);
        return redirect()->route('publikasi.index')->with('success', 'Publikasi berhasil diperbarui.');
    }

    public function destroy(Publikasi $publikasi)
    {
        if ($publikasi->sampul) Storage::disk('public')->delete($publikasi->sampul);
        $publikasi->delete();
        return redirect()->route('publikasi.index')->with('success', 'Publikasi berhasil dihapus.');
    }
}
