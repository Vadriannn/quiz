<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
</head>
<body>
    <h1>Tambah Barang Baru</h1>

    <!-- Action mengarah ke route "/simpan-barang" menggunakan metode POST -->
    <form action="{{ url('/simpan-barang') }}" method="POST">
        <!-- Wajib menambahkan csrf untuk keamanan form di Laravel -->
        @csrf 

        <table> 
            <tr> 
                <td>Nama Barang:</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr> 
                <td>Harga:</td>
                <td><input type="number" name="harga" required></td>
            </tr>
            <tr> 
                <td>Stok:</td>
                <td><input type="number" name="stok" required></td>
            </tr>
            <tr> 
                <td>Kategori:</td>
                <td>
                    <!-- Kita gunakan dropdown (select) agar user tinggal pilih kategori yang ada -->
                    <select name="kategori_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr> 
                <td colspan="2" align="center">
                    <br>
                    <button type="submit">Simpan Barang</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
