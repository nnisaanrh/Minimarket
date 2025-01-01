<x-app-layout>
    <div class="max-w-5xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-red-900 dark:text-gray-200 mb-6">Daftar Transaksi</h1>

        @if(session('success'))
            <div class="mb-4 p-4 text-sm text-green-800 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-900">
                {{ session('success') }}
            </div>
        @endif
        <!-- Tombol Import -->
        <form action="{{ route('transaksi.import') }}" method="POST" enctype="multipart/form-data" class="inline-block">
            @csrf
            <input type="file" name="file" class="mb-2" accept=".xlsx,.xls">
            @error('file')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
            <button type="submit" 
                    class="inline-block px-6 py-2 text-sm font-medium text-white bg-green-600 rounded-lg shadow hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600">
                Import Transaksi
            </button>
        </form>
        
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

        <div class="overflow-x-auto mt-8">
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

        <div class="mt-6 text-center">
            <a href="{{ route('transaksi.create') }}" 
               class="inline-block px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
                Tambah Transaksi
            </a>
        </div>
    </div>
</x-app-layout>
