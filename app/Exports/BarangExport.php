<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BarangExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Mengambil data barang dengan relasi stok dan stockMovements
        return Barang::with('stok', 'stok.cabang', 'stockMovements')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Cabang',
            'Nama Barang',
            'SKU',
            'Harga/Barang',
            'Stok',

        ];
    }

    /**
     * Mengubah data untuk ekspor.
     *
     * @param  \App\Models\Barang  $barang
     * @return array
     */
    public function map($barang): array
    {
        // Mengambil nama cabang dari stok terkait
        $cabangNames = $barang->stok->map(function ($stok) {
            return $stok->cabang ? $stok->cabang->name : 'Tidak Ada Cabang';
        })->unique()->implode(', ');

        // Mengambil pergerakan stok terakhir
        $lastStockMovement = $barang->stockMovements->last();

        return [
            $barang->id, // No
            $cabangNames, // Nama cabang terkait
            $barang->nama_barang, // Nama Barang
            $barang->sku, // SKU
            $barang->harga_satuan, // Harga per Barang
            $barang->stok->sum('quantity'), // Total stok
        ];
    }
}

