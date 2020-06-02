<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use App\Role;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'name'                          =>      $faker->name,
        'father_name'                   =>      $faker->name,
        'phone_number'                  =>      '+92 ' . rand(300, 349) . ' ' . rand(1000000, 9999999),
        'cnic'                          =>      rand(10000, 99999) . '-' . rand(1000000, 9999999) . '-' . rand(0, 9),
        'address'                       =>      $faker->address,
        'property'                      =>      rand(0, 500)
    ];
});
