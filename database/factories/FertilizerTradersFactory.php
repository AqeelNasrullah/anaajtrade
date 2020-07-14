<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FertilizerTrader;
use Faker\Generator as Faker;

$factory->define(FertilizerTrader::class, function (Faker $faker) {
    return [
        'name'              =>      $faker->company,
        'phone_number'      =>      '+92 ' . rand(300, 349) . ' ' . rand(1000000, 9999999),
        'address'           =>      $faker->address
    ];
});
