<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    protected $transaksis;

    public function __construct($transaksis)
    {
        $this->transaksis = $transaksis;
    }

    public function collection()
    {
        // Mengembalikan data transaksi dalam format yang sesuai untuk diexport
        $data = [];
        foreach ($this->transaksis as $transaksi) {
            foreach ($transaksi->transaksiDetails as $detail) {
                $data[] = [
                    'transaksi_id' => $transaksi->id,
                    'tanggal_penjualan' => $transaksi->tanggal_penjualan,
                    'barang_nama' => $detail->barang->nama_barang, // Asumsi ada kolom nama pada tabel barang
                    'jumlah_barang' => $detail->jumlah_barang,
                    'harga' => $detail->harga,
                    'harga_total' => $detail->harga_total,
                ];
            }
        }
        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Transaksi ID',
            'Tanggal Penjualan',
            'Nama Barang',
            'Jumlah Barang',
            'Harga',
            'Harga Total',
        ];
    }
}

