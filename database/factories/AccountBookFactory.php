<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AccountBook;
use App\Profile;
use App\User;
use Faker\Generator as Faker;

$factory->define(AccountBook::class, function (Faker $faker) {
    $types = ['Loan', 'Returned'];
    return [
        'profile_id'            =>  function() {
            return Profile::all()->random();
        },
        'user_id'               =>  function() {
            return User::all()->random();
        },
        'amount'                =>  rand(100, 50000),
        'type'                  =>  $types[array_rand($types)]
    ];
});
