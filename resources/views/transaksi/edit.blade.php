<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Edit Transaksi</h1>
        <div class="container">
            <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label for="tanggal_penjualan">Tanggal Penjualan:</label>
                <input type="date" id="tanggal_penjualan" name="tanggal_penjualan" value="{{ $transaksi->tanggal_penjualan }}" required>

                <h3>Detail Transaksi</h3>
                <div id="details">
                    @foreach($transaksi->transaksiDetails as $index => $detail)
                        <div class="detail-row" id="detail-row-{{ $index }}">
                            <label for="barang_id">Barang:</label>
                            <select name="details[{{ $index }}][barang_id]" class="barang_select" data-index="{{ $index }}" onchange="updateHarga({{ $index }})" required>
                                @foreach($barangs as $barang)
                                    <option value="{{ $barang->id }}" {{ $barang->id == $detail->barang_id ? 'selected' : '' }}>{{ $barang->nama_barang }}</option>
                                @endforeach
                            </select>

                            <label for="jumlah_barang">Jumlah:</label>
                            <input type="number" name="details[{{ $index }}][jumlah_barang]" value="{{ $detail->jumlah_barang }}" required oninput="updateHarga({{ $index }})">

                            <label for="harga">Harga:</label>
                            <input type="number" name="details[{{ $index }}][harga]" step="0.01" value="{{ $detail->harga }}" class="harga" data-index="{{ $index }}" required readonly>

                            <label for="harga_total">Harga Total:</label>
                            <input type="number" name="details[{{ $index }}][harga_total]" step="0.01" value="{{ $detail->harga_total }}" class="harga_total" data-index="{{ $index }}" required readonly>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-success mt-3">Perbarui</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary mt-3">Batal</a>
            </form>
        </div>
    </div>

    <script>
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
