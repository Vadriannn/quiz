<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // <-- Pastikan ini ada (bawaan)
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function tampil()
    {
        $barangs = DB::table('barangs')
            ->leftJoin('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
            ->select('barangs.*', 'kategoris.nama as nama_kategori')
            ->orderBy('barangs.id', 'desc')
            ->get();

        return view('barang.daftar', ['barangs' => $barangs]);
    }

    public function create()
    {
        $kategoris = DB::table('kategoris')->get();
        
        return view('barang.create', ['kategoris' => $kategoris]);
    }

    public function simpan(Request $request)
    {
        DB::table('barangs')->insert([
            'nama'        => $request->nama,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'kategori_id' => $request->kategori_id,
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        return redirect('/daftar-barang');
    }

    public function hapus($id)
    {
        DB::table('barangs')->where('id', $id)->delete();
        return redirect('/daftar-barang');
    }

    public function ubah($id)
    {
        $barang = DB::table('barangs')->where('id', $id)->first();
        $kategoris = DB::table('kategoris')->get();
        return view('barang.ubah', ['barang' => $barang, 'kategoris' => $kategoris]);
    }

    public function update(Request $request, $id)
    {
        DB::table('barangs')->where('id', $id)->update([
            'nama'        => $request->nama,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'kategori_id' => $request->kategori_id,
            'updated_at'  => now()
        ]);

        return redirect('/daftar-barang');
    }
}
