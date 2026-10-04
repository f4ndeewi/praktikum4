<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();      // dipakai di URL: /berita/{slug}
            $table->string('kategori');
            $table->string('gambar')->nullable();  // URL penuh atau path storage
            $table->longText('isi');
            $table->json('tags')->nullable();      // ["desa","jalatrang",...]
            $table->string('penulis')->default('Admin');
            $table->unsignedInteger('dilihat')->default(0);
            $table->date('tanggal');               // tanggal terbit
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
