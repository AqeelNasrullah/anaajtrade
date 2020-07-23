<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineType extends Model
{
    // Fillable Properties
    protected $fillable = [
        'name', 'type'
    ];

    /**
     * Database Relations
     */

    // Medicine type  has many medicine stocks
    public function medicineStocks()
    {
        return $this->hasMany(MedicineStock::class);
    }
}
