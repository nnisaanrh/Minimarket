<x-app-layout>
    <x-slot name="header">
        @hasrole('admin')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        @endhasrole 
        @hasrole('gudang')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        @endhasrole 
        @hasrole('kasir')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Selamat Datang Kasir GoMart') }}
        </h2>   
        @endhasrole 
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @hasrole('admin')
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Selamat datang admin") }}
                </div>
                @endhasrole 
                @hasrole('gudang')
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Selamat datang Staf Gudang") }}
                </div>
                @endhasrole 
            </div>
        </div>
    </div>
</x-app-layout>
