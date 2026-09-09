@extends('layouts.app')

@section('title', 'Tambah Barang · Adminator')
@section('active_page', 'barang')
@section('breadcrumbs', 'Data Master | Barang | Tambah')

@section('content')
<div class="grid">
    <section class="col-12 card">
        <div class="card-head">
            <div class="card-title-wrap">
                <span class="eyebrow">Data Master</span>
                <h2 class="card-title">Tambah Barang</h2>
            </div>
        </div>
        <form method="POST" action="{{ route('barang.simpan') }}">
            @csrf
            <div class="form-grid">
                <div class="field">
                    <label class="field-label" for="nama">Nama Barang <span class="req">*</span></label>
                    <input id="nama" name="nama" class="input" type="text" required>
                </div>
                <div class="field">
                    <label class="field-label" for="kategori_id">Kategori <span class="req">*</span></label>
                    <select id="kategori_id" name="kategori_id" class="select" required>
                        <option value="" disabled selected>Pilih Kategori...</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label class="field-label" for="harga">Harga <span class="req">*</span></label>
                    <div class="input-icon">
                        <span class="ico" style="font-weight:bold;">Rp</span>
                        <input id="harga" name="harga" class="input" type="number" required>
                    </div>
                </div>
                <div class="field">
                    <label class="field-label" for="stok">Stok <span class="req">*</span></label>
                    <input id="stok" name="stok" class="input" type="number" required>
                </div>
            </div>
            <div class="form-actions">
                <span class="spacer"></span>
                <a href="{{ route('daftar-barang') }}" class="btn btn--ghost">Batal</a>
                <button type="submit" class="btn btn--primary">Simpan Barang</button>
            </div>
        </form>
    </section>
</div>
@endsection
