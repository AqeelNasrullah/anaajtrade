<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
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

    // User has many account books
    public function accountBooks()
    {
        return $this->hasMany(AccountBook::class);
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

    // User has many others
    public function others()
    {
        return $this->hasMany(Other::class);
    }



    /*---------------------------------------------------------------------------------------*/

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
