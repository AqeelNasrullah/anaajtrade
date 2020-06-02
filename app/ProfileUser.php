<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileUser extends Model
{
    // Fillable Properties
    protected $fillable = [
        'profile_id', 'user_id'
    ];
    protected $table = 'profile_user';
}
