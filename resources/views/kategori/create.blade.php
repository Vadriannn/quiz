<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Kategori</title>
</head>
<body>
    <h1>Tambah Kategori</h1>
    <form action="{{ url('/simpan-kategori') }}" method="post">
        @csrf
        <table> 
            <tr> 
                <td> Nama :</td>
                <td>
                    <input type="text" name="nama" value="{{ old('nama') }}">
                    @error('nama')
                        <br><span style="color: red; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr> 
                <td> Deskripsi :</td>
                <td><input type = "textarea" name = "deskripsi"> </td>
            </tr>
            <tr> 
                <td colspan = "2" align = "center"><input type="submit" value = "Simpan"></button></td>
            </tr>
        </table>
    </form>
</body>
</html>