<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'brand' => $faker->company,
        'price' => $faker->randomFloat(2, 0, 9999),
        'unitsPerBox' => $faker->numberBetween(1, 12),
        'byWeight' => $faker->numberBetween(0, 1),
        'provider_id' => $faker->numberBetween(1, 8),
        'active' => $faker->numberBetween(0, 1)
    ];
});
