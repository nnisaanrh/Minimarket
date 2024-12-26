<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cabang;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cabang::create([
            'name'=> 'IndoJanuari',
            'alamat'=> 'jln Kayangan Gunung Kembar',
            'kota'=> 'Cianjur'
        ]);
        Cabang::create([
            'name'=> 'IndoFebuari',
            'alamat'=> 'jln Bikini Bottom',
            'kota'=> 'Cianjur'
        ]);
        Cabang::create([
            'name'=> 'IndoMaret',
            'alamat'=> 'jln Cainengah Hilir',
            'kota'=> 'Cianjur'
        ]);
        Cabang::create([
            'name'=> 'IndoApril',
            'alamat'=> 'jln Ahlan Wasahlan',
            'kota'=> 'Cianjur'
        ]);
        Cabang::create([
            'name'=> 'IndoMei',
            'alamat'=> 'jln pangeran popowi ',
            'kota'=> 'Cianjur'
        ]);
    }
}
