<?php

namespace Database\Seeders;

use App\Models\cabang; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            "namacabang" => "IndoApril Cianjur",
            "alamatcabang" => "Cianjur payonanan",
            "kota" => "Cianjur"
        ]);
    }
}
