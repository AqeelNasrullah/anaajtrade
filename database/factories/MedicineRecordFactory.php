<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MedicineRecord;
use App\MedicineType;
use App\Profile;
use App\User;
use Faker\Generator as Faker;

$factory->define(MedicineRecord::class, function (Faker $faker) {
    $types = ['Poison', 'Spray'];
    $ind = array_rand($types);
    return [
        'quantity'                  =>      rand(20, 75),
        'price'                     =>      850,
        'paid'                      =>      870,
        'type'                      =>      $types[$ind],
        'medicine_type_id'          =>      function() {
            return MedicineType::all()->random();
        },
        'profile_id'                =>      function() {
            return Profile::all()->random();
        },
        'user_id'                   =>      function() {
            return User::all()->random();
        }
    ];
});
