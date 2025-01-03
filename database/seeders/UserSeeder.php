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
                'name' => 'Manager Cabang 1',
                'email' => 'manager1@gmail.com',
                'password' => 'managercabang1',
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
                'name' => 'Manager Cabang 2',
                'email' => 'manager2@gmail.com',
                'password' => 'managercabang2',
                'cabang_id' => 2, // Pastikan ID cabang 1 ada di tabel cabangs
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
                'name' => 'Manager Cabang 3',
                'email' => 'manager3@gmail.com',
                'password' => 'managercabang3',
                'cabang_id' => 3, // Pastikan ID cabang 1 ada di tabel cabangs
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
                'name' => 'Manager Cabang 4',
                'email' => 'manager4@gmail.com',
                'password' => 'managercabang4',
                'cabang_id' => 4, // Pastikan ID cabang 1 ada di tabel cabangs
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
                'name' => 'Manager Cabang 5',
                'email' => 'manager5@gmail.com',
                'password' => 'managercabang5',
                'cabang_id' => 5, // Pastikan ID cabang 1 ada di tabel cabangs
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
                'name' => 'Supervisor Cabang 1',
                'email' => 'supervisor1@gmail.com',
                'password' => 'supervisorcabang1',
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
                'name' => 'Supervisor Cabang 2',
                'email' => 'supervisor2@gmail.com',
                'password' => 'supervisorcabang2',
                'cabang_id' => 2,
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
                'name' => 'Supervisor Cabang 3',
                'email' => 'supervisor3@gmail.com',
                'password' => 'supervisorcabang3',
                'cabang_id' => 3,
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
                'name' => 'Supervisor Cabang 4',
                'email' => 'supervisor4@gmail.com',
                'password' => 'supervisorcabang4',
                'cabang_id' => 4,
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
                'name' => 'Supervisor Cabang 5',
                'email' => 'supervisor5@gmail.com',
                'password' => 'supervisorcabang5',
                'cabang_id' => 5,
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
                'name' => 'Kasir Cabang 3',
                'email' => 'kasir3@gmail.com',
                'password' => 'kasircabang3',
                'cabang_id' => 3,
                'role' => 'kasir',
                'permissions' => [
                    'view_produk',
                    'edit_transaksi',
                    'edit_transaksi_detail',
                ],
            ],
            [
                'name' => 'Kasir Cabang 4',
                'email' => 'kasir4@gmail.com',
                'password' => 'kasircabang4',
                'cabang_id' => 4,
                'role' => 'kasir',
                'permissions' => [
                    'view_produk',
                    'edit_transaksi',
                    'edit_transaksi_detail',
                ],
            ],
            [
                'name' => 'Kasir Cabang 5',
                'email' => 'kasir5@gmail.com',
                'password' => 'kasircabang5',
                'cabang_id' => 5,
                'role' => 'kasir',
                'permissions' => [
                    'view_produk',
                    'edit_transaksi',
                    'edit_transaksi_detail',
                ],
            ],
            [
                'name' => 'Gudang Cabang 1',
                'email' => 'gudang1@gmail.com',
                'password' => 'gudangcabang1',
                'role' => 'gudang',
                'cabang_id' => 1,
                'permissions' => [
                    'view_barang',
                    'view_stok',
                    'edit_stok_movements',
                ],
            ],
            [
                'name' => 'Gudang Cabang 2',
                'email' => 'gudang2@gmail.com',
                'password' => 'gudangcabang2',
                'role' => 'gudang',
                'cabang_id' => 2,
                'permissions' => [
                    'view_barang',
                    'view_stok',
                    'edit_stok_movements',
                ],
            ],
            [
                'name' => 'Gudang Cabang 3',
                'email' => 'gudang3@gmail.com',
                'password' => 'gudangcabang3',
                'role' => 'gudang',
                'cabang_id' => 3,
                'permissions' => [
                    'view_barang',
                    'view_stok',
                    'edit_stok_movements',
                ],
            ],
            [
                'name' => 'Gudang Cabang 4',
                'email' => 'gudang4@gmail.com',
                'password' => 'gudangcabang4',
                'role' => 'gudang',
                'cabang_id' => 4,
                'permissions' => [
                    'view_barang',
                    'view_stok',
                    'edit_stok_movements',
                ],
            ],
            [
                'name' => 'Gudang Cabang 5',
                'email' => 'gudang5@gmail.com',
                'password' => 'gudangcabang5',
                'role' => 'gudang',
                'cabang_id' => 5,
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
