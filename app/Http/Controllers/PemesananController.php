<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::with('barangs.barang')->get();
        return response()->json($pemesanans);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'pemesanan' => 'required|string|max:255',
            'detail_pemesanan' => 'required|string',
            'tanggal_pemesanan' => 'required|date',
            'unit' => 'required|integer',
            'pemesan' => 'sometimes|string',
        ]);

        $pemesanan = Pemesanan::create($request->all());
        return response()->json($pemesanan, 201);
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        return response()->json($pemesanan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'pemesanan' => 'sometimes|string|max:255',
            'detail_pemesanan' => 'sometimes|string',
            'pemesan' => 'sometimes|string',
            'tanggal_pemesanan' => 'sometimes|date',
            'unit' => 'sometimes|integer',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update($request->all());
        return response()->json($pemesanan);
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();
        return response()->json(null, 204);
    }
}
