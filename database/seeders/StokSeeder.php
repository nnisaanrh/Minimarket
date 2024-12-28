<?php

namespace Database\Seeders;

use App\Models\Stok;
use App\Models\Barang;
use Illuminate\Database\Seeder;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stok::insert([
            ['cabang_id' => 1, 'barang_id' => 1, 'jumlah' => 0],
            ['cabang_id' => 1, 'barang_id' => 2, 'jumlah' => 50],
            ['cabang_id' => 1, 'barang_id' => 3, 'jumlah' => 40],
            ['cabang_id' => 1, 'barang_id' => 4, 'jumlah' => 35],
            ['cabang_id' => 1, 'barang_id' => 5, 'jumlah' => 45],
            ['cabang_id' => 1, 'barang_id' => 6, 'jumlah' => 60],
            ['cabang_id' => 1, 'barang_id' => 7, 'jumlah' => 25],
            ['cabang_id' => 1, 'barang_id' => 8, 'jumlah' => 20],
            ['cabang_id' => 1, 'barang_id' => 9, 'jumlah' => 50],
            ['cabang_id' => 1, 'barang_id' => 10, 'jumlah' => 55],
            ['cabang_id' => 1, 'barang_id' => 11, 'jumlah' => 35],
            ['cabang_id' => 1, 'barang_id' => 12, 'jumlah' => 40],
            ['cabang_id' => 1, 'barang_id' => 13, 'jumlah' => 30],
            ['cabang_id' => 1, 'barang_id' => 14, 'jumlah' => 25],
            ['cabang_id' => 1, 'barang_id' => 15, 'jumlah' => 45],
            ['cabang_id' => 1, 'barang_id' => 16, 'jumlah' => 50],
            ['cabang_id' => 1, 'barang_id' => 17, 'jumlah' => 60],
            ['cabang_id' => 1, 'barang_id' => 18, 'jumlah' => 20],
            ['cabang_id' => 1, 'barang_id' => 19, 'jumlah' => 25],
            ['cabang_id' => 1, 'barang_id' => 20, 'jumlah' => 70],
            ['cabang_id' => 1, 'barang_id' => 21, 'jumlah' => 80],
            ['cabang_id' => 1, 'barang_id' => 22, 'jumlah' => 55],
            ['cabang_id' => 1, 'barang_id' => 23, 'jumlah' => 35],
            ['cabang_id' => 1, 'barang_id' => 24, 'jumlah' => 45],
            ['cabang_id' => 1, 'barang_id' => 25, 'jumlah' => 50],
            ['cabang_id' => 1, 'barang_id' => 26, 'jumlah' => 20],
            ['cabang_id' => 1, 'barang_id' => 27, 'jumlah' => 25],
            ['cabang_id' => 1, 'barang_id' => 28, 'jumlah' => 40],
            ['cabang_id' => 1, 'barang_id' => 29, 'jumlah' => 60],
            ['cabang_id' => 1, 'barang_id' => 30, 'jumlah' => 75],
        ]);
    }
}
