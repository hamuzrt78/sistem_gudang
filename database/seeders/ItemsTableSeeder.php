<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('items')->delete();
        
        \DB::table('items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'kode_barang' => 'BRG-0001',
                'nama_barang' => 'AMD Ryzen 7 9800X3D',
                'harga' => 7300000,
                'category_id' => 1,
                'unit_id' => 1,
                'stok' => 15,
                'stok_minimum' => 5,
                'lokasi_rak' => 'Rak B-02',
                'deskripsi' => 'Processor AMD Ryzen 7 9800X3D AM5, 3D V-Cache Technology',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            1 => 
            array (
                'id' => 2,
                'kode_barang' => 'BRG-0002',
                'nama_barang' => 'Intel Core i7-14700K',
                'harga' => 6800000,
                'category_id' => 1,
                'unit_id' => 1,
                'stok' => 10,
                'stok_minimum' => 3,
                'lokasi_rak' => 'Rak B-03',
                'deskripsi' => 'Processor Intel Core i7-14700K LGA1700',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            2 => 
            array (
                'id' => 3,
                'kode_barang' => 'BRG-0003',
                'nama_barang' => 'NVIDIA GeForce RTX 5070',
                'harga' => 15000000,
                'category_id' => 2,
                'unit_id' => 1,
                'stok' => 3,
                'stok_minimum' => 5,
                'lokasi_rak' => 'Rak A-01',
                'deskripsi' => 'VGA RTX 5070 GDDR7 12GB, DLSS 4, Ray Tracing',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            3 => 
            array (
                'id' => 4,
                'kode_barang' => 'BRG-0004',
                'nama_barang' => 'NVIDIA GeForce RTX 4080 Super',
                'harga' => 30000000,
                'category_id' => 2,
                'unit_id' => 1,
                'stok' => 8,
                'stok_minimum' => 3,
                'lokasi_rak' => 'Rak A-02',
                'deskripsi' => 'VGA RTX 4080 Super GDDR6X 16GB',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            4 => 
            array (
                'id' => 5,
                'kode_barang' => 'BRG-0005',
                'nama_barang' => 'ASUS ROG Strix X870-E Gaming',
                'harga' => 8200000,
                'category_id' => 3,
                'unit_id' => 1,
                'stok' => 7,
                'stok_minimum' => 2,
                'lokasi_rak' => 'Rak D-01',
                'deskripsi' => 'Motherboard AMD AM5, DDR5, PCIe 5.0',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            5 => 
            array (
                'id' => 6,
                'kode_barang' => 'BRG-0006',
                'nama_barang' => 'Kingston Fury Beast DDR5 16GB',
                'harga' => 1500000,
                'category_id' => 4,
                'unit_id' => 2,
                'stok' => 25,
                'stok_minimum' => 8,
                'lokasi_rak' => 'Rak E-01',
                'deskripsi' => 'RAM DDR5 16GB 5200MHz CL40',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            6 => 
            array (
                'id' => 7,
                'kode_barang' => 'BRG-0007',
                'nama_barang' => 'Corsair Vengeance DDR5 32GB',
                'harga' => 2800000,
                'category_id' => 4,
                'unit_id' => 2,
                'stok' => 4,
                'stok_minimum' => 5,
                'lokasi_rak' => 'Rak E-02',
            'deskripsi' => 'RAM DDR5 32GB 6000MHz CL36 Kit (2x16GB)',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            7 => 
            array (
                'id' => 8,
                'kode_barang' => 'BRG-0008',
                'nama_barang' => 'Samsung 990 Pro SSD NVMe 1TB',
                'harga' => 2200000,
                'category_id' => 5,
                'unit_id' => 1,
                'stok' => 40,
                'stok_minimum' => 10,
                'lokasi_rak' => 'Rak C-01',
                'deskripsi' => 'SSD NVMe M.2 PCIe 4.0, Read 7450MB/s',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:45:39',
            ),
            8 => 
            array (
                'id' => 9,
                'kode_barang' => 'BRG-0009',
                'nama_barang' => 'WD Blue HDD 2TB',
                'harga' => 800000,
                'category_id' => 5,
                'unit_id' => 1,
                'stok' => 30,
                'stok_minimum' => 5,
                'lokasi_rak' => 'Rak C-02',
                'deskripsi' => 'HDD 3.5 inch SATA 5400RPM',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:45:39',
            ),
            9 => 
            array (
                'id' => 10,
                'kode_barang' => 'BRG-0010',
                'nama_barang' => 'Keyboard Gaming Rexus Daxa M84',
                'harga' => 700000,
                'category_id' => 6,
                'unit_id' => 1,
                'stok' => 12,
                'stok_minimum' => 4,
                'lokasi_rak' => 'Rak F-01',
                'deskripsi' => 'Keyboard Mekanikal TKL, RGB, Switch Red',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            10 => 
            array (
                'id' => 11,
                'kode_barang' => 'BRG-0011',
                'nama_barang' => 'Mouse Gaming Logitech G502 X',
                'harga' => 3500000,
                'category_id' => 6,
                'unit_id' => 1,
                'stok' => 15,
                'stok_minimum' => 5,
                'lokasi_rak' => 'Rak F-02',
                'deskripsi' => 'Mouse Gaming wired, sensor HERO 25K, 11 tombol',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            11 => 
            array (
                'id' => 12,
                'kode_barang' => 'BRG-0012',
                'nama_barang' => 'Monitor Gaming MSI G272QPF 165Hz',
                'harga' => 12000000,
                'category_id' => 6,
                'unit_id' => 1,
                'stok' => 6,
                'stok_minimum' => 2,
                'lokasi_rak' => 'Rak F-03',
                'deskripsi' => 'Monitor 27 inch QHD 165Hz IPS 1ms',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            12 => 
            array (
                'id' => 13,
                'kode_barang' => 'BRG-0013',
                'nama_barang' => 'PC Gaming Entry Level',
                'harga' => 20000000,
                'category_id' => 7,
                'unit_id' => 1,
                'stok' => 5,
                'stok_minimum' => 2,
                'lokasi_rak' => 'Rak G-01',
                'deskripsi' => 'Ryzen 5 + RTX 3060 + 16GB DDR4 + SSD 512GB',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            13 => 
            array (
                'id' => 14,
                'kode_barang' => 'BRG-0014',
                'nama_barang' => 'PC Gaming Mid Range',
                'harga' => 45000000,
                'category_id' => 7,
                'unit_id' => 1,
                'stok' => 3,
                'stok_minimum' => 1,
                'lokasi_rak' => 'Rak G-02',
                'deskripsi' => 'Ryzen 7 + RTX 4070 + 32GB DDR5 + SSD 1TB',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            14 => 
            array (
                'id' => 15,
                'kode_barang' => 'BRG-0015',
                'nama_barang' => 'PC Gaming High End',
                'harga' => 45000000,
                'category_id' => 7,
                'unit_id' => 1,
                'stok' => 2,
                'stok_minimum' => 1,
                'lokasi_rak' => 'Rak G-03',
                'deskripsi' => 'Ryzen 9 + RTX 5070 + 64GB DDR5 + SSD 2TB NVMe',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
        ));
        
        
    }
}