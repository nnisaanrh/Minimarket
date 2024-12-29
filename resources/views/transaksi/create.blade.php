<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6">Transaksi</h1>
        <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6">
            @csrf

            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Detail Transaksi</h3>
            <div id="details" class="space-y-4">
                <div class="detail-row flex flex-wrap items-center gap-4">
                    <div class="w-full md:w-1/3">
                        <label for="barang_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang:</label>
                        <select name="details[0][barang_id]" class="w-full p-2 mt-1 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full md:w-1/6">
                        <label for="jumlah_barang" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah:</label>
                        <input type="number" name="details[0][jumlah_barang]" class="w-full p-2 mt-1 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required oninput="updateHarga(0)">
                    </div>

                    <div class="w-full md:w-1/4">
                        <label for="harga" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga:</label>
                        <input type="number" name="details[0][harga]" class="w-full p-2 mt-1 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 harga" data-index="0" step="0.01" required readonly>
                    </div>

                    <div class="w-full md:w-1/4">
                        <label for="harga_total" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga Total:</label>
                        <input type="number" name="details[0][harga_total]" class="w-full p-2 mt-1 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 harga_total" data-index="0" step="0.01" required readonly>
                    </div>
                </div>
            </div>

            <button type="button" onclick="addDetail()" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 focus:ring focus:ring-blue-300">
                Tambah Barang
            </button>

            <div class="flex justify-between mt-6">
                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 focus:ring focus:ring-green-300">
                    Simpan
                </button>
                <a href="{{ route('transaksi.index') }}" class="px-6 py-2 bg-gray-600 text-white rounded-lg shadow hover:bg-gray-700 focus:ring focus:ring-gray-300">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        let detailIndex = 1;

        // Menambahkan baris detail baru
        function addDetail() {
            const detailRow = document.createElement('div');
            detailRow.classList.add('detail-row', 'flex', 'flex-wrap', 'items-center', 'gap-4', 'mt-4');

            detailRow.innerHTML = `
                <div class="w-full md:w-1/3">
                    <label for="barang_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barang:</label>
                    <select name="details[${detailIndex}][barang_id]" class="w-full p-2 mt-1 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required onchange="updateHarga(${detailIndex})">
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full md:w-1/6">
                    <label for="jumlah_barang" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah:</label>
                    <input type="number" name="details[${detailIndex}][jumlah_barang]" class="w-full p-2 mt-1 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" required oninput="updateHarga(${detailIndex})">
                </div>

                <div class="w-full md:w-1/4">
                    <label for="harga" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga:</label>
                    <input type="number" name="details[${detailIndex}][harga]" class="w-full p-2 mt-1 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 harga" step="0.01" required readonly>
                </div>

                <div class="w-full md:w-1/4">
                    <label for="harga_total" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga Total:</label>
                    <input type="number" name="details[${detailIndex}][harga_total]" class="w-full p-2 mt-1 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 harga_total" step="0.01" required readonly>
                </div>
            `;

            document.getElementById('details').appendChild(detailRow);
            detailIndex++;
        }

        // Fungsi untuk memperbarui harga otomatis ketika memilih barang atau jumlah barang
        function updateHarga(index) {
            const barangId = document.querySelector(`select[name="details[${index}][barang_id]"]`).value;
            const jumlahBarang = document.querySelector(`input[name="details[${index}][jumlah_barang]"]`).value;

            const barang = @json($barangs);

            const selectedBarang = barang.find(b => b.id == barangId);
            if (selectedBarang) {
                const hargaSatuan = selectedBarang.harga_satuan;
                const hargaInput = document.querySelector(`input[name="details[${index}][harga]"]`);
                const hargaTotalInput = document.querySelector(`input[name="details[${index}][harga_total]"]`);

                hargaInput.value = hargaSatuan;
                const hargaTotal = hargaSatuan * jumlahBarang;
                hargaTotalInput.value = hargaTotal;
            }
        }
    </script>
</x-app-layout>
