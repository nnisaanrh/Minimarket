<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Daftar Transaksi</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">ID Transaksi</th>
                    <th class="px-4 py-2 border">Tanggal Penjualan</th>
                    <th class="px-4 py-2 border">Total</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksis as $transaksi)
                    <tr>
                        <td class="px-4 py-2 border">{{ $transaksi->id }}</td>
                        <td class="px-4 py-2 border">{{ $transaksi->tanggal_penjualan }}</td>
                        <td class="px-4 py-2 border">{{ number_format($transaksi->total, 2) }}</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('transaksi.show', $transaksi->id) }}" class="text-blue-500">Detail</a>
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('transaksi.create') }}" class="btn btn-primary mt-6">Tambah Transaksi</a>
    </div>
</x-app-layout>
cdmdg