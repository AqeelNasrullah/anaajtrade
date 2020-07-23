<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineTrader extends Model
{
    // Fillable Properties
    protected $fillable = [
        'avatar', 'name', 'phone_number', 'address'
    ];

    /**
     * Database Relationships
     */

    // Medicine traders belongs to many users
    public function manyUsers()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    // Medicine trader has many medicine stocks
    public function medicineStocks()
    {
        return $this->hasMany(MedicineStock::class);
    }
}
