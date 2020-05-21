<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker; 

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'businessName' => $faker->company,
        'cuit' => $faker->numberBetween(141500003, 203516161),
        'balance' => $faker->randomFloat(2,0, 99999),
        'clientType_id' => $faker->numberBetween(1,5),
        'location_id' => $faker->numberBetween(1,200),
        'active' => $faker->numberBetween(0,1)
    ];
});
