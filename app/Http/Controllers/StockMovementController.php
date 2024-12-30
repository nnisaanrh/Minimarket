<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use App\Models\Cabang;
use App\Models\Barang;
use App\Models\User;
use App\Models\Stok;
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
    
    public function create()
{
    // Ambil data cabang, barang, dan user untuk diisi dalam form
    $cabangs = Cabang::all();
    $barangs = Barang::all();
    $users = User::all();

    return view('stock_movements.create', compact('cabangs', 'barangs', 'users'));
}

    // Menyimpan data stock movement baru
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'cabang_id' => 'required|exists:cabangs,id',
            'barang_id' => 'required|exists:barangs,id',
            'user_id'   => 'required|exists:users,id',
            'type'      => 'required|in:in,out',
            'quantity'  => 'required|integer|min:1',
        ]);
    
        // Simpan data stock_movements
        $stockMovement = StockMovement::create($request->all());
    
        // Update stok berdasarkan tipe
        $stok = Stok::where('cabang_id', $request->cabang_id)
                    ->where('barang_id', $request->barang_id)
                    ->first();
    
        if ($request->type === 'in') {
            if ($stok) {
                $stok->quantity += $request->quantity;
            } else {
                // Jika stok tidak ada, buat stok baru
                $stok = Stok::create([
                    'cabang_id' => $request->cabang_id,
                    'barang_id' => $request->barang_id,
                    'quantity'  => $request->quantity,
                ]);
            }
        } elseif ($request->type === 'out') {
            if ($stok) {
                $stok->quantity -= $request->quantity;
    
                // Pastikan stok cukup
                if ($stok->quantity < 0) {
                    return redirect()->back()->with('error', 'Jumlah stok tidak mencukupi');
                }
            } else {
                return redirect()->back()->with('error', 'Stok tidak ditemukan');
            }
        }
    
        $stok->save();
    
        return redirect()->route('stock_movements.index')->with('success', 'Stock Movement berhasil ditambahkan');
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
