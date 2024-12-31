<?php

namespace App\Imports;

use App\Models\StockMovement;
use App\Models\Cabang;
use App\Models\Barang;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class StokMovementImport implements ToModel, WithHeadingRow
{
    /**
     * Menyimpan data dari setiap baris ke dalam model StockMovement
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Validasi data untuk memastikan kolom 'Cabang', 'Barang', 'User' ada
        $cabang = Cabang::where('name', $row['cabang'])->first();
        $barang = Barang::where('nama_barang', $row['barang'])->first();
        $user = User::where('name', $row['user'])->first();

        if (!$cabang || !$barang || !$user) {
            // Jika cabang, barang, atau user tidak ditemukan, lewati baris ini
            return null;
        }

        // Parse tanggal dari kolom Movement Date
        $movementDate = Carbon::parse($row['movement_date'])->format('Y-m-d H:i:s');

        // Cek apakah data stock movement dengan kombinasi yang sama sudah ada
        $existingMovement = StockMovement::where('cabang_id', $cabang->id)
            ->where('barang_id', $barang->id)
            ->where('user_id', $user->id)
            ->where('movement_date', $movementDate)
            ->first();

        if ($existingMovement) {
            // Jika data sudah ada, lewati penyimpanan
            return null;
        }

        // Membuat dan mengembalikan model StockMovement jika belum ada
        return new StockMovement([
            'cabang_id' => $cabang->id,
            'barang_id' => $barang->id,
            'user_id' => $user->id,
            'type' => strtolower($row['type']), // Pastikan 'in' atau 'out' sesuai format
            'quantity' => $row['quantity'],
            'movement_date' => $movementDate,
        ]);
    }

    /**
     * Menambahkan validasi sebelum proses impor dilakukan
     */
    public function rules(): array
    {
        return [
            'cabang' => 'required|string',
            'barang' => 'required|string',
            'user' => 'required|string',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'movement_date' => 'required|date',
        ];
    }
}
