@extends('layouts.app')

@section('title', 'Daftar Barang & Kategori · Adminator')
@section('active_page', 'barang')
@section('breadcrumbs', 'Data Master | Barang & Kategori')

@section('content')
<section class="hero">
    <div class="hero-text">
        <span class="eyebrow">
            {{ Auth::user()->isAdmin() ? 'Data Master · Barang' : 'Katalog Inventaris' }}
        </span>
        <h1 class="hero-title">Daftar Barang & Kategori</h1>
        <p class="hero-sub">
            @if(Auth::user()->isAdmin())
                Kelola data inventaris barang beserta kategorinya pada sistem.
            @else
                Daftar lengkap inventaris barang beserta kategori dan informasi ketersediaan stok.
            @endif
        </p>
    </div>
    @if(Auth::user()->isAdmin())
    <div class="hero-actions">
        <a href="{{ route('tambah-barang') }}" class="btn btn--primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14" />
            </svg>
            Tambah Barang
        </a>
    </div>
    @endif
</section>

@if(session('success'))
<div style="background: rgba(16, 185, 129, 0.1); border-left: 4px solid var(--success, #10b981); padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 13.5px; color: var(--success, #10b981);">
    {{ session('success') }}
</div>
@endif

<div class="grid">
    <section class="col-12 card">
        <div class="card-head">
            <div class="card-title-wrap">
                <h2 class="card-title">Semua Barang & Kategori</h2>
            </div>
            <span class="badge primary">{{ count($barangs) }} BARANG</span>
        </div>
        <div class="table-scroll">
            <table class="table">
                <thead>
                    <tr>
                        <th style="text-align:center">Nama Barang</th>
                        <th style="text-align:center">Kategori</th>
                        <th style="text-align:center">Harga</th>
                        <th style="text-align:center">Stok</th>
                        @if(Auth::user()->isAdmin())
                        <th style="text-align:center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangs as $barang) 
                    <tr>
                        <td class="cell-name">{{ $barang->nama }}</td>
                        <td style="text-align:center">
                            @if($barang->nama_kategori)
                                <span class="badge info">{{ $barang->nama_kategori }}</span>
                            @else
                                <span class="badge" style="background: rgba(100, 116, 139, 0.15); color: #94a3b8;">Tanpa Kategori</span>
                            @endif
                        </td>
                        <td style="text-align:center" class="cell-price">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                        <td style="text-align:center">
                            @if($barang->stok > 10)
                                <span class="badge success">{{ $barang->stok }}</span>
                            @elseif($barang->stok > 0)
                                <span class="badge warning">{{ $barang->stok }}</span>
                            @else
                                <span class="badge danger">Habis</span>
                            @endif
                        </td>
                        @if(Auth::user()->isAdmin())
                        <td style="text-align:center;">
                            <div style="display:flex; gap:10px; justify-content:center;">
                                <a href="{{ route('barang.ubah', $barang->id) }}" class="badge solid" style="text-decoration:none;">Ubah</a>
                                <form method="POST" action="{{ route('barang.hapus', $barang->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="badge danger" style="border:none; cursor:pointer;">Hapus</button> 
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ Auth::user()->isAdmin() ? 5 : 4 }}" style="text-align:center; padding: 24px; color: var(--t-muted);">
                            Belum ada data barang yang tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
