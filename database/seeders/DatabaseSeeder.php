<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\StockMutation;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ========================
        // USERS
        // ========================
        $superadmin = User::create([
            'name'     => 'Superadmin',
            'email'    => 'superadmin@gudang.com',
            'password' => Hash::make('password'),
            'role'     => 'superadmin',
        ]);

        $staff = User::create([
            'name'     => 'Staff Gudang',
            'email'    => 'staff@gudang.com',
            'password' => Hash::make('password'),
            'role'     => 'staff',
        ]);

        $pimpinan = User::create([
            'name'     => 'Pimpinan',
            'email'    => 'pimpinan@gudang.com',
            'password' => Hash::make('password'),
            'role'     => 'pimpinan',
        ]);

        // ========================
        // SATUAN BARANG
        // ========================
        $unitUnit = Unit::create(['nama_satuan' => 'Unit', 'simbol' => 'unit']);
        $unitPcs  = Unit::create(['nama_satuan' => 'Pcs',  'simbol' => 'pcs']);
        $unitBox  = Unit::create(['nama_satuan' => 'Box',  'simbol' => 'box']);

        // ========================
        // KATEGORI BARANG
        // ========================
        $catProcessor   = Category::create(['nama_kategori' => 'Processor',   'deskripsi' => 'CPU / Prosesor AMD & Intel']);
        $catVGA         = Category::create(['nama_kategori' => 'VGA',          'deskripsi' => 'Kartu Grafis / Graphics Card']);
        $catMotherboard = Category::create(['nama_kategori' => 'Motherboard',  'deskripsi' => 'Papan Induk / Mainboard']);
        $catRAM         = Category::create(['nama_kategori' => 'RAM',          'deskripsi' => 'Memory / RAM DDR4 & DDR5']);
        $catStorage     = Category::create(['nama_kategori' => 'Storage',      'deskripsi' => 'SSD NVMe & HDD']);
        $catPeriferal   = Category::create(['nama_kategori' => 'Periferal',    'deskripsi' => 'Keyboard, Mouse, Headset, Monitor Gaming']);
        $catPCGaming    = Category::create(['nama_kategori' => 'PC Gaming',    'deskripsi' => 'Unit PC Gaming siap pakai (Entry, Mid, High End)']);

        // ========================
        // DATA BARANG
        // ========================
        // --- Processor ---
        $amdRyzen7 = Item::create([
            'nama_barang'  => 'AMD Ryzen 7 9800X3D',
            'category_id'  => $catProcessor->id,
            'unit_id'      => $unitUnit->id,
            'stok'         => 15,
            'stok_minimum' => 5,
            'lokasi_rak'   => 'Rak B-02',
            'deskripsi'    => 'Processor AMD Ryzen 7 9800X3D AM5, 3D V-Cache Technology',
        ]);

        $intelCore = Item::create([
            'nama_barang'  => 'Intel Core i7-14700K',
            'category_id'  => $catProcessor->id,
            'unit_id'      => $unitUnit->id,
            'stok'         => 10,
            'stok_minimum' => 3,
            'lokasi_rak'   => 'Rak B-03',
            'deskripsi'    => 'Processor Intel Core i7-14700K LGA1700',
        ]);

        // --- VGA ---
        $rtx5070 = Item::create([
            'nama_barang'  => 'NVIDIA GeForce RTX 5070',
            'category_id'  => $catVGA->id,
            'unit_id'      => $unitUnit->id,
            'stok'         => 3,  // intentionally low for "stok kritis" demo
            'stok_minimum' => 5,
            'lokasi_rak'   => 'Rak A-01',
            'deskripsi'    => 'VGA RTX 5070 GDDR7 12GB, DLSS 4, Ray Tracing',
        ]);

        $rtx4080 = Item::create([
            'nama_barang'  => 'NVIDIA GeForce RTX 4080 Super',
            'category_id'  => $catVGA->id,
            'unit_id'      => $unitUnit->id,
            'stok'         => 8,
            'stok_minimum' => 3,
            'lokasi_rak'   => 'Rak A-02',
            'deskripsi'    => 'VGA RTX 4080 Super GDDR6X 16GB',
        ]);

        // --- Motherboard ---
        $mobASUS = Item::create([
            'nama_barang'  => 'ASUS ROG Strix X870-E Gaming',
            'category_id'  => $catMotherboard->id,
            'unit_id'      => $unitUnit->id,
            'stok'         => 7,
            'stok_minimum' => 2,
            'lokasi_rak'   => 'Rak D-01',
            'deskripsi'    => 'Motherboard AMD AM5, DDR5, PCIe 5.0',
        ]);

        // --- RAM ---
        $ramKingston = Item::create([
            'nama_barang'  => 'Kingston Fury Beast DDR5 16GB',
            'category_id'  => $catRAM->id,
            'unit_id'      => $unitPcs->id,
            'stok'         => 25,
            'stok_minimum' => 8,
            'lokasi_rak'   => 'Rak E-01',
            'deskripsi'    => 'RAM DDR5 16GB 5200MHz CL40',
        ]);

        $ramCorsair = Item::create([
            'nama_barang'  => 'Corsair Vengeance DDR5 32GB',
            'category_id'  => $catRAM->id,
            'unit_id'      => $unitPcs->id,
            'stok'         => 4,
            'stok_minimum' => 5, // also critically low
            'lokasi_rak'   => 'Rak E-02',
            'deskripsi'    => 'RAM DDR5 32GB 6000MHz CL36 Kit (2x16GB)',
        ]);

        // --- Storage ---
        $ssdSamsung = Item::create([
            'nama_barang'  => 'Samsung 990 Pro SSD NVMe 1TB',
            'category_id'  => $catStorage->id,
            'unit_id'      => $unitUnit->id,
            'stok'         => 30,
            'stok_minimum' => 10,
            'lokasi_rak'   => 'Rak C-01',
            'deskripsi'    => 'SSD NVMe M.2 PCIe 4.0, Read 7450MB/s',
        ]);

        $hddWD = Item::create([
            'nama_barang'  => 'WD Blue HDD 2TB',
            'category_id'  => $catStorage->id,
            'unit_id'      => $unitUnit->id,
            'stok'         => 20,
            'stok_minimum' => 5,
            'lokasi_rak'   => 'Rak C-02',
            'deskripsi'    => 'HDD 3.5 inch SATA 5400RPM',
        ]);

        // --- Periferal ---
        $keyboard = Item::create([
            'nama_barang'  => 'Keyboard Gaming Rexus Daxa M84',
            'category_id'  => $catPeriferal->id,
            'unit_id'      => $unitUnit->id,
            'stok'         => 12,
            'stok_minimum' => 4,
            'lokasi_rak'   => 'Rak F-01',
            'deskripsi'    => 'Keyboard Mekanikal TKL, RGB, Switch Red',
        ]);

        $mouse = Item::create([
            'nama_barang'  => 'Mouse Gaming Logitech G502 X',
            'category_id'  => $catPeriferal->id,
            'unit_id'      => $unitUnit->id,
            'stok'         => 15,
            'stok_minimum' => 5,
            'lokasi_rak'   => 'Rak F-02',
            'deskripsi'    => 'Mouse Gaming wired, sensor HERO 25K, 11 tombol',
        ]);

        $monitor = Item::create([
            'nama_barang'  => 'Monitor Gaming MSI G272QPF 165Hz',
            'category_id'  => $catPeriferal->id,
            'unit_id'      => $unitUnit->id,
            'stok'         => 6,
            'stok_minimum' => 2,
            'lokasi_rak'   => 'Rak F-03',
            'deskripsi'    => 'Monitor 27 inch QHD 165Hz IPS 1ms',
        ]);

        // --- PC Gaming ---
        $pcEntryLevel = Item::create([
            'nama_barang'  => 'PC Gaming Entry Level',
            'category_id'  => $catPCGaming->id,
            'unit_id'      => $unitUnit->id,
            'stok'         => 5,
            'stok_minimum' => 2,
            'lokasi_rak'   => 'Rak G-01',
            'deskripsi'    => 'Ryzen 5 + RTX 3060 + 16GB DDR4 + SSD 512GB',
        ]);

        $pcMidRange = Item::create([
            'nama_barang'  => 'PC Gaming Mid Range',
            'category_id'  => $catPCGaming->id,
            'unit_id'      => $unitUnit->id,
            'stok'         => 3,
            'stok_minimum' => 1,
            'lokasi_rak'   => 'Rak G-02',
            'deskripsi'    => 'Ryzen 7 + RTX 4070 + 32GB DDR5 + SSD 1TB',
        ]);

        $pcHighEnd = Item::create([
            'nama_barang'  => 'PC Gaming High End',
            'category_id'  => $catPCGaming->id,
            'unit_id'      => $unitUnit->id,
            'stok'         => 2,
            'stok_minimum' => 1,
            'lokasi_rak'   => 'Rak G-03',
            'deskripsi'    => 'Ryzen 9 + RTX 5070 + 64GB DDR5 + SSD 2TB NVMe',
        ]);

        // ========================
        // TRANSAKSI BARANG MASUK (Restock dari Supplier)
        // ========================
        $restockItems = [
            ['item' => $rtx5070,    'jumlah' => 20, 'supplier' => 'PT Nvidia Distributor Indonesia', 'days' => 7],
            ['item' => $amdRyzen7,  'jumlah' => 30, 'supplier' => 'CV AMD Jaya Mandiri',             'days' => 6],
            ['item' => $ssdSamsung, 'jumlah' => 50, 'supplier' => 'PT Samsung Electronics Indonesia','days' => 5],
            ['item' => $ramKingston,'jumlah' => 40, 'supplier' => 'PT Kingston Technology',          'days' => 4],
            ['item' => $mobASUS,    'jumlah' => 15, 'supplier' => 'PT ASUS Distributor',             'days' => 3],
            ['item' => $keyboard,   'jumlah' => 25, 'supplier' => 'CV Rexus Gaming',                'days' => 2],
            ['item' => $mouse,      'jumlah' => 30, 'supplier' => 'PT Logitech Indonesia',           'days' => 1],
        ];

        foreach ($restockItems as $rs) {
            $stockBefore = $rs['item']->stok;
            StockIn::create([
                'item_id'      => $rs['item']->id,
                'jumlah'       => $rs['jumlah'],
                'tanggal_masuk'=> now()->subDays($rs['days'])->toDateString(),
                'supplier'     => $rs['supplier'],
                'keterangan'   => 'Restock dari supplier',
                'user_id'      => $staff->id,
            ]);
            StockMutation::create([
                'item_id'      => $rs['item']->id,
                'tipe_mutasi'  => 'in',
                'jumlah'       => $rs['jumlah'],
                'stok_sebelum' => 0,
                'stok_sesudah' => $rs['jumlah'],
                'referensi'    => 'Restock: ' . $rs['supplier'],
                'created_by'   => $staff->id,
                'created_at'   => now()->subDays($rs['days']),
                'updated_at'   => now()->subDays($rs['days']),
            ]);
        }

        // ========================
        // TRANSAKSI BARANG KELUAR (Distribusi ke Divisi Perakitan)
        // ========================
        $outItems = [
            ['item' => $rtx5070,    'jumlah' => 5,  'tujuan' => 'Divisi Perakitan PC',     'days' => 3],
            ['item' => $amdRyzen7,  'jumlah' => 5,  'tujuan' => 'Divisi Perakitan PC',     'days' => 3],
            ['item' => $ssdSamsung, 'jumlah' => 5,  'tujuan' => 'Divisi Perakitan PC',     'days' => 2],
            ['item' => $ramKingston,'jumlah' => 10, 'tujuan' => 'Penjualan Retail',        'days' => 2],
            ['item' => $keyboard,   'jumlah' => 5,  'tujuan' => 'Pengiriman ke Cabang Bali','days' => 1],
            ['item' => $rtx4080,    'jumlah' => 2,  'tujuan' => 'Penjualan Online',        'days' => 1],
        ];

        foreach ($outItems as $out) {
            StockOut::create([
                'item_id'       => $out['item']->id,
                'jumlah'        => $out['jumlah'],
                'tanggal_keluar'=> now()->subDays($out['days'])->toDateString(),
                'tujuan'        => $out['tujuan'],
                'keterangan'    => 'Pengeluaran barang',
                'user_id'       => $staff->id,
            ]);
            StockMutation::create([
                'item_id'      => $out['item']->id,
                'tipe_mutasi'  => 'out',
                'jumlah'       => $out['jumlah'],
                'stok_sebelum' => $out['item']->stok + $out['jumlah'],
                'stok_sesudah' => $out['item']->stok,
                'referensi'    => 'Keluar: ' . $out['tujuan'],
                'created_by'   => $staff->id,
                'created_at'   => now()->subDays($out['days']),
                'updated_at'   => now()->subDays($out['days']),
            ]);
        }
    }
}
