<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountBook extends Model
{
    // Fillable Properties
    protected $fillable = ['profile_id', 'user_id', 'amount', 'type', 'status'];

    // Account book belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Account book belongs to Profile
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
