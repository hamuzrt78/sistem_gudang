<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang Masuk</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Laporan Barang Masuk Gudang</h2>
    <table>
        <tr>
            <th>Tanggal</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total Harga</th>
            <th>Supplier</th>
            <th>Pencatat</th>
        </tr>
        @foreach($stockIns as $in)
        <tr>
            <td>{{ $in->tanggal_masuk }}</td>
            <td>{{ $in->item->kode_barang ?? '-' }}</td>
            <td>{{ $in->item->nama_barang ?? '-' }}</td>
            <td>{{ $in->jumlah }}</td>
            <td>Rp {{ number_format($in->item->harga ?? 0, 0, ',', '.') }}</td>
            <td>Rp {{ number_format(($in->item->harga ?? 0) * $in->jumlah, 0, ',', '.') }}</td>
            <td>{{ $in->supplier ?: '-' }}</td>
            <td>{{ $in->user->name ?? '-' }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
