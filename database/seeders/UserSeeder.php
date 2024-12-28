<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
        ])->assignRole('manager')->givePermissionTo(
            'view_cabang',
                'view_barang',
                'view_stok',
                'view_transaksi',
                'view_transaksi_detail',
                'view_stok_movements',
        );

        User::factory()->create([
            'name' => 'supervisor',
            'email' => 'supervisor@gmail.com',
        ])->assignRole('supervisor')->givePermissionTo(
            'view_barang',
                'view_stok',
                'view_transaksi',
                'view_transaksi_detail',
                'edit_stok_movements',
        );

        User::factory()->create([
            'name' => 'kasir',
            'email' => 'kasir@gmail.com',
        ])->assignRole('kasir')->givePermissionTo(
            'view_produk',
                'edit_transaksi',
                'edit_transaksi_detail',
        );

        User::factory()->create([
            'name' => 'gudang',
            'email' => 'gudang@gmail.com',
        ])->assignRole('gudang')->givePermissionTo(
            'view_barang',
                'view_stok',
                'edit_stok_movements',
        );

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
        ])->assignRole('admin')
        ->givePermissionTo(['edit_user',
                'edit_cabang',
                'edit_barang',
                'view_cabang',
                'view_barang',
                'view_stok',
                'view_transaksi',
                'view_transaksi_detail',
                'view_stok_movements',
                'edit_stok_movements',
                'view_produk',
                'edit_transaksi',
                'edit_transaksi_detail',]);
    }
}
