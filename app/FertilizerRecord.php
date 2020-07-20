<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FertilizerRecord extends Model
{
    // Fillable properties
    protected $fillable = [
        'quantity', 'weight', 'price', 'paid', 'type', 'user_id', 'profile_id', 'status'
    ];

    /**
     * Database Relationships
     */

    // Fertilizer record belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Fertilizer record belongs to profile
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
