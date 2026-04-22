<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        // Mengambil data terbaru di atas
        $transaksi = Transaksi::orderBy('tanggal', 'desc')->get();

        // Memanggil file index.blade.php di dalam folder transaksi
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        // Memanggil file create.blade.php di dalam folder transaksi
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'keterangan' => 'required|string|max:255',
            'jumlah'     => 'required|integer',
            'jenis'      => 'required|in:masuk,keluar',
            'tanggal'    => 'required|date',
        ]);

        Transaksi::create($validated);

        return redirect()->route('transaksi.index')->with('success', 'Data transaksi berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Data berhasil dihapus!');
    }

    public function edit($id)
    {
        // Mengambil data tunggal berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // Mengirim variabel ke view transaksi/edit.blade.php
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'keterangan' => 'required|string|max:255',
            'jumlah'     => 'required|integer',
            'jenis'      => 'required|in:masuk,keluar',
            'tanggal'    => 'required|date',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($validated);

        return redirect()->route('transaksi.index')->with('success', 'Data transaksi berhasil diperbarui!');
    }
}
