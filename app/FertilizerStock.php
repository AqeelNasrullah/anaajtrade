<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FertilizerStock extends Model
{
    // Fillable Properties
    protected $fillable = [
        'quantity', 'price', 'type', 'weight', 'fertilizer_trader_id', 'user_id'
    ];

    /**
     * Database Relationships
     */

    // Fertilizer stock belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Fertilizer stock belongs to fertilizer trader
    public function fertilizerTrader()
    {
        return $this->belongsTo(FertilizerTrader::class);
    }
}
