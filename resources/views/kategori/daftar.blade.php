@extends('layouts.app')

@section('title', 'Daftar Kategori · Adminator')
@section('active_page', 'kategori')
@section('breadcrumbs', 'Data Master | Kategori')

@section('content')
<section class="hero">
    <div class="hero-text">
        <span class="eyebrow">Data Master · Kategori</span>
        <h1 class="hero-title">Daftar Kategori</h1>
        <p class="hero-sub">Kelola data kategori barang pada sistem.</p>
    </div>
    <div class="hero-actions">
        <a href="{{ route('tambah-kategori') }}" class="btn btn--primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14" />
            </svg>
            Tambah Kategori
        </a>
    </div>
</section>

<div class="grid">
    <section class="col-12 card">
        <div class="card-head">
            <div class="card-title-wrap">
                <h2 class="card-title">Semua Kategori</h2>
            </div>
            <span class="badge primary">{{ count($kategoris) }} KATEGORI</span>
        </div>
        <div class="table-scroll">
            <table class="table">
                <thead>
                    <tr>
                        <th style = "text-align:center">Nama Kategori</th>
                        <th style = "text-align:center">Deskripsi</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategoris as $kategori) 
                    <tr>
                        <td class="cell-name">{{ $kategori->nama }}</td>
                        <td style = "text-align:center">{{ $kategori->deskripsi ?: '-' }}</td>
                        <td style="text-align:center;">
                            <div style="display:flex; gap:10px; justify-content:center;">
                                <a href="{{ route('kategori.ubah', $kategori) }}" class="badge solid" style="text-decoration:none;">Ubah</a>
                                <form method="POST" action="{{ route('kategori.hapus', $kategori) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="badge danger" style="border:none; cursor:pointer;">Hapus</button> 
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection