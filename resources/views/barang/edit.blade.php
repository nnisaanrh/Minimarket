<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Edit Barang</h1>
        <form action="{{ route('barang.update', $barang->id) }}" method="POST">
            @csrf
            @method('PUT')
    
            {{-- Input Nama Barang --}}
            <div class="mb-4">
                <label for="name" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Nama Barang</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" value="{{ old('name', $cabang->name) }}" required>
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
    
            {{-- Input sku --}}
            <div class="mb-4">
                <label for="sku" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">SKU</label>
                <input type="text" name="sku" id="sku" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" value="{{ old('sku', $barang->sku) }}" required>
                @error('sku')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
    
            {{-- Input Kota --}}
            <div class="mb-4">
                <label for="harga_satuan" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Harga Satuan</label>
                <input type="text" name="harga_satuan" id="harga_satuan" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" value="{{ old('harga_satuan', $barang->harga_satuan) }}" required>
                @error('harga_satuan')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
    
            {{-- Tombol Perbarui dan Kembali --}}
            <div class="flex justify-end space-x-4">
                <a href="{{ route('barang.index') }}" class="px-4 py-2 bg-gray-500 text-white font-semibold rounded-lg shadow-md hover:bg-gray-600 transition">Kembali</a>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition">Perbarui</button>
            </div>
        </form>
    </div>
    </x-app-layout>
    