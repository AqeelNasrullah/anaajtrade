<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use App\User;
use App\WheatStock;
use Faker\Generator as Faker;

$factory->define(WheatStock::class, function (Faker $faker) {
    return [
        'user_id'               =>      function() {
            return User::all()->random();
        },
        'profile_id'            =>      function() {
            return Profile::all()->random();
        },
        'no_of_sacks'           =>      rand(1, 200),
        'weight_per_sack'       =>      65,
        'price'                 =>      1710,
        'commission'            =>      rand(2, 4),
        'category'              =>      'A'
    ];
});
