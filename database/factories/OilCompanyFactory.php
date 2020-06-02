<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OilCompany;
use Faker\Generator as Faker;

$factory->define(OilCompany::class, function (Faker $faker) {
    return [
        'name'                          =>      $faker->company,
        'phone_number'                  =>      $faker->unique()->phoneNumber,
        'address'                       =>      $faker->address
    ];
});
