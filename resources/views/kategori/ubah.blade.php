@extends('layouts.app')

@section('title', 'Ubah Kategori · Adminator')
@section('active_page', 'kategori')
@section('breadcrumbs', 'Data Master | Kategori | Ubah')

@section('content')
<div class="grid">
    <section class="col-12 card">
        <div class="card-head">
            <div class="card-title-wrap">
                <span class="eyebrow">Data Master</span>
                <h2 class="card-title">Ubah Kategori</h2>
            </div>
        </div>
        <form method="POST" action="{{ route('kategori.update', $kategori->id) }}">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="field span-2">
                    <label class="field-label" for="nama">Nama Kategori <span class="req">*</span></label>
                    <input id="nama" name="nama" class="input" type="text" value="{{ $kategori->nama }}" required>
                </div>
                <div class="field span-2">
                    <label class="field-label" for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="textarea">{{ $kategori->deskripsi }}</textarea>
                </div>
            </div>
            <div class="form-actions">
                <span class="spacer"></span>
                <a href="{{ route('daftar-kategori') }}" class="btn btn--ghost">Batal</a>
                <button type="submit" class="btn btn--primary">Simpan Perubahan</button>
            </div>
        </form>
    </section>
</div>
@endsection