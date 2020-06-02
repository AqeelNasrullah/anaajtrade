<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OilRecord extends Model
{
    // Fillable Properties
    protected $fillable = [
        'quantity', 'price_per_litre', 'paid_per_litre', 'user_id', 'filling_station_id', 'profile_id', 'status'
    ];

    /**
     * Database Relations
     *
     * @return Model filled with data
     */

    // Oil record belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Oil record bleongs to filling station
    public function fillingStation()
    {
        return $this->belongsTo(FillingStation::class);
    }

    // Oil record belongs to profile
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
