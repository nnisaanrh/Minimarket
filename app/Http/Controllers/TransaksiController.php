<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil cabang_id dari pengguna yang sedang login
        $cabang_id = auth()->user()->cabang_id;

        // Ambil transaksi berdasarkan cabang_id yang terkait dengan pengguna
        $transaksis = Transaksi::where('cabang_id', $cabang_id)
            ->with('transaksiDetails') // Memuat detail transaksi
            ->get();

        return view('transaksi.index', compact('transaksis'));
    }
    
    public function show()
    {
        // Ambil cabang_id dari pengguna yang sedang login
        $cabang_id = auth()->user()->cabang_id;

        // Ambil transaksi berdasarkan cabang_id yang terkait dengan pengguna
        $transaksis = Transaksi::where('cabang_id', $cabang_id)
            ->with('transaksiDetails') // Memuat detail transaksi
            ->get();

        return view('transaksi.show', compact('transaksis'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangs = Barang::all(); // Mengambil semua barang untuk dropdown
        return view('transaksi.create', compact('barangs'));
    }

    public function store(Request $request)
{
    // Validasi data yang diterima
    $request->validate([
        'details' => 'required|array',
        'details.*.barang_id' => 'required|exists:barangs,id',
        'details.*.jumlah_barang' => 'required|numeric|min:1',
        'details.*.harga' => 'required|numeric|min:0',
        'details.*.harga_total' => 'required|numeric|min:0',
    ]);

    $cabangId = auth()->user()->cabang_id;

    // Validasi stok barang
    $stokData = \App\Models\Stok::whereIn('barang_id', collect($request->details)->pluck('barang_id'))
    ->where('cabang_id', $cabangId)
    ->get()
    ->keyBy('barang_id');

    foreach ($request->details as $detail) {
    $stok = $stokData->get($detail['barang_id']);
    if (!$stok || $stok->jumlah < $detail['jumlah_barang']) {
        return redirect()->back()->withErrors([
            'error' => "Stok barang dengan ID {$detail['barang_id']} tidak mencukupi."
            ]);
        }
    }

    // Membuat transaksi baru
    $transaksi = Transaksi::create([
        'tanggal_penjualan' => now(),
        'user_id' => auth()->id(),
        'cabang_id' => $cabangId,
        'total' => 0,
    ]);

    // Menyimpan detail transaksi dan menghitung total
    $total = 0;

    foreach ($request->details as $detail) {
        // Menyimpan detail transaksi
        $transaksiDetail = $transaksi->transaksiDetails()->create([
            'barang_id' => $detail['barang_id'],
            'jumlah_barang' => $detail['jumlah_barang'],
            'harga' => $detail['harga'],
            'harga_total' => $detail['harga_total'],
        ]);

        // Mengurangi stok barang
        $stok = \App\Models\Stok::where('barang_id', $detail['barang_id'])
            ->where('cabang_id', $cabangId)
            ->first();
        $stok->decrement('jumlah', $detail['jumlah_barang']);

        // Menambahkan harga_total untuk menghitung total transaksi
        $total += $detail['harga_total'];
    }

    // Memperbarui total transaksi
    $transaksi->update(['total' => $total]);

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat!');
}




}
