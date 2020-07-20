<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FertilizerRecord;
use App\Profile;
use App\User;
use Faker\Generator as Faker;

$factory->define(FertilizerRecord::class, function (Faker $faker) {
    $type = ['Urea', 'DAP'];
    return [
        'quantity'                  =>      rand(10, 50),
        'weight'                    =>      50,
        'price'                     =>      1200,
        'paid'                      =>      1230,
        'type'                      =>      $type[array_rand($type)],
        'profile_id'                =>      function() {
            return Profile::all()->random();
        },
        'user_id'                   =>      function() {
            return User::all()->random();
        }
    ];
});
