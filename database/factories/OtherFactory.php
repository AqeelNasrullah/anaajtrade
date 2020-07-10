<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Other;
use App\Profile;
use App\User;
use Faker\Generator as Faker;

$factory->define(Other::class, function (Faker $faker) {
    return [
        'profile_id'                =>      function() {
            return Profile::all()->random();
        },
        'user_id'                   =>      function() {
            return User::all()->random();
        },
        'description'               =>      $faker->sentence,
        'amount'                    =>      rand(1000, 50000)
    ];
});
