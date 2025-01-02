<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cabang') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-6">Daftar Cabang</h1>

                {{-- Tombol tambah cabang --}}
                <a href="{{ route('cabang.create') }}" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition mb-4 inline-block">Tambah Cabang</a>

                {{-- Tampilkan pesan sukses jika ada --}}
                @if(session('success'))
                    <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Tabel daftar cabang --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 rounded-lg">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-100">
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Nama</th>
                                <th class="px-4 py-2 border">Alamat</th>
                                <th class="px-4 py-2 border">Kota</th>
                                <th class="px-4 py-2 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cabangs as $index => $cabang)
                            <tr class="{{ $index % 2 === 0 ? 'bg-gray-100 dark:bg-gray-800' : 'bg-white dark:bg-gray-700' }}">
                                <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                                <td class="px-4 py-2 border">{{ $cabang->name }}</td>
                                <td class="px-4 py-2 border">{{ $cabang->alamat }}</td>
                                <td class="px-4 py-2 border">{{ $cabang->Kota }}</td>
                                <td class="px-4 py-2 border text-center">
                                    <a href="{{ route('cabang.edit', $cabang->id) }}" class="px-2 py-1 bg-green-500 text-white text-sm rounded hover:bg-yellow-600 transition inline-block">Edit</a>
                                    <form action="{{ route('cabang.destroy', $cabang->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600 transition" onclick="return confirm('Yakin ingin menghapus cabang ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
