@extends('layouts.app')
@section('title', 'Tambah Berita')

@section('hero_title', 'Tambah Berita')
@section('hero_sub', 'Isi formulir untuk menambah berita baru')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-berita">
            <div class="filter-header"><i class="bi bi-plus-circle-fill me-1"></i> Tambah Berita</div>
            <div class="card-body">
                <form action="{{ route('berita.store') }}" method="POST">
                    @csrf
                    @include('berita._form')
                    <div class="d-flex gap-2 pt-2 border-top mt-3">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                        <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
