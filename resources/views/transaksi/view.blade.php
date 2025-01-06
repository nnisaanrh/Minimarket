<x-app-layout>
    <div class="max-w-6xl mx-auto mt-10 bg-white dark:bg-gray-800 p-7 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-red-900 dark:text-gray-200 mb-6">Daftar Transaksi di {{ $cabangName }}</h1>
    </div>
    <div class="max-w-6xl mx-auto mt-10 bg-white dark:bg-gray-800 p-7 rounded-lg shadow-lg">
        <div class="overflow-x-auto mt-2">
            <table class="table-auto w-full text-sm text-left text-black dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-red-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-4 py-3 border">ID Transaksi</th>
                        <th class="px-4 py-3 border">Tanggal Penjualan</th>
                        <th class="px-4 py-3 border">Total</th>
                        <th class="px-4 py-3 border">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($transaksis as $transaksi)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-4 py-3 border text-gray-900 dark:text-gray-200">{{ $transaksi->id }}</td>
                            <td class="px-4 py-3 border text-gray-900 dark:text-gray-200">{{ $transaksi->tanggal_penjualan }}</td>
                            <td class="px-4 py-3 border text-gray-900 dark:text-gray-200">{{ number_format($transaksi->total, 2) }}</td>
                            <td class="px-4 py-3 border">
                                <a href="{{ route('transaksi.show', $transaksi->id) }}" class="text-blue-600 hover:underline dark:text-blue-400">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

        <div class="mt-6 w-1/2 ml-20">
            <!-- Tombol Export -->
            <a href="{{ route('transaksi.export') }}" 
             class="inline-block px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 ml-4">
             Export Transaksi
            </a>
            <!-- Tombol Print -->
            <a href="{{ route('transaksi.print') }}" 
            class="inline-block px-6 py-2 text-sm font-medium text-white bg-red-600 rounded-lg shadow hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 ml-4">
            Print Transaksi
            </a>
        </div>
    </div>
</x-app-layout>
