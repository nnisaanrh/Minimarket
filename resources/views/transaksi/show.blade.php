<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Detail Transaksi</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
                    <!-- Detail transaksi -->
                    <tr>
                        <td colspan="4">
                            <table class="w-full mt-2">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 border" >Barang</th>
                                        <th class="px-4 py-2 border" >Jumlah</th>
                                        <th class="px-4 py-2 border" >Harga Satuan</th>
                                        <th class="px-4 py-2 border" >Harga Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transaksis as $transaksi)

                                    @foreach($transaksi->transaksiDetails as $detail)
                                        <tr>
                                            <td class="px-4 py-2 border" >{{ $detail->barang->nama_barang }}</td>
                                            <td class="px-4 py-2 border" >{{ $detail->jumlah_barang }}</td>
                                            <td class="px-4 py-2 border" >{{ number_format($detail->harga, 2) }}</td>
                                            <td class="px-4 py-2 border" >{{ number_format($detail->harga_total, 2) }}</td>
                                        </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('transaksi.index') }}" class="btn btn-primary mt-6">Kembali</a>
    </div>
</x-app-layout>
cdmdg