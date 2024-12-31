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
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('info'))
                <div class="alert alert-info">
                    {{ session('info') }}
                </div>
            @endif
            
                <!-- Tombol Import -->
        <form action="{{ route('stock_movements.import') }}" method="POST" enctype="multipart/form-data" class="inline-block">
            @csrf
            <input type="file" name="file" class="mb-2" accept=".xlsx,.xls">
            @error('file')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
            <button type="submit" 
                    class="inline-block px-6 py-2 text-sm font-medium text-white bg-green-600 rounded-lg shadow hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600">
                Import Pergerakan stok
            </button>
        </form>
        
        <!-- Tombol Export -->
        <a href="{{ route('stock_movements.export') }}" 
           class="inline-block px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 ml-4">
            Export Pergerakan stok
        </a>
        
        <!-- Tombol Print -->
        <a href="{{ route('stock_movements.print') }}" 
           class="inline-block px-6 py-2 text-sm font-medium text-white bg-red-600 rounded-lg shadow hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 ml-4">
            Print Pergerakan stok
        </a>
    </div>

                {{-- Tabel daftar pergerakan stok --}}
                <div class="overflow-x-auto">
                    <table class="table table-bordered table-striped mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border text-center">#</th>
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


