<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    private array $kategoriList = [
        'ekonomi', 'keuangan', 'kunjungan', 'Olahraga', 'pembangunan', 'pemuda',
        'Pendidikan', 'potensi', 'Prestasi dan Apresiasi', 'tidak memiliki kategori',
    ];

    public function index(Request $request)
    {
        $beritas = Berita::query()
            ->when($request->q, fn ($q, $k) => $q->where('judul', 'like', "%{$k}%"))
            ->when($request->kategori, fn ($q, $k) => $q->where('kategori', $k))
            ->orderByDesc('tanggal')->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return view('berita.index', [
            'beritas'      => $beritas,
            'kategoriList' => $this->kategoriList,
        ]);
    }

    public function create()
    {
        return view('berita.create', ['kategoriList' => $this->kategoriList]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'    => 'required|max:255|unique:beritas,judul',
            'kategori' => 'required',
            'penulis'  => 'required|max:100',
            'gambar'   => 'nullable|url',
            'tags'     => 'nullable|string',
            'isi'      => 'required|min:10',
        ]);

        $data['slug']    = Str::slug($data['judul']);
        $data['tags']    = $this->pecahTags($data['tags'] ?? null);
        $data['tanggal'] = now()->toDateString();
        $data['isi']     = strip_tags($data['isi'], '<p><h3><ul><li><strong><em><br>');

        Berita::create($data);

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function show(Berita $berita)
    {
        $berita->increment('dilihat');

        $terkait = Berita::where('id', '!=', $berita->id)
            ->orderByRaw('kategori = ? desc', [$berita->kategori])
            ->latest('tanggal')
            ->take(5)->get();

        return view('berita.show', compact('berita', 'terkait'));
    }

    public function edit(Berita $berita)
    {
        return view('berita.edit', ['berita' => $berita, 'kategoriList' => $this->kategoriList]);
    }

    public function update(Request $request, Berita $berita)
    {
        $data = $request->validate([
            'judul'    => 'required|max:255',
            'kategori' => 'required',
            'penulis'  => 'required|max:100',
            'gambar'   => 'nullable|url',
            'tags'     => 'nullable|string',
            'isi'      => 'required|min:10',
        ]);

        $data['tags'] = $this->pecahTags($data['tags'] ?? null);
        $data['isi']  = strip_tags($data['isi'], '<p><h3><ul><li><strong><em><br>');

        $berita->update($data);

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    private function pecahTags(?string $tags): array
    {
        return collect(explode(',', (string) $tags))
            ->map(fn ($t) => trim(ltrim(trim($t), '#')))
            ->filter()->values()->all();
    }
}
