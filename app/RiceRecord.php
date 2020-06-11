<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiceRecord extends Model
{
    // Fillable Properties
    protected $fillable = [
        'user_id', 'profile_id', 'quantity', 'price_per_mann', 'paid_per_mann', 'rice_type_id', 'category', 'status'
    ];

    /**
     * Database Relations
     *
     * @return Model filled with data
     */

    // Rice record belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Rice record belongs to profile
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    // Rice record belongs to rice type
    public function riceType()
    {
        return $this->belongsTo(RiceType::class);
    }
}
