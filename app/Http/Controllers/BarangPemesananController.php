<?php

namespace App\Http\Controllers;

use App\Models\BarangPemesanan;
use Illuminate\Http\Request;

class BarangPemesananController extends Controller
{
    public function index()
    {
        $barangPemesanans = BarangPemesanan::all();
        return response()->json($barangPemesanans);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id',
            'id_pemesanan' => 'required|exists:pemesanans,id',
        ]);

        $barangPemesanan = BarangPemesanan::create($request->all());
        return response()->json($barangPemesanan, 201);
    }

    public function show($id)
    {
        $barangPemesanan = BarangPemesanan::findOrFail($id);
        return response()->json($barangPemesanan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_barang' => 'sometimes|exists:barangs,id',
            'id_pemesanan' => 'sometimes|exists:pemesanans,id',
        ]);

        $barangPemesanan = BarangPemesanan::findOrFail($id);
        $barangPemesanan->update($request->all());
        return response()->json($barangPemesanan);
    }

    public function destroy($id)
    {
        $barangPemesanan = BarangPemesanan::findOrFail($id);
        $barangPemesanan->delete();
        return response()->json(null, 204);
    }
}
