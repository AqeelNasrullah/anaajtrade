<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FillingStation;
use App\OilRecord;
use App\Profile;
use App\User;
use Faker\Generator as Faker;

$factory->define(OilRecord::class, function (Faker $faker) {
    return [
        'quantity'                      =>      rand(100, 300),
        'price_per_litre'               =>      80,
        'paid_per_litre'                =>      84,
        'user_id'                       =>      function() {
            return User::all()->random();
        },
        'filling_station_id'            =>      function() {
            return FillingStation::all()->random();
        },
        'profile_id'                    =>      function() {
            return Profile::all()->random();
        }
    ];
});
