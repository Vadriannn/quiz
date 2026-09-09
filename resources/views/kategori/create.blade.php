@extends('layouts.app')

@section('title', 'Tambah Kategori · Adminator')
@section('active_page', 'kategori')
@section('breadcrumbs', 'Data Master | Kategori | Tambah')

@section('content')
<div class="grid">
    <section class="col-12 card">
        <div class="card-head">
            <div class="card-title-wrap">
                <span class="eyebrow">Data Master</span>
                <h2 class="card-title">Tambah Kategori</h2>
            </div>
        </div>
        <form method="POST" action="{{ route('kategori.simpan') }}">
            @csrf
            <div class="form-grid">
                <div class="field span-2">
                    <label class="field-label" for="nama">Nama Kategori <span class="req">*</span></label>
                    <input id="nama" name="nama" class="input" type="text" required>
                </div>
                <div class="field span-2">
                    <label class="field-label" for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" class="textarea" placeholder="Opsional..."></textarea>
                </div>
            </div>
            <div class="form-actions">
                <span class="spacer"></span>
                <a href="{{ route('daftar-kategori') }}" class="btn btn--ghost">Batal</a>
                <button type="submit" class="btn btn--primary">Simpan Kategori</button>
            </div>
        </form>
    </section>
</div>
@endsection