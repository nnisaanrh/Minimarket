<x-app-layout>
    <x-slot name="header">
        @hasrole('admin')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Selamat datang admin') }}
        </h2>
        @endhasrole 
        @hasrole('gudang')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Selamat datang Staf Gudang') }}
        </h2>
        @endhasrole 
        @hasrole('kasir')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Selamat Datang Kasir GoMart') }}
        </h2>   
        @endhasrole 
        @hasrole('manager')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Selamat Datang Manager GoMart') }}
        </h2>   
        @endhasrole 
        @hasrole('supervisor')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Selamat Datang Supervisor GoMart') }}
        </h2>   
        @endhasrole 
    </x-slot>
    @hasrole('supervisor|admin|manager|kasir|gudang')
    <div class=" flex h-full w-full p-5 gap-5 font-semibold ">
        <div class="w-1/2">
            <img src="{{ asset('images/toko2.jpg') }}" alt="toko" class="w-100">
        </div>
        <div class="w-1/2">
            <h3 class="text-white bg-red-700 text-center text-2xl font-semibold rounded-xl shadow-md mb-4">VISI</h3>
            <p class="text-justify">Menjadi minimarket pilihan utama masyarakat, menyediakan kebutuhan sehari-hari dengan layanan terbaik, harga kompetitif, dan kenyamanan berbelanja di seluruh cabang YusMart.</p>
            <h3 class="text-white bg-red-700 text-center text-2xl font-semibold rounded-xl shadow-md mb-4 mt-3" >MISI</h3>
            <p>1. Memberikan Pelayanan Terbaik<br>Menyediakan pelayanan ramah, cepat, dan profesional untuk menciptakan pengalaman belanja yang menyenangkan.</p>
            <p>2. Menyediakan Produk Berkualitas<br>Menjamin ketersediaan produk yang lengkap, berkualitas, dan sesuai dengan kebutuhan pelanggan.</p>
            <p>3. Harga yang Kompetitif<br>Menawarkan harga yang terjangkau agar dapat dijangkau oleh seluruh lapisan masyarakat.</p>
            <p>4. Meningkatkan Kenyamanan Berbelanja<br>Menghadirkan suasana belanja yang nyaman, bersih, dan modern di seluruh cabang YusMart.</p>
        </div>
    </div>
    @endhasrole 
</x-app-layout>
