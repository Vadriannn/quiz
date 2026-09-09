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

@if(session('error'))
<div style="background: rgba(239, 68, 68, 0.1); border-left: 4px solid var(--danger, #ef4444); padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 13.5px; color: var(--danger, #ef4444); display: flex; align-items: center; gap: 10px;">
    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
    <div>{{ session('error') }}</div>
</div>
@endif

<div class="grid">
    <section class="col-12 card">
        <div class="card-head" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
            <div class="card-title-wrap">
                <h2 class="card-title">Semua Barang & Kategori</h2>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <form method="GET" action="{{ route('daftar-barang') }}" style="margin: 0;">
                    <div class="input-icon" style="width: 260px;">
                        <span class="ico">
                            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="7"/>
                                <path d="m21 21-4.3-4.3"/>
                            </svg>
                        </span>
                        <input id="tableSearch" name="cari" class="input" type="text" placeholder="Cari nama atau kategori..." value="{{ $cari ?? '' }}" style="padding-top: 6px; padding-bottom: 6px; font-size: 13px;">
                    </div>
                </form>
                <span class="badge primary" id="barangCountBadge">{{ count($barangs) }} BARANG</span>
            </div>
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
                            @if(!empty($barang->nama_kategori))
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('tableSearch');
    const countBadge = document.getElementById('barangCountBadge');
    const tbody = document.querySelector('.table tbody');
    if (!searchInput || !tbody) return;

    searchInput.addEventListener('input', function() {
        const term = searchInput.value.toLowerCase().trim();
        const rows = tbody.querySelectorAll('tr');
        let visibleCount = 0;

        rows.forEach(row => {
            if (row.id === 'noMatchRow' || row.querySelector('td[colspan]')) return;
            const text = row.textContent.toLowerCase();
            if (text.includes(term)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        let noMatch = document.getElementById('noMatchRow');
        if (visibleCount === 0 && rows.length > 0) {
            if (!noMatch) {
                noMatch = document.createElement('tr');
                noMatch.id = 'noMatchRow';
                noMatch.innerHTML = `<td colspan="{{ Auth::user()->isAdmin() ? 5 : 4 }}" style="text-align:center; padding: 24px; color: var(--t-muted);">Tidak ada barang yang cocok dengan pencarian "${term}".</td>`;
                tbody.appendChild(noMatch);
            } else {
                noMatch.style.display = '';
                noMatch.querySelector('td').innerText = `Tidak ada barang yang cocok dengan pencarian "${term}".`;
            }
        } else if (noMatch) {
            noMatch.style.display = 'none';
        }

        if (countBadge) {
            countBadge.innerText = `${visibleCount} BARANG`;
        }
    });
});
</script>
@endsection
