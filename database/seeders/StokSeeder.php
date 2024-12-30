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
            ['cabang_id' => 1, 'barang_id' => 1, 'quantity' => 0],
            ['cabang_id' => 1, 'barang_id' => 2, 'quantity' => 50],
            ['cabang_id' => 1, 'barang_id' => 3, 'quantity' => 40],
            ['cabang_id' => 1, 'barang_id' => 4, 'quantity' => 35],
            ['cabang_id' => 1, 'barang_id' => 5, 'quantity' => 45],
            ['cabang_id' => 1, 'barang_id' => 6, 'quantity' => 60],
            ['cabang_id' => 1, 'barang_id' => 7, 'quantity' => 25],
            ['cabang_id' => 1, 'barang_id' => 8, 'quantity' => 20],
            ['cabang_id' => 1, 'barang_id' => 9, 'quantity' => 50],
            ['cabang_id' => 1, 'barang_id' => 10, 'quantity' => 55],
            ['cabang_id' => 1, 'barang_id' => 11, 'quantity' => 35],
            ['cabang_id' => 1, 'barang_id' => 12, 'quantity' => 40],
            ['cabang_id' => 1, 'barang_id' => 13, 'quantity' => 30],
            ['cabang_id' => 1, 'barang_id' => 14, 'quantity' => 25],
            ['cabang_id' => 1, 'barang_id' => 15, 'quantity' => 45],
            ['cabang_id' => 1, 'barang_id' => 16, 'quantity' => 50],
            ['cabang_id' => 1, 'barang_id' => 17, 'quantity' => 60],
            ['cabang_id' => 1, 'barang_id' => 18, 'quantity' => 20],
            ['cabang_id' => 1, 'barang_id' => 19, 'quantity' => 25],
            ['cabang_id' => 1, 'barang_id' => 20, 'quantity' => 70],
            ['cabang_id' => 1, 'barang_id' => 21, 'quantity' => 80],
            ['cabang_id' => 1, 'barang_id' => 22, 'quantity' => 55],
            ['cabang_id' => 1, 'barang_id' => 23, 'quantity' => 35],
            ['cabang_id' => 1, 'barang_id' => 24, 'quantity' => 45],
            ['cabang_id' => 1, 'barang_id' => 25, 'quantity' => 50],
            ['cabang_id' => 1, 'barang_id' => 26, 'quantity' => 20],
            ['cabang_id' => 1, 'barang_id' => 27, 'quantity' => 25],
            ['cabang_id' => 1, 'barang_id' => 28, 'quantity' => 40],
            ['cabang_id' => 1, 'barang_id' => 29, 'quantity' => 60],
            ['cabang_id' => 1, 'barang_id' => 30, 'quantity' => 75],



            ['cabang_id' => 2, 'barang_id' => 1, 'quantity' => 30],
            ['cabang_id' => 2, 'barang_id' => 2, 'quantity' => 0],
            ['cabang_id' => 2, 'barang_id' => 3, 'quantity' => 40],
            ['cabang_id' => 2, 'barang_id' => 4, 'quantity' => 35],
            ['cabang_id' => 2, 'barang_id' => 5, 'quantity' => 45],
            ['cabang_id' => 2, 'barang_id' => 6, 'quantity' => 60],
            ['cabang_id' => 2, 'barang_id' => 7, 'quantity' => 25],
            ['cabang_id' => 2, 'barang_id' => 8, 'quantity' => 20],
            ['cabang_id' => 2, 'barang_id' => 9, 'quantity' => 50],
            ['cabang_id' => 2, 'barang_id' => 10, 'quantity' => 55],
            ['cabang_id' => 2, 'barang_id' => 11, 'quantity' => 35],
            ['cabang_id' => 2, 'barang_id' => 12, 'quantity' => 40],
            ['cabang_id' => 2, 'barang_id' => 13, 'quantity' => 30],
            ['cabang_id' => 2, 'barang_id' => 14, 'quantity' => 25],
            ['cabang_id' => 2, 'barang_id' => 15, 'quantity' => 45],
            ['cabang_id' => 2, 'barang_id' => 16, 'quantity' => 50],
            ['cabang_id' => 2, 'barang_id' => 17, 'quantity' => 60],
            ['cabang_id' => 2, 'barang_id' => 18, 'quantity' => 20],
            ['cabang_id' => 2, 'barang_id' => 19, 'quantity' => 25],
            ['cabang_id' => 2, 'barang_id' => 20, 'quantity' => 70],
            ['cabang_id' => 2, 'barang_id' => 21, 'quantity' => 80],
            ['cabang_id' => 2, 'barang_id' => 22, 'quantity' => 55],
            ['cabang_id' => 2, 'barang_id' => 23, 'quantity' => 35],
            ['cabang_id' => 2, 'barang_id' => 24, 'quantity' => 45],
            ['cabang_id' => 2, 'barang_id' => 25, 'quantity' => 50],
            ['cabang_id' => 2, 'barang_id' => 26, 'quantity' => 20],
            ['cabang_id' => 2, 'barang_id' => 27, 'quantity' => 25],
            ['cabang_id' => 2, 'barang_id' => 28, 'quantity' => 40],
            ['cabang_id' => 2, 'barang_id' => 29, 'quantity' => 60],
            ['cabang_id' => 2, 'barang_id' => 30, 'quantity' => 75],
        ]);
    }
}
