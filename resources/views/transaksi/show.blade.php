<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6">Detail Transaksi</h1>

        @if(session('success'))
            <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300 border">Barang</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300 border">Jumlah</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300 border">Harga Satuan</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300 border">Harga Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksis as $transaksi)
                        @foreach($transaksi->transaksiDetails as $detail)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 border">
                                    {{ $detail->barang->nama_barang }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 border">
                                    {{ $detail->jumlah_barang }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 border">
                                    {{ number_format($detail->harga, 2) }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 border">
                                    {{ number_format($detail->harga_total, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('transaksi.index') }}" class="px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:ring focus:ring-blue-300">
                Kembali
            </a>
        </div>
    </div>
</x-app-layout>
