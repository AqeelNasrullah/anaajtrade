<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WheatStock extends Model
{
    // Filliable Properties
    protected $fillable = [
        'user_id', 'profile_id', 'num_of_sack', 'weight_per_sack', 'price', 'price', 'commission', 'category', 'status'
    ];

    /**
     * Database Relations
     *
     * @return Model filled with data
     */

    // Wheat stock belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Wheat stock belongs to Profile
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

}
