<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Cabang;
use App\Models\Barang;
use Illuminate\Http\Request;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   // Ambil cabang_id dari pengguna yang sedang login
        $cabang_id = auth()->user()->cabang_id;
        // Ambil stok berdasarkan cabang_id yang terkait dengan pengguna
        $stok = Stok::where('cabang_id', $cabang_id)
            ->with('barang') // Memuat detail transaksi
            ->get();
        return view('barang.view', compact('stok'));
    }
    //CABANG 1
    public function adminViewCabangSatu()
    {
    // Tetapkan cabang ID yang ingin difilter (misalnya, cabang ID = 1)
    $cabang_id = 1;
    // Ambil stok berdasarkan cabang ID = 1
    $stok = Stok::where('cabang_id', $cabang_id)
        ->with('barang') // Memuat data relasi barang
        ->get();
    // Mengirim data stok ke view barang.view1
    return view('barang.view1', compact('stok'));
    }
    //CABANG 2
    public function adminViewCabangdua()
    {
    // Tetapkan cabang ID yang ingin difilter (misalnya, cabang ID = 1)
    $cabang_id = 2;
    // Ambil stok berdasarkan cabang ID = 1
    $stok = Stok::where('cabang_id', $cabang_id)
        ->with('barang') // Memuat data relasi barang
        ->get();
    // Mengirim data stok ke view barang.view1
    return view('barang.view2', compact('stok'));
    }
    //CABANG 3
    public function adminViewCabangtiga()
    {
    // Tetapkan cabang ID yang ingin difilter (misalnya, cabang ID = 1)
    $cabang_id = 3;
    // Ambil stok berdasarkan cabang ID = 1
    $stok = Stok::where('cabang_id', $cabang_id)
        ->with('barang') // Memuat data relasi barang
        ->get();
    // Mengirim data stok ke view barang.view1
    return view('barang.view2', compact('stok'));
    }
    //CABANG 4
    public function adminViewCabangempat()
    {
    // Tetapkan cabang ID yang ingin difilter (misalnya, cabang ID = 1)
    $cabang_id = 4;
    // Ambil stok berdasarkan cabang ID = 1
    $stok = Stok::where('cabang_id', $cabang_id)
        ->with('barang') // Memuat data relasi barang
        ->get();
    // Mengirim data stok ke view barang.view1
    return view('barang.view2', compact('stok'));
    }
    //CABANG 5
    public function adminViewCabanglima()
    {
    // Tetapkan cabang ID yang ingin difilter (misalnya, cabang ID = 1)
    $cabang_id = 5;
    // Ambil stok berdasarkan cabang ID = 1
    $stok = Stok::where('cabang_id', $cabang_id)
        ->with('barang') // Memuat data relasi barang
        ->get();
    // Mengirim data stok ke view barang.view1
    return view('barang.view2', compact('stok'));
    }
    //AND
  
    public function create()
    {
        // Mengambil semua data cabang dan barang untuk dropdown di form
        $cabangs = Cabang::all(); 
        $barangs = Barang::all();
        return view('stok.create', compact('cabangs', 'barangs')); // Mengirim data cabang dan barang ke view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'cabang_id'=> 'required',
            'barang_id'=> 'required',
            'quantity'=> 'required'
        ]);

        // Membuat data baru di tabel stok
        Stok::create($validated);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('stok.index')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stok $stok)
    {
        // Mengambil semua data cabang dan barang untuk dropdown di form
        $cabangs = Cabang::all(); 
        $barangs = Barang::all();

        // Mengirim data stok yang ingin diedit beserta data cabang dan barang ke view
        return view('stok.edit', compact('stok', 'cabangs', 'barangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stok $stok)
    {
        // Validasi data input
        $validated = $request->validate([
            'cabang_id'=> 'required',
            'barang_id'=> 'required',
            'quantity'=> 'required'
        ]);

        // Melakukan update data stok
        $stok->update($validated);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('stok.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stok $stok)
    {
        // Menghapus data stok
        $stok->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('stok.index')->with('success', 'Data berhasil dihapus');
    }
}
