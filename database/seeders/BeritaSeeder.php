<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        // ===== BERITA 1 =====
        $judul1 = 'Malam Penuh Gengsi Dimulai! 16 Tim Berebut Mahkota Juara di Ajang CVC Cup 2026 Desa Jalatrang';
        Berita::create([
            'judul'    => $judul1,
            'slug'     => Str::slug($judul1),
            'kategori' => 'Olahraga',
            'gambar'   => 'https://jalatrang.id/assets/images/web_berita/1790662317-whatsapp-image-2026-09-27-at-081321.jpeg',
            'tags'     => ['cikandung','dusun','2026','voli','desa','jalatrang','cipaku','hingga','kecamatan','malam'],
            'penulis'  => 'Dadi Haryadi',
            'dilihat'  => 319,
            'tanggal'  => '2026-09-26',
            'isi'      => file_get_contents(database_path('seeders/data/berita-1.html')),
        ]);

        // ===== BERITA 2 =====
        $judul2 = 'Pemerintah Desa Jalatrang Kukuhkan Desa Siaga TB, Perkuat Kolaborasi Lintas Sektor Basmi Tuberkulosis';
        Berita::create([
            'judul'    => $judul2,
            'slug'     => Str::slug($judul2),
            'kategori' => 'Pendidikan',
            'gambar'   => 'https://jalatrang.id/assets/images/web_berita/1790660451-whatsapp-image-2026-09-28-at-102755.jpeg',
            'tags'     => ['desa','jalatrang','siaga','serta','pemerintah','kesehatan','masyarakat','pembentukan','dihadiri','tingkat'],
            'penulis'  => 'Dadi Haryadi',
            'dilihat'  => 121,
            'tanggal'  => '2026-09-28',
            'isi'      => file_get_contents(database_path('seeders/data/berita-2.html')),
        ]);
    }
}
