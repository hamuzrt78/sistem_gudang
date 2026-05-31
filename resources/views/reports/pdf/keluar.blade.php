<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang Keluar</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Laporan Barang Keluar Gudang</h2>
    <table>
        <tr>
            <th>Tanggal</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga Satuan</th>
            <th>Total Harga</th>
            <th>Tujuan</th>
            <th>Pencatat</th>
        </tr>
        @foreach($stockOuts as $out)
        <tr>
            <td>{{ $out->tanggal_keluar }}</td>
            <td>{{ $out->item->kode_barang ?? '-' }}</td>
            <td>{{ $out->item->nama_barang ?? '-' }}</td>
            <td>{{ $out->jumlah }}</td>
            <td>Rp {{ number_format($out->item->harga ?? 0, 0, ',', '.') }}</td>
            <td>Rp {{ number_format(($out->item->harga ?? 0) * $out->jumlah, 0, ',', '.') }}</td>
            <td>{{ $out->tujuan ?: '-' }}</td>
            <td>{{ $out->user->name ?? '-' }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
