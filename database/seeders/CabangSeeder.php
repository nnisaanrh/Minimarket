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
            'name'=> 'GoMart Cabang 1',
            'alamat'=> 'jln Kayangan Gunung Kembar',
            'kota'=> 'Cianjur'
        ]);
        Cabang::create([
            'name'=> 'GoMart Cabang 2',
            'alamat'=> 'jln Bikini Bottom',
            'kota'=> 'Sukabumi'
        ]);
        Cabang::create([
            'name'=> 'GoMart Cabang 3',
            'alamat'=> 'jln Cainengah Hilir',
            'kota'=> 'Bandung'
        ]);
        Cabang::create([
            'name'=> 'GoMart Cabang 4',
            'alamat'=> 'jln Ahlan Wasahlan',
            'kota'=> 'Bogor'
        ]);
        Cabang::create([
            'name'=> 'GoMart Cabang 5',
            'alamat'=> 'jln pangeran popowi ',
            'kota'=> 'Garut'
        ]);
    }
}
