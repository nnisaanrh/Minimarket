<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pergerakan Stok') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Tambah Pergerakan Stok</h1>

                {{-- Form Tambah Pergerakan Stok --}}
                <form action="{{ route('stock_movements.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        {{-- Cabang --}}
                        <div>
                            <label for="cabang_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cabang</label>
                            <select name="cabang_id" id="cabang_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                                <option value="" disabled selected>-- Pilih Cabang --</option>
                                @foreach($cabangs as $cabang)
                                    <option value="{{ $cabang->id }}">{{ $cabang->name }}</option>
                                @endforeach
                            </select>
                            @error('cabang_id')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Barang --}}
                        <div>
                            <label for="barang_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang</label>
                            <select name="barang_id" id="barang_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                                <option value="" disabled selected>-- Pilih Barang --</option>
                                @foreach($barangs as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                @endforeach
                            </select>
                            @error('barang_id')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- User --}}
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User</label>
                            <select name="user_id" id="user_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                                <option value="" disabled selected>-- Pilih User --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tipe --}}
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipe</label>
                            <select name="type" id="type" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                                <option value="in">Masuk</option>
                                <option value="out">Keluar</option>
                            </select>
                            @error('type')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jumlah --}}
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah</label>
                            <input type="number" name="quantity" id="quantity" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required min="1">
                            @error('quantity')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>


                        {{-- Submit Button --}}
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
