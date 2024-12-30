<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
{
    $barangs = Barang::all(); // Mengambil semua data barang
    return view('barang.index', compact('barangs'));
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
            'sku' => 'required|max:50|unique:barangs,sku',
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

    // public function destroy($id)
    // {
    //     $barang = Barang::findOrFail($id); // Temukan data berdasarkan ID
    //     $barang->delete(); // Hapus data

    //     return redirect()->route('barang.index')->with('success', 'Data berhasil dihapus');
    // }
}
    

