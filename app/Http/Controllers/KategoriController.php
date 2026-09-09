<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
// use DB;

class KategoriController extends Controller
{
    public function tampil(Request $request)
    {
        $cari = $request->get('cari') ?? $request->get('q');
        $query = Kategori::query();

        if ($cari) {
            $query->where('nama', 'like', "%{$cari}%")
                  ->orWhere('deskripsi', 'like', "%{$cari}%");
        }

        $kategoris = $query->orderBy('id', 'asc')->get();
        return view('kategori.daftar', ['kategoris' => $kategoris, 'cari' => $cari]);
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function simpan(Request $request){
        $request->validate([
            'nama' => ['required', 'regex:/^[^0-9]+$/'],
        ], [    
            'nama.regex' => 'Nama kategori tidak boleh mengandung angka.',
            'nama.required' => 'Nama kategori harus diisi.'
        ]);

        $kategori = new Kategori;
        $kategori->nama = $request->get('nama');
        $kategori->deskripsi = $request->get('deskripsi');
        $kategori->save();

        return redirect('/daftar-kategori');
    }

    public function hapus(Kategori $kategori) {
        try {
            $kategori->delete();
            return redirect('/daftar-kategori')->with('success', 'Data kategori berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect('/daftar-kategori')->with('error', 'Kategori ini tidak dapat dihapus karena masih digunakan sebagai data induk (parent) oleh data barang.');
            }
            return redirect('/daftar-kategori')->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }

    public function ubah(Kategori $kategori) {
        return view('kategori.ubah', ['kategori' => $kategori]);
    }

     public function update(Request $request, Kategori $kategori) {
        $request->validate([
            'nama' => ['required', 'regex:/^[^0-9]+$/'],
        ], [
            'nama.regex' => 'Nama kategori tidak boleh mengandung angka.',
            'nama.required' => 'Nama kategori harus diisi.'
        ]);
        
        $kategori->nama = $request->get('nama');
        $kategori->deskripsi = $request->get('deskripsi');
        $kategori->save();
        
        return redirect('/daftar-kategori');
    }

}
