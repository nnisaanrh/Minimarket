<?php

namespace App\Imports;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class TransaksiImport implements ToModel, WithHeadingRow
{
    private $currentTransaksi;

    public function __construct()
    {
        $this->currentTransaksi = null;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row['barang_id']) || !isset($row['jumlah_barang'])) {
            // This indicates the row contains Transaksi data, not TransaksiDetail
            $this->currentTransaksi = Transaksi::create([
                'cabang_id' => $row['cabang_id'],
                'user_id' => $row['user_id'],
                'total' => $row['total'],
                'tanggal_penjualan' => $row['tanggal_penjualan'],
            ]);

            return $this->currentTransaksi;
        }
        
// Add TransaksiDetail for the current Transaksi
        return new TransaksiDetail([
            'transaksi_id' => $this->currentTransaksi ? $this->currentTransaksi->id : null,
            'barang_id' => $row['barang_id'],
            'jumlah_barang' => $row['jumlah_barang'],
            'harga' => $row['harga_barang'],
            'harga_total' => $row['harga_total'],
        ]);
    }
}
