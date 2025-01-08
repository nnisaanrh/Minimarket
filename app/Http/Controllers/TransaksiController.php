<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Imports\TransaksiImport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use \Maatwebsite\Excel\Facades\Excel;


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
        $cabang_id = auth()->user()->cabang_id;
    
        // Memeriksa jika cabang_id null
        if ($cabang_id) {
            $transaksis = Transaksi::where('cabang_id', $cabang_id)
            ->with('transaksiDetails') // Memuat detail transaksi
            ->get();

        return view('transaksi.index', compact('transaksis'));
        } else {
            // Jika cabang_id null, ambil semua barang
            $transaksis = Transaksi::all(); // Mengambil semua data barang
            return view('transaksi.index', compact('transaksis')); // Menggunakan view untuk daftar barang umum
        }
        // Ambil transaksi berdasarkan cabang_id yang terkait dengan pengguna
       
    }
    public function view()
    {
        $user = auth()->user();

    // Ambil cabang_id dan nama cabang terkait pengguna
    $cabang = $user->cabang; // Pastikan relasi ke Cabang ada di model User

    // Ambil transaksi berdasarkan cabang_id
    $transaksis = Transaksi::where('cabang_id', $cabang->id)
        ->with('transaksiDetails') // Memuat detail transaksi
        ->get();

    // Kirim data ke view
    return view('transaksi.view', [
        'transaksis' => $transaksis,
        'cabangName' => $cabang->name // Ganti 'name' sesuai dengan nama kolom di tabel cabang
    ]);
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
    if (!$stok || $stok->quantity < $detail['jumlah_barang']) {
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
        $stok->decrement('quantity', $detail['jumlah_barang']);

        // Menambahkan harga_total untuk menghitung total transaksi
        $total += $detail['harga_total'];
    }

    // Memperbarui total transaksi
    $transaksi->update(['total' => $total]);

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat!');
}

public function print()
{
    // Ambil cabang_id dari pengguna yang sedang login
    $cabang_id = auth()->user()->cabang_id;

    // Ambil transaksi yang sesuai dengan cabang_id
    $transaksis = Transaksi::where('cabang_id', $cabang_id)
        ->with(['transaksiDetails.barang']) // Relasi transaksiDetails dan barang
        ->get();

    // Siapkan data untuk dikirim ke view
    $data['transaksis'] = $transaksis;

    // Buat PDF menggunakan data transaksi
    $pdf = Pdf::loadView('transaksi.print', $data);

    // Download file PDF dengan nama khusus
    return $pdf->download('Detail_Transaksi_Cabang_' . $cabang_id . '.pdf');
}



public function export()
{
    // Ambil cabang_id dari pengguna yang sedang login
    $cabang_id = auth()->user()->cabang_id;

    // Ambil transaksi yang hanya terkait dengan cabang_id
    $transaksis = Transaksi::where('cabang_id', $cabang_id)
        ->with('transaksiDetails', 'transaksiDetails.barang') // Memuat detail transaksi dan barang
        ->get();

    // Menjalankan ekspor ke Excel menggunakan data transaksi cabang yang login
    return Excel::download(new TransaksiExport($transaksis), 'transaksi_'.$cabang_id.'.xlsx');
}

public function import(Request $request){
    Excel::import(new TransaksiImport, $request->file('file'));
    $notification = array( 
        'message' => 'Data transasksi', 
        'alert-type' => 'success' 
    );
    return redirect()->route('transaksi.index')->with($notification);
}




}
