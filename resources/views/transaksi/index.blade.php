<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6">Daftar Transaksi</h1>

        @if(session('success'))
            <div class="mb-4 p-4 text-sm text-green-800 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-900">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="table-auto w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
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

        <div class="mt-6 text-center">
            <a href="{{ route('transaksi.create') }}" 
               class="inline-block px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
                Tambah Transaksi
            </a>
        </div>
    </div>
</x-app-layout>
