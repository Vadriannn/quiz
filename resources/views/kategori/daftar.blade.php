@extends('layouts.app')

@section('title', 'Daftar Kategori · KnowHub')
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
        <div class="card-head" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
            <div class="card-title-wrap">
                <h2 class="card-title">Semua Kategori</h2>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <form method="GET" action="{{ route('daftar-kategori') }}" style="margin: 0;">
                    <div class="input-icon" style="width: 260px;">
                        <span class="ico">
                            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="7"/>
                                <path d="m21 21-4.3-4.3"/>
                            </svg>
                        </span>
                        <input id="kategoriSearch" name="cari" class="input" type="text" placeholder="Cari nama atau deskripsi..." value="{{ $cari ?? '' }}" style="padding-top: 6px; padding-bottom: 6px; font-size: 13px;">
                    </div>
                </form>
                <span class="badge primary" id="kategoriCountBadge">{{ count($kategoris) }} KATEGORI</span>
            </div>
        </div>
        <div class="table-scroll">
            <table class="table">
                <thead>
                    <tr>
                        <th style="text-align:center">Nama Kategori</th>
                        <th style="text-align:center">Deskripsi</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategoris as $kategori) 
                    <tr>
                        <td class="cell-name">{{ $kategori->nama }}</td>
                        <td style="text-align:center">{{ $kategori->deskripsi ?: '-' }}</td>
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
                    @empty
                    <tr>
                        <td colspan="3" style="text-align:center; padding: 24px; color: var(--t-muted);">
                            Belum ada data kategori yang tersedia.
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
    const searchInput = document.getElementById('kategoriSearch');
    const countBadge = document.getElementById('kategoriCountBadge');
    const tbody = document.querySelector('.table tbody');
    if (!searchInput || !tbody) return;

    searchInput.addEventListener('input', function() {
        const term = searchInput.value.toLowerCase().trim();
        const rows = tbody.querySelectorAll('tr');
        let visibleCount = 0;

        rows.forEach(row => {
            if (row.id === 'noMatchRowKategori' || row.querySelector('td[colspan]')) return;
            const text = row.textContent.toLowerCase();
            if (text.includes(term)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        let noMatch = document.getElementById('noMatchRowKategori');
        if (visibleCount === 0 && rows.length > 0) {
            if (!noMatch) {
                noMatch = document.createElement('tr');
                noMatch.id = 'noMatchRowKategori';
                noMatch.innerHTML = `<td colspan="3" style="text-align:center; padding: 24px; color: var(--t-muted);">Tidak ada kategori yang cocok dengan pencarian "${term}".</td>`;
                tbody.appendChild(noMatch);
            } else {
                noMatch.style.display = '';
                noMatch.querySelector('td').innerText = `Tidak ada kategori yang cocok dengan pencarian "${term}".`;
            }
        } else if (noMatch) {
            noMatch.style.display = 'none';
        }

        if (countBadge) {
            countBadge.innerText = `${visibleCount} KATEGORI`;
        }
    });
});
</script>
@endsection