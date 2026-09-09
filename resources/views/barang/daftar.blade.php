<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
</head>
<body>
    <h1>Daftar Barang</h1>
    <table border="1">
        <tr>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th colspan="2">Aksi</th>
        </tr>
        
        <!-- Lakukan perulangan untuk setiap data barang -->
        @foreach($barangs as $barang)
        <tr>
            <td>{{ $barang->nama }}</td>
            <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
            <td align = "Center">{{ $barang->stok }}</td>
            <td>
                <form method="POST" action="{{ route('barang.hapus', $barang->id) }}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Hapus"/>
                </form>
            </td>
            <td>
                <a href="{{ route('barang.ubah', $barang->id) }}">Ubah</a>
            </td>
        </tr>
        @endforeach
    </table>
    <br>
    <a href = "{{ route('tambah-barang') }}">Tambah Barang</a>
</body>
</html>
