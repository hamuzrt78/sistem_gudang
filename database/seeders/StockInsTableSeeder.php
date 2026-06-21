<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StockInsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('stock_ins')->delete();
        
        \DB::table('stock_ins')->insert(array (
            0 => 
            array (
                'id' => 1,
                'item_id' => 3,
                'jumlah' => 20,
                'tanggal_masuk' => '2026-06-12',
                'supplier' => 'PT Nvidia Distributor Indonesia',
                'keterangan' => 'Restock dari supplier',
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
                'jumlah' => 30,
                'tanggal_masuk' => '2026-06-13',
                'supplier' => 'CV AMD Jaya Mandiri',
                'keterangan' => 'Restock dari supplier',
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
                'jumlah' => 50,
                'tanggal_masuk' => '2026-06-14',
                'supplier' => 'PT Samsung Electronics Indonesia',
                'keterangan' => 'Restock dari supplier',
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
                'jumlah' => 40,
                'tanggal_masuk' => '2026-06-15',
                'supplier' => 'PT Kingston Technology',
                'keterangan' => 'Restock dari supplier',
                'status' => 'pending_superadmin',
                'user_id' => 2,
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
                'pengajuan_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'item_id' => 5,
                'jumlah' => 15,
                'tanggal_masuk' => '2026-06-16',
                'supplier' => 'PT ASUS Distributor',
                'keterangan' => 'Restock dari supplier',
                'status' => 'pending_superadmin',
                'user_id' => 2,
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
                'pengajuan_id' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'item_id' => 10,
                'jumlah' => 25,
                'tanggal_masuk' => '2026-06-17',
                'supplier' => 'CV Rexus Gaming',
                'keterangan' => 'Restock dari supplier',
                'status' => 'pending_superadmin',
                'user_id' => 2,
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
                'pengajuan_id' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'item_id' => 11,
                'jumlah' => 30,
                'tanggal_masuk' => '2026-06-18',
                'supplier' => 'PT Logitech Indonesia',
                'keterangan' => 'Restock dari supplier',
                'status' => 'pending_superadmin',
                'user_id' => 2,
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
                'pengajuan_id' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'item_id' => 8,
                'jumlah' => 10,
                'tanggal_masuk' => '2026-06-19',
                'supplier' => 'CV Bale Games',
                'keterangan' => 'Kebutuhan Gudang',
                'status' => 'pending_superadmin',
                'user_id' => 2,
                'created_at' => '2026-06-19 02:43:45',
                'updated_at' => '2026-06-19 02:43:45',
                'pengajuan_id' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'item_id' => 9,
                'jumlah' => 10,
                'tanggal_masuk' => '2026-06-19',
                'supplier' => 'CV Bale Games',
                'keterangan' => 'Kebutuhan Gudang',
                'status' => 'pending_superadmin',
                'user_id' => 2,
                'created_at' => '2026-06-19 02:43:45',
                'updated_at' => '2026-06-19 02:43:45',
                'pengajuan_id' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'item_id' => 3,
                'jumlah' => 10,
                'tanggal_masuk' => '2026-06-20',
                'supplier' => 'PT VGA GAMER',
                'keterangan' => 'Restock',
                'status' => 'pending_superadmin',
                'user_id' => 2,
                'created_at' => '2026-06-20 03:23:15',
                'updated_at' => '2026-06-20 03:23:15',
                'pengajuan_id' => 2,
            ),
            10 => 
            array (
                'id' => 11,
                'item_id' => 4,
                'jumlah' => 10,
                'tanggal_masuk' => '2026-06-20',
                'supplier' => 'PT VGA GAMER',
                'keterangan' => 'Restock',
                'status' => 'pending_superadmin',
                'user_id' => 2,
                'created_at' => '2026-06-20 03:23:15',
                'updated_at' => '2026-06-20 03:23:15',
                'pengajuan_id' => 2,
            ),
            11 => 
            array (
                'id' => 12,
                'item_id' => 7,
                'jumlah' => 7,
                'tanggal_masuk' => '2026-06-20',
                'supplier' => 'CV Bale Games',
                'keterangan' => 'Restock',
                'status' => 'pending_superadmin',
                'user_id' => 2,
                'created_at' => '2026-06-20 03:23:49',
                'updated_at' => '2026-06-20 03:23:49',
                'pengajuan_id' => 3,
            ),
            12 => 
            array (
                'id' => 13,
                'item_id' => 15,
                'jumlah' => 5,
                'tanggal_masuk' => '2026-06-20',
                'supplier' => 'CV Bale Games',
                'keterangan' => 'Restock',
                'status' => 'pending_superadmin',
                'user_id' => 2,
                'created_at' => '2026-06-20 03:23:49',
                'updated_at' => '2026-06-20 03:23:49',
                'pengajuan_id' => 3,
            ),
        ));
        
        
    }
}