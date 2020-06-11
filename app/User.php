<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Fillable Properties
    protected $fillable = [
        'phone_number', 'password', 'profile_id'
    ];

    /**
     * Database Relations
     *
     * @return Model filled with data
     */

    // User belongs to profile
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    // User belongs to many filling stations
    public function manyFillingStations()
    {
        return $this->belongsToMany(FillingStation::class);
    }

    // User belongs to many profiles
    public function manyProfiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    // User has many oil records
    public function oilRecords()
    {
        return $this->hasMany(OilRecord::class);
    }

    // User has many wheat stocks
    public function wheatStocks()
    {
        return $this->hasMany(WheatStock::class);
    }

    // User has many Wheat records
    public function wheatRecords()
    {
        return $this->hasMany(WheatRecord::class);
    }

    // User has many rice stocks
    public function riceStocks()
    {
        return $this->hasMany(RiceStock::class);
    }

    // User has many rice records
    public function riceRecords()
    {
        return $this->hasMany(RiceRecord::class);
    }
}
