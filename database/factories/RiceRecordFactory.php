<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use App\RiceRecord;
use App\RiceType;
use App\User;
use Faker\Generator as Faker;

$factory->define(RiceRecord::class, function (Faker $faker) {
    return [
        'user_id'               =>      function() {
            return User::all()->random();
        },
        'profile_id'               =>      function() {
            return Profile::all()->random();
        },
        'quantity'              =>      rand(40, 500),
        'price_per_mann'        =>      1710,
        'paid_per_mann'         =>      1740,
        'rice_type_id'          =>      function() {
            return RiceType::all()->random();
        },
        'category'              =>      'A'
    ];
});
