<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PengajuansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pengajuans')->delete();
        
        \DB::table('pengajuans')->insert(array (
            0 => 
            array (
                'id' => 1,
                'kode_pengajuan' => 'KB-19-06-001',
                'tipe' => 'in',
                'user_id' => 2,
                'status' => 'approved',
                'tanggal' => '2026-06-19',
                'supplier_tujuan' => 'CV Bale Games',
                'keterangan_umum' => 'Kebutuhan Gudang',
                'created_at' => '2026-06-19 02:43:45',
                'updated_at' => '2026-06-19 02:45:39',
            ),
            1 => 
            array (
                'id' => 2,
                'kode_pengajuan' => 'KB-20-06-001',
                'tipe' => 'in',
                'user_id' => 2,
                'status' => 'pending_superadmin',
                'tanggal' => '2026-06-20',
                'supplier_tujuan' => 'PT VGA GAMER',
                'keterangan_umum' => 'Restock',
                'created_at' => '2026-06-20 03:23:15',
                'updated_at' => '2026-06-20 03:23:15',
            ),
            2 => 
            array (
                'id' => 3,
                'kode_pengajuan' => 'KB-20-06-002',
                'tipe' => 'in',
                'user_id' => 2,
                'status' => 'pending_superadmin',
                'tanggal' => '2026-06-20',
                'supplier_tujuan' => 'CV Bale Games',
                'keterangan_umum' => 'Restock',
                'created_at' => '2026-06-20 03:23:49',
                'updated_at' => '2026-06-20 03:23:49',
            ),
        ));
        
        
    }
}