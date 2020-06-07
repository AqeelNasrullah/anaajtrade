<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WheatRecord extends Model
{
    // Fillable Properties
    protected $fillable = [
        'user_id', 'profile_id', 'quantity', 'price_per_mann', 'paid_per_mann', 'status'
    ];

    /**
     * Database Relations
     *
     * @return Model filled with data
     */

    // Wheat record belongs to user
    public function user()
    {
        $this->belongsTo(User::class);
    }

    // Wheat record belongs to profile
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
