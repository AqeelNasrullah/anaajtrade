<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FertilizerStock;
use App\FertilizerTrader;
use App\User;
use Faker\Generator as Faker;

$factory->define(FertilizerStock::class, function (Faker $faker) {
    $fert = ['Urea', 'DAP'];
    return [
        'quantity'                  =>      rand(150, 300),
        'price'                     =>      rand(1200, 1300),
        'type'                      =>      $fert[array_rand($fert)],
        'weight'                    =>      50,
        'fertilizer_trader_id'      =>      function() {
            return FertilizerTrader::all()->random();
        },
        'user_id'                   =>      function() {
            return User::all()->random();
        }
    ];
});
