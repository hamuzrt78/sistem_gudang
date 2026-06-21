<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Superadmin',
                'email' => 'superadmin@gudang.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$v8wZO07r7u/O5rdjffD2o.CW5uVxH3mLR9BfhPIUTzl79/zVEsE1u',
                'role' => 'superadmin',
                'remember_token' => NULL,
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Staff Gudang',
                'email' => 'staff@gudang.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$sRzWymtZ8TjdUHDWz1MTr.36wrrIQ6wAtFpuATtt389G7Ox.dyoem',
                'role' => 'staff',
                'remember_token' => NULL,
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Pimpinan',
                'email' => 'pimpinan@gudang.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$40Et5seDISCxUsVgF3lr1erFD19YiictU.CjK.qfOd9sqiy9GImJ.',
                'role' => 'pimpinan',
                'remember_token' => NULL,
                'created_at' => '2026-06-19 02:34:19',
                'updated_at' => '2026-06-19 02:34:19',
            ),
        ));
        
        
    }
}