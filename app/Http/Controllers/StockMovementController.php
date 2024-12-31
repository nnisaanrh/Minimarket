<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use App\Models\Cabang;
use App\Models\Barang;
use App\Models\User;
use App\Models\Stok;
use Illuminate\Http\Request;

use App\Exports\StokMovementExport;
use App\Imports\StokMovementImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use \Maatwebsite\Excel\Facades\Excel;


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

    // Menampilkan form edit stock movement berdasarkan ID
    public function edit($id)
    {
        $stockMovement = StockMovement::find($id);

        if (!$stockMovement) {
            return redirect()->route('stock_movements.index')->with('error', 'Stock movement not found');
        }

        $cabangs = Cabang::all();
        $barangs = Barang::all();
        $users = User::all();

        return view('stock_movements.edit', compact('stockMovement', 'cabangs', 'barangs', 'users'));
    }

    // Mengupdate data stock movement berdasarkan ID
    public function update(Request $request, $id)
    {
        $stockMovement = StockMovement::find($id);

        if (!$stockMovement) {
            return redirect()->route('stock_movements.index')->with('error', 'Stock movement not found');
        }

        // Validasi data
        $request->validate([
            'cabang_id' => 'required|exists:cabangs,id',
            'barang_id' => 'required|exists:barangs,id',
            'user_id'   => 'required|exists:users,id',
            'type'      => 'required|in:in,out',
            'quantity'  => 'required|integer|min:1',
        ]);

        // Update data stock movement
        $stockMovement->update($request->all());

        return redirect()->route('stock_movements.index')->with('success', 'Stock Movement berhasil diupdate');
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


    public function export()
{
    // Menjalankan ekspor ke Excel
    return Excel::download(new StokMovementExport, 'Pergerakan Gudang.xlsx');
}

public function import(Request $request)
{
    // Validasi file
    $request->validate([
        'file' => 'required|mimes:xlsx,csv'
    ]);

    try {
        // Impor data menggunakan class StockMovementsImport
        $imported = Excel::import(new StokMovementImport, $request->file('file'));

        // Hitung data yang berhasil diimpor
        $count = StockMovement::count(); // Hitung total jumlah data setelah impor

        // Mengambil jumlah data yang diimpor dan yang sudah ada
        $newDataCount = StockMovement::where('created_at', '>=', now()->subMinutes(5))->count(); // Mengasumsikan data baru diimpor dalam 5 menit terakhir

        // Menampilkan pemberitahuan sukses atau informasi
        if ($newDataCount > 0) {
            return back()->with('success', "Data berhasil diimpor! {$newDataCount} data baru ditambahkan.");
        } else {
            return back()->with('info', 'Tidak ada data baru yang ditambahkan karena data sudah ada.');
        }
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        // Jika ada error validasi
        $errors = $e->errors(); // Ambil pesan error validasi
        $errorMessage = implode(' ', $errors);

        return back()->with('error', 'Data gagal diimpor! Error: ' . $errorMessage);
    } catch (\Exception $e) {
        // Tangani kesalahan lainnya
        return back()->with('error', 'Data gagal diimpor! Alasan: ' . $e->getMessage());
    }
}



// public function import(Request $request){
//     Excel::import(new StokMovementImport, $request->file('file'));
//     $notification = array( 
//         'message' => 'Data buku berhasil diImport', 
//         'alert-type' => 'success' 
//     );
//     return redirect()->route('stock_movements.index')->with($notification);
// }

    public function print()
    {
        $data['stock_movements'] = StockMovement::with(['cabang', 'barang', 'user'])->get();
        $pdf = Pdf::loadView('stock_movements.print', $data);
        return $pdf->download('stok_movement.pdf');
    }
}