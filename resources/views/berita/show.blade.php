@extends('layouts.app')
@section('title', $berita->judul)
@section('compact_hero', '1')
@section('crumbs')
    <li class="breadcrumb-item"><a href="{{ route('berita.index') }}" class="text-warning text-decoration-none">Berita</a></li>
    <li class="breadcrumb-item active text-white">Detail</li>
@endsection

@section('content')
@php
    $urlBerita = urlencode(url()->current());
    $judulUrl  = urlencode($berita->judul);
    $a = 10; $b = 2;
@endphp
<div class="row g-4">

    {{-- Kolom utama --}}
    <div class="col-lg-8">
        <article class="card border-0 shadow-sm" style="border-radius:14px;overflow:hidden">
            <img src="{{ $berita->gambar_url }}" class="card-img-top" style="height:380px;object-fit:cover"
                 alt="{{ $berita->judul }}"
                 onerror="this.onerror=null;this.src='https://placehold.co/800x380?text=Berita+Desa'">

            <div class="card-body p-4">
                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                    <span class="badge text-white" style="background:#0f3460">{{ $berita->kategori }}</span>
                    <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>{{ $berita->tanggal->translatedFormat('l, j F Y') }}</small>
                    <small class="text-muted"><i class="fas fa-user me-1"></i>{{ $berita->penulis }}</small>
                    <small class="text-muted"><i class="fas fa-eye me-1"></i>{{ number_format($berita->dilihat) }} dibaca</small>
                </div>

                <h1 class="teko fw-bold mb-4" style="font-size:clamp(1.5rem,3vw,2.2rem);line-height:1.2">{{ $berita->judul }}</h1>

                {{-- isi disimpan sebagai HTML; input dari form sudah difilter strip_tags di controller --}}
                <div class="article-body" style="font-size:1rem;line-height:1.85;color:#333">{!! $berita->isi !!}</div>

                @if (!empty($berita->tags))
                    <div class="mt-4 pt-3 border-top">
                        <span class="fw-semibold text-muted small me-2"><i class="fas fa-tags me-1"></i>Tags:</span>
                        @foreach ($berita->tags as $tag)
                            <a href="#" class="badge bg-light text-dark border me-1 text-decoration-none px-2.5 py-1.5 rounded-pill fw-normal mb-1">#{{ $tag }}</a>
                        @endforeach
                    </div>
                @endif

                <div class="mt-4 pt-3 border-top">
                    <span class="fw-semibold me-3 small">Bagikan:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $urlBerita }}" target="_blank" class="btn btn-sm me-1" style="background:#1877f2;color:#fff"><i class="fab fa-facebook-f me-1"></i>Facebook</a>
                    <a href="https://twitter.com/intent/tweet?url={{ $urlBerita }}&text={{ $judulUrl }}" target="_blank" class="btn btn-sm me-1" style="background:#1da1f2;color:#fff"><i class="fab fa-twitter me-1"></i>Twitter</a>
                    <a href="https://wa.me/?text={{ $judulUrl }}%20{{ $urlBerita }}" target="_blank" class="btn btn-sm me-1" style="background:#25d366;color:#fff"><i class="fab fa-whatsapp me-1"></i>WhatsApp</a>
                </div>
            </div>
        </article>

        {{-- Komentar (tampilan saja; fitur komentar di luar cakupan praktikum ini) --}}
        <div class="card border-0 shadow-sm mt-4 p-4" id="komentar" style="border-radius:14px">
            <h4 class="fw-bold mb-4 teko" style="font-size:1.6rem;color:#0f3460">
                <i class="fas fa-comments me-2 text-warning"></i> Komentar (0)
            </h4>

            <div class="bg-light p-3 rounded-3 mb-4 border">
                <h6 class="fw-bold mb-3"><i class="fas fa-edit me-1"></i> Tulis Komentar Anda:</h6>
                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Fitur komentar tidak termasuk praktikum ini.');">
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted mb-1">Nama Lengkap *</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Nama Anda" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted mb-1">Alamat Email * <span class="badge bg-secondary" style="font-size:0.6rem">Privat</span></label>
                            <input type="email" class="form-control form-control-sm" placeholder="nama@email.com" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted mb-1">Nomor HP * <span class="badge bg-secondary" style="font-size:0.6rem">Privat</span></label>
                            <input type="tel" class="form-control form-control-sm" placeholder="08xxxxxxxxxx" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted mb-1">Pesan Komentar *</label>
                        <textarea id="commentMessage" class="form-control" rows="3" placeholder="Tuliskan masukan atau komentar Anda..." required></textarea>
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <small class="text-muted" style="font-size:0.75rem">Dilarang menggunakan kata kasar / ujaran kebencian.</small>
                            <small id="charCount" class="text-muted" style="font-size:0.75rem">300 karakter tersisa</small>
                        </div>
                    </div>

                    <div class="mb-3 p-2 rounded-3 bg-white border">
                        <label class="form-label small fw-semibold text-dark mb-1">
                            <i class="fas fa-shield-alt text-primary me-1"></i> Pertanyaan Keamanan (Captcha Anti-Bot) *
                        </label>
                        <div class="d-flex align-items-center gap-2">
                            <div class="badge bg-primary text-white p-2 font-monospace fs-6 shadow-sm d-flex align-items-center gap-1">
                                <span>{{ $a }} + {{ $b }}</span> = ?
                            </div>
                            <input type="number" class="form-control form-control-sm" style="max-width:130px" placeholder="Jawaban" required>
                            <button type="button" class="btn btn-sm btn-outline-secondary" title="Hitung Soal Baru"><i class="fas fa-sync-alt"></i></button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm text-white px-4 fw-semibold" style="background:#0f3460;border-color:#0f3460">
                        <i class="fas fa-paper-plane me-1"></i> Kirim Komentar
                    </button>
                </form>
            </div>

            <div class="comment-list">
                <div class="text-center py-4 text-muted">
                    <i class="far fa-comments fa-2x mb-2 opacity-50"></i>
                    <p class="mb-0 small">Belum ada komentar. Jadilah yang pertama memberikan masukan!</p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('berita.index') }}" class="btn btn-outline-primary"><i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar</a>
        </div>
    </div>

    {{-- Sidebar: Berita Terkait --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="top:80px;border-radius:12px;overflow:hidden">
            <div class="card-header text-white fw-bold" style="background:#0f3460">
                <i class="fas fa-newspaper me-2"></i> Berita Terkait
            </div>
            <div class="card-body p-3">
                @forelse ($terkait as $t)
                    <div class="d-flex gap-3 mb-3 pb-3 border-bottom">
                        <img src="{{ $t->gambar_url }}" style="width:72px;height:56px;object-fit:cover;border-radius:6px;flex-shrink:0"
                             alt="{{ $t->judul }}" onerror="this.onerror=null;this.src='https://placehold.co/72x56'">
                        <div>
                            <a href="{{ route('berita.show', $t) }}" class="text-decoration-none text-dark fw-semibold" style="font-size:0.83rem;line-height:1.3">{{ Str::limit($t->judul, 65) }}</a>
                            <div class="text-muted mt-1" style="font-size:0.75rem">
                                <i class="fas fa-calendar-alt me-1"></i>{{ $t->tanggal->translatedFormat('j M Y') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted small mb-0">Belum ada berita terkait.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Penghitung karakter komentar (sama seperti website asli)
    const msgInput = document.getElementById('commentMessage');
    const charCount = document.getElementById('charCount');
    msgInput.addEventListener('input', function () {
        if (this.value.length > 300) this.value = this.value.substring(0, 300);
        const sisa = 300 - this.value.length;
        charCount.textContent = sisa + ' karakter tersisa';
        charCount.style.color = sisa <= 50 ? 'red' : '#6c757d';
    });
</script>
@endpush
