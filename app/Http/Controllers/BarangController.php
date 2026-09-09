<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // <-- Pastikan ini ada (bawaan)
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function tampil(Request $request)
    {
        $cari = $request->get('cari') ?? $request->get('q');

        $query = DB::table('barangs')
            ->leftJoin('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
            ->select('barangs.*', 'kategoris.nama as nama_kategori')
            ->orderBy('barangs.id', 'desc');

        if ($cari) {
            $query->where(function ($q) use ($cari) {
                $q->where('barangs.nama', 'like', "%{$cari}%")
                  ->orWhere('kategoris.nama', 'like', "%{$cari}%");
            });
        }

        $barangs = $query->get();

        return view('barang.daftar', ['barangs' => $barangs, 'cari' => $cari]);
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
        try {
            DB::table('barangs')->where('id', $id)->delete();
            return redirect('/daftar-barang')->with('success', 'Data barang berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Error code 23000 / MySQL 1451: foreign key constraint fails
            if ($e->getCode() == 23000) {
                return redirect('/daftar-barang')->with('error', 'Barang ini tidak dapat dihapus karena masih digunakan sebagai data induk (parent) pada transaksi detail nota.');
            }
            return redirect('/daftar-barang')->with('error', 'Gagal menghapus barang: ' . $e->getMessage());
        }
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
