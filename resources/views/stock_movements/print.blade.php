
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Movements Report</title>
    <style>
        th, td {
            padding: 10px;
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1 style="text-align: center;">Stock Movements Report</h1>
    </header>
    <section>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cabang</th>
                    <th>Barang</th>
                    <th>User</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Movement Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stock_movements as $index => $movement)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $movement->cabang->name }}</td>
                    <td>{{ $movement->barang->nama_barang }}</td>
                    <td>{{ $movement->user->name }}</td>
                    <td>{{ ucfirst($movement->type) }}</td>
                    <td>{{ $movement->quantity }}</td>
                    <td>{{ $movement->movement_date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</body>
</html>