<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Models\Barang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class BarangController extends Controller
{
    public function index()
    {
        // Ambil cabang_id dari pengguna yang sedang login
        $cabang_id = auth()->user()->cabang_id;
    
        // Memeriksa jika cabang_id null
        if ($cabang_id) {
            // Jika cabang_id ada, ambil barang yang terkait dengan cabang_id
            $barangs = Barang::where('cabang_id', $cabang_id)->get();
            return view('barang.view', compact('barangs')); // Menggunakan view khusus untuk cabang tertentu
        } else {
            // Jika cabang_id null, ambil semua barang
            $barangs = Barang::all(); // Mengambil semua data barang
            return view('barang.index', compact('barangs')); // Menggunakan view untuk daftar barang umum
        }
    }
    

    public function create()
    {
        return view('barang.create'); // Perbaikan pada nama view
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'nama_barang' => 'required|max:50',
        'sku' => 'required|max:50|unique:barangs,sku',
        'harga_satuan' => 'required|numeric|min:0'
    ], [
        'nama_barang.required' => 'Nama barang tidak boleh kosong.',
        'sku.unique' => 'SKU sudah terdaftar.',
        'harga_satuan.numeric' => 'Harga satuan harus berupa angka.'
    ]);
    

        Barang::create($validated);

        return redirect()->route('barang.index')->with('success', 'Data berhasil ditambah.');
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang')); // Perbaikan pada nama view
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|max:50',
            'sku' => 'required|max:50|unique:barangs,sku,' . $barang->id,
            'harga_satuan' => 'required|numeric|min:0'
        ], [
            'nama_barang.required' => 'Nama barang tidak boleh kosong.',
            'sku.unique' => 'SKU sudah terdaftar.',
            'harga_satuan.numeric' => 'Harga satuan harus berupa angka.'
        ]);
        

        $barang->update($validated);

        return redirect()->route('barang.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }

    public function export()
    {
        // Ambil cabang_id dari pengguna yang sedang login
        $cabang_id = auth()->user()->cabang_id;

        // Ambil barang yang terkait dengan cabang_id melalui relasi stok
        $barangs = Barang::whereHas('stok', function ($query) use ($cabang_id) {
            // Filter stok berdasarkan cabang_id
            $query->where('cabang_id', $cabang_id);
        })
        ->with(['stok' => function($query) use ($cabang_id) {
            // Pastikan stok juga difilter berdasarkan cabang yang login
            $query->where('cabang_id', $cabang_id);
        }, 'stok.cabang', 'stockMovements'])
        ->get(); // Mengambil barang yang sesuai dengan cabang_id login

        // Menjalankan ekspor ke Excel menggunakan data barang yang sesuai dengan cabang
        return Excel::download(new BarangExport($barangs), 'barang_'.$cabang_id.'.xlsx');
    }

   
    
public function print()
{
    // Ambil cabang_id dari pengguna yang sedang login
    $cabang_id = auth()->user()->cabang_id;

    // Ambil barang yang terkait dengan cabang_id melalui relasi Stok
    $barangs = Barang::whereHas('stoks', function ($query) use ($cabang_id) {
        $query->where('cabang_id', $cabang_id);
    })->get();

    // Mengirim data barang untuk dicetak
    $data['barangs'] = $barangs;

    // Load view PDF dan buat file PDF
    $pdf = Pdf::loadView('barang.print', $data);

    // Download file PDF
    return $pdf->download('Barang_'.$cabang_id.'.pdf');
}


}
    

