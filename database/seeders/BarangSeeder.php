<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       

        Barang::insert([
            ['nama_barang' => 'Mie Sedap', 'sku' => 'SKU001', 'harga_satuan' => 3500],
            ['nama_barang' => 'Indomie Goreng', 'sku' => 'SKU002', 'harga_satuan' => 3500],
            ['nama_barang' => 'Mie Sedap Kari Ayam', 'sku' => 'SKU003', 'harga_satuan' => 3500],
            ['nama_barang' => 'Supermie Soto', 'sku' => 'SKU004', 'harga_satuan' => 3600],
            ['nama_barang' => 'Teh Pucuk Harum (350ml)', 'sku' => 'SKU005', 'harga_satuan' => 5000],
            ['nama_barang' => 'Aqua Botol (600ml)', 'sku' => 'SKU006', 'harga_satuan' => 4000],
            ['nama_barang' => 'Coca-Cola (330ml)', 'sku' => 'SKU007', 'harga_satuan' => 7500],
            ['nama_barang' => 'Chitato (68g)', 'sku' => 'SKU008', 'harga_satuan' => 13000],
            ['nama_barang' => 'Taro Net (50g)', 'sku' => 'SKU009', 'harga_satuan' => 8000],
            ['nama_barang' => 'SilverQueen (62g)', 'sku' => 'SKU010', 'harga_satuan' => 15000],
            ['nama_barang' => 'Beng-Beng', 'sku' => 'SKU011', 'harga_satuan' => 2500],
            ['nama_barang' => 'Susu Ultra (250ml)', 'sku' => 'SKU012', 'harga_satuan' => 6000],
            ['nama_barang' => 'Good Day Cappuccino (200ml)', 'sku' => 'SKU013', 'harga_satuan' => 4500],
            ['nama_barang' => 'Oreo (137g)', 'sku' => 'SKU014', 'harga_satuan' => 12000],
            ['nama_barang' => 'Fanta (1L)', 'sku' => 'SKU015', 'harga_satuan' => 12000],
            ['nama_barang' => 'Yupi Gummy Bears (45g)', 'sku' => 'SKU016', 'harga_satuan' => 7000],
            ['nama_barang' => 'Chocolatos', 'sku' => 'SKU017', 'harga_satuan' => 2000],
            ['nama_barang' => 'Fruit Tea (350ml)', 'sku' => 'SKU018', 'harga_satuan' => 5000],
            ['nama_barang' => 'Sprite (390ml)', 'sku' => 'SKU019', 'harga_satuan' => 6500],
            ['nama_barang' => 'Lays BBQ (68g)', 'sku' => 'SKU020', 'harga_satuan' => 12000],
            ['nama_barang' => 'Pringles Original (110g)', 'sku' => 'SKU021', 'harga_satuan' => 25000],
            ['nama_barang' => 'KitKat 4 Finger', 'sku' => 'SKU022', 'harga_satuan' => 10000],
            ['nama_barang' => 'Pop Mie Ayam Bawang', 'sku' => 'SKU023', 'harga_satuan' => 7500],
            ['nama_barang' => 'Sari Roti Coklat', 'sku' => 'SKU024', 'harga_satuan' => 6000],
            ['nama_barang' => 'Good Time Choco Chips (90g)', 'sku' => 'SKU025', 'harga_satuan' => 9500],
            ['nama_barang' => 'Nutrisari Jeruk Nipis', 'sku' => 'SKU026', 'harga_satuan' => 2000],
            ['nama_barang' => 'Milkuat Botol (125ml)', 'sku' => 'SKU027', 'harga_satuan' => 4000],
            ['nama_barang' => 'Tango Wafer Coklat (120g)', 'sku' => 'SKU028', 'harga_satuan' => 11000],
            ['nama_barang' => 'Sedaap Cup Pop', 'sku' => 'SKU029', 'harga_satuan' => 8000],
            ['nama_barang' => 'Magnum Classic', 'sku' => 'SKU030', 'harga_satuan' => 15000],
        ]);
    }
}
