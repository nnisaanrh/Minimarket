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

                {{-- Tombol tambah pergerakan stok --}}
                <a href="{{ route('stock_movements.create') }}" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition mb-4 inline-block">
                    Tambah Pergerakan Stok
                </a>

                {{-- Tampilkan pesan sukses jika ada --}}
                @if(session('success'))
                    <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Tabel daftar pergerakan stok --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 rounded-lg">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-100">
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Cabang</th>
                                <th class="px-4 py-2 border">Barang</th>
                                <th class="px-4 py-2 border">User</th>
                                <th class="px-4 py-2 border">Tipe</th>
                                <th class="px-4 py-2 border">Jumlah</th>
                                <th class="px-4 py-2 border">Tanggal</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stock_movements as $index => $movement)
                                <tr class="{{ $index % 2 === 0 ? 'bg-gray-100 dark:bg-gray-800' : 'bg-white dark:bg-gray-700' }}">
                                    <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 border">{{ $movement->cabang->nama }}</td>
                                    <td class="px-4 py-2 border">{{ $movement->barang->nama_barang }}</td>
                                    <td class="px-4 py-2 border">{{ $movement->user->name }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <span class="px-2 py-1 text-sm font-semibold rounded {{ $movement->type === 'in' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                            {{ ucfirst($movement->type) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 border text-center">{{ $movement->quantity }}</td>
                                    <td class="px-4 py-2 border text-center">{{ $movement->movement_date->format('d-m-Y H:i') }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <a href="{{ route('stock_movements.edit', $movement->id) }}" class="px-2 py-1 bg-green-500 text-white text-sm rounded hover:bg-green-600 transition inline-block">
                                            Edit
                                        </a>
                                        <form action="{{ route('stock_movements.destroy', $movement->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus pergerakan stok ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-2 border text-center">Tidak ada data pergerakan stok.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
