<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MedicineStock;
use App\MedicineTrader;
use App\MedicineType;
use App\User;
use Faker\Generator as Faker;

$factory->define(MedicineStock::class, function (Faker $faker) {
    $types = ['Poison', 'Spray'];
    $ind = array_rand($types);
    return [
        'quantity'                  =>      rand(20, 75),
        'price'                     =>      850,
        'type'                      =>      $types[$ind],
        'medicine_type_id'          =>      function() {
            return MedicineType::all()->random();
        },
        'medicine_trader_id'        =>      function() {
            return MedicineTrader::all()->random();
        },
        'user_id'                   =>      function() {
            return User::all()->random();
        }
    ];
});
