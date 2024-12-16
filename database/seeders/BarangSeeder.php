<?php

namespace Database\Seeders;

use App\Models\barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\fascade\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barangs')->insert([
            ['namabarang' => 'Indomie', 'hargasatuan' =>  '3500'],
        ]);

        barangs::create(['namabarang' => 'Mie Sedap', 'hargasatuan' => '3500']);
        Barangs::create(['namabarang' => 'Indomie Goreng', 'hargasatuan' => '3500']);
        Barangs::create(['namabarang' => 'Mie Sedap Kari Ayam', 'hargasatuan' => '3500']);
        Barangs::create(['namabarang' => 'Supermie Soto', 'hargasatuan' => '3600']);
        Barangs::create(['namabarang' => 'Teh Pucuk Harum (350ml)', 'hargasatuan' => '5000']);
        Barangs::create(['namabarang' => 'Aqua Botol (600ml)', 'hargasatuan' => '4000']);
        Barangs::create(['namabarang' => 'Coca-Cola (330ml)', 'hargasatuan' => '7500']);
        Barangs::create(['namabarang' => 'Chitato (68g)', 'hargasatuan' => '13000']);
        Barangs::create(['namabarang' => 'Taro Net (50g)', 'hargasatuan' => '8000']);
        Barangs::create(['namabarang' => 'SilverQueen (62g)', 'hargasatuan' => '15000']);
        Barangs::create(['namabarang' => 'Beng-Beng', 'hargasatuan' => '2500']);
        Barangs::create(['namabarang' => 'Susu Ultra (250ml)', 'hargasatuan' => '6000']);
        Barangs::create(['namabarang' => 'Good Day Cappuccino (200ml)', 'hargasatuan' => '4500']);
        Barangs::create(['namabarang' => 'Oreo (137g)', 'hargasatuan' => '12000']);
        Barangs::create(['namabarang' => 'Fanta (1L)', 'hargasatuan' => '12000']);
        Barangs::create(['namabarang' => 'Yupi Gummy Bears (45g)', 'hargasatuan' => '7000']);
        Barangs::create(['namabarang' => 'Chocolatos', 'hargasatuan' => '2000']);
        Barangs::create(['namabarang' => 'Fruit Tea (350ml)', 'hargasatuan' => '5000']);
        Barangs::create(['namabarang' => 'Sprite (390ml)', 'hargasatuan' => '6500']);
        Barangs::create(['namabarang' => 'Lays BBQ (68g)', 'hargasatuan' => '12000']);
        Barangs::create(['namabarang' => 'Pringles Original (110g)', 'hargasatuan' => '25000']);
        Barangs::create(['namabarang' => 'KitKat 4 Finger', 'hargasatuan' => '10000']);
        Barangs::create(['namabarang' => 'Pop Mie Ayam Bawang', 'hargasatuan' => '7500']);
        Barangs::create(['namabarang' => 'Sari Roti Coklat', 'hargasatuan' => '6000']);
        Barangs::create(['namabarang' => 'Good Time Choco Chips (90g)', 'hargasatuan' => '9500']);
        Barangs::create(['namabarang' => 'Nutrisari Jeruk Nipis', 'hargasatuan' => '2000']);
        Barangs::create(['namabarang' => 'Milkuat Botol (125ml)', 'hargasatuan' => '4000']);
        Barangs::create(['namabarang' => 'Tango Wafer Coklat (120g)', 'hargasatuan' => '11000']);
        Barangs::create(['namabarang' => 'Sedaap Cup Pop', 'hargasatuan' => '8000']);
        Barangs::create(['namabarang' => 'Magnum Classic', 'hargasatuan' => '15000']);
        Barangs::create(['namabarang' => 'Cornetto Chocolate', 'hargasatuan' => '12000']);
        Barangs::create(['namabarang' => 'Yakult (5 botol)', 'hargasatuan' => '15000']);
        Barangs::create(['namabarang' => 'Richeese Nabati', 'hargasatuan' => '8000']);
        Barangs::create(['namabarang' => 'Energen Coklat', 'hargasatuan' => '3000']);
        Barangs::create(['namabarang' => 'Indo Milk (190ml)', 'hargasatuan' => '4500']);
        Barangs::create(['namabarang' => 'Torabika Cappuccino', 'hargasatuan' => '6000']);

    }
}
