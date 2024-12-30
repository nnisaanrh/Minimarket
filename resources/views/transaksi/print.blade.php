<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Buku Perpustakaan</title>
    <style>
        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1 style="text-align: center;">List Buku Perpustakaan</h1>
    </header>
    <section>
        <table border="1" style="border-collapse: collapse; margin: 0px 10px 0px 10px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cabang</th>
                    <th>User</th>
                    <th>Total Harga</th>
                    <th>Tanggal Penjualan</th>
                    <th>ID Detail Transaksi</th>
                    <th>Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody style="text-align: center;">
                @foreach ($transaksis as $transaksi)
                    @foreach ($transaksi->transaksiDetails as $detail)
                        <tr>
                            <td>{{ $loop->parent->iteration }}</td> <!-- Looping untuk transaksi -->
                            <td>{{ $transaksi->cabang->name }}</td>
                            <td>{{ $transaksi->user->name }}</td>
                            <td>{{ $transaksi->total }}</td>
                            <td>{{ $transaksi->tanggal_penjualan }}</td>
                            <td>{{ $detail->id }}</td> <!-- Menambahkan ID detail transaksi -->
                            <td>{{ $detail->barang->nama_barang }}</td> <!-- Akses barang dari transaksiDetails -->
                            <td>{{ $detail->jumlah_barang }}</td>
                            <td>{{ $detail->harga }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </section>
</body>
</html>
