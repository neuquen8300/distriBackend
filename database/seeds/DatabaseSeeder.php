<?php

use App\Client;
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
        $this->call(UserSeeder::class);
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
