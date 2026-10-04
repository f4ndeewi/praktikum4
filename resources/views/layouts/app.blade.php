<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Berita Desa') — Jalatrang</title>
    <meta name="description" content="Kumpulan berita dan informasi terkini dari Desa Jalatrang">
    <link rel="shortcut icon" href="https://jalatrang.id/favicon.png" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@400;500;600;700&display=swap" rel="stylesheet">
    {{-- CSS bawaan website asli; harus di atas layout-desa.css --}}
    <link rel="stylesheet" href="https://jalatrang.id/assets/template/css/custom_style.css">
    <link rel="stylesheet" href="{{ asset('css/layout-desa.css') }}">
    <style>.teko { font-family:'Teko',sans-serif; }</style>
</head>
<body>

@php
    $logo     = 'https://jalatrang.id/assets/images/info_desa/logo.png';
    $logoAlt  = 'https://jalatrang.id/assets/template/img/logo_ciamis.png';
    $menu = [
        ['Profil', null, false, ['VISI','MISI','Sejarah','Struktural']],
        ['Kependudukan', '#', false, []],
        ['Berita', route('berita.index'), true, []],
        ['Potensi Wisata', '#', false, []],
        ['IDM & SDGs', null, false, ['IDM','SDGs']],
        ['Ketahanan Pangan', null, false, ['Statistik','Galeri','Top 10']],
        ['Keuangan', null, false, ['APBdes','PBB','Kegiatan']],
        ['Download', null, false, ['Regulasi','Materi']],
    ];
    // [kelas item, kelas ikon, ikon, judul, kelas badge, teks badge, deskripsi, target]
    $drawer = [
        ['section' => 'Ekonomi & Belanja Warga', 'icon' => 'fa-store text-success'],
        ['item-warung','icon-warung','fa-store','Warung Desa','bg-success bg-opacity-25 text-success rounded-pill font-monospace','PASAR','Katalog produk UMKM & hasil tani warga',''],
        ['item-cart','icon-cart','fa-cart-shopping','Keranjang Belanja','bg-secondary bg-opacity-25 text-white-50 rounded-pill','0 Item','Periksa daftar belanjaan & checkout',''],
        ['item-kopdes','icon-kopdes','fa-building-columns','Kopdes Merah Putih','bg-danger bg-opacity-25 text-danger rounded-pill font-monospace','KOPDES','Layanan simpan pinjam & ekonomi warga',''],
        ['section' => 'Literasi & Prestasi', 'icon' => 'fa-book-open-reader text-info'],
        ['item-perpus','icon-perpus','fa-book-open-reader','Perpustakaan Desa','bg-info bg-opacity-25 text-info rounded-pill font-monospace','LITERASI','Katalog buku fisik, e-library & pustaka',''],
        ['item-prestasi','icon-prestasi','fa-trophy','Prestasi Desa','bg-warning bg-opacity-25 text-warning rounded-pill font-monospace','PRESTASI','Piagam, penghargaan & prestasi kebanggaan',''],
        ['section' => 'Layanan Mandiri & Admin', 'icon' => 'fa-shield-halved text-primary'],
        ['item-warga','icon-warga','fa-users','Warga Desa','bg-primary bg-opacity-25 text-info rounded-pill font-monospace','PORTAL','Layanan surat, belanjaan saya & profil',''],
        ['item-admin','icon-admin','fa-shield-halved','Admin Desa','bg-danger bg-opacity-25 text-danger rounded-pill font-monospace','ADMIN','Panel administrasi & tata kelola desa','_blank'],
    ];
    $medsos = [
        ['twitter/x','https://x.com','67ac8de22ae3b_1739361762.png'],
        ['facebook','https://facebook.com','67ac8dd784ead_1739361751.png'],
        ['youtube','https://www.youtube.com/@jalatrangTV','67ac8dee5976c_1739361774.png'],
        ['instagram','https://instagram.com/pemerintahdesajalatrang','67ac8e05b46f1_1739361797.png'],
    ];
@endphp

