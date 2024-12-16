<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('cabang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <x-primary-button tag="a" href="{{ route('cabang.create') }}">Tambah Data Buku</x-primary-button>
                    <x-primary-button tag="a" target="_blank" href="{{ route('cabang.print') }}">Print Data Buku</x-primary-button>
                    <x-primary-button tag="a" target="_blank" href="{{ route('cabang.export') }}">Export Data Buku</x-primary-button>
                    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'import-cabang')">{{ __('Import Excel') }}</x-primary-button> 

                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th scope="col">#</th>
                                <th scope="col">Nama Cabang</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Kota</th>
                            </tr>
                        </x-slot>
                        @foreach ($cabangs as $cabang)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cabang->namacabang }}</td>
                                <td>{{ $cabang->alamatcabang }}</td>
                                <td>{{ $cabang->kota }}</td>
                                    <x-primary-button tag="a"
                                        href="{{ route('cabang.edit', $cabang->id) }}">Edit</x-primary-button>
                                    <x-danger-button x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-cabang-deletion')"
                                        x-on:click="$dispatch('set-action', '{{ route('cabang.destroy', $cabang->id) }}')">{{ __('Delete') }}</x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </x-table>

                    <x-modal name="confirm-cabang-deletion" focusable maxWidth="xl">
                        <form method="post" x-bind:action="action" class="p-6">
                            @method('delete')
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Apakah anda yakin akan menghapus data?') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Setelah proses dilaksanakan. Data akan dihilangkan secara permanen.') }}
                            </p>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                                <x-danger-button class="ml-3">
                                    {{ __('Delete!!!') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>
                    <x-modal name="import-cabang" focusable maxWidth="xl">
                        <form method="post" enctype="multipart/form-data" action="{{route('cabang.import')}}" class="p-6">
                            @method('POST')
                            @csrf
                            <x-file-input id="file" name="file" accept=".xlsx, .xls" class="mt-1 block w-full" />
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                                <x-primary-button class="ml-3">
                                    {{ __('Upload') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
