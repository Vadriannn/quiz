@extends('layouts.app')

@section('title', 'Daftar Barang · Adminator')
@section('active_page', 'barang')
@section('breadcrumbs', 'Data Master | Barang')

@section('content')
<section class="hero">
    <div class="hero-text">
        <span class="eyebrow">Data Master · Barang</span>
        <h1 class="hero-title">Daftar Barang</h1>
        <p class="hero-sub">Kelola data inventaris barang pada sistem.</p>
    </div>
    <div class="hero-actions">
        <a href="{{ route('tambah-barang') }}" class="btn btn--primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14" />
            </svg>
            Tambah Barang
        </a>
    </div>
</section>

<div class="grid">
    <section class="col-12 card">
        <div class="card-head">
            <div class="card-title-wrap">
                <h2 class="card-title">Semua Barang</h2>
            </div>
            <span class="badge primary">{{ count($barangs) }} BARANG</span>
        </div>
        <div class="table-scroll">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th style="text-align:right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $barang) 
                    <tr>
                        <td class="cell-name">{{ $barang->nama }}</td>
                        <td class="cell-price">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                        <td>
                            @if($barang->stok > 10)
                                <span class="badge success">{{ $barang->stok }}</span>
                            @elseif($barang->stok > 0)
                                <span class="badge warning">{{ $barang->stok }}</span>
                            @else
                                <span class="badge danger">Habis</span>
                            @endif
                        </td>
                        <td style="text-align:right;">
                            <div style="display:flex; gap:10px; justify-content:flex-end;">
                                <a href="{{ route('barang.ubah', $barang->id) }}" class="badge solid" style="text-decoration:none;">Ubah</a>
                                <form method="POST" action="{{ route('barang.hapus', $barang->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');" style="margin:0;">
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
