@extends('layouts.app')
@section('title', 'Edit Berita')

@section('hero_title', 'Edit Berita')
@section('hero_sub', 'Perbarui isi berita')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-berita">
            <div class="filter-header"><i class="bi bi-pencil-square me-1"></i> Edit Berita</div>
            <div class="card-body">
                <form action="{{ route('berita.update', $berita) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('berita._form')
                    <small class="text-muted"><i class="bi bi-eye"></i> Dibaca {{ $berita->dilihat }} kali • Terakhir diubah {{ $berita->updated_at->diffForHumans() }}</small>
                    <div class="d-flex gap-2 pt-2 border-top mt-3">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
                        <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
