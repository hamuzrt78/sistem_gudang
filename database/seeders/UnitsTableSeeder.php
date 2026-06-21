<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('units')->delete();
        
        \DB::table('units')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama_satuan' => 'Unit',
                'simbol' => 'unit',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            1 => 
            array (
                'id' => 2,
                'nama_satuan' => 'Pcs',
                'simbol' => 'pcs',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            2 => 
            array (
                'id' => 3,
                'nama_satuan' => 'Box',
                'simbol' => 'box',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
        ));
        
        
    }
}