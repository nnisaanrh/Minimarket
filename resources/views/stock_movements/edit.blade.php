<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Pergerakan Stok') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Edit Pergerakan Stok</h1>

                {{-- Form Edit Pergerakan Stok --}}
                <form action="{{ route('stock_movements.update', $stockMovement->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        {{-- Cabang --}}
                        <div>
                            <label for="cabang_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cabang</label>
                            <select name="cabang_id" id="cabang_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                                @foreach($cabangs as $cabang)
                                    <option value="{{ $cabang->id }}" {{ $stockMovement->cabang_id == $cabang->id ? 'selected' : '' }}>
                                        {{ $cabang->name }}
                                    </option>
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
                                @foreach($barangs as $barang)
                                    <option value="{{ $barang->id }}" {{ $stockMovement->barang_id == $barang->id ? 'selected' : '' }}>
                                        {{ $barang->nama_barang }}
                                    </option>
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
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $stockMovement->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
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
                                <option value="in" {{ $stockMovement->type == 'in' ? 'selected' : '' }}>Masuk</option>
                                <option value="out" {{ $stockMovement->type == 'out' ? 'selected' : '' }}>Keluar</option>
                            </select>
                            @error('type')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jumlah --}}
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah</label>
                            <input type="number" name="quantity" id="quantity" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="{{ $stockMovement->quantity }}" required min="1">
                            @error('quantity')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
