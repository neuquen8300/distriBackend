<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
