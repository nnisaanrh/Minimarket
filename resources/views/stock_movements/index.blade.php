<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pergerakan Stok') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Daftar Pergerakan Stok</h1>

                {{-- Tombol aksi --}}
                <div class="flex space-x-4 mb-6">
                    @hasrole('gudang')
                    <a href="{{ route('stock_movements.create') }}" 
                       class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition">
                        Tambah Pergerakan Stok
                    </a>
                    @endhasrole
                    <a href="{{ route('stock_movements.export') }}" 
                       class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition">
                        Export Pergerakan Stok
                    </a>
                    <a href="{{ route('stock_movements.print') }}" 
                       class="px-4 py-2 bg-red-700 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 transition">
                        Print Pergerakan Stok
                    </a>
                </div>

                {{-- Pesan flash --}}
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('info'))
                    <div class="mb-4 p-4 bg-blue-100 text-blue-800 rounded-lg">
                        {{ session('info') }}
                    </div>
                @endif

                {{-- Tabel daftar pergerakan stok --}}
                <div class="overflow-x-auto bg-gray-100 dark:bg-gray-900 rounded-lg shadow">
                    <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
                        <thead class="bg-red-700 dark:bg-gray-700">
                            <tr class="text-white dark:text-gray-300">
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">#</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Cabang</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Barang</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">User</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Tipe</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Jumlah</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stockMovements as $movement)
                                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">{{ $movement->cabang->name ?? 'Cabang Tidak Ditemukan' }}</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">{{ $movement->barang->nama_barang ?? 'Barang Tidak Ditemukan' }}</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">{{ $movement->user->name ?? 'User Tidak Ditemukan' }}</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">
                                        <span class="{{ $movement->type === 'in' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }} px-2 py-1 rounded">
                                            {{ $movement->type === 'in' ? 'Masuk' : 'Keluar' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">{{ $movement->quantity }}</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">
                                        {{ \Carbon\Carbon::parse($movement->movement_date)->format('d-m-Y H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center text-gray-500">
                                        Tidak ada data pergerakan stok
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
