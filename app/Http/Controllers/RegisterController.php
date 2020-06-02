<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function addProfile()
    {
        // $profile = Profile::create([
        //     'avatar'                        =>      'aqeel.jpg',
        //     'name'                          =>      'Aqeel Nasrullah',
        //     'father_name'                   =>      'Muhammad Nasrullah',
        //     'phone_number'                  =>      '+92 306 9203074',
        //     'cnic'                          =>      '34101-8548933-7',
        //     'address'                       =>      'Near Masjid e Quba, Madina town, Mandiala Warraich, Gujranwala',
        //     'property'                      =>      8,
        //     'role_id'                       =>      3
        // ]);

        // if($profile) {
        //     echo 'Profile Added ...';
        // } else {
        //     echo 'An Error occured while adding profile.';
        // }
    }

    public function addUser()
    {
        // $user = User::create([
        //     'phone_number'                  =>      '+92 306 9203074',
        //     'password'                      =>      Hash::make('password'),
        //     'profile_id'                    =>      51
        // ]);
        // if ($user) {
        //     echo 'User Added ...';
        // } else {
        //     echo 'An Error occured while adding user.';
        // }
    }
}
