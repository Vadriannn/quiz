<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Kategori</title>
</head>
<body>
    <h1> Ubah Kategori</h1>
    <form method="POST" action="{{ url('/update-kategori', $kategori) }}">
        @csrf
        @method('PUT')
        <table> 
            <tr>
                <td>Nama: </td>
                <td> 
                    <input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}">
                    @error('nama')
                        <br><span style="color: red; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Deskripsi: </td>
                <td> <textarea name="deskripsi">{{ $kategori->deskripsi }} </textarea> </td>
            </tr>
            <tr>
                <td colspan="2" align = "center"> <input type="submit" value="Update"> </td>
            </tr>
        </table>
    </form>
</body>
</html>