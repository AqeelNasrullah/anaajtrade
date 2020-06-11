<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiceStock extends Model
{
    // Fillable Properties
    protected $fillable = [
        'user_id', 'profile_id', 'num_of_sack', 'weight_per_sack', 'price', 'commission', 'rice_type_id', 'category', 'status'
    ];

    /**
     * Database Relations
     *
     * @return Model filled with data
     */

    // Rice stock belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Rice stock belongs to profile
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    // Rice stock belongs to rice type
    public function riceType()
    {
        return $this->belongsTo(RiceType::class);
    }
}
