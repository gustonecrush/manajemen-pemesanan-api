<?php

namespace App\Http\Controllers;

use App\Models\NotaJalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotaJalanController extends Controller
{
    public function index()
    {
        $notas = NotaJalan::all();
        return response()->json($notas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pemesanan' => 'required|exists:pemesanans,id',
            'nama' => 'required|string|max:255',
            'no_nota_jalan' => 'required|string|max:255',
            'part_number' => 'required|string|max:255',
            'kuantitas' => 'required|integer',
            'satuan' => 'required|integer',
            'harga_unit' => 'required|integer',
            'file' => 'required|file|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('nota_jalans', 'public');
            $requestData = $request->all();
            $requestData['file'] = $filePath;

            $nota = NotaJalan::create($requestData);
            return response()->json($nota, 201);
        }

        return response()->json(['error' => 'File upload failed'], 400);
    }

    public function show($id)
    {
        $nota = NotaJalan::findOrFail($id);
        return response()->json($nota);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pemesanan' => 'sometimes|exists:pemesanans,id',
            'nama' => 'sometimes|string|max:255',
            'no_nota_jalan' => 'sometimes|string|max:255',
            'part_number' => 'sometimes|string|max:255',
            'kuantitas' => 'sometimes|integer',
            'satuan' => 'sometimes|integer',
            'harga_unit' => 'sometimes|integer',
            'file' => 'sometimes|file|max:2048',
        ]);

        $nota = NotaJalan::findOrFail($id);
        $requestData = $request->all();

        if ($request->hasFile('file')) {
            if ($nota->file) {
                Storage::disk('public')->delete($nota->file);
            }

            $filePath = $request->file('file')->store('nota_jalans', 'public');
            $requestData['file'] = $filePath;
        }

        $nota->update($requestData);
        return response()->json($nota);
    }

    public function destroy($id)
    {
        $nota = NotaJalan::findOrFail($id);

        if ($nota->file) {
            Storage::disk('public')->delete($nota->file);
        }

        $nota->delete();
        return response()->json(null, 204);
    }
}
