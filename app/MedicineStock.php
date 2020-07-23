<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineStock extends Model
{
    // Fillable Properties
    protected $fillable = [
        'quantity', 'price', 'type', 'medicine_type_id', 'medicine_trader_id', 'user_id'
    ];

    /**
     * Database Relationships
     */

    //  Medicine Stock belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Medicine Stock belongs to medicine trader
    public function medicineTrader()
    {
        return $this->belongsTo(MedicineTrader::class);
    }

    // Medicien Stock belongs to medicine type
    public function medicineType()
    {
        return $this->belongsTo(MedicineType::class);
    }
}
