<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FillingStationUser extends Model
{
    // Fillable Properties
    protected $fillable = [
        'filling_station_id', 'user_id'
    ];
    protected $table = 'filling_station_user';
}
