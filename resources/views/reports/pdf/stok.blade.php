<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Laporan Stok Gudang</h2>
    <table>
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Satuan</th>
            <th>Stok</th>
            <th>Harga Satuan</th>
            <th>Nilai Stok</th>
            <th>Stok Min</th>
            <th>Lokasi Rak</th>
        </tr>
        @foreach($items as $item)
        <tr>
            <td>{{ $item->kode_barang }}</td>
            <td>{{ $item->nama_barang }}</td>
            <td>{{ $item->category->nama_kategori ?? '-' }}</td>
            <td>{{ $item->unit->nama_satuan ?? '-' }}</td>
            <td>{{ $item->stok }}</td>
            <td>Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}</td>
            <td>Rp {{ number_format(($item->harga ?? 0) * $item->stok, 0, ',', '.') }}</td>
            <td>{{ $item->stok_minimum }}</td>
            <td>{{ $item->lokasi_rak }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
