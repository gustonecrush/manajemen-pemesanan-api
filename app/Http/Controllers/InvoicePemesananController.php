<?php

namespace App\Http\Controllers;

use App\Models\InvoicePemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicePemesananController extends Controller
{
    public function index()
    {
        $invoices = InvoicePemesanan::all();
        return response()->json($invoices);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pemesanan' => 'required|exists:pemesanans,id',
            'tanggal_invoice' => 'nullable|date',
            'file' => 'required|file|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('invoices', 'public');
            $requestData = $request->all();
            $requestData['file'] = $filePath;

            $invoice = InvoicePemesanan::create($requestData);
            return response()->json($invoice, 201);
        }

        return response()->json(['error' => 'File upload failed'], 400);
    }

    public function show($id)
    {
        $invoice = InvoicePemesanan::findOrFail($id);
        return response()->json($invoice);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pemesanan' => 'sometimes|exists:pemesanans,id',
            'tanggal_invoice' => 'sometimes|date',
            'file' => 'sometimes|file|max:2048',
        ]);

        $invoice = InvoicePemesanan::findOrFail($id);
        $requestData = $request->all();

        if ($request->hasFile('file')) {
            if ($invoice->file) {
                Storage::disk('public')->delete($invoice->file);
            }

            $filePath = $request->file('file')->store('invoices', 'public');
            $requestData['file'] = $filePath;
        }

        $invoice->update($requestData);
        return response()->json($invoice);
    }

    public function destroy($id)
    {
        $invoice = InvoicePemesanan::findOrFail($id);

        if ($invoice->file) {
            Storage::disk('public')->delete($invoice->file);
        }

        $invoice->delete();
        return response()->json(null, 204);
    }
}
