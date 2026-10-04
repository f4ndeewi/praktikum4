<div class="mb-3">
    <label for="judul" class="form-label fw-semibold">Judul</label>
    <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $berita->judul ?? '') }}">
    @error('judul') <div class="text-danger small">{{ $message }}</div> @enderror
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="kategori" class="form-label fw-semibold">Kategori</label>
        <select name="kategori" id="kategori" class="form-select">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategoriList as $k)
                <option value="{{ $k }}" @selected(old('kategori', $berita->kategori ?? '') == $k)>{{ $k }}</option>
            @endforeach
        </select>
        @error('kategori') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="penulis" class="form-label fw-semibold">Penulis</label>
        <input type="text" name="penulis" id="penulis" class="form-control" value="{{ old('penulis', $berita->penulis ?? 'Admin') }}">
        @error('penulis') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
</div>
<div class="mb-3">
    <label for="gambar" class="form-label fw-semibold">URL Gambar (opsional)</label>
    <input type="text" name="gambar" id="gambar" class="form-control" value="{{ old('gambar', $berita->gambar ?? '') }}">
    @error('gambar') <div class="text-danger small">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label for="tags" class="form-label fw-semibold">Tags (pisahkan dengan koma)</label>
    <input type="text" name="tags" id="tags" class="form-control" value="{{ old('tags', isset($berita) ? implode(', ', $berita->tags ?? []) : '') }}" placeholder="desa, jalatrang, voli">
</div>
<div class="mb-3">
    <label for="isi" class="form-label fw-semibold">Isi Berita (boleh tag &lt;p&gt;, &lt;h3&gt;, &lt;ul&gt;, &lt;li&gt;)</label>
    <textarea name="isi" id="isi" rows="8" class="form-control">{{ old('isi', $berita->isi ?? '') }}</textarea>
    @error('isi') <div class="text-danger small">{{ $message }}</div> @enderror
</div>
