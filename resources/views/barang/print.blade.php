<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Daftar Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h1>Daftar Barang Cabang {{ auth()->user()->cabang->name }}</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Cabang</th>
                <th>Nama Barang</th>
                <th>SKU</th>
                <th>Harga/Barang</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barangs as $barang)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                    @foreach($barang->stoks as $stok)
                            @if($stok->cabang_id == auth()->user()->cabang_id) <!-- Pastikan hanya stok cabang yang login -->
                                {{ $stok->cabang->name}}
                            @endif
                        @endforeach
                    </td>
                    <!-- Ambil cabang dari stok -->
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->sku }}</td>
                    <td>{{ number_format($barang->harga_satuan, 2) }}</td>
                    
                    <!-- Tampilkan stok sesuai dengan cabang -->
                    <td>
                        @foreach($barang->stoks as $stok)
                            @if($stok->cabang_id == auth()->user()->cabang_id) <!-- Pastikan hanya stok cabang yang login -->
                                {{ $stok->quantity }}
                            @endif
                        @endforeach
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada barang yang tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ date('Y-m-d H:i:s') }}
    </div>
</body>
</html>
