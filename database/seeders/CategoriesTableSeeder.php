<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nama_kategori' => 'Processor',
                'deskripsi' => 'CPU / Prosesor AMD & Intel',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            1 => 
            array (
                'id' => 2,
                'nama_kategori' => 'VGA',
                'deskripsi' => 'Kartu Grafis / Graphics Card',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            2 => 
            array (
                'id' => 3,
                'nama_kategori' => 'Motherboard',
                'deskripsi' => 'Papan Induk / Mainboard',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            3 => 
            array (
                'id' => 4,
                'nama_kategori' => 'RAM',
                'deskripsi' => 'Memory / RAM DDR4 & DDR5',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            4 => 
            array (
                'id' => 5,
                'nama_kategori' => 'Storage',
                'deskripsi' => 'SSD NVMe & HDD',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            5 => 
            array (
                'id' => 6,
                'nama_kategori' => 'Periferal',
                'deskripsi' => 'Keyboard, Mouse, Headset, Monitor Gaming',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            6 => 
            array (
                'id' => 7,
                'nama_kategori' => 'PC Gaming',
            'deskripsi' => 'Unit PC Gaming siap pakai (Entry, Mid, High End)',
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
        ));
        
        
    }
}