<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use App\Models\Cabang;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    // Menampilkan semua data stock movements dalam tampilan
    public function index()
    {
        $stockMovements = StockMovement::with(['cabang', 'barang', 'user'])->get();
        return view('stock_movements.index', compact('stockMovements'));
    }

    // Menampilkan detail satu stock movement berdasarkan ID dalam tampilan
    public function show($id)
    {
        $stockMovement = StockMovement::with(['cabang', 'barang', 'user'])->find($id);

        if (!$stockMovement) {
            return redirect()->route('stock_movements.index')->with('error', 'Stock movement not found');
        }

        return view('stock_movements.show', compact('stockMovement'));
    }

    // Menyimpan data stock movement baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'cabang_id' => 'required|exists:cabangs,id',
            'barang_id' => 'required|exists:barangs,id',
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
        ]);

        // Membuat stock movement baru
        $stockMovement = StockMovement::create($validated);

        return redirect()->route('stock_movements.index')->with('success', 'Stock movement created successfully');
    }

    // Memperbarui data stock movement berdasarkan ID
    public function update(Request $request, $id)
    {
        $stockMovement = StockMovement::find($id);

        if (!$stockMovement) {
            return redirect()->route('stock_movements.index')->with('error', 'Stock movement not found');
        }

        // Validasi input
        $validated = $request->validate([
            'cabang_id' => 'required|exists:cabangs,id',
            'barang_id' => 'required|exists:barangs,id',
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
        ]);

        // Memperbarui stock movement
        $stockMovement->update($validated);

        return redirect()->route('stock_movements.index')->with('success', 'Stock movement updated successfully');
    }

    // Menghapus stock movement berdasarkan ID
    public function destroy($id)
    {
        $stockMovement = StockMovement::find($id);

        if (!$stockMovement) {
            return redirect()->route('stock_movements.index')->with('error', 'Stock movement not found');
        }

        $stockMovement->delete();

        return redirect()->route('stock_movements.index')->with('success', 'Stock movement deleted successfully');
    }
}
