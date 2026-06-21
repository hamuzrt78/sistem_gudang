<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StockMutationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('stock_mutations')->delete();
        
        \DB::table('stock_mutations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'item_id' => 3,
                'tipe_mutasi' => 'in',
                'jumlah' => 20,
                'stok_sebelum' => 0,
                'stok_sesudah' => 20,
                'referensi' => 'Restock: PT Nvidia Distributor Indonesia',
                'created_by' => 2,
                'created_at' => '2026-06-12 02:34:19',
                'updated_at' => '2026-06-12 02:34:19',
            ),
            1 => 
            array (
                'id' => 2,
                'item_id' => 1,
                'tipe_mutasi' => 'in',
                'jumlah' => 30,
                'stok_sebelum' => 0,
                'stok_sesudah' => 30,
                'referensi' => 'Restock: CV AMD Jaya Mandiri',
                'created_by' => 2,
                'created_at' => '2026-06-13 02:34:19',
                'updated_at' => '2026-06-13 02:34:19',
            ),
            2 => 
            array (
                'id' => 3,
                'item_id' => 8,
                'tipe_mutasi' => 'in',
                'jumlah' => 50,
                'stok_sebelum' => 0,
                'stok_sesudah' => 50,
                'referensi' => 'Restock: PT Samsung Electronics Indonesia',
                'created_by' => 2,
                'created_at' => '2026-06-14 02:34:19',
                'updated_at' => '2026-06-14 02:34:19',
            ),
            3 => 
            array (
                'id' => 4,
                'item_id' => 6,
                'tipe_mutasi' => 'in',
                'jumlah' => 40,
                'stok_sebelum' => 0,
                'stok_sesudah' => 40,
                'referensi' => 'Restock: PT Kingston Technology',
                'created_by' => 2,
                'created_at' => '2026-06-15 02:34:19',
                'updated_at' => '2026-06-15 02:34:19',
            ),
            4 => 
            array (
                'id' => 5,
                'item_id' => 5,
                'tipe_mutasi' => 'in',
                'jumlah' => 15,
                'stok_sebelum' => 0,
                'stok_sesudah' => 15,
                'referensi' => 'Restock: PT ASUS Distributor',
                'created_by' => 2,
                'created_at' => '2026-06-16 02:34:19',
                'updated_at' => '2026-06-16 02:34:19',
            ),
            5 => 
            array (
                'id' => 6,
                'item_id' => 10,
                'tipe_mutasi' => 'in',
                'jumlah' => 25,
                'stok_sebelum' => 0,
                'stok_sesudah' => 25,
                'referensi' => 'Restock: CV Rexus Gaming',
                'created_by' => 2,
                'created_at' => '2026-06-17 02:34:19',
                'updated_at' => '2026-06-17 02:34:19',
            ),
            6 => 
            array (
                'id' => 7,
                'item_id' => 11,
                'tipe_mutasi' => 'in',
                'jumlah' => 30,
                'stok_sebelum' => 0,
                'stok_sesudah' => 30,
                'referensi' => 'Restock: PT Logitech Indonesia',
                'created_by' => 2,
                'created_at' => '2026-06-18 02:34:19',
                'updated_at' => '2026-06-18 02:34:19',
            ),
            7 => 
            array (
                'id' => 8,
                'item_id' => 3,
                'tipe_mutasi' => 'out',
                'jumlah' => 5,
                'stok_sebelum' => 8,
                'stok_sesudah' => 3,
                'referensi' => 'Keluar: Divisi Perakitan PC',
                'created_by' => 2,
                'created_at' => '2026-06-16 02:34:19',
                'updated_at' => '2026-06-16 02:34:19',
            ),
            8 => 
            array (
                'id' => 9,
                'item_id' => 1,
                'tipe_mutasi' => 'out',
                'jumlah' => 5,
                'stok_sebelum' => 20,
                'stok_sesudah' => 15,
                'referensi' => 'Keluar: Divisi Perakitan PC',
                'created_by' => 2,
                'created_at' => '2026-06-16 02:34:19',
                'updated_at' => '2026-06-16 02:34:19',
            ),
            9 => 
            array (
                'id' => 10,
                'item_id' => 8,
                'tipe_mutasi' => 'out',
                'jumlah' => 5,
                'stok_sebelum' => 35,
                'stok_sesudah' => 30,
                'referensi' => 'Keluar: Divisi Perakitan PC',
                'created_by' => 2,
                'created_at' => '2026-06-17 02:34:19',
                'updated_at' => '2026-06-17 02:34:19',
            ),
            10 => 
            array (
                'id' => 11,
                'item_id' => 6,
                'tipe_mutasi' => 'out',
                'jumlah' => 10,
                'stok_sebelum' => 35,
                'stok_sesudah' => 25,
                'referensi' => 'Keluar: Penjualan Retail',
                'created_by' => 2,
                'created_at' => '2026-06-17 02:34:19',
                'updated_at' => '2026-06-17 02:34:19',
            ),
            11 => 
            array (
                'id' => 12,
                'item_id' => 10,
                'tipe_mutasi' => 'out',
                'jumlah' => 5,
                'stok_sebelum' => 17,
                'stok_sesudah' => 12,
                'referensi' => 'Keluar: Pengiriman ke Cabang Bali',
                'created_by' => 2,
                'created_at' => '2026-06-18 02:34:19',
                'updated_at' => '2026-06-18 02:34:19',
            ),
            12 => 
            array (
                'id' => 13,
                'item_id' => 4,
                'tipe_mutasi' => 'out',
                'jumlah' => 2,
                'stok_sebelum' => 10,
                'stok_sesudah' => 8,
                'referensi' => 'Keluar: Penjualan Online',
                'created_by' => 2,
                'created_at' => '2026-06-18 02:34:19',
                'updated_at' => '2026-06-18 02:34:19',
            ),
            13 => 
            array (
                'id' => 14,
                'item_id' => 8,
                'tipe_mutasi' => 'in',
                'jumlah' => 10,
                'stok_sebelum' => 30,
                'stok_sesudah' => 40,
                'referensi' => 'KB-19-06-001',
                'created_by' => 3,
                'created_at' => '2026-06-19 02:45:39',
                'updated_at' => '2026-06-19 02:45:39',
            ),
            14 => 
            array (
                'id' => 15,
                'item_id' => 9,
                'tipe_mutasi' => 'in',
                'jumlah' => 10,
                'stok_sebelum' => 20,
                'stok_sesudah' => 30,
                'referensi' => 'KB-19-06-001',
                'created_by' => 3,
                'created_at' => '2026-06-19 02:45:39',
                'updated_at' => '2026-06-19 02:45:39',
            ),
        ));
        
        
    }
}