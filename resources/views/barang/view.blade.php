<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Barang') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Daftar Barang</h1>

                {{-- Tampilkan pesan sukses jika ada --}}
                @if (session('success'))
                    <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Tabel daftar barang --}}
                <div class="overflow-x-auto bg-gray-100 dark:bg-gray-900 rounded-lg shadow">
                    <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
                        <thead class="bg-red-700 dark:bg-gray-700 text-white dark:text-gray-300">
                            <tr>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">No</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Nama Barang</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">SKU</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Harga Satuan</th>
                                <th class="px-4 py-2 border border-gray-300 dark:border-gray-600">Stok</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                            @forelse ($stok as $item)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                        {{ $item->barang->nama_barang ?? 'Barang Tidak Ditemukan' }}
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600">
                                        {{ $item->barang->sku ?? 'Barang Tidak Ditemukan' }}
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-right">
                                        {{ number_format($item->barang->harga_satuan ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">
                                        {{ $item->quantity }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-center">
                                        Tidak ada data stok untuk cabang ini
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
