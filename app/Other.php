<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    protected $fillable = [
        'profile_id', 'user_id', 'description', 'amount', 'status'
    ];

    // Other belongs to profile
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    // Other belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
