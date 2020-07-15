<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FertilizerTrader extends Model
{
    // Fillable properties
    protected $fillable = [
        'avatar', 'name', 'phone_number', 'address'
    ];

    /**
     * Database Relationships
     */

    // Fertilizer trader belongs to many users
    public function manyUsers()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    // Fertilizer trader has many fertilizer stocks
    public function fertilizerStocks()
    {
        return $this->hasMany(FertilizerStock::class);
    }
}
