<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Transaksi</h1>
        <div class="container">
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <h3>Detail Transaksi</h3>
                <div id="details">
                    <div class="detail-row">
                        <label for="barang_id">Barang:</label>
                        <select name="details[0][barang_id]" required>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                            @endforeach
                        </select>

                        <label for="jumlah_barang">Jumlah:</label>
                        <input type="number" name="details[0][jumlah_barang]" required oninput="updateHarga(0)">

                        <label for="harga">Harga:</label>
                        <input type="number" name="details[0][harga]" step="0.01" class="harga" data-index="0" required readonly>

                        <label for="harga_total">Harga Total:</label>
                        <input type="number" name="details[0][harga_total]" step="0.01" class="harga_total" data-index="0" required readonly>
                    </div>
                </div>

                <button type="button" onclick="addDetail()">Tambah Barang</button>

                <button type="submit" class="btn btn-success mt-3">Simpan</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary mt-3">Batal</a>
            </form>
        </div>
    </div>

    <script>
        let detailIndex = 1;

        // Menambahkan baris detail baru
        function addDetail() {
            const detailRow = document.createElement('div');
            detailRow.classList.add('detail-row');

            detailRow.innerHTML = `
                <label for="barang_id">Barang:</label>
                <select name="details[${detailIndex}][barang_id]" class="barang_select" data-index="${detailIndex}" onchange="updateHarga(${detailIndex})" required>
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                    @endforeach
                </select>

                <label for="jumlah_barang">Jumlah:</label>
                <input type="number" name="details[${detailIndex}][jumlah_barang]" required oninput="updateHarga(${detailIndex})">

                <label for="harga">Harga:</label>
                <input type="number" name="details[${detailIndex}][harga]" step="0.01" class="harga" data-index="${detailIndex}" required readonly>

                <label for="harga_total">Harga Total:</label>
                <input type="number" name="details[${detailIndex}][harga_total]" step="0.01" class="harga_total" data-index="${detailIndex}" required readonly>
            `;

            document.getElementById('details').appendChild(detailRow);
            detailIndex++;
        }

        // Fungsi untuk memperbarui harga otomatis ketika memilih barang atau jumlah barang
        function updateHarga(index) {
            const barangId = document.querySelector(`select[name="details[${index}][barang_id]"]`).value;
            const jumlahBarang = document.querySelector(`input[name="details[${index}][jumlah_barang]"]`).value;

            // Mencari harga barang berdasarkan barang_id yang dipilih
            const barang = @json($barangs); // Mendapatkan semua barang yang ada di backend

            const selectedBarang = barang.find(b => b.id == barangId);
            if (selectedBarang) {
                const hargaSatuan = selectedBarang.harga_satuan;
                const hargaInput = document.querySelector(`input[name="details[${index}][harga]"]`);
                const hargaTotalInput = document.querySelector(`input[name="details[${index}][harga_total]"]`);

                // Mengupdate harga satuan
                hargaInput.value = hargaSatuan;

                // Menghitung harga total
                const hargaTotal = hargaSatuan * jumlahBarang;
                hargaTotalInput.value = hargaTotal;
            }
        }
    </script>
</x-app-layout>
