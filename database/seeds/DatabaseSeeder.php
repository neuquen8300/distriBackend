<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(clientSeeder::class);
        $this->call(productSeeder::class);
        DB::table('users')->insert([
            'name' => 'Cacho Perez',
            'email' => 'cachoperez@gmail.com',
            'password' => bcrypt('password123'),
            'role_id' => 3
        ]);
        DB::table('users')->insert([
            'name' => 'Martin Perez',
            'email' => 'martinperez@gmail.com',
            'password' => bcrypt('password123'),
            'role_id' => 2
        ]);
        DB::table('users')->insert([
            'name' => 'Mayorista Perez',
            'email' => 'perezmayorista@gmail.com',
            'password' => bcrypt('password123'),
            'role_id' => 1
        ]);
        DB::table('roles')->insert([
            'name' => 'seller',
            'active' => 1,
        ]);
        DB::table('roles')->insert([
            'name' => 'warehouse',
            'active' => 1,
        ]);
        DB::table('roles')->insert([
            'name' => 'admin',
            'active' => 1,
        ]);
    }
}
