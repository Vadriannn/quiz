<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Barang</title>
</head>
<body>
    <h1>Ubah Data Barang</h1>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
        @csrf 
        @method('PUT')

        <table> 
            <tr> 
                <td>Nama Barang:</td>
                <td><input type="text" name="nama" value="{{ $barang->nama }}" required></td>
            </tr>
            <tr> 
                <td>Harga:</td>
                <td><input type="number" name="harga" value="{{ (int)$barang->harga }}" required></td>
            </tr>
            <tr> 
                <td>Stok:</td>
                <td><input type="number" name="stok" value="{{ $barang->stok }}" required></td>
            </tr>
            <tr> 
                <td>Kategori:</td>
                <td>
                    <select name="kategori_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr> 
                <td colspan="2" align="center">
                    <br>
                    <button type="submit">Update Barang</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
