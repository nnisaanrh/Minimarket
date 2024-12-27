<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use App\Models\Cabang;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data transaksi beserta relasi cabang dan user
        $transaksi = Transaksi::with('cabang', 'user')->get();
        return view('transaksi.index', compact('transaksi')); // Mengirim data ke view transaksi.index
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil semua data cabang dan user untuk dropdown di form
        $cabangs = Cabang::select('id', 'nama')->get();
        $users = User::select('id', 'name')->get();
        return view('transaksi.create', compact('cabangs', 'users')); // Mengirim data ke view transaksi.create
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'cabang_id' => 'required|exists:cabangs,id',
            'user_id'   => 'required|exists:users,id',
            'total'     => 'required|numeric|min:0',
        ], [
            'cabang_id.required' => 'Cabang harus dipilih.',
            'cabang_id.exists'   => 'Cabang tidak ditemukan.',
            'user_id.required'   => 'User harus dipilih.',
            'user_id.exists'     => 'User tidak ditemukan.',
            'total.required'     => 'Total harus diisi.',
            'total.numeric'      => 'Total harus berupa angka.',
            'total.min'          => 'Total tidak boleh negatif.',
        ]);

        // Membuat data baru di tabel transaksi
        Transaksi::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('transaksi.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        // Mengambil semua data cabang dan user untuk dropdown di form
        $cabangs = Cabang::select('id', 'nama')->get();
        $users = User::select('id', 'name')->get();

        // Mengirim data transaksi yang ingin diedit beserta data cabang dan user ke view
        return view('transaksi.edit', compact('transaksi', 'cabangs', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        // Validasi data input
        $validated = $request->validate([
            'cabang_id' => 'required|exists:cabangs,id',
            'user_id'   => 'required|exists:users,id',
            'total'     => 'required|numeric|min:0',
        ], [
            'cabang_id.required' => 'Cabang harus dipilih.',
            'cabang_id.exists'   => 'Cabang tidak ditemukan.',
            'user_id.required'   => 'User harus dipilih.',
            'user_id.exists'     => 'User tidak ditemukan.',
            'total.required'     => 'Total harus diisi.',
            'total.numeric'      => 'Total harus berupa angka.',
            'total.min'          => 'Total tidak boleh negatif.',
        ]);

        // Melakukan update data transaksi
        $transaksi->update($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('transaksi.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        // Menghapus data transaksi
        $transaksi->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('transaksi.index')->with('success', 'Data berhasil dihapus');
    }
}
