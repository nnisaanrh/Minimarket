<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BarangExport implements FromCollection, WithHeadings, WithMapping
{
    protected $barangs;

    // Konstruktor untuk menerima data barang yang difilter
    public function __construct($barangs)
    {
        $this->barangs = $barangs;
    }

    public function collection()
    {
        // Mengembalikan koleksi barang yang sudah difilter berdasarkan cabang
        return $this->barangs;
    }

    public function headings(): array
    {
        return [
            'No',
            'Cabang',
            'Nama Barang',
            'SKU',
            'Harga/barang',
            'Stok',
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
            $barang->stok->sum('quantity'), // Menghitung total stok
        ];
    }
}


