<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    // Hanya kolom di sini yang boleh diisi lewat create()/update() (mass assignment)
    protected $fillable = [
        'judul', 'slug', 'kategori', 'gambar', 'isi',
        'tags', 'penulis', 'dilihat', 'tanggal',
    ];

    protected $casts = [
        'tags'    => 'array',
        'tanggal' => 'date',
    ];

    // URL pakai slug, bukan id
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getGambarUrlAttribute(): string
    {
        if (! $this->gambar) {
            return 'https://placehold.co/400x220?text=Berita+Desa';
        }
        return str_starts_with($this->gambar, 'http')
            ? $this->gambar
            : asset('storage/' . $this->gambar);
    }
}
