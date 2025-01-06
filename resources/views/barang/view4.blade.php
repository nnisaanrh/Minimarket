<x-app-layout>
    <x-slot name="header">
        @hasrole('admin')
        <a href="{{ url('/barang') }}" class="font-semibold text-sm text-white dark:text-gray-200 leading-tight bg-red-800 rounded-lg shadow inline-block px-6 py-2 hover:bg-red-600">
            {{ __('Daftar Barang') }}
        </a>
        <a href="{{ url('/barang/admin-cabang-satu') }}" class="font-semibold text-sm text-white dark:text-gray-200 leading-tight bg-red-800 rounded-lg shadow inline-block px-6 py-2 hover:bg-red-600 ">
            {{ __('Barang Cabang 1') }}
        </a>
        <a href="{{ url('/barang/admin-cabang-dua') }}" class="font-semibold text-sm text-white dark:text-gray-200 leading-tight bg-red-800 rounded-lg shadow inline-block px-6 py-2 hover:bg-red-600 ">
            {{ __('Barang Cabang 2') }}
        </a>
        <a href="{{ url('/barang/admin-cabang-tiga') }}" class="font-semibold text-sm text-white dark:text-gray-200 leading-tight bg-red-800 rounded-lg shadow inline-block px-6 py-2 hover:bg-red-600 ">
            {{ __('Barang Cabang 3') }}
        </a>
        <a href="{{ url('/barang/admin-cabang-empat') }}" class="font-semibold text-sm text-white dark:text-gray-200 leading-tight bg-red-800 rounded-lg shadow inline-block px-6 py-2 hover:bg-red-600 ">
            {{ __('Barang Cabang 4') }}
        </a>
        <a href="{{ url('/barang/admin-cabang-lima') }}" class="font-semibold text-sm text-white dark:text-gray-200 leading-tight bg-red-800 rounded-lg shadow inline-block px-6 py-2 hover:bg-red-600 ">
            {{ __('Barang Cabang 5') }}
        </a>
        @endhasrole 
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-red-900 dark:text-gray-100">
                <h1 class="text-3xl font-bold mb-6">Daftar Barang Cabang 4</h1>

                {{-- Tampilkan pesan sukses jika ada --}}
                @if (session('success'))
                    <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- <div class="detail-row flex flex-nowrap items-start gap-4">
                     <!-- Tombol Export -->
                    <a href="{{ route('barang.export') }}" 
                    class="inline-block px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 ml-4">
                    Export Barang
                    </a>
                     <!-- Tombol Print -->
                    <a href="{{ route('barang.print') }}" 
                    class="inline-block px-6 py-2 text-sm font-medium text-white bg-red-600 rounded-lg shadow hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 ml-4">
                    Print Barang
                    </a>
                </div> --}}
                {{-- Tabel daftar barang --}}
                <div class="overflow-x-auto bg-gray-100 dark:bg-gray-900 rounded-lg shadow mt-10">
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
