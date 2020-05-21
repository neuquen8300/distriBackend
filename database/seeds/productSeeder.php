<?php

use Illuminate\Database\Seeder;
use App\Product;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 200)->create();
    }
}
