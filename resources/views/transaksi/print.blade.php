<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <style>
        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1 style="text-align: center;">Transaksi</h1>
    </header>
    <section>
        <table border="1" style="border-collapse: collapse; margin: 0px 10px 0px 10px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cabang</th>
                    <th>User</th>
                    <th>Tanggal Penjualan</th>
                    <th>ID Detail Transaksi</th>
                    <th>Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                    $totalPenghasilan = 0; // Variabel untuk menyimpan total penghasilan
                @endphp
                @foreach ($transaksis as $transaksi)
                    @foreach ($transaksi->transaksiDetails as $detail)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $transaksi->cabang->name }}</td>
                            <td>{{ $transaksi->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_penjualan)->format('d-m-Y') }}</td>
                            <td>{{ $detail->id }}</td>
                            <td>{{ $detail->barang->nama_barang }}</td>
                            <td>{{ $detail->jumlah_barang }}</td>
                            <td>{{ number_format($detail->harga, 0, ',', '.') }}</td>
                            <td>{{ number_format($transaksi->total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    @php
                        $totalPenghasilan += $transaksi->total; // Tambahkan total transaksi ke total penghasilan
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" style="text-align: left;">Total Semua Penghasilan:</td>
                    <td>{{ number_format($totalPenghasilan, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </section>
</body>
</html>
