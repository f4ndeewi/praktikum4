@extends('layouts.app')
@section('title', 'Berita Desa')

@section('content')
<div class="row g-4">

    {{-- Sidebar filter --}}
    <div class="col-lg-3">
        <div class="card border-0 shadow-sm sticky-top" style="top:80px;border-radius:12px;overflow:hidden">
            <div class="card-header text-white fw-bold" style="background:#0f3460">
                <i class="fas fa-filter me-2"></i> Filter Berita
            </div>
            <div class="card-body p-3">
                <form method="GET" action="{{ route('berita.index') }}">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Kata Kunci</label>
                        <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Cari berita...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Kategori</label>
                        <select name="kategori" class="form-select form-select-sm">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoriList as $k)
                                <option value="{{ $k }}" @selected(request('kategori') == $k)>{{ $k }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                        <a href="{{ route('berita.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                    </div>
                </form>

                {{-- LOKASI 1: Tombol Tambah Berita --}}
                @if (request()->has('admin'))
                    <a href="{{ route('berita.create') }}" class="btn btn-sm btn-success w-100 mt-3">+ Tambah Berita</a>
                @endif
            </div>
        </div>
    </div>

    {{-- Daftar berita --}}
    <div class="col-lg-9">
        @if ($beritas->count())
            <div class="row g-4">
                @foreach ($beritas as $berita)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up">
                        <div class="card border-0 shadow-sm h-100" style="border-radius:12px;overflow:hidden;transition:transform 0.3s,box-shadow 0.3s"
                             onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 30px rgba(0,0,0,0.15)'"
                             onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
                            <div style="height:160px;overflow:hidden">
                                <img src="{{ $berita->gambar_url }}" class="w-100 h-100" style="object-fit:cover;transition:transform 0.4s"
                                     onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'"
                                     alt="{{ $berita->judul }}"
                                     onerror="this.onerror=null;this.src='https://placehold.co/400x220?text=Berita+Desa'">
                            </div>
                            <div class="card-body p-3 d-flex flex-column">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge text-white" style="background:#0f3460;font-size:0.7rem">{{ $berita->kategori }}</span>
                                    <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>{{ $berita->tanggal->translatedFormat('j M Y') }}</small>
                                </div>
                                <h6 class="fw-bold mb-2" style="line-height:1.3;flex:1">
                                    <a href="{{ route('berita.show', $berita) }}" class="text-decoration-none text-dark">{{ Str::limit($berita->judul, 70) }}</a>
                                </h6>
                                <p class="text-muted small mb-2">{{ Str::limit(strip_tags($berita->isi), 90) }}</p>

                                @if (!empty($berita->tags))
                                    <div class="mb-3">
                                        @foreach (array_slice($berita->tags, 0, 3) as $tag)
                                            <a href="#" class="badge bg-light text-secondary border me-1 text-decoration-none small fw-normal" style="font-size:0.68rem">#{{ $tag }}</a>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                    <small class="text-muted"><i class="fas fa-eye me-1"></i>{{ number_format($berita->dilihat) }}</small>
                                    <a href="{{ route('berita.show', $berita) }}" class="btn btn-sm btn-outline-primary" style="font-size:0.75rem">Baca <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>

                                {{-- LOKASI 2: Tombol Edit & Hapus --}}
                                @if (request()->has('admin'))
                                    <div class="mt-2 pt-2 border-top d-flex gap-2">
                                        <a href="{{ route('berita.edit', $berita) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <form action="{{ route('berita.destroy', $berita) }}" method="POST" onsubmit="return confirm('Yakin hapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $beritas->links() }}
            </div>
        @else
            <p class="text-muted">Berita tidak ditemukan.</p>
        @endif
    </div>
</div>
@endsection