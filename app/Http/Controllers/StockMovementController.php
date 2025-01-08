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
    $cabangId = auth()->user()->cabang_id; // Ambil cabang_id dari user yang sedang login
    
    if ($cabangId) {
        // Jika cabang_id ada, ambil barang yang terkait dengan cabang_id
        $stockMovements = StockMovement::with(['cabang', 'barang', 'user'])
            ->where('cabang_id', $cabangId)
            ->get();
    } else {
        // Jika cabang_id null, ambil semua barang
        $stockMovements = StockMovement::with(['cabang', 'barang', 'user'])->get();
    }

    return view('stock_movements.index', compact('stockMovements'));
}


    // Menampilkan detail satu stock movement berdasarkan ID dalam tampilan
    public function show()
    {
        $cabangId = auth()->user()->cabang_id; // Ambil cabang_id dari user yang sedang login
    $stockMovements = StockMovement::with(['cabang', 'barang', 'user'])
        ->where('cabang_id', $cabangId)
        ->get();
    return view('stock_movements.show', compact('stockMovements'));
    }
    
    public function create()
    {
    $cabangId = auth()->user()->cabang_id; // Ambil cabang_id dari user yang sedang login
    $barangs = Barang::whereHas('stok', function ($query) use ($cabangId) {
        $query->where('cabang_id', $cabangId);
    })->get();

    $users = User::all(); // Atur sesuai kebutuhan

    return view('stock_movements.create', compact('barangs', 'users', 'cabangId'));
    }

    // Menyimpan data stock movement baru
    public function store(Request $request)
    {
        $cabangId = auth()->user()->cabang_id; // Ambil cabang_id dari user yang sedang login

        $request->merge(['cabang_id' => $cabangId]); // Tambahkan cabang_id ke request

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
                        // Jika tipe 'in', buat stok baru jika belum ada dengan quantity 0
                        if (!$stok) {
                            $stok = Stok::create([
                                'cabang_id' => $request->cabang_id,
                                'barang_id' => $request->barang_id,
                                'quantity'  => 0,
                            ]);
                        }
                    } elseif ($request->type === 'out') {
                        // Jika tipe 'out', tambahkan quantity
                        if ($stok) {
                            $stok->quantity += $request->quantity;
                        } else {
                            // Buat stok baru dengan quantity dari input
                            $stok = Stok::create([
                                'cabang_id' => $request->cabang_id,
                                'barang_id' => $request->barang_id,
                                'quantity'  => $request->quantity,
                            ]);
                        }
                    }
    
        $stok->save();
    
        return redirect()->route('stock_movements.index')->with('success', 'Stock Movement berhasil ditambahkan');
    }

    // Menampilkan form edit stock movement berdasarkan ID
    public function edit($id)
    {
    $cabangId = auth()->user()->cabang_id;
    $stockMovement = StockMovement::where('cabang_id', $cabangId)->find($id);

    if (!$stockMovement) {
        return redirect()->route('stock_movements.index')->with('error', 'Stock movement not found');
    }

    $barangs = Barang::all();
    $users = User::all();

    return view('stock_movements.edit', compact('stockMovement', 'barangs', 'users'));
    }

    // Mengupdate data stock movement berdasarkan ID
    public function update(Request $request, $id)
    {
    $cabangId = auth()->user()->cabang_id;
    $stockMovement = StockMovement::where('cabang_id', $cabangId)->find($id);

    if (!$stockMovement) {
        return redirect()->route('stock_movements.index')->with('error', 'Stock movement not found');
    }

    $request->validate([
        'barang_id' => 'required|exists:barangs,id',
        'user_id'   => 'required|exists:users,id',
        'type'      => 'required|in:in,out',
        'quantity'  => 'required|integer|min:1',
    ]);

    $stockMovement->update($request->all());

    return redirect()->route('stock_movements.index')->with('success', 'Stock Movement berhasil diupdate');
    }

    // Menghapus stock movement berdasarkan ID
    public function destroy($id)
    {
    $cabangId = auth()->user()->cabang_id;
    $stockMovement = StockMovement::where('cabang_id', $cabangId)->find($id);

    if (!$stockMovement) {
        return redirect()->route('stock_movements.index')->with('error', 'Stock movement not found');
    }

    $stockMovement->delete();

    return redirect()->route('stock_movements.index')->with('success', 'Stock movement deleted successfully');
    }


    public function export()
{
    // Mendapatkan ID cabang dari pengguna yang sedang login
    $cabangId = auth()->user()->cabang_id;
    // Menjalankan ekspor ke Excel hanya untuk data cabang yang sedang login
    return Excel::download(new StokMovementExport($cabangId), 'Pergerakan_Gudang_' . $cabangId . '.xlsx');
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
            $cabangId = auth()->user()->cabang_id;
            $data['stock_movements'] = StockMovement::with(['cabang', 'barang', 'user'])
                ->where('cabang_id', $cabangId)
                ->get();
            $pdf = Pdf::loadView('stock_movements.print', $data);
            return $pdf->download('stok_movement.pdf');
        }
}