{{-- Preloader --}}
<div id="preloader">
    <div class="preloader-box">
        <div class="preloader-logo-wrapper">
            <img src="{{ $logo }}" class="preloader-logo" alt="Logo Jalatrang" onerror="this.src='{{ $logoAlt }}'">
        </div>
        <div class="preloader-spinner"></div>
        <div class="preloader-title">PEMERINTAH DESA JALATRANG</div>
        <div class="preloader-subtitle">Sedang memuat data...</div>
    </div>
</div>

{{-- Topbar --}}
<div class="topbar">
    <div class="container-fluid px-lg-4 px-3 d-flex align-items-center justify-content-between gap-3">
        <div class="d-flex align-items-center gap-2 overflow-hidden" style="flex:1">
            <span class="topbar-badge text-nowrap"><i class="fas fa-bullhorn me-1"></i> INFO TERKINI</span>
            <div class="news-flash-wrapper">
                <div class="news-flash-scroll">
                    @foreach ([
                        'Sekarang Anda dapat belanja langsung di Warung Desa yang merupakan Warung Online Masyarakat Desa Jalatrang.',
                        'Kini Hadir Perpustakaan Desa Selaras dengan wajah baru dan manjamen yang lebih baik',
                        'Warga bisa memeriksa langsung untuk memeriksa pembayaran PBB pada website',
                        'Desa Jalatrang akan membuka layanan public untuk mempermudah akses informasi dan pelayanan masyarakat',
                    ] as $info)
                        <span class="me-5 text-white-50"><i class="far fa-circle text-warning me-1" style="font-size:0.5rem"></i> {{ $info }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="d-none d-md-flex align-items-center gap-3 text-nowrap text-white-50" style="font-size:0.75rem">
            <span><i class="far fa-clock text-warning me-1"></i> {{ now()->translatedFormat('l, j F Y') }}</span>
        </div>
    </div>
</div>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-publik sticky-top" id="mainNav">
    <div class="container-fluid px-lg-4 px-3">
        <a class="navbar-brand d-flex align-items-center gap-2 brand-box text-decoration-none me-2" href="{{ route('berita.index') }}">
            <img src="{{ $logo }}" class="navbar-logo flex-shrink-0" alt="Logo Desa" onerror="this.src='{{ $logoAlt }}'">
            <div class="brand-desa-text text-white overflow-hidden" style="min-width:0;">
                <div class="fw-bold teko text-truncate" style="font-size:1.35rem;line-height:1;color:#fff">PEMERINTAH DESA JALATRANG</div>
                <div class="sub text-white-50 text-truncate d-none d-sm-block" style="font-size:0.65rem;letter-spacing:0.05em">KECAMATAN CIPAKU KABUPATEN CIAMIS</div>
            </div>
        </a>

        <div class="navbar-action-group d-flex flex-row align-items-center flex-nowrap gap-2 ms-auto flex-shrink-0 order-lg-last">
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasPubMain" aria-controls="offcanvasPubMain" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter:invert(1)"></span>
            </button>
            <button class="btn btn-top-layanan-grid position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSideMenu" aria-controls="offcanvasSideMenu" title="Menu Layanan & Toko Desa">
                <span class="grid-icon-wrap"><i class="bi bi-grid-3x3-gap-fill text-warning"></i></span>
            </button>
        </div>

        <div class="offcanvas offcanvas-start offcanvas-lg text-bg-dark border-end-0" tabindex="-1" id="offcanvasPubMain" aria-labelledby="offcanvasPubMainLabel">
            <div class="offcanvas-header border-bottom border-white-10 p-3 d-lg-none">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ $logo }}" class="navbar-logo" alt="Logo Desa" onerror="this.src='{{ $logoAlt }}'">
                    <div>
                        <div class="fw-bold teko text-white" style="font-size:1.3rem;line-height:1">DESA JALATRANG</div>
                        <small class="text-warning small fw-bold" style="letter-spacing:0.05em">PANEL MENU UTAMA</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-3 p-lg-0">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item mb-1 mb-lg-0">
                        <a class="nav-link nav-home-pill " href="#" title="Beranda">
                            <i class="fas fa-home me-2 me-lg-0"></i><span class="d-inline d-lg-none fw-bold ms-1">Beranda</span>
                        </a>
                    </li>
                    @foreach ($menu as [$label, $url, $aktif, $anak])
                        @if ($anak)
                            <li class="nav-item dropdown mb-1 mb-lg-0">
                                <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">{{ $label }}</a>
                                <ul class="dropdown-menu">
                                    @foreach ($anak as $a)
                                        <li>
                                            <a class="dropdown-item " href="#">
                                                <i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i> {{ $a }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="nav-item mb-1 mb-lg-0">
                                <a class="nav-link {{ $aktif ? 'active' : '' }}" href="{{ $url }}">{{ $label }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</nav>

{{-- Drawer kanan: Layanan & Toko Desa --}}
<div class="offcanvas offcanvas-end text-bg-dark border-0" tabindex="-1" id="offcanvasSideMenu" aria-labelledby="offcanvasSideMenuLabel">
    <div class="offcanvas-header border-bottom border-white-10 p-3" style="background: rgba(15, 23, 42, 0.95);">
        <div class="d-flex align-items-center gap-2">
            <div class="rounded-circle d-flex align-items-center justify-content-center text-warning" style="width: 38px; height: 38px; background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.35);">
                <i class="bi bi-grid-3x3-gap-fill fs-5"></i>
            </div>
            <div>
                <h6 class="fw-bold text-white mb-0" id="offcanvasSideMenuLabel" style="font-size: 0.95rem;">Layanan & Toko Desa</h6>
                <small class="text-white-50" style="font-size: 0.72rem;">Portal Digital Desa Jalatrang</small>
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-3 d-flex flex-column justify-content-between">
        <div class="d-flex flex-column gap-3">
            @foreach ($drawer as $i => $d)
                @if (isset($d['section']))
                    <div class="drawer-section-title {{ $i > 0 ? 'mt-1' : '' }}">
                        <i class="fa-solid {{ $d['icon'] }} me-1"></i> {{ $d['section'] }}
                    </div>
                @else
                    <a href="#" @if ($d[7]) target="{{ $d[7] }}" @endif class="quick-card-item {{ $d[0] }}">
                        <div class="quick-card-icon {{ $d[1] }}"><i class="fa-solid {{ $d[2] }}"></i></div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <span class="fw-bold text-white" style="font-size: 0.88rem;">{{ $d[3] }}</span>
                                <span class="badge {{ $d[4] }}" style="font-size: 0.65rem;">{{ $d[5] }}</span>
                            </div>
                            <p class="text-white-50 mb-0 text-truncate" style="font-size: 0.75rem;">{{ $d[6] }}</p>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
        <div class="border-top border-white-10 pt-3 mt-3 text-center">
            <small class="text-white-50 d-block" style="font-size: 0.72rem;">
                <i class="fa-solid fa-store text-success me-1"></i> Pasar & Layanan Digital Desa Jalatrang
            </small>
        </div>
    </div>
</div>

{{-- Header gradasi + breadcrumb --}}
@hasSection('compact_hero')
<div style="background:linear-gradient(135deg,#0f3460,#1a1a6e);padding:50px 0 30px">
    <div class="container text-white">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="#" class="text-warning text-decoration-none">Beranda</a></li>
                @yield('crumbs')
            </ol>
        </nav>
    </div>
</div>
@else
<div style="background:linear-gradient(135deg,#0f3460,#1a1a6e);padding:60px 0 40px" class="mt-0">
    <div class="container text-white">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-warning text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item active text-white">Berita</li>
            </ol>
        </nav>
        <h1 class="teko fw-bold mb-0" style="font-size:2.5rem">@yield('hero_title', 'Berita & Informasi')</h1>
        <p style="opacity:0.7">@yield('hero_sub', 'Informasi terkini dari Desa Jalatrang')</p>
    </div>
</div>
@endif

<div class="container my-5">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('content')
</div>

{{-- Footer --}}
<footer class="footer-dark pt-5 pb-2 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ $logo }}" style="width:50px;height:50px;object-fit:contain" alt="Logo">
                    <div>
                        <div class="fw-bold text-white">PEMERINTAH DESA</div>
                        <div class="fw-bold text-warning" style="font-size:1.1rem">JALATRANG</div>
                    </div>
                </div>
                <p style="font-size:0.83rem;line-height:1.7">
                    Jalan Raya Cipaku Nomor 181<br>
                    Desa Jalatrang, Kecamatan Cipaku<br>
                    Kabupaten Ciamis<br>
                    <i class="fas fa-phone me-1"></i> 08<br>
                    <i class="fas fa-envelope me-1"></i> <a href="mailto:pemerintahdesajalatrang@gmail.com">pemerintahdesajalatrang@gmail.com</a>
                </p>
                <a href="https://www.google.com/maps/place/Jalatrang" target="_blank" class="btn btn-sm btn-outline-warning mt-1">
                    <i class="fas fa-map-marker-alt me-1"></i> Lihat Peta
                </a>
            </div>
            <div class="col-lg-2 col-6">
                <h5 class="mb-3">Menu</h5>
                <ul class="list-unstyled">
                    @foreach (['Beranda' => '#', 'Berita' => route('berita.index'), 'Struktural' => '#', 'APBDes' => '#', 'Prestasi' => '#'] as $n => $u)
                        <li class="mb-1"><a href="{{ $u }}"><i class="bi bi-chevron-right me-1"></i>{{ $n }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-3 col-6">
                <h5 class="mb-3">Link Terkait</h5>
                <ul class="list-unstyled">
                    <li class="mb-1"><a href="https://kemendesa.go.id" target="_blank"><i class="bi bi-box-arrow-up-right me-1"></i>Kemendesa</a></li>
                    <li class="mb-1"><a href="https://ciamis.go.id" target="_blank"><i class="bi bi-box-arrow-up-right me-1"></i>Kab. Ciamis</a></li>
                    <li class="mb-1"><a href="https://jabar.go.id" target="_blank"><i class="bi bi-box-arrow-up-right me-1"></i>Pemprov Jabar</a></li>
                    <li class="mb-1"><a href="#" target="_blank"><i class="bi bi-shield-lock me-1"></i>Panel Admin</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h5 class="mb-3">Media Sosial</h5>
                @foreach ($medsos as [$nama, $url, $img])
                    <a href="{{ $url }}" target="_blank" class="d-flex align-items-center gap-2 mb-2">
                        <img src="https://jalatrang.id/assets/images/medsos/{{ $img }}" style="width:22px;height:22px;object-fit:contain" alt="{{ $nama }}">
                        {{ $nama }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center mt-4 py-3">
        &copy; 2026 Pemerintah Desa Jalatrang — Semua hak dilindungi.
    </div>
</footer>

<button id="scrollTop" title="Ke atas"><i class="fas fa-chevron-up"></i></button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
// Preloader
const hidePreloader = () => {
    const loader = document.getElementById('preloader');
    if (loader && !loader.classList.contains('hidden')) {
        loader.classList.add('hidden');
        setTimeout(() => loader.remove(), 400);
    }
};
document.addEventListener('DOMContentLoaded', hidePreloader);
window.addEventListener('load', hidePreloader);
setTimeout(hidePreloader, 1200);

// AOS
AOS.init({ duration: 700, once: true });

// Efek navbar saat scroll
const nav = document.getElementById('mainNav');
const topbarEl = document.querySelector('.topbar');
const handleNavScroll = () => {
    if (!nav) return;
    const threshold = topbarEl ? topbarEl.offsetHeight : 35;
    if (window.scrollY >= threshold) nav.classList.add('is-sticky-fixed', 'scrolled');
    else nav.classList.remove('is-sticky-fixed', 'scrolled');
};
window.addEventListener('scroll', handleNavScroll);
document.addEventListener('DOMContentLoaded', handleNavScroll);
handleNavScroll();

// Tombol ke atas
const btn = document.getElementById('scrollTop');
window.addEventListener('scroll', () => btn.classList.toggle('visible', window.scrollY > 300));
btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

// Tooltip Bootstrap
document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));
</script>
@stack('scripts')
</body>
</html>
