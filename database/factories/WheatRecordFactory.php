<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use App\User;
use App\WheatRecord;
use Faker\Generator as Faker;

$factory->define(WheatRecord::class, function (Faker $faker) {
    return [
        'user_id'               =>      function() {
            return User::all()->random();
        },
        'profile_id'               =>      function() {
            return Profile::all()->random();
        },
        'quantity'              =>      rand(10, 50),
        'price_per_mann'        =>      1710,
        'paid_per_mann'         =>      1740
    ];
});
