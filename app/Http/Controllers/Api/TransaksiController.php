<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransaksiResources;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index() {
        $transaksi = Transaksi::latest()->get();
        return new TransaksiResources(true, 'List Data Transaksi', $transaksi);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'keterangan' => 'required',
            'jenis' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $transaksi = Transaksi::create($request->all());

        return new TransaksiResources(true, 'Data Transaksi Berhasil Ditambahkan!', $transaksi);
    }

    public function show($id) {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Data tidak ditemukan!'], 404);
        }

        return new TransaksiResources(true, 'Detail Data Transaksi!', $transaksi);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'keterangan' => 'required',
            'jenis' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Data tidak ditemukan!'], 404);
        }

        $transaksi->update($request->all());

        return new TransaksiResources(true, 'Data Transaksi Berhasil Diubah!', $transaksi);
    }

    public function destroy($id) {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Data tidak ditemukan!'], 404);
        }

        $transaksi->delete();

        return new TransaksiResources(true, 'Data Transaksi Berhasil Dihapus!', null);
    }
}
