<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDetail;
use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Http\Request;

class TransaksiDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksiDetails = TransaksiDetail::with(['transaksi', 'barang'])->get();
        return view('transaksi_details.index', compact('transaksiDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaksi_details.create', [
            'transaksi' => Transaksi::all(),
            'barang' => Barang::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah_barang' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
        ]);

        // Hitung harga_total
        $harga_total = $request->harga * $request->jumlah_barang;

        // Simpan transaksi detail
        TransaksiDetail::create([
            'transaksi_id' => $validated['transaksi_id'],
            'barang_id' => $validated['barang_id'],
            'jumlah_barang' => $validated['jumlah_barang'],
            'harga' => $validated['harga'],
            'harga_total' => $harga_total,
        ]);

        return redirect()->route('transaksi-details.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $transaksiDetail = TransaksiDetail::find($id);

        if (!$transaksiDetail) {
            return redirect()->route('transaksi-details.index')->with('error', 'Transaksi Detail not found');
        }

        return view('transaksi_details.edit', compact('transaksiDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah_barang' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
        ]);

        $transaksiDetail = TransaksiDetail::find($id);

        if (!$transaksiDetail) {
            return redirect()->route('transaksi-details.index')->with('error', 'Transaksi Detail not found');
        }

        // Hitung harga_total
        $harga_total = $request->harga * $request->jumlah_barang;

        // Update transaksi detail
        $transaksiDetail->update([
            'transaksi_id' => $validated['transaksi_id'],
            'barang_id' => $validated['barang_id'],
            'jumlah_barang' => $validated['jumlah_barang'],
            'harga' => $validated['harga'],
            'harga_total' => $harga_total,
        ]);

        return redirect()->route('transaksi-details.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaksiDetail = TransaksiDetail::find($id);

        if (!$transaksiDetail) {
            return redirect()->route('transaksi-details.index')->with('error', 'Transaksi Detail not found');
        }

        $transaksiDetail->delete();

        return redirect()->route('transaksi-details.index');
    }
}
