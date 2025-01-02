<?php

namespace App\Exports;

use App\Models\Barang;
use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class LaporanPenjualanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Mengambil data koleksi barang dan transaksi terkait.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil data barang beserta stok dan transaksi terkait
        return Barang::with(['stok', 'stockMovements', 'transaksiDetails.transaksi'])->get();
    }

    /**
     * Menyusun headings untuk laporan
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Cabang',
            'Nama Barang',
            'SKU',
            'Harga/barang',
            'Stok Tersedia',
            'Pergerakan Stok',
            'Total Penjualan',
            'Tanggal Penjualan',
        ];
    }

    /**
     * Mapping data untuk setiap baris laporan
     *
     * @param Barang $barang
     * @return array
     */
    public function map($barang): array
    {
        // Ambil nama cabang terkait dari stok
        $cabangNames = $barang->stok->map(function ($stok) {
            return $stok->cabang ? $stok->cabang->name : 'Tidak Ada Cabang';
        })->unique()->implode(', ');

        // Ambil total penjualan dari transaksi terkait
        $totalPenjualan = $barang->transaksiDetails->sum(function ($detail) {
            return $detail->harga_total;
        });

        // Ambil tanggal penjualan terbaru (jika ada)
        $tanggalPenjualan = $barang->transaksiDetails->first()
            ? Carbon::parse($barang->transaksiDetails->first()->transaksi->tanggal_penjualan)->format('Y-m-d')
            : 'Belum ada transaksi';

        return [
            $barang->id,
            $cabangNames, // Nama cabang
            $barang->nama_barang,
            $barang->sku,
            $barang->harga_satuan,
            $barang->stok->sum('qantity'), // Total stok
            ucfirst(optional($barang->stockMovements->first())->type), // Pergerakan stok pertama
            $totalPenjualan, // Total penjualan
            $tanggalPenjualan, // Tanggal penjualan
        ];
    }
}
