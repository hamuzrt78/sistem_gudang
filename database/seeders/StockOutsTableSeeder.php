<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StockOutsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('stock_outs')->delete();
        
        \DB::table('stock_outs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'item_id' => 3,
                'jumlah' => 5,
                'tanggal_keluar' => '2026-06-16',
                'tujuan' => 'Divisi Perakitan PC',
                'keterangan' => 'Pengeluaran barang',
                'status' => 'pending_superadmin',
                'user_id' => 2,
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
                'pengajuan_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'item_id' => 1,
                'jumlah' => 5,
                'tanggal_keluar' => '2026-06-16',
                'tujuan' => 'Divisi Perakitan PC',
                'keterangan' => 'Pengeluaran barang',
                'status' => 'pending_superadmin',
                'user_id' => 2,
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
                'pengajuan_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'item_id' => 8,
                'jumlah' => 5,
                'tanggal_keluar' => '2026-06-17',
                'tujuan' => 'Divisi Perakitan PC',
                'keterangan' => 'Pengeluaran barang',
                'status' => 'pending_superadmin',
                'user_id' => 2,
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
                'pengajuan_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'item_id' => 6,
                'jumlah' => 10,
                'tanggal_keluar' => '2026-06-17',
                'tujuan' => 'Penjualan Retail',
                'keterangan' => 'Pengeluaran barang',
                'status' => 'pending_superadmin',
                'user_id' => 2,
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
                'pengajuan_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'item_id' => 10,
                'jumlah' => 5,
                'tanggal_keluar' => '2026-06-18',
                'tujuan' => 'Pengiriman ke Cabang Bali',
                'keterangan' => 'Pengeluaran barang',
                'status' => 'pending_superadmin',
                'user_id' => 2,
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
                'pengajuan_id' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'item_id' => 4,
                'jumlah' => 2,
                'tanggal_keluar' => '2026-06-18',
                'tujuan' => 'Penjualan Online',
                'keterangan' => 'Pengeluaran barang',
                'status' => 'pending_superadmin',
                'user_id' => 2,
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
                'pengajuan_id' => NULL,
            ),
        ));
        
        
    }
}