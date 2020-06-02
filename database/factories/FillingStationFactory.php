<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FillingStation;
use App\OilCompany;
use Faker\Generator as Faker;

$factory->define(FillingStation::class, function (Faker $faker) {
    return [
        'name'                          =>      $faker->company,
        'phone_number'                  =>      $faker->unique()->phoneNumber,
        'address'                       =>      $faker->address,
        'oil_company_id'                =>      function() {
            return OilCompany::all()->random();
        }
    ];
});
