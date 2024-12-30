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
                    <table class="table table-bordered table-striped mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border text-center"">#</th>
                                <th class="px-4 py-2 border text-center">Cabang</th>
                                <th class="px-4 py-2 border text-center">Barang</th>
                                <th class="px-4 py-2 border text-center">User</th>
                                <th class="px-4 py-2 border text-center">Tipe</th>
                                <th class="px-4 py-2 border text-center">Jumlah</th>
                                <th class="px-4 py-2 border text-center">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stockMovements as $movement)
                                <tr>
                                    <td class="px-4 py-2 border text-center" >{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 border text-center" >{{ $movement->cabang->name ?? 'Cabang Tidak Ditemukan' }}</td>
                                    <td class="px-4 py-2 border text-center" >{{ $movement->barang->nama_barang ?? 'Barang Tidak Ditemukan' }}</td>
                                    <td class="px-4 py-2 border text-center" >{{ $movement->user->name ?? 'User Tidak Ditemukan' }}</td>
                                    <td class="px-4 py-2 border text-center" >
                                        @if ($movement->type === 'in')
                                            <span class="badge bg-success">Masuk</span>
                                        @else
                                            <span class="badge bg-danger">Keluar</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border text-center" >{{ $movement->quantity }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        {{ \Carbon\Carbon::parse($movement->movement_date)->format('d-m-Y H:i') }}
                                    </td>                                    
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data pergerakan stok</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


