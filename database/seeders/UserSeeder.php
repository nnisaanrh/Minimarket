<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'manager',
                'email' => 'manager@gmail.com',
                'password' => 'manager_password',
                'cabang_id' => 1, // Pastikan ID cabang 1 ada di tabel cabangs
                'role' => 'manager',
                'permissions' => [
                    'view_cabang',
                    'view_barang',
                    'view_stok',
                    'view_transaksi',
                    'view_transaksi_detail',
                    'view_stok_movements',
                ],
            ],
            [
                'name' => 'supervisor',
                'email' => 'supervisor@gmail.com',
                'password' => 'supervisor_password',
                'cabang_id' => 1,
                'role' => 'supervisor',
                'permissions' => [
                    'view_barang',
                    'view_stok',
                    'view_transaksi',
                    'view_transaksi_detail',
                    'edit_stok_movements',
                ],
            ],
            [
                'name' => 'kasir',
                'email' => 'kasir@gmail.com',
                'password' => 'kasir_password',
                'role' => 'kasir',
                'cabang_id' => null, // Tidak ada cabang yang terkait
                'permissions' => [
                    'view_produk',
                    'edit_transaksi',
                    'edit_transaksi_detail',
                ],
            ],
            [
                'name' => 'Kasir Cabang 1',
                'email' => 'kasir1@gmail.com',
                'password' => 'kasircabang1',
                'cabang_id' => 1,
                'role' => 'kasir',
                'permissions' => [
                    'view_produk',
                    'edit_transaksi',
                    'edit_transaksi_detail',
                ],
            ],
            [
                'name' => 'Kasir Cabang 2',
                'email' => 'kasir2@gmail.com',
                'password' => 'kasircabang2',
                'cabang_id' => 2,
                'role' => 'kasir',
                'permissions' => [
                    'view_produk',
                    'edit_transaksi',
                    'edit_transaksi_detail',
                ],
            ],
            [
                'name' => 'gudang',
                'email' => 'gudang@gmail.com',
                'password' => 'gudang_password',
                'role' => 'gudang',
                'cabang_id' => 1,
                'permissions' => [
                    'view_barang',
                    'view_stok',
                    'edit_stok_movements',
                ],
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => 'admin_password',
                'role' => 'admin',
                'cabang_id' => null, // Admin tidak terkait dengan cabang tertentu
                'permissions' => [
                    'edit_user',
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
                    'edit_transaksi_detail',
                ],
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => bcrypt($userData['password']), // Mengenkripsi password
                'cabang_id' => $userData['cabang_id'], // Isi null jika tidak didefinisikan
            ]);

            $user->assignRole($userData['role']);
            $user->givePermissionTo($userData['permissions']);
        }
    }
}
