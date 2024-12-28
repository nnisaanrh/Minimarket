<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar permissions
        $permissions = [
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
        ];

        // Buat semua permissions jika belum ada
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Role dan permissions yang sesuai
        $rolesWithPermissions = [
            'admin' => [
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
            'manager' => [
                'view_cabang',
                'view_barang',
                'view_stok',
                'view_transaksi',
                'view_transaksi_detail',
                'view_stok_movements',
            ],
            'supervisor' => [
                'view_barang',
                'view_stok',
                'view_transaksi',
                'view_transaksi_detail',
                'edit_stok_movements',
            ],
            'kasir' => [
                'view_produk',
                'edit_transaksi',
                'edit_transaksi_detail',
            ],
            'gudang' => [
                'view_barang',
                'view_stok',
                'edit_stok_movements',
            ],
        ];

        // Buat roles dan tautkan permissions
        foreach ($rolesWithPermissions as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            $role->syncPermissions($rolePermissions);
        }
    }
}
