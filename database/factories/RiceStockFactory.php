<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use App\RiceStock;
use App\RiceType;
use App\User;
use Faker\Generator as Faker;

$factory->define(RiceStock::class, function (Faker $faker) {
    return [
        'user_id'               =>      function() {
            return User::all()->random();
        },
        'profile_id'            =>      function() {
            return Profile::all()->random();
        },
        'num_of_sack'           =>      rand(1, 200),
        'weight_per_sack'       =>      65,
        'price'                 =>      1710,
        'commission'            =>      rand(2, 4),
        'rice_type_id'          =>      function() {
            return RiceType::all()->random();
        },
        'category'              =>      'A'
    ];
});
