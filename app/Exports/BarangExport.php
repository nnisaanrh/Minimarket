<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
class BarangExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Barang::with('stok','stockMovements');
    }

    public function headings(): array
    {
        return [
            'No',
            'cabang',
            'Nama Barang',
            'SKU',
            'Harga/barang',
            'stok',
            'pergerakan stok',
        ];
    }
    

    public function map($barang): array
{
    // Ambil semua nama cabang dari stok terkait
    $cabangNames = $barang->stok->map(function ($stok) {
        return $stok->cabang ? $stok->cabang->name : 'Tidak Ada Cabang';
    })->unique()->implode(', ');

    return [
        $barang->id,
        $cabangNames, // Menampilkan nama-nama cabang terkait
        $barang->nama_barang,
        $barang->sku,
        $barang->harga_satuan,
        $barang->stok->sum('qantity'), // Menghitung total stok
        ucfirst(optional($barang->stockMovements->first())->type), // Mengambil pergerakan stok pertama
    ];
}
}